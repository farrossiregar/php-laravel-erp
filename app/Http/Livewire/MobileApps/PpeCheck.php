<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\PpeCheck as PpeCheckModel;
use Livewire\WithPagination;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use App\Models\Region;
use App\Models\SubRegion;

class PpeCheck extends Component
{
    public $date_start,$date_end,$keyword,$region=[],$sub_region=[],$region_id,$sub_region_id;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $data = PpeCheckModel::select('ppe_check.*','employees.name')->orderBy('ppe_check.is_submit','DESC')->orderBy('ppe_check.updated_at','DESC')->join('employees','employees.id','=','employee_id');
        
        if($this->keyword) $data->where('employees.name',"LIKE", "%{$this->keyword}%");
        if($this->date_start and $this->date_end) $data = $data->whereBetween('ppe_check.created_at',[$this->date_start,$this->date_end]);
        if($this->region_id) {
            $data->where('ppe_check.region_id',$this->region_id);
            $this->sub_region = SubRegion::where('region_id',$this->region_id)->get();
        }

        if($this->sub_region_id) {
            $data->where('ppe_check.sub_region_id',$this->sub_region_id);
        }

        return view('livewire.mobile-apps.ppe-check')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        $this->region  = Region::select(['id','region'])->get();
    }

    public function downloadExcel()
    {
        $objPHPExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("PMT System")
                                    ->setLastModifiedBy("Stalavista System")
                                    ->setTitle("Office 2007 XLSX Product Database")
                                    ->setSubject("PPE Check")
                                    ->setDescription("PPE Check")
                                    ->setKeywords("office 2007 openxml php")
                                    ->setCategory("PPE Check");

        $activeSheet = $objPHPExcel->setActiveSheetIndex(0);
        $activeSheet->getStyle('A1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('689a3b');
        $activeSheet->setCellValue('B1', 'PPE Check');
        $activeSheet->mergeCells("B1:D1");
        $activeSheet->getRowDimension('1')->setRowHeight(34);
        $activeSheet->getStyle('B1')->getFont()->setSize(16);
        $activeSheet->getStyle('B1')->getAlignment()->setWrapText(false);
        $activeSheet->getStyle('A4:N4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('c2d7f3');
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
        $activeSheet
                    ->setCellValue('A4', 'No')
                    ->setCellValue('B4', 'Employee')
                    ->setCellValue('C4', 'Date')
                    ->setCellValue('D4', 'Foto Dengan PPE')
                    ->setCellValue('E4', 'Foto Banner')
                    ->setCellValue('F4', 'Foto Sertifikasi WAH')
                    ->setCellValue('G4', 'Foto Elektrikal')
                    ->setCellValue('H4', 'Foto First Aid')
                    ->setCellValue('I4', 'PPE Lengkap')
                    ->setCellValue('J4', 'PPE alasan tidak lengkap')
                    ->setCellValue('K4', 'Banner lengkap')
                    ->setCellValue('L4', 'Banner alasan tidak lengkap')
                    ->setCellValue('M4', 'Sertifikasi alasan tidak lengkap');
        $num=5;

        $data = PpeCheckModel::select('ppe_check.*','employees.name')->orderBy('ppe_check.id','DESC')->join('employees','employees.id','=','employee_id');
        
        if($this->keyword) $data->where('employees.name',"LIKE", "%{$this->keyword}%");
        if($this->date_start and $this->date_end) $data = $data->whereBetween('ppe_check.created_at',[$this->date_start,$this->date_end]);

        foreach($data->get() as $k => $i){
            $activeSheet
                ->setCellValue('A'.$num,($k+1));

                $activeSheet->setCellValue('B'.$num,$i->name)
                            ->setCellValue('C'.$num,date('d-M-Y',strtotime($i->created_at)))
                            ->setCellValue('D'.$num,$i->foto_dengan_ppe==1 ? "Yes" : "No")
                            ->setCellValue('E'.$num,$i->foto_banner==1 ? "Yes" : "No")
                            ->setCellValue('F'.$num,$i->foto_wah==1 ? "Yes" : "No")
                            ->setCellValue('G'.$num,$i->foto_elektril==1 ? "Yes" : "No")
                            ->setCellValue('H'.$num,$i->foto_first_aid==1 ? "Yes" : "No")
                            ->setCellValue('I'.$num,$i->ppe_lengkap==1 ? "Yes" : "No")
                            ->setCellValue('J'.$num,$i->ppe_alasan_tidak_lengkap)
                            ->setCellValue('K'.$num,$i->banner_lengkap==1 ? "Yes" : "No")
                            ->setCellValue('L'.$num,$i->banner_alasan_tidak_lengkap)
                            ->setCellValue('M'.$num,$i->sertifikasi_alasan_tidak_lengkap);
            $num++;
        }

        // Rename worksheet
        $activeSheet->setTitle('PPE Check');
        // Set active sheet index to the first sheet, so Excel opens this as the first sheet
        $objPHPExcel->setActiveSheetIndex(0);
        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="ppe-check.xlsx"');
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
        },'ppe-check.xlsx');
    }
}
