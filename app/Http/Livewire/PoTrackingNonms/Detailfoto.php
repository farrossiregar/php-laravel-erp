<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingNonms;
use App\Models\PoTrackingNonmsBast;
use Auth;
use DB;


class Detailfoto extends Component
{
    use WithPagination;
    public $data, $datadoc;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        // if(!check_access('po-tracking-nonms.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }

        // $user = \Auth::user();
       
        
        // $data = json_encode($data);
        $data = $this->data;
        $datadoc = $this->datadoc;
        // return view('livewire.po-tracking-nonms.index')->with(['data'=>$data->paginate(50)]);
        // return view('livewire.po-tracking-nonms.detailfoto')->with(['data'=>$data]);
        return view('livewire.po-tracking-nonms.detailfoto');
       
    }


    public function mount($id){
        // $this->id = $id;

        $this->data     = PoTrackingNonmsBast::where('po_tracking_nonms_id', $id)->orderBy('id', 'DESC')->get();
        $this->datadoc  = PoTrackingNonms::where('id', $id)->orderBy('id', 'DESC')->first();
    }


}



