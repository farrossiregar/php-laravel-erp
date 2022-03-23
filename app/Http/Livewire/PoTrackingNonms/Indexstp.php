<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingNonms;

class Indexstp extends Component
{
    use WithPagination;
    public $date;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $user = \Auth::user();
        
        if(check_access('po-tracking-nonms.index-regional')){
            $data = PoTrackingNonms::where('region', isset(\Auth::user()->employee->region->region)?\Auth::user()->employee->region->region:'')
                                ->where('type_doc', '1')
                                ->orderBy('id', 'DESC'); 
        }else
            $data = PoTrackingNonms::where('type_doc', '1')->orderBy('id', 'DESC');
        
        if($this->date) $data->whereDate('created_at',$this->date);
        
        return view('livewire.po-tracking-nonms.indexstp')->with(['data'=>$data->paginate(50)]);   
    }
}