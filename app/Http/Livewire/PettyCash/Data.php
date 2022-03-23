<?php

namespace App\Http\Livewire\PettyCash;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingNonms;
use Auth;
use DB;
use Session;


class Data extends Component
{
    use WithPagination;
    public $date;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {

       
        $data = \App\Models\PettyCash::where('company_id', Session::get('company_id'))->orderBy('created_at', 'desc');
            //    dd($data->get());

        if($this->date) $ata = $data->whereDate('created_at',$this->date);
                        
        
        return view('livewire.petty-cash.data')->with(['data'=>$data->paginate(50)]);

        
    }


}



