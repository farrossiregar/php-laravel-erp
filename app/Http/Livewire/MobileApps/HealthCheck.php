<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\HealthCheck as HealthCheckModel;
use Livewire\WithPagination;

class HealthCheck extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    public $date_start,$date_end,$keyword;

    public function render()
    {
        $data = HealthCheckModel::select('employees.name','health_check.*')->orderBy('health_check.id','DESC')->join('employees','employees.id','=','employee_id');

        if($this->keyword) $data->where('employees.name',"LIKE", "%{$this->keyword}%");
        if($this->date_start and $this->date_end) $data = $data->whereBetween('health_check.created_at',[$this->date_start,$this->date_end]);

        return view('livewire.mobile-apps.health-check')->with(['data'=>$data->paginate(100)]);
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
        $activeSheet->getStyle('A4:K4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('c2d7f3');
        $activeSheet
                    ->setCellValue('A4', 'No')
                    ->setCellValue('B4', 'Employee')
                    ->setCellValue('C4', 'Date')
                    ->setCellValue('D4', 'Perusahaan')
                    ->setCellValue('E4', 'Lokasi Kantor')
                    ->setCellValue('F4', 'Department')
                    ->setCellValue('G4', 'Status Bekerja Hari ini')
                    ->setCellValue('H4', 'Kondisi Badan')
                    ->setCellValue('I4', 'Tinggal Dengan Keluarga Terkonfirmasi Covid 19')
                    ->setCellValue('J4', 'Apakah anda bepergian keluar kota')
                    ->setCellValue('K4', 'Apakah anda ada mengunjungi keluarga yang sedang dirawat di rumah sakit dalam 3 hari terakhir');

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
        $num=5;

        $data = HealthCheckModel::select('employees.name','health_check.*')->orderBy('health_check.id','DESC')->join('employees','employees.id','=','employee_id');

        if($this->keyword) $data->where('employees.name',"LIKE", "%{$this->keyword}%");
        if($this->date_start and $this->date_end) $data = $data->whereBetween('health_check.created_at',[$this->date_start,$this->date_end]);
        foreach($data->get() as $k => $i){
            $activeSheet
                ->setCellValue('A'.$num,($k+1))
                ->setCellValue('B'.$num,$i->name)
                ->setCellValue('C'.$num,date('d-M-Y H:i',strtotime($i->created_at)));

            if($i->is_submit ==1){
                $activeSheet->setCellValue('D'.$num,$i->company)
                            ->setCellValue('E'.$num,$i->lokasi_kantor)
                            ->setCellValue('F'.$num,$i->department)
                            ->setCellValue('G'.$num,$i->status_bekerja)
                            ->setCellValue('H'.$num,$i->kondisi_badan==1?"Sehat" : "Sakit")
                            ->setCellValue('I'.$num,$i->tinggal_serumah_covid==1 ? "Yes" : "No")
                            ->setCellValue('J'.$num,$i->bepergian_keluar_kota==1?"Ya":"Tidak")
                            ->setCellValue('K'.$num,$i->mengunjungi_keluarga==1?"Ya":"Tidak")
                            ;
            }else{
                $activeSheet->setCellValue('D'.$num,"-")
                            ->setCellValue('E'.$num,"-")
                            ->setCellValue('F'.$num,"-")
                            ->setCellValue('G'.$num,"-")
                            ->setCellValue('H'.$num,"-")
                            ->setCellValue('I'.$num,"-")
                            ->setCellValue('K'.$num,"-")
                            ->setCellValue('K'.$num,"-")
                            ;
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
