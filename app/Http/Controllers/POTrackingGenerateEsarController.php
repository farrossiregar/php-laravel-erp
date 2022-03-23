<?php

namespace App\Http\Controllers;

use App\Models\PoTrackingReimbursement;

class POTrackingGenerateEsarController extends Controller
{
    public function index(PoTrackingReimbursement $po_tracking)
    {
        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadView('livewire.po-tracking.generate-esar',['po_tracking'=>$po_tracking]);
        
        return $pdf->stream();
    }
}
