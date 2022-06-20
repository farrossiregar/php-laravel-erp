<?php

namespace App\Http\Livewire\AssetRequest;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;
use Auth;


class Add extends Component
{
    use WithPagination;
    // public $date, $employee_id;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $dataproject, $company_name, $project, $client_project_id, $region, $employee_name, $position, $datalocation, $dataassetname, $stock;
    public $asset_type, $asset_name, $location, $quantity, $dimension, $detail, $file, $reason_request, $link, $reference_pic;
    public $serial_number;

    public function render()
    {

        return view('livewire.asset-request.add');
    }

  
    public function save()
    {

        // $user                           = \App\Models\Employee::where('user_id', Auth::user()->id)->first();
        $data                           = new \App\Models\AssetDatabase();
        $data->company_id               = Session::get('company_id');
        $data->project                  = $this->project;      
        $data->region                   = $this->region;
        $data->asset_type               = $this->asset_type;
        $data->asset_name               = $this->asset_name;
        $data->location                 = $this->location;
        $data->dimension                = $this->dimension;
        $data->detail                   = $this->detail;
        $data->reason_request           = $this->reason_request;
        $data->serial_number            = $this->serial_number;
        $data->source_asset             = 'request';
        $this->validate([
            'file'=>'required|mimes:jpg,jpeg,png|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $reference_request = 'reference-request'.date('Ymd').'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/Asset_request/',$reference_request);

            $data->reference_pic         = $reference_request;
        }
        $data->link                     = $this->link;
        
        $data->save();

        // $notif = get_user_from_access('asset-request.hq-ga');
        // foreach($notif as $user){
        //     if($user->email){
        //         $message  = "<p>Dear {$user->name}<br />, Asset Request need Approval </p>";
        //         $message .= "<p>Nama Employee: {$data->name}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
        //         \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - Asset Request",$message));
        //     }
        // }

        session()->flash('message-success',"Asset Request Berhasil diinput");
        
        return redirect()->route('asset-request.index');
    }

    public function weekOfMonth3($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }


}



