<?php

namespace App\Http\Livewire\AssetTransferRequest;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;
use Auth;


class Add extends Component
{
    protected $listeners = [
        'modaladdassettransferrequest'=>'addassettransferrequest',
    ];

    use WithPagination;
    // public $date, $employee_id;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $selected_id, $transfer_from, $transfer_to, $transfer_reason;
    public $dataproject, $company_name, $project, $client_project_id, $region, $employee_name, $position, $datalocation;
    public $asset_type, $asset_name, $location, $quantity, $dimension, $detail, $file, $reason_request, $link, $reference_pic;
    public $pic_asset, $pic_bank_account;

    public function render()
    {

        
        
        return view('livewire.asset-transfer-request.add');
    }

    public function addassettransferrequest($id)
    {
        $this->selected_id = $id;
        $data                           = \App\Models\AssetRequest::where('id', $this->selected_id)->first();
        // dd($data);
        $this->company_name             = Session::get('company_id');
        $this->client_project_id        = $data->client_project_id;
        $this->project                  = $data->project;
        $this->employee_name            = $data->name;
        $this->transfer_from            = $data->name;
        $this->position                 = \App\Models\UserAccess::where('id', Auth::user()->user_access_id)->first()->name;
        $this->region                   = $data->region;
        $this->name                     = $data->employee_name;
        $this->nik                      = $data->nik;
        $this->asset_type               = $data->asset_type;
        $this->asset_name               = $data->asset_name;
        $this->location                 = \App\Models\DophomebaseMaster::where('id', $data->location)->first()->nama_dop;
        $this->quantity                 = $data->quantity;
        $this->dimension                = $data->dimension;
        $this->detail                   = $data->detail;
        $this->quantity                 = $data->quantity;
        $this->reason_request           = $data->reason_request;
        $this->reference_pic            = $data->reference_pic;
        $this->link                     = $data->link;
        
        $dataasset                      = \App\Models\AssetDatabase::where('asset_type', $data->asset_type)->where('asset_name', $data->asset_name)->first();
        
        $this->pic_asset                = $dataasset->pic;
        $this->pic_bank_account         = $dataasset->pic_bank_account;
    }
  
    public function save()
    {

        $user                           = \App\Models\Employee::where('user_id', Auth::user()->id)->first();
        $data                           = new \App\Models\AssetTransferRequest();
        $data->id_asset_request         = $this->selected_id;
        $data->transfer_from            = $this->transfer_from;
        $data->transfer_to              = $this->pic_asset;
        $data->transfer_reason          = $this->transfer_reason;
        $data->company_name             = Session::get('company_id');
        $data->client_project_id        = $this->client_project_id;
        $data->project                  = $this->project;
        $data->region                   = $this->region;
      
        $data->save();

        // $notif = get_user_from_access('asset-request.hq-ga');
        // foreach($notif as $user){
        //     if($user->email){
        //         $message  = "<p>Dear {$user->name}<br />, Asset Request need Approval </p>";
        //         $message .= "<p>Nama Employee: {$data->name}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
        //         \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - Asset Request",$message));
        //     }
        // }

        session()->flash('message-success',"Asset Transfer Request Berhasil diinput");
        
        return redirect()->route('asset-transfer-request.index');
    }

    public function weekOfMonth3($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }


}



