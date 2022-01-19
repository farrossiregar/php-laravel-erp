<?php

namespace App\Http\Livewire\ConsumableItemDatabase;

use Livewire\Component;
use Livewire\WithFileUploads;
use DB;
use Datetime;
use Session;

class Importasset extends Component
{

    use WithFileUploads;
    public $file, $selected_id, $filtermonth, $filteryear, $filterproject;

    
    public function render()
    {
        return view('livewire.consumable-item-database.importasset');
        
    }

    
    public function save()
    {

       

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
                
                
                if($i[2] == 'Stationary'){
                    $itemcat = '1';
                }

                if($i[2] == 'Pantry Supplies'){
                    $itemcat = '2';
                }

                if($i[2] == 'Electric Supplies'){
                    $itemcat = '3';
                }

                if($i[2] == 'Office Supplies'){
                    $itemcat = '4';
                }
                $check = \App\Models\ConsumableItemDatabase::where('item_name', $i[1])
                                                    ->where('item_category', $itemcat)
                                                    ->first();
                
                if($i[0]!="") 
                
                if($check){
                    $data = \App\Models\ConsumableItemDatabase::where('item_name', $i[1])->where('item_category', $itemcat)->first();
                    $data->stock                  = $i[3];
                    $data->price                  = $i[4];
                    $data->save();

                    $total_success++;
                }else{
                    $data = new \App\Models\ConsumableItemDatabase();
                    $data->item_name              = $i[1];
                    $data->item_category          = $itemcat;
                    $data->stock                  = $i[3];
                    $data->price                  = $i[4];
                    $data->save();

                    $total_success++;
                }
                
            }

        }

        session()->flash('message-success',"Upload Consumable Item Database Success!!!");
        
        
        return redirect()->route('consumable-item-database.index');

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
                    ->setCellValue('B1', 'Item name')
                    ->setCellValue('C1', 'Item Category')
                    ->setCellValue('D1', 'Stock')
                    ->setCellValue('E1', 'Price');
                    
        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('d2ffcf');
        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold( true );
        // $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setRGB('ffcfcf');
        // $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getFont()->setBold( true );
        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:E1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        // $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(34);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        
        //$objPHPExcel->getActiveSheet()->freezePane('A4');
        $objPHPExcel->getActiveSheet()->setAutoFilter('B1:E1');
        
        $num=2;

        // $data = \App\Models\TeamScheduleNoc::where('status', '1')->orderBy('id', 'desc');
    
        // if($this->filteryear) $ata = $data->whereYear('start_schedule',$this->filteryear);
        // if($this->filtermonth) $ata = $data->whereMonth('start_schedule',$this->filtermonth);
        // if($this->filterproject) $ata = $data->where('project',$this->filterproject);
       
        // $data = $data->get();

        // foreach($data as $k => $item){
            // if($item->company_name == '1'){
            //     $company_name = 'HUP';
            // }else{
            //     $company_name = 'PMT';
            // }
            // $objPHPExcel->setActiveSheetIndex(0)
            //         ->setCellValue('A'.$num, $k + 1)
            //         ->setCellValue('B'.$num,$company_name)
            //         ->setCellValue('C'.$num,get_project_company($item->project, $item->company_name))
            //         ->setCellValue('D'.$num,$item->region)
            //         ->setCellValue('E'.$num,$item->name)
            //         ->setCellValue('F'.$num,$item->nik)
            //         ->setCellValue('G'.$num,date_format(date_create($item->start_schedule), 'Y-m-d'))
            //         ->setCellValue('H'.$num,date_format(date_create($item->start_schedule), 'H:i'))
            //         ->setCellValue('I'.$num,date_format(date_create($item->end_schedule), 'H:i'));
            //     $objPHPExcel->getActiveSheet()->getStyle('A'.$num)->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
            //     $objPHPExcel->getActiveSheet()->getStyle('A'.$num.':G'.$num)->getFont()->setBold( true );
                
            // $num++;
        // }
        
        // if(Session::get('company_id') == '1'){
        //     $company_name = 'HUP';
        // }else{
        //     $company_name = 'PMT';
        // }

        
        $objPHPExcel->setActiveSheetIndex(0);

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Sample_ConsumableItemDatabase.xlsx"');
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
        },'Sample_ConsumableItemDatabase.xlsx');


    }


    public function weekOfMonth3($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }
    
}
