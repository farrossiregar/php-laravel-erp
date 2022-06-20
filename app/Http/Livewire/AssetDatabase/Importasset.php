<?php

namespace App\Http\Livewire\AssetDatabase;

use Livewire\Component;
use Livewire\WithFileUploads;
use DB;
use Datetime;
use Session;

class Importasset extends Component
{

    use WithFileUploads;
    public $file, $selected_id, $filtermonth, $filteryear, $filterproject, $project, $region;

    
    public function render()
    {
        return view('livewire.asset-database.importasset');
        
    }

  
    
    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx|max:51200' // 50MB maksimal
        ]);

        

        $path = $this->file->getRealPath();
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $data = $reader->load($path);
        $sheetData = $data->getActiveSheet()->toArray();
       
        if(count($sheetData) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;

            foreach($sheetData as $key => $i){
                

                if($key<1) continue; // skip header
                
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
              
                // if($i[0]!="") continue;
                
                $data                                   = new \App\Models\AssetDatabase();
                $data->company_id                       = Session::get('company_id');
                $data->region                           = $this->region;
                $data->project                          = $this->project;
                if($i[1] == 'Air Conditioner & Fan')
                    $assettype = '1';
                elseif($i[1] == 'Furniture & Fixture')
                    $assettype = '2';
                elseif($i[1] == 'Computer Equipment')
                    $assettype = '3';
                else $assettype = '4';
                
                $data->asset_type                       = $assettype;
                $data->asset_name                       = $i[2];
                $data->expired_date                     = $i[3];
                $data->serial_number                    = $i[4];
                $data->pic                              = $i[5];
                // $data->location                         = $i[6];
                $data->source_asset                     = 'database';
                
                $data->save();

                $total_success++;
            }
        }

        session()->flash('message-success',"Upload Asset Success!!!");
        
        
        return redirect()->route('asset-database.index');

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
       
        // $objPHPExcel->getActiveSheet()->getStyle('A1')->getFont()->setSize(16);
        $objPHPExcel->getActiveSheet()->getStyle('A1')->getAlignment()->setWrapText(false);
                   

        $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', 'NO')
                        ->setCellValue('B1', 'Asset Type')
                        ->setCellValue('C1', 'Asset Name')
                        ->setCellValue('D1', 'Expired Date (YYYY-MM-DD)')
                        ->setCellValue('E1', 'Serial Number')
                        ->setCellValue('F1', 'PIC');
                        // ->setCellValue('G1', 'Location');
                    
        $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        $objPHPExcel->getActiveSheet()->getStyle('A1:F1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
        // $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(34);
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setAutoSize(true);
        // $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        // $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setAutoSize(true);
        
        
        //$objPHPExcel->getActiveSheet()->freezePane('A4');
        $objPHPExcel->getActiveSheet()->setAutoFilter('A1:F1');
        
        $num=2;

        
        
        if(Session::get('company_id') == '1'){
            $company_name = 'HUP';
        }else{
            $company_name = 'PMT';
        }

        
        $objPHPExcel->setActiveSheetIndex(0);

        $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Sample_AssetDatabase-'.$company_name.'.xlsx"');
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
        },'Sample_AssetDatabase-'.$company_name.'.xlsx');


    }


    public function weekOfMonth3($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }
    
}
