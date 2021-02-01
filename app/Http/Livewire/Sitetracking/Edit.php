<?php

namespace App\Http\Livewire\Sitetracking;

use Livewire\Component;
use App\Models\SiteListTrackingMaster;
use App\Models\SiteListTrackingDetail;


class Edit extends Component
{
    public $data;
    // public $id;
    public $collection;
    public $item_number;
    public $date_po_released;
    public $pic_rpm;
    public $pic_sm;
    public $type;
    public $message;


    public function render()
    {
        // if(check_access_controller('cluster.edit') == false){
        //     session()->flash('message-error','Access denied.');
        //     $this->redirect('/');
        // }
        
        $data           = $this->data;
        $status         = $this->status;
        $id_site_master = $this->id;

        // return view('livewire.sitetracking.edit')->with(['data'=>$this->data]);
        return view('livewire.sitetracking.edit')->with(compact('data', 'id_site_master', 'status'));
    }

    public function mount($id)
    {
        $this->data      = SiteListTrackingDetail::where('id_site_master',$id)->get();
        $this->status    = SiteListTrackingMaster::select('status')->where('id',$id)->get();
        $this->id        = $id;       
        
    }

    // public function save(){
    //     $this->validate();
        
    //     $this->data->name = $this->name;
    //     $this->data->region_id = $this->region_id;
    //     $this->data->save();

    //     session()->flash('message-success',__('Data saved successfully'));

    //     return redirect()->to('cluster');
    // }
}
