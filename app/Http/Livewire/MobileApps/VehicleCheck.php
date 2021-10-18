<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\VehicleCheck as VehicleCheckModel;
use App\Models\Region;
use App\Models\SubRegion;
use App\Models\AccidentReport;
use App\Models\AccidentReportImage;
use Livewire\WithPagination;
use Illuminate\Support\Arr;
use App\Models\EmployeeProject;

class VehicleCheck extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    public $employee_id,$site_id,$date,$klasifikasi_insiden,$jenis_insiden,$rincian_kronologis,$nik_and_nama,$foto_insiden=[];
    public $date_start,$date_end,$keyword,$user_access_id,$region=[],$sub_region=[],$region_id,$sub_region_id;
    public function render()
    {
        $data = $this->data_();
        return view('livewire.mobile-apps.vehicle-check')->with(['data'=>$data->paginate(100)]);
    }

    public function data_()
    {
        $data = VehicleCheckModel::select('employees.name','vehicle_check.*')
                    ->with(['employee','cleanliness'])
                    ->orderBy('vehicle_check.id','DESC')
                    ->join('employees','employees.id','=','vehicle_check.employee_id');
        
        if($this->keyword) {
            $data->where(function($table){ 
                $table->where('employees.name',"LIKE", "%{$this->keyword}%")
                        ->orWhere('plat_nomor','LIKE', "%{$this->keyword}%")
                        ->orWhere('employees.nik',$this->keyword); 
            });
        } 

        if($this->date_start and $this->date_end){
            if($this->date_start == $this->date_end)
                $data->whereDate('vehicle_check.created_at',$this->date_start);
            else
                $data->whereBetween('vehicle_check.created_at',[$this->date_start,$this->date_end]);
        }

        if($this->user_access_id) $data->where('employees.user_access_id',$this->user_access_id);
        if($this->region_id) {
            $data->where('vehicle_check.region_id',$this->region_id);
            $this->sub_region = SubRegion::where('region_id',$this->region_id)->get();
        }
        if($this->sub_region_id) $data->where('vehicle_check.sub_region_id',$this->sub_region_id);

        if(check_access('all-project.index'))
            $client_project_ids = [session()->get('project_id')];
        else
            $client_project_ids = Arr::pluck(EmployeeProject::select('client_project_id')->where(['employee_id'=>\Auth::user()->employee->id])->get()->toArray(),'client_project_id');
        
        $data->whereIn('vehicle_check.client_project_id',$client_project_ids);

        return $data;
    }

    public function mount()
    {
        $this->region  = Region::select(['id','region'])->get();
    }

    public function set_accident_report(AccidentReport $data)
    {
        $this->site_id = $data->site_id;
        $this->date = $data->date;
        $this->klasifikasi_insiden = $data->klasifikasi_insiden;
        $this->jenis_insiden = $data->jenis_insiden;
        $this->rincian_kronologis = $data->rincian_kronologis;
        $this->nik_and_nama = $data->nik_and_nama;
        $this->foto_insiden = AccidentReportImage::where(['accident_report_id'=>$data->id])->get();
    }

    public function downloadExcel()
    {
        $objPHPExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("PMT System")
                                    ->setLastModifiedBy("Stalavista System")
                                    ->setTitle("Office 2007 XLSX Product Database")
                                    ->setSubject("Vehicle Check")
                                    ->setDescription("Vehicle Check")
                                    ->setKeywords("office 2007 openxml php")
                                    ->setCategory("Vehicle Check");

        $activeSheet = $objPHPExcel->setActiveSheetIndex(0);
        $activeSheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('689a3b');
        $activeSheet->setCellValue('B1', 'VEHICLE CHECK');
        $activeSheet->mergeCells("B1:D1");
        $activeSheet->getRowDimension('1')->setRowHeight(34);
        $activeSheet->getStyle('B1')->getFont()->setSize(16);
        $activeSheet->getStyle('B1')->getAlignment()->setWrapText(false);
        $activeSheet->getStyle('A4:G4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('c2d7f3');
        $activeSheet
                    ->setCellValue('A4', 'No')
                    ->setCellValue('B4', 'NIK')
                    ->setCellValue('C4', 'Employee')
                    ->setCellValue('D4', 'Date')
                    ->setCellValue('E4', 'Plat Nomor')
                    ->setCellValue('F4', 'Stiker Safety Driving')
                    ->setCellValue('G4', 'Accident Report');

        $activeSheet->getColumnDimension('A')->setWidth(5);
        $activeSheet->getColumnDimension('B')->setAutoSize(true);
        $activeSheet->getColumnDimension('C')->setAutoSize(true);
        $activeSheet->getColumnDimension('D')->setAutoSize(true);
        $activeSheet->getColumnDimension('E')->setAutoSize(true);
        $activeSheet->getColumnDimension('F')->setAutoSize(true);
        $activeSheet->getColumnDimension('G')->setAutoSize(true);
        $num=5;

        $data = $this->data_();

        foreach($data->get() as $k => $i){
            $activeSheet
                ->setCellValue('A'.$num,($k+1))
                ->setCellValue('B'.$num,isset($i->employee->nik) ? $i->employee->nik : '')
                ->setCellValue('C'.$num,$i->name)
                ->setCellValue('D'.$num,date('d-M-Y H:i',strtotime($i->created_at)));

            if($i->is_submit ==1){
                $activeSheet->setCellValue('E'.$num,$i->plat_nomor)
                            ->setCellValue('F'.$num,$i->stiker_safety_driving==1 ? "Ya" : "Tidak ", ($i->sticker_note!="" ? " - ( ".$i->sticker_note .")" : ''))
                            ->setCellValue('G'.$num,$i->accident_report_id==1?"Ya" : "Tidak");
            }else{
                $activeSheet->setCellValue('E'.$num,"-")
                            ->setCellValue('F'.$num,"-")
                            ->setCellValue('G'.$num,"-");
            }
            
            $num++;
        }

        // Rename worksheet
        $activeSheet->setTitle('Vehicle Check');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="vehicle-check.xlsx"');
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
        },'vehicle-check.xlsx');
    }
}
