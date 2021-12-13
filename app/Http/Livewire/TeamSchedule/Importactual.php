<?php

namespace App\Http\Livewire\TeamSchedule;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;
use Session;

class Importactual extends Component
{

    // protected $listeners = [
    //     'modalimportactual'=>'importactual',
    // ];

    use WithFileUploads;
    public $file, $selected_id, $filtermonth, $filteryear, $filterproject;

    
    public function render()
    {
        
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        
        return view('livewire.team-schedule.importactual');
        
    }

    // public function importactual($id)
    // {
    //     $this->selected_id = $id;
    // }
    
    public function save()
    {

        // $this->validate([
        //     'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        // ]);

        // if($this->file){
        //     $legal = 'vm-legal'.$this->selected_id.'.'.$this->file->extension();
        //     $this->file->storePubliclyAs('public/Vendor_Management/Legal/',$legal);

        //     $data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();
        //     $data->legal         = $legal;
            
        //     $data->save();
        // }

        $this->validate([
            'file'=>'required|mimes:xls,xlsx|max:51200' // 50MB maksimal
        ]);


        $path = $this->file->getRealPath();
       
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $data = $reader->load($path);
        $sheetData = $data->getActiveSheet()->toArray();
        // $sheetData = $data->getActiveSheet();
        
       
        if(count($sheetData) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;

            foreach($sheetData as $key => $i){
                if($key<1) continue; // skip header
                
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                
                $check = \App\Models\TeamScheduleNoc::where('name', $i[4])
                                                    // ->whereMonth('start_schedule', date_format(date_create($i[6]), 'm'))
                                                    // ->where('start_schedule', date_format(date_create($i[6]), 'Y-m-d'))
                                                    ->where(DB::Raw('date(start_schedule)'), $i[6])
                                                    ->first();
                
                if($i[0]!="") 
                // dd($check);
                if($check){
                    // $dataactual = \App\Models\TeamScheduleNoc::where('name', $i[4])->whereMonth('start_schedule', date_format(date_create($i[6]), 'm'))->first();
                    $dataactual = \App\Models\TeamScheduleNoc::where('name', $i[4])->where(DB::Raw('date(start_schedule)'), $i[6])->first();
                    // dd($dataactual);
                    $dataactual->start_actual                                  = $i[9].' '.$i[10].':00';
                    $dataactual->end_actual                                    = $i[9].' '.$i[11].':00';
                    $dataactual->status                                        = '1';
                    
                    $dataactual->save();

                    $total_success++;
                }
                
            }

        }

        session()->flash('message-success',"Upload Actual Team Schedule Success!!!");
        
        
        return redirect()->route('team-schedule.index');

    }


    public function sampleimport()
    {

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

        $data = \App\Models\TeamScheduleNoc::where('status', '1')->orderBy('id', 'desc');
    
        if($this->filteryear) $ata = $data->whereYear('start_schedule',$this->filteryear);
        if($this->filtermonth) $ata = $data->whereMonth('start_schedule',$this->filtermonth);
        if($this->filterproject) $ata = $data->where('project',$this->filterproject);
       
        $data = $data->get();

        foreach($data as $k => $item){
            if($item->company_name == '1'){
                $company_name = 'HUP';
            }else{
                $company_name = 'PMT';
            }
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
                    ->setCellValue('J'.$num,isset($item->start_actual) ? date_format(date_create($item->start_actual), 'Y-m-d') : '')
                    ->setCellValue('K'.$num,isset($item->start_actual) ? date_format(date_create($item->start_actual), 'H:i') : '')
                    ->setCellValue('L'.$num,isset($item->end_actual) ? date_format(date_create($item->end_actual), 'H:i') : '');
                $objPHPExcel->getActiveSheet()->getStyle('A'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$num.':G'.$num)->getFont()->setBold( true );
                // $objPHPExcel->getActiveSheet()->getStyle('B'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                // $objPHPExcel->getActiveSheet()->getStyle('C'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                // $objPHPExcel->getActiveSheet()->getStyle('D'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                // $objPHPExcel->getActiveSheet()->getStyle('E'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                // $objPHPExcel->getActiveSheet()->getStyle('F'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
                // $objPHPExcel->getActiveSheet()->getStyle('G'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
               
            $num++;
        }
        

        
        $objPHPExcel->setActiveSheetIndex(0);

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Sample_TeamSchedule-'.get_project_company($this->filterproject, Session::get('company_id')).'_'.$this->filtermonth.'_'.$this->filteryear.'.xlsx"');
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
        },'Sample_TeamSchedule-'.get_project_company($this->filterproject, Session::get('company_id')).'_'.$this->filtermonth.'_'.$this->filteryear.'.xlsx');



        
        // session()->flash('message-success',"Insiden Report Berhasil diupload");
        // require 'vendor/autoload.php';


        // $spreadsheet = new Spreadsheet();
        // $sheet = $spreadsheet->getActiveSheet();
        // $sheet->setCellValue('A1', 'Hello World !');

        // $writer = new Xlsx($spreadsheet);
        // $writer->save('hello world.xlsx');


        // $filename = 'export.xlsx';
        // // here is generated a "normal" file download response of Laravel
        // return Excel::download(new CustomExcelExport(), $filename);
        // // return redirect()->route('dana-stpl.index');
        // // dd('download');

        // return Storage::disk('exports')->download('export.csv');

        // Excel::create('Filename', function($excel) {

        // })->download('xls');

        // return response()->download('export.csv');

        // return (new \App\Models\DanaStplReport($download))->download('EPL.DanaStplReport.xlsx');
    }
    
}
