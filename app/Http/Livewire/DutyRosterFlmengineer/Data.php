<?php

namespace App\Http\Livewire\DutyRosterFlmengineer;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingNonms;
use Auth;
use DB;


class Data extends Component
{
    use WithPagination;
    public $month, $year, $yr;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {

        if($this->month){
            $this->month = $this->month;
        }else{
            $this->month = date('m');
        }

        if($this->year){
            $this->year = $this->year;
        }else{
            $this->year = date('Y');
        }

        $this->yr = \App\Models\DutyrosterFlmengineerMaster::select(DB::Raw('year(created_at) as yr'))->groupBy(DB::Raw('year(created_at)'))->get();
        // $data = check_access_data('duty-roster-flmengineer.flmengineer-list', '');
        $data = \App\Models\DutyrosterFlmengineerMaster::select('dutyroster_flmengineer_master.*', 'employees.name', 'employees.user_access_id', 'employees.join_date', 'employees.resign_date', 'employees.account_mateline', 'employees.no_pass_id', 'employees.training_k3', 'employees.total_site', 'employees.status_synergy')
                                                        ->orderBy('dutyroster_flmengineer_master.id', 'Desc')
                                                        ->leftjoin('employees', 'employees.id', 'dutyroster_flmengineer_master.user_id');
        if($this->month) $ata = $data->where(DB::Raw('month(dutyroster_flmengineer_master.created_at)'),$this->month);
        if($this->year) $ata = $data->where(DB::Raw('year(dutyroster_flmengineer_master.created_at)'),$this->year);
        // dd($data->get());                                                        
        
        
        
        return view('livewire.duty-roster-flmengineer.data')->with(['data'=>$data->paginate(50)]);

        
    }


    // public function export($id)
    // {
    //     dd('$id');
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

                    

    //     $objPHPExcel->getActiveSheet()->getStyle('A2:BO2')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('FFFF00');
    //     $objPHPExcel->getActiveSheet()->getStyle('A2:BO2')->getFont()->setBold( true );
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
        
    //     $objPHPExcel->getActiveSheet()->setAutoFilter('A2:BO2');
    //     $num=3;

    //     $data = \App\Models\DutyrosterFlmengineerMaster::where(DB::Raw('month(dutyroster_flmengineer_master.created_at)'), '08')
    //                                                     ->where(DB::Raw('year(dutyroster_flmengineer_master.created_at)'), '2021')
    //                                                     ->leftjoin('employees', 'employees.id', 'dutyroster_flmengineer_master.user_id')
    //                                                     ->orderBy('dutyroster_flmengineer_master.id', 'asc')
    //                                                     ->get();

    //     // dd($data);
    //     foreach($data as $k => $item){
    //         $objPHPExcel->setActiveSheetIndex(0)
    //                         ->setCellValue('A'.$num, $item->position)
    //                         ->setCellValue('B'.$num, $item->account_mateline)
    //                         ->setCellValue('C'.$num, $item->date_join)
    //                         ->setCellValue('D'.$num, $item->status_synergy)
    //                         ->setCellValue('E'.$num, $item->no_pass_id)
    //                         ->setCellValue('F'.$num, $item->training_k3)
    //                         ->setCellValue('G'.$num, $item->total_site);

    //                     if($item->remarks == '1'){
    //                         $objPHPExcel->getActiveSheet()->getStyle('AB'.$num.':AG'.$num)->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('ffcccc');
    //                     }
          
    //             $num++;
    //     }
        

        
    //     $objPHPExcel->setActiveSheetIndex(0);

    //     $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");

    //     // Redirect output to a client’s web browser (Excel5)
    //     header('Content-Type: application/vnd.ms-excel');
    //     header('Content-Disposition: attachment;filename="Report-Dutyroster-Sitelist.xlsx"');
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
    //     },'Report-Dutyroster-Sitelist.xlsx');

    // }


}



