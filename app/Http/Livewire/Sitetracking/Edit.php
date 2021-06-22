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
    public $message,$master;

    protected $listeners = ['proses'];

    public function render()
    {
        // if(check_access_controller('site-tracking.edit') == false){
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
        $this->master = SiteListTrackingMaster::find($id);
        
    }

    public function proses($id)
    {
        $this->master->status = $id;
        $this->master->approved_id = \Auth::user()->employee->id;
        $this->master->approved_date  = date('Y-m-d');
        $this->master->save();

        session()->flash('message-success',"Data processed successfully");
            
        return redirect()->route('site-tracking.index');
    }
}
