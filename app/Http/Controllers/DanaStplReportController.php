<?php

namespace App\Http\Controllers;

use App\Models\DanaStpl;

class DanaStplReportController extends Controller
{
    public function downloadreport(DanaStpl $danastpl)
    {
        // $pdf = \App::make('dompdf.wrapper');

        // $pdf->loadView('livewire.po-tracking.generate-esar',['po_tracking'=>$po_tracking]);
        
        // return $pdf->stream();

        require 'vendor/autoload.php';

        use PhpOffice\PhpSpreadsheet\Spreadsheet;
        use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', 'Hello World !');

        $writer = new Xlsx($spreadsheet);
        $writer->save('hello world.xlsx');
    }
}
