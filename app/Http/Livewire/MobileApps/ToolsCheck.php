<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\ToolsCheck as ToolsCheckModel;
use App\Models\Toolbox;
use Illuminate\Support\Arr;
use App\Models\EmployeeProject;
use App\Models\ClientProjectRegion;
use App\Models\SubRegion;
use Livewire\WithPagination;

class ToolsCheck extends Component
{
    public $keyword,$employee_id,$tahun,$bulan,$toolboxs,$region=[],$sub_region=[],$region_id,$sub_region_id,$user_access_id;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = $this->init_data();
        
        return view('livewire.mobile-apps.tools-check')->with(['data'=>$data->paginate(100)]);
    }

    public function init_data()
    {
        $data = ToolsCheckModel::select('tools_check.*','employees.name')
                            ->with(['_employee','region','sub_region','toolsboxCheck'])
                            ->orderBy('tools_check.updated_at','DESC')
                            ->join('employees','employees.id','=','employee_id');
        
        if($this->tahun) $data->where('tahun',$this->tahun);
        if($this->bulan) $data->where('bulan',$this->bulan);
        if($this->region_id) {
            $data->where('tools_check.region_id',$this->region_id);
        }
        if($this->sub_region_id) $data->where('tools_check.sub_region_id',$this->sub_region_id);
        if($this->user_access_id) $data->where('employees.user_access_id',$this->user_access_id);
        if($this->keyword) $data->where(function($table){
                                        $table->where('name',"LIKE","%{$this->keyword}%")
                                                ->orWhere('nik',"LIKE","%{$this->keyword}%");
                                    });
        if(check_access('all-project.index'))
            $client_project_ids = [session()->get('project_id')];
        else
            $client_project_ids = Arr::pluck(EmployeeProject::select('client_project_id')->where(['employee_id'=>\Auth::user()->employee->id])->get()->toArray(),'client_project_id');
        
        $data->whereIn('tools_check.client_project_id',$client_project_ids);

        return $data;
    }
 
    public function updated($propertyName)
    {
        if($this->region_id) $this->sub_region = SubRegion::where('region_id',$this->region_id)->get();
    }

    public function clear_filter()
    {
        $this->reset(['keyword','user_access_id','region_id','sub_region_id','tahun','bulan']);
    }

    public function mount()
    {
        \LogActivity::add('[web] Performance KPI Tools Check');

        $this->toolboxs = Toolbox::orderBy('name')->get();
        $this->region = ClientProjectRegion::select('region.*')
                                                ->where('client_project_id',session()->get('project_id'))
                                                ->join('region','region.id','client_project_region.region_id')
                                                ->groupBy('region.id')
                                                ->get();
    }

    public function downloadExcel()
    {
        $objPHPExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("PMT System")
                                    ->setLastModifiedBy("Stalavista System")
                                    ->setTitle("Office 2007 XLSX Product Database")
                                    ->setSubject("Tools Check")
                                    ->setDescription("Tools Check")
                                    ->setKeywords("office 2007 openxml php")
                                    ->setCategory("Tools Check");

        $activeSheet = $objPHPExcel->setActiveSheetIndex(0);
        $activeSheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('689a3b');
        $activeSheet->setCellValue('B1', 'Tools Check');
        $activeSheet->mergeCells("B1:D1");
        $activeSheet->getRowDimension('1')->setRowHeight(34);
        $activeSheet->getStyle('B1')->getFont()->setSize(16);
        $activeSheet->getStyle('B1')->getAlignment()->setWrapText(false);
        
        $data = $this->init_data()->get();
        $activeSheet
                    ->setCellValue('A4', 'No')
                    ->setCellValue('B4', 'Region')
                    ->setCellValue('C4', 'Sub Region')
                    ->setCellValue('D4', 'NIK')
                    ->setCellValue('E4', 'Employee')
                    ->setCellValue('F4', 'Year')
                    ->setCellValue('G4', 'Month');
        $num_alpha = 7;
        $last_alpha = '';
        foreach($this->toolboxs as $k => $item){
            $activeSheet->getColumnDimension(num2alpha($k+$num_alpha))->setAutoSize(true);
            $activeSheet
                    ->setCellValue(num2alpha($k+$num_alpha)."4", $item->name);
            $last_alpha = num2alpha($k+$num_alpha);
        }
        $activeSheet->getStyle("A4:{$last_alpha}4")->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('c2d7f3');
        
        $num=5;
        foreach($data as $k => $i){
            $activeSheet
                ->setCellValue('A'.$num,($k+1))
                ->setCellValue('B'.$num,isset($i->region->region) ? $i->region->region : '')
                ->setCellValue('C'.$num,isset($i->sub_region->name) ? $i->sub_region->name : '')
                ->setCellValue('D'.$num,isset($i->_employee->nik) ? $i->_employee->nik : '')
                ->setCellValue('E'.$num,isset($i->_employee->name) ? $i->_employee->name : '')
                ->setCellValue('F'.$num,$i->tahun)
                ->setCellValue('G'.$num,$i->bulan);

                if(isset($i->toolsboxCheck)){
                    foreach($this->toolboxs as $k2 => $tool){
                        $upload = $i->toolsboxCheck->where('toolbox_id',$tool->id)->first();
                        $status = '-';
                        if($upload->status==1) $status='Baik';
                        if($upload->status==2) $status='Rusak';
                        $activeSheet->setCellValue(num2alpha($k2+$num_alpha).$num, $status);
                    }
                }

            $num++;
        }

        // Rename worksheet
        $activeSheet->setTitle('Tools Check');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="tools-check.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        //header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
        header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header ('Pragma: public'); // HTTP/1.0
        return response()->streamDownload(function() use($writer){
            $writer->save('php://output');
        },'tools-check.xlsx');
    }
}