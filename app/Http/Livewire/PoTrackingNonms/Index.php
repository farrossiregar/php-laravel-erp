<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingNonms;
use Auth;


class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        // if(!check_access('po-tracking.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }

        $data = PoTrackingNonms::orderBy('id', 'DESC');
        // $data = PoTrackingNonms::orderBy('id', 'DESC')->get();
        
        
        return view('livewire.po-tracking-nonms.index')->with(['data'=>$data->paginate(50)]);
        // return view('livewire.po-tracking-nonms.index')->with(compact('data'));
        
    }


}



