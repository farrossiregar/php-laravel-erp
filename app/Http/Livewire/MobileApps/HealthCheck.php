<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\HealthCheck as HealthCheckModel;
use Livewire\WithPagination;
use App\Models\Region;
use App\Models\SubRegion;
use Illuminate\Support\Arr;
use App\Models\EmployeeProject;
use App\Models\ClientProjectRegion;

class HealthCheck extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    public $date_start,$date_end,$keyword,$region=[],$sub_region=[],$region_id,$sub_region_id,$user_access_id;
    public $selected_id;
    
    public function render()
    {
        $data = HealthCheckModel::with(['employee.access','region','sub_region'])->select('employees.name','health_check.*')->orderBy('health_check.is_submit','DESC')->orderBy('health_check.updated_at','DESC')->join('employees','employees.id','=','employee_id');

        if($this->keyword) $data->where(function($table){
            $table->where('employees.name',"LIKE", "%{$this->keyword}%")
                ->orWhere('employees.nik',$this->keyword);
        });
        if($this->date_start and $this->date_end){
            if($this->date_start == $this->date_end)
                $data->whereDate('health_check.created_at',$this->date_start);
            else
                $data->whereBetween('health_check.created_at',[$this->date_start,$this->date_end]);
        } 
        if($this->region_id) {
            $data->where('health_check.region_id',$this->region_id);
            $this->sub_region = SubRegion::where('region_id',$this->region_id)->get();
        }
        if($this->sub_region_id) $data->where('health_check.sub_region_id',$this->sub_region_id);
        if($this->user_access_id) $data->where('employees.user_access_id',$this->user_access_id);

        if(check_access('all-project.index'))
            $client_project_ids = [session()->get('project_id')];
        else
            $client_project_ids = Arr::pluck(EmployeeProject::select('client_project_id')->where(['employee_id'=>\Auth::user()->employee->id])->get()->toArray(),'client_project_id');
        
        $data->whereIn('health_check.client_project_id',$client_project_ids);
        
        return view('livewire.mobile-apps.health-check')->with(['data'=>$data->paginate(100)]);
    }

    public function clear_filter()
    {
        $this->reset(['keyword','date_start','date_end','user_access_id','region_id','sub_region_id']);
        $this->emit('clear_daterange');
    }

    public function updated($propertyName)
    {
        if($this->region_id) $this->sub_region = SubRegion::where('region_id',$this->region_id)->get();
    }

    public function mount()
    {
        \LogActivity::add('[web] Performance KPI HC');
        $this->region = ClientProjectRegion::select('region.*')
                                                ->where('client_project_id',session()->get('project_id'))
                                                ->join('region','region.id','client_project_region.region_id')
                                                ->groupBy('region.id')
                                                ->get();
    }

    public function set_id(HealthCheckModel $data)
    {
        $this->selected_id = $data;
    }

    public function delete()
    {
        if($this->selected_id){
            $this->selected_id->delete();;
        }

        $this->reset(['selected_id']);
        $this->emit('message-success','Data berhasil di hapus');
        $this->emit('refresh-page');
    }

    public function downloadExcel()
    {
        $objPHPExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("PMT System")
                                    ->setLastModifiedBy("Stalavista System")
                                    ->setTitle("Office 2007 XLSX Product Database")
                                    ->setSubject("Health Check")
                                    ->setDescription("Health Check")
                                    ->setKeywords("office 2007 openxml php")
                                    ->setCategory("Health Check");

        $activeSheet = $objPHPExcel->setActiveSheetIndex(0);
        $activeSheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('689a3b');
        $activeSheet->setCellValue('B1', 'HEALTH CHECK');
        $activeSheet->mergeCells("B1:D1");
        $activeSheet->getRowDimension('1')->setRowHeight(34);
        $activeSheet->getStyle('B1')->getFont()->setSize(16);
        $activeSheet->getStyle('B1')->getAlignment()->setWrapText(false);
        $activeSheet->getStyle('A4:O4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('c2d7f3');
        $activeSheet
                    ->setCellValue('A4', 'No')
                    ->setCellValue('B4', 'Region')
                    ->setCellValue('C4', 'Sub Region')
                    ->setCellValue('D4', 'NIK')
                    ->setCellValue('E4', 'Employee')
                    ->setCellValue('F4', 'Jobe Role/Access')
                    ->setCellValue('G4', 'Date')
                    ->setCellValue('H4', 'Perusahaan')
                    ->setCellValue('I4', 'Lokasi Kantor')
                    ->setCellValue('J4', 'Department')
                    ->setCellValue('K4', 'Status Bekerja Hari ini')
                    ->setCellValue('L4', 'Kondisi Badan')
                    ->setCellValue('M4', 'Tinggal Dengan Keluarga Terkonfirmasi Covid 19')
                    ->setCellValue('N4', 'Apakah anda bepergian keluar kota')
                    ->setCellValue('O4', 'Apakah anda ada mengunjungi keluarga yang sedang dirawat di rumah sakit dalam 3 hari terakhir');

        $activeSheet->getColumnDimension('A')->setWidth(5);
        $activeSheet->getColumnDimension('B')->setAutoSize(true);
        $activeSheet->getColumnDimension('C')->setAutoSize(true);
        $activeSheet->getColumnDimension('D')->setAutoSize(true);
        $activeSheet->getColumnDimension('E')->setAutoSize(true);
        $activeSheet->getColumnDimension('F')->setAutoSize(true);
        $activeSheet->getColumnDimension('G')->setAutoSize(true);
        $activeSheet->getColumnDimension('H')->setAutoSize(true);
        $activeSheet->getColumnDimension('I')->setAutoSize(true);
        $activeSheet->getColumnDimension('J')->setAutoSize(true);
        $activeSheet->getColumnDimension('K')->setAutoSize(true);
        $activeSheet->getColumnDimension('L')->setAutoSize(true);
        $activeSheet->getColumnDimension('M')->setAutoSize(true);
        $activeSheet->getColumnDimension('N')->setAutoSize(true);
        $activeSheet->getColumnDimension('O')->setAutoSize(true);
        $num=5;

        $data = HealthCheckModel::with(['employee.access'])->select('employees.name','health_check.*')->orderBy('health_check.id','DESC')->join('employees','employees.id','=','employee_id');

        if($this->keyword) $data->where('employees.name',"LIKE", "%{$this->keyword}%");
        if($this->date_start and $this->date_end){
            if($this->date_start == $this->date_end)
                $data->whereDate('health_check.created_at',$this->date_start);
            else
                $data->whereBetween('health_check.created_at',[$this->date_start,$this->date_end]);
        } 
        foreach($data->get() as $k => $i){
            $activeSheet
                ->setCellValue('A'.$num,($k+1))
                ->setCellValue('B'.$num,isset($i->region->region) ? $i->region->region : '')
                ->setCellValue('C'.$num,isset($i->sub_region->name) ? $i->sub_region->name : '')
                ->setCellValue('D'.$num,isset($i->employee->nik) ? $i->employee->nik : '')
                ->setCellValue('E'.$num,$i->name)
                ->setCellValue('F'.$num,isset($i->employee->access->name) ? $i->employee->access->name : '')
                ->setCellValue('G'.$num,date('d-M-Y H:i',strtotime($i->created_at)));

            if($i->is_submit ==1){
                $activeSheet->setCellValue('H'.$num,$i->company)
                            ->setCellValue('I'.$num,$i->lokasi_kantor)
                            ->setCellValue('J'.$num,$i->department)
                            ->setCellValue('K'.$num,$i->status_bekerja)
                            ->setCellValue('L'.$num,$i->kondisi_badan==1?"Sehat" : "Sakit")
                            ->setCellValue('M'.$num,$i->tinggal_serumah_covid==1 ? "Yes" : "No")
                            ->setCellValue('N'.$num,$i->bepergian_keluar_kota==1?"Ya":"Tidak")
                            ->setCellValue('O'.$num,$i->mengunjungi_keluarga==1?"Ya":"Tidak");
            }else{
                $activeSheet->setCellValue('H'.$num,"-")
                            ->setCellValue('I'.$num,"-")
                            ->setCellValue('J'.$num,"-")
                            ->setCellValue('K'.$num,"-")
                            ->setCellValue('L'.$num,"-")
                            ->setCellValue('M'.$num,"-")
                            ->setCellValue('N'.$num,"-")
                            ->setCellValue('O'.$num,"-");
            }
            
            $num++;
        }

        // Rename worksheet
        $activeSheet->setTitle('Health Check');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="health-check.xlsx"');
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
        },'health-check.xlsx');
    }
}
