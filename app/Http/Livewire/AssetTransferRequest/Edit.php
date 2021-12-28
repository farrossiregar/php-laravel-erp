<?php

namespace App\Http\Livewire\AssetTransferRequest;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;
use Auth;


class Edit extends Component
{
    protected $listeners = [
        'modaleditassettransferrequest'=>'editassettransferrequest',
    ];

    use WithPagination;
    // public $date, $employee_id;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $selected_id, $dana_from, $pr_no, $prno, $amount_transfer;

    public function render()
    {
        
        return view('livewire.asset-transfer-request.edit');
    }

    public function editassettransferrequest($id)
    {
        $this->selected_id = $id;
        // dd($id);

        $this->dana_from           = \App\Models\AssetRequest::where('id', $id[1  ])->first()->dana_from;
       
        
    }

  
    public function save()
    {
        $id = $this->selected_id;
        $data                           = \App\Models\AssetTransferRequest::where('id', $id[0])->first();
        $data->amount_transfer          = $this->amount_transfer;
        $data->save();

        // $message  = "<p>Dear {$data->name}<br />, Asset Request is Approved </p>";
        // \Mail::to($data->email)->send(new GeneralEmail("[PMT E-PM] - Asset Request",$message));

        session()->flash('message-success',"Dana Asset Request Berhasil ditransfer");
        
        return redirect()->route('asset-transfer-request.index');
    }

   

}



