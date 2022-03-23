<?php

namespace App\Http\Controllers;

class PmReportController extends Controller
{
    public function tmgMonthly()
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('pm-report.tmg-monthly');
        
        return $pdf->stream();
    }
}
