<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\DanaStpl;

class DanaStplReport implements FromView
{
    // use Exportable;

    // protected $year;
    
    // protected $month;

    // protected $data;
    
    // public function __construct(array $data)
    // {
        
    //     $this->data = $data;
    // }

    // public function view(): View
    // {
    //     return view('livewire.dana-stpl.reportdanastpl', [
    //         'data' => $this->data
    //     ]);
    // }

    public function collection(){
        return DanaStpl::get();
    }
}