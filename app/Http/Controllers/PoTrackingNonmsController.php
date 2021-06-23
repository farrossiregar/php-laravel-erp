<?php

namespace App\Http\Controllers;

use App\Models\PoTrackingNonms;

class PoTrackingNonmsController extends Controller
{
    public function generatebast(PoTrackingNonms $data)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('livewire.po-tracking-nonms.generate-bast',['data'=>$data]);
        
        return $pdf->stream();
    }

    public function generateesar(PoTrackingNonms $data)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('livewire.po-tracking-nonms.generate-esar',['data'=>$data]);
        
        return $pdf->stream();
    }
}
