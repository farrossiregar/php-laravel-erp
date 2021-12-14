<?php

namespace App\Http\Livewire\TimesheetRecord;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingNonms;
use Auth;
use DB;


class Datapmt extends Component
{
    use WithPagination;
    public $project, $filterproject, $filterweek, $filtermonth, $filteryear, $employee_name;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {

       
        $data = \App\Models\TeamScheduleNoc::orderBy('created_at', 'desc')
                                            ->where('company_name', '2')
                                            ->groupBy('project')
                                            ->groupBy('region')
                                            ->groupBy(DB::Raw('month(created_at)'))
                                            ->groupBy(DB::Raw('year(created_at)'));
            //    dd($data->get());

        // if($this->date) $ata = $data->whereDate('created_at',$this->date);
        if($this->filteryear) $ata = $data->whereYear('start_schedule',$this->filteryear);
        if($this->filtermonth) $ata = $data->whereMonth('start_schedule',$this->filtermonth);                
        if($this->filterweek) $ata = $data->where('week',$this->filterweek);                        
        if($this->filterproject) $ata = $data->where('project',$this->filterproject);                        
        
        return view('livewire.timesheet-record.datapmt')->with(['data'=>$data->paginate(50)]);

        
    }


    public function generatetimesheet($project, $company, $month, $year, $region){
        $objPHPExcel = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        // Set document properties
        $objPHPExcel->getProperties()->setCreator("Stalavista System")
                                    ->setLastModifiedBy("Stalavista System")
                                    ->setTitle("Office 2007 XLSX Product Database")
                                    ->setSubject("Data Member")
                                    ->setDescription("Data Member")
                                    ->setKeywords("office 2007 openxml php")
                                    ->setCategory("Member");

        $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('c2d7f3');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'Account');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('B1', '(Multiple Items)');
        // $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(false);

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'NO')
                    ->setCellValue('B1', 'Company')
                    ->setCellValue('C1', 'Project')
                    ->setCellValue('D1', 'Region')
                    ->setCellValue('E1', 'Employee')
                    ->setCellValue('F1', 'NIK')
                    ->setCellValue('G1', 'Date Plan Schedule (YYYY-mm-dd)')
                    ->setCellValue('H1', 'Start Time Plan (HH:II)')
                    ->setCellValue('I1', 'End Time Plan (HH:II)')
                    ->setCellValue('J1', 'Date Actual Schedule (YYYY-mm-dd)')
                    ->setCellValue('K1', 'Start Time Actual (HH:II)')
                    ->setCellValue('L1', 'End Time Actual (HH:II)');
                    
        $objPHPExcel->getActiveSheet()->getStyle('J1:L1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('d2ffcf');
        $objPHPExcel->getActiveSheet()->getStyle('J1:L1')->getFont()->setBold( true );
        $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('ffcfcf');
        $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getFont()->setBold( true );
        $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:I1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        // $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(34);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        
        //$objPHPExcel->getActiveSheet()->freezePane('A4');
        $objPHPExcel->getActiveSheet()->setAutoFilter('B1:E1');
        
        $num=2;

        $data = \App\Models\TeamScheduleNoc::where('status', '2')->orderBy('id', 'desc')
                                                ->where('company_name',$company)
                                                ->whereYear('start_schedule',$year)
                                                ->whereMonth('start_schedule',$month)
                                                ->where('project',$project)
                                                ->where('region',\App\Models\Region::where('id', $region)->first()->region_code);
       
        $data = $data->get();
        // dd($data);
        
        foreach($data as $k => $item){
            if($item->company_name == '1'){
                $company_name = 'HUP';
            }else{
                $company_name = 'PMT';
            }

            if($item->end_actual){
                $diff = abs(strtotime(date_format(date_create($item->end_actual), 'Y-m-d H:i:s')) - strtotime(date_format(date_create($item->end_schedule), 'Y-m-d H:i:s')));
                $years   = floor($diff / (365*60*60*24)); 
                $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
                $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
                $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
        
                $waktu = '';
                if($hours > 0){
                    $waktu .= $hours.' hr ';
                }else{
                    $waktu .= '';
                }
        
                if($minuts > 0){
                    $waktu .= $minuts.' min ';
                }else{
                    $waktu .= '';
                }

                $waktu;

                if($hours > 0){
                    $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$num, $k + 1)
                    ->setCellValue('B'.$num,$company_name)
                    ->setCellValue('C'.$num,get_project_company($item->project, $item->company_name))
                    ->setCellValue('D'.$num,$item->region)
                    ->setCellValue('E'.$num,$item->name)
                    ->setCellValue('F'.$num,$item->nik)
                    ->setCellValue('G'.$num,date_format(date_create($item->start_schedule), 'Y-m-d'))
                    ->setCellValue('H'.$num,date_format(date_create($item->start_schedule), 'H:i'))
                    ->setCellValue('I'.$num,date_format(date_create($item->end_schedule), 'H:i'))
                    ->setCellValue('J'.$num,date_format(date_create($item->start_actual), 'Y-m-d'))
                    ->setCellValue('K'.$num,date_format(date_create($item->start_actual), 'H:i'))
                    ->setCellValue('L'.$num,date_format(date_create($item->end_actual), 'H:i'));
                        $objPHPExcel->getActiveSheet()->getStyle('A'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                        $objPHPExcel->getActiveSheet()->getStyle('A'.$num.':G'.$num)->getFont()->setBold( true );
                        // $objPHPExcel->getActiveSheet()->getStyle('B'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                        // $objPHPExcel->getActiveSheet()->getStyle('C'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                        // $objPHPExcel->getActiveSheet()->getStyle('D'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                        // $objPHPExcel->getActiveSheet()->getStyle('E'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                        // $objPHPExcel->getActiveSheet()->getStyle('F'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                        // $objPHPExcel->getActiveSheet()->getStyle('G'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                    
                    $num++;
                }else{
                    continue;
                }
            }

            
        }
        

        
        $objPHPExcel->setActiveSheetIndex(0);

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="generate_timesheet-'.get_project_company($project, $company).'_'.$this->filtermonth.'_'.$this->filteryear.'.xlsx"');
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
        },'generate_timesheet-'.get_project_company($project, $company).'_'.$month.'_'.$year.'.xlsx');



    }


}



