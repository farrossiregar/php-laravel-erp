<?php

namespace App\Http\Livewire\AssetRequest;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;
use Auth;


class Addpoprno extends Component
{
    protected $listeners = [
        'modalpoprassetrequest'=>'poprassetrequest',
    ];

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $selected_id, $dana_from, $pr_no, $prno, $dana_amount, $location, $insert=false;

    public function render()
    {
        $data = \App\Models\AssetDatabasePoprnumber::where('asset_id', $this->selected_id)->orderBy('id','DESC');
        return view('livewire.asset-request.addpoprno')->with(['data'=>$data->get()]);
    }

    public function poprassetrequest($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        $datapo                             = new \App\Models\AssetDatabasePoprnumber();
        $datapo->asset_id                   = $this->selected_id;
        $datapo->pr_po_number               = $this->pr_no;
        $datapo->save();

        session()->flash('message-success',"Dana Asset Request Berhasil diinput");
        
        $this->insert = false;
        $this->reset(['pr_no']);
        // $this->emit('reload');

        return redirect()->route('asset-request.index');   
    }
}



