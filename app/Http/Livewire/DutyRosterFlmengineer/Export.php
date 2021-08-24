<?php

namespace App\Http\Livewire\DutyRosterFlmengineer;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingNonms;
use Auth;
use DB;


class Export extends Component
{
    protected $listeners = [
        'modalexportdutyrosterflm'=>'expdata',
    ];

    use WithPagination;
    public $month, $year, $yr, $selected_id, $monthyear, $ids;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {

        return view('livewire.duty-roster-flmengineer.export');
        
    }

    public function expdata($id)
    {
        // dd($id);
        $month = substr($id, 0, 2);
        $year = substr($id, 2, 4);
        // dd($year);

        $objPHPExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Stalavista System")
                                    ->setLastModifiedBy("Stalavista System")
                                    ->setTitle("Office 2007 XLSX Product Database")
                                    ->setSubject("Data Member")
                                    ->setDescription("Data Member")
                                    ->setKeywords("office 2007 openxml php")
                                    ->setCategory("Member");

        // $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('c2d7f3');

        // $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(false);
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A2', 'Position')
                    ->setCellValue('B2', 'Account Mateline')
                    ->setCellValue('C2', 'Date Join')
                    ->setCellValue('D2', 'Status Karyawan (Synergy/Tidak)')
                    ->setCellValue('E2', 'No. Pass ID')
                    ->setCellValue('F2', 'Training K3')
                    ->setCellValue('G2', 'Total Site');

                    

        $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
        $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getFont()->setBold( true );
        $objPHPExcel->getActiveSheet()->getStyle('A4:G4')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A4:G4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        // $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(34);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        
        //$objPHPExcel->getActiveSheet()->freezePane('A4');
        
        $objPHPExcel->getActiveSheet()->setAutoFilter('A2:G2');
        $num=3;

        $data = \App\Models\DutyrosterFlmengineerMaster::where(DB::Raw('month(dutyroster_flmengineer_master.created_at)'), $month)
                                                        ->where(DB::Raw('year(dutyroster_flmengineer_master.created_at)'), $year)
                                                        ->where('dutyroster_flmengineer_master.status', '1')
                                                        ->leftjoin('employees', 'employees.id', 'dutyroster_flmengineer_master.user_id')
                                                        ->orderBy('dutyroster_flmengineer_master.id', 'asc')
                                                        ->get();

        // dd($data);
        foreach($data as $k => $item){
            $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A'.$num, @get_position($item->user_access_id))
                            ->setCellValue('B'.$num, $item->account_mateline)
                            ->setCellValue('C'.$num, $item->date_join)
                            ->setCellValue('D'.$num, $item->status_synergy)
                            ->setCellValue('E'.$num, $item->no_pass_id)
                            ->setCellValue('F'.$num, $item->training_k3)
                            ->setCellValue('G'.$num, $item->total_site);

                        if($item->remarks == '1'){
                            $objPHPExcel->getActiveSheet()->getStyle('A'.$num.':G'.$num)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('ffcccc');
                        }
          
                $num++;
        }
        

        
        $objPHPExcel->setActiveSheetIndex(0);

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Report-Dutyroster-Flmengineer.xlsx"');
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
        },'Report-Dutyroster-Flmengineer.xlsx');
    }


    // public function save()
    // {
    //     dd($this->month);
    //     // $id = $this->selected_id;
       

    //     $objPHPExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    //     // Set document properties
    //     $objPHPExcel->getProperties()->setCreator("Stalavista System")
    //                                 ->setLastModifiedBy("Stalavista System")
    //                                 ->setTitle("Office 2007 XLSX Product Database")
    //                                 ->setSubject("Data Member")
    //                                 ->setDescription("Data Member")
    //                                 ->setKeywords("office 2007 openxml php")
    //                                 ->setCategory("Member");

    //     // $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('c2d7f3');

    //     // $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
    //     $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(false);
    //     $objPHPExcel->setActiveSheetIndex(0)
    //                 ->setCellValue('A2', 'Position')
    //                 ->setCellValue('B2', 'Account Mateline')
    //                 ->setCellValue('C2', 'Date Join')
    //                 ->setCellValue('D2', 'Status Karyawan (Synergy/Tidak)')
    //                 ->setCellValue('E2', 'No. Pass ID')
    //                 ->setCellValue('F2', 'Training K3')
    //                 ->setCellValue('G2', 'Total Site');

                    

    //     $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
    //     $objPHPExcel->getActiveSheet()->getStyle('A2:G2')->getFont()->setBold( true );
    //     $objPHPExcel->getActiveSheet()->getStyle('A4:G4')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
    //     $objPHPExcel->getActiveSheet()->getStyle('A4:G4')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
    //     // $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(34);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
    //     $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        
    //     //$objPHPExcel->getActiveSheet()->freezePane('A4');
        
    //     $objPHPExcel->getActiveSheet()->setAutoFilter('A2:G2');
    //     $num=3;

    //     $data = \App\Models\DutyrosterFlmengineerMaster::where(DB::Raw('month(dutyroster_flmengineer_master.created_at)'), '08')
    //                                                     ->where(DB::Raw('year(dutyroster_flmengineer_master.created_at)'), '2021')
    //                                                     ->where('dutyroster_flmengineer_master.status', '1')
    //                                                     ->leftjoin('employees', 'employees.id', 'dutyroster_flmengineer_master.user_id')
    //                                                     ->orderBy('dutyroster_flmengineer_master.id', 'asc')
    //                                                     ->get();

    //     // dd($data);
    //     foreach($data as $k => $item){
    //         $objPHPExcel->setActiveSheetIndex(0)
    //                         ->setCellValue('A'.$num, @get_position($item->user_access_id))
    //                         ->setCellValue('B'.$num, $item->account_mateline)
    //                         ->setCellValue('C'.$num, $item->date_join)
    //                         ->setCellValue('D'.$num, $item->status_synergy)
    //                         ->setCellValue('E'.$num, $item->no_pass_id)
    //                         ->setCellValue('F'.$num, $item->training_k3)
    //                         ->setCellValue('G'.$num, $item->total_site);

    //                     if($item->remarks == '1'){
    //                         $objPHPExcel->getActiveSheet()->getStyle('A'.$num.':G'.$num)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('ffcccc');
    //                     }
          
    //             $num++;
    //     }
        

        
    //     $objPHPExcel->setActiveSheetIndex(0);

    //     $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");

    //     // Redirect output to a client’s web browser (Excel5)
    //     header('Content-Type: application/vnd.ms-excel');
    //     header('Content-Disposition: attachment;filename="Report-Dutyroster-Flmengineer.xlsx"');
    //     header('Cache-Control: max-age=0');
    //     // If you're serving to IE 9, then the following may be needed
    //     //header('Cache-Control: max-age=1');

    //     // If you're serving to IE over SSL, then the following may be needed
    //     header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
    //     header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
    //     header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
    //     header ('Pragma: public'); // HTTP/1.0
    //     return response()->streamDownload(function() use($writer){
    //         $writer->save('php://output');
    //     },'Report-Dutyroster-Flmengineer.xlsx');

    // }


}



