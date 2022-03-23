<?php

namespace App\Http\Controllers;

use App\Models\PoTrackingNonmsPo;

class PoTrackingNonmsController extends Controller
{
    public function po_generate_bast(PoTrackingNonmsPo $data)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('livewire.po-tracking-nonms.po-generate-bast',['data'=>$data]);
        
        return $pdf->stream();
    }

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
