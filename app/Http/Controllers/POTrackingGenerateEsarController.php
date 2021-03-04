<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PoTrackingReimbursementMaster;

class POTrackingGenerateEsarController extends Controller
{
    public function index(PoTrackingReimbursementMaster $po_tracking)
    {
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadView('livewire.po-tracking.generate-esar',['po_tracking'=>$po_tracking]);
        return $pdf->stream();
    }
}
