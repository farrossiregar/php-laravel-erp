<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Auth;

class Detailscore extends Component
{    
    protected $listeners = [
        'modaldetailscore'=>'detailscore',
    ];
    public $selected_id, $data,$supplier_category, $general_information, $team_availability_capability, $tools_facilities, $ehs_quality_management, $commercial_compliance;

    public function render()
    {
        return view('livewire.vendor-management.detailscore');        
    }

    public function detailscore($id)
    {
        $this->selected_id = $id;
        
        $this->data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        
        $this->supplier_category                    = $this->data->supplier_category;
        $this->general_information                  = $this->data->general_information;
        $this->team_availability_capability         = $this->data->team_availability_capability;
        $this->tools_facilities                     = $this->data->tools_facilities;
        $this->ehs_quality_management               = $this->data->ehs_quality_management;
        $this->commercial_compliance                = $this->data->commercial_compliance;
        
        
    }

    public function save(){
        // $pdf = \App::make('dompdf.wrapper');
        // // $pdf->loadView('livewire.po-tracking-nonms.generate-bast',['data'=>'']);
        // $pdf->loadView('livewire.vendor-management.downloadscoring',['vendor_management'=>'1']);
        
        // return $pdf->stream();


        $pdf = \App::make('dompdf.wrapper');
        $this->data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        $pdf->loadView('livewire.vendor-management.downloadscoring',['vendor_management'=>$this->data]);
        $pdf->stream();
        $filename = 'vendormanagementscore'.$this->selected_id;
        // return $pdf->download($filename);
        
        $output = $pdf->output();
        
        
        // $destinationPath = public_path($filename);
        \Storage::put($filename .'.pdf',$output);
    }

    // public function save(){

    //     // dd("download");
        
    //     $objPHPExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    //     // Set document properties
    //     $objPHPExcel->getProperties()->setCreator("Stalavista System")
    //                                 ->setLastModifiedBy("Stalavista System")
    //                                 ->setTitle("Office 2007 XLSX Product Database")
    //                                 ->setSubject("Data Member")
    //                                 ->setDescription("Data Member")
    //                                 ->setKeywords("office 2007 openxml php")
    //                                 ->setCategory("Member");

    //     $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('c2d7f3');
    //     $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Account');
    //     $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', '(Multiple Items)');
    //     // $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
    //     $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(false);
    //     $objPHPExcel->setActiveSheetIndex(0)
    //                 ->setCellValue('A3', 'Sum of Withdrawal')
    //                 ->setCellValue('B3', 'Column Labels');
    //     $objPHPExcel->setActiveSheetIndex(0)
    //                 ->setCellValue('A4', 'Row Labels')
    //                 ->setCellValue('B4', 'CMI')
    //                 ->setCellValue('C4', 'H3I')
    //                 ->setCellValue('D4', 'ISAT')
    //                 ->setCellValue('E4', 'STPL')
    //                 ->setCellValue('F4', 'XL')
    //                 ->setCellValue('G4', 'Grand Total');
                    
    //     $objPHPExcel->getActiveSheet()->getStyle('A3:G3')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('c2d7f3');
    //     $objPHPExcel->getActiveSheet()->getStyle('A3:G3')->getFont()->setBold( true );
    //     $objPHPExcel->getActiveSheet()->getStyle('A4:G4')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('c2d7f3');
    //     $objPHPExcel->getActiveSheet()->getStyle('A4:G4')->getFont()->setBold( true );
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
    //     $objPHPExcel->getActiveSheet()->setAutoFilter('B3:B3');
    //     $objPHPExcel->getActiveSheet()->setAutoFilter('A4:A4');
    //     $num=5;

    //     $yeartotal = \App\Models\DanaStpl::select(DB::Raw('year(dana_stpl_master.created_at) as year'), DB::Raw('sum(cmi) as t_cmi'), DB::Raw('sum(h3i) as t_h3i'), DB::Raw('sum(isat) as t_isat'), DB::Raw('sum(stp) as t_stp'), DB::Raw('sum(xl) as t_xl'), DB::Raw('sum(danastpl) as grandtotal'))
    //                                             ->where(DB::Raw('year(created_at)'), '>=', $year_from)
    //                                             ->where(DB::Raw('year(created_at)'), '<=', $year_to)
    //                                             ->where('status','3')
    //                                             ->groupBy(DB::Raw('year(created_at)'))
    //                                             ->orderBy(DB::Raw('year(created_at)'), 'asc')
    //                                             ->get();

    //     // dd($yeartotal);
    //     foreach($yeartotal as $k => $item){
    //         $objPHPExcel->setActiveSheetIndex(0)
    //                 ->setCellValue('A'.$num,$item->year)
    //                 ->setCellValue('B'.$num,$item->t_cmi)
    //                 ->setCellValue('C'.$num,$item->t_h3i)
    //                 ->setCellValue('D'.$num,$item->t_isat)
    //                 ->setCellValue('E'.$num, $item->t_stp)
    //                 ->setCellValue('F'.$num,$item->t_xl)
    //                 ->setCellValue('G'.$num, $item->grandtotal);
    //             $objPHPExcel->getActiveSheet()->getStyle('A'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
    //             $objPHPExcel->getActiveSheet()->getStyle('A'.$num.':G'.$num)->getFont()->setBold( true );
    //             // $objPHPExcel->getActiveSheet()->getStyle('B'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
    //             // $objPHPExcel->getActiveSheet()->getStyle('C'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
    //             // $objPHPExcel->getActiveSheet()->getStyle('D'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
    //             // $objPHPExcel->getActiveSheet()->getStyle('E'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
    //             // $objPHPExcel->getActiveSheet()->getStyle('F'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
    //             // $objPHPExcel->getActiveSheet()->getStyle('G'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                
    //             $datayear = \App\Models\DanaStpl::select(DB::Raw('year(dana_stpl_master.created_at) as year'),DB::Raw('month(dana_stpl_master.created_at) as month'), DB::Raw('sum(cmi) as t_cmi'), DB::Raw('sum(h3i) as t_h3i'), DB::Raw('sum(isat) as t_isat'), DB::Raw('sum(stp) as t_stp'), DB::Raw('sum(xl) as t_xl'), DB::Raw('sum(danastpl) as grandtotal'))
    //                                     ->where(DB::Raw('year(created_at)'), $item->year)
    //                                     ->groupBy(DB::Raw('month(created_at)'))
    //                                     // ->groupBy(DB::Raw('year(created_at)'))
    //                                     ->orderBy(DB::Raw('month(created_at)'), 'asc')
    //                                     // ->orderBy(DB::Raw('year(created_at)'), 'asc')
    //                                     ->get();
                
    //             // dd(count($datayear));
                
    //             $numdetail = $num+1;
    //             foreach($datayear as $l => $itemdetail){
    //                 $arrmonth = array('Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember');
    //                 $objPHPExcel->setActiveSheetIndex(0)
    //                 ->setCellValue('A'.$numdetail,'    '.$arrmonth[$itemdetail->month - 1])
    //                 ->setCellValue('B'.$numdetail,$itemdetail->t_cmi)
    //                 ->setCellValue('C'.$numdetail,$itemdetail->t_h3i)
    //                 ->setCellValue('D'.$numdetail,$itemdetail->t_isat)
    //                 ->setCellValue('E'.$numdetail,$itemdetail->t_stp)
    //                 ->setCellValue('F'.$numdetail,$itemdetail->t_xl)
    //                 ->setCellValue('G'.$numdetail, $itemdetail->grandtotal);

    //                 // $objPHPExcel->getActiveSheet()->getStyle('A'.$numdetail)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    //                 $objPHPExcel->getActiveSheet()->getStyle('A'.$numdetail.':G'.$numdetail)->getFont()->setBold( true );
    //                 $datamonth = \App\Models\DanaStpl::select('region.region', DB::Raw('year(dana_stpl_master.created_at) as year'), DB::Raw('month(dana_stpl_master.created_at) as month'), DB::Raw('sum(cmi) as t_cmi'), DB::Raw('sum(h3i) as t_h3i'), DB::Raw('sum(isat) as t_isat'), DB::Raw('sum(stp) as t_stp'), DB::Raw('sum(xl) as t_xl'), DB::Raw('sum(danastpl) as grandtotal'))
    //                                                     ->join(env("DB_DATABASE_EPL_PMT").'.region', 'region.id', 'dana_stpl_master.region_id')
    //                                                     ->where(DB::Raw('month(dana_stpl_master.created_at)'), $itemdetail->month)
    //                                                     ->where(DB::Raw('year(dana_stpl_master.created_at)'), $itemdetail->year)
    //                                                     ->groupBy('dana_stpl_master.region_id')
    //                                                     ->orderBy(DB::Raw('dana_stpl_master.region_id'), 'asc')
    //                                                     ->get();
    //                 $nummonthdetail = $numdetail+1;
    //                 foreach($datamonth as $l => $itemmonth){
    //                 // dd($datamonth);
    //                     $objPHPExcel->setActiveSheetIndex(0)
    //                     ->setCellValue('A'.$nummonthdetail,'      '.$itemmonth->region)
    //                     ->setCellValue('B'.$nummonthdetail,$itemmonth->t_cmi)
    //                     ->setCellValue('C'.$nummonthdetail,$itemmonth->t_h3i)
    //                     ->setCellValue('D'.$nummonthdetail,$itemmonth->t_isat)
    //                     ->setCellValue('E'.$nummonthdetail,$itemmonth->t_stp)
    //                     ->setCellValue('F'.$nummonthdetail,$itemmonth->t_xl)
    //                     ->setCellValue('G'.$nummonthdetail, $itemmonth->grandtotal);

    //                     // $objPHPExcel->getActiveSheet()->getStyle('A'.$nummonthdetail)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    //                     $nummonthdetail++;
    //                 }

    //                 $numdetail = $numdetail+count($datamonth);
    //                 $numdetail++;
    //             }

    //             $num = $num+$numdetail+count($datayear);
    //             $num++;
                
    //     }
        

    //     $objPHPExcel->setActiveSheetIndex(0);

    //     $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");

    //     // Redirect output to a client’s web browser (Excel5)
    //     header('Content-Type: application/vnd.ms-excel');
    //     header('Content-Disposition: attachment;filename="Report-DanaSTPL-' .$year_from.'sd'.$year_to .'.xlsx"');
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
    //     },'Report-DanaSTPL-' .$year_from.'sd'.$year_to .'.xlsx');

    // }
  

    public function duration($start_time, $end_time){
        
        $diff = abs(strtotime($end_time) - strtotime($start_time));
        $years   = floor($diff / (365*60*60*24)); 
        $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
        $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
        $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
   
        $waktu = '';
        if($months > 0){
            $waktu .= $months.' month ';
        }else{
            $waktu .= '';
        }

        if($days > 0){
            $waktu .= $days.' days';
        }else{
            $waktu .= '';
        }
        return $waktu;
    }
}