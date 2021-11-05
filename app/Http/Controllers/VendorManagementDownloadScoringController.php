<?php

namespace App\Http\Controllers;

use App\Models\VendorManagement;

class VendorManagementDownloadScoringController extends Controller
{
    public function index(VendorManagement $id)
    {
        $pdf = \App::make('dompdf.wrapper');

        $pdf->loadView('livewire.vendow-management.download-scoring',['vendor_management'=>$id]);
        
        return $pdf->stream();
    }
}
