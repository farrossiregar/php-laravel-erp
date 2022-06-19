<?php

namespace App\Http\Livewire\AssetDatabase;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;
use Auth;


class Transferasset extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    use WithFileUploads;
    public $dataproject, $company_name, $project, $client_project_id, $region, $employee_name, $position, $datalocation, $dataassetname;
    public $asset_type, $asset_name, $location, $quantity, $dimension, $detail, $file, $reason_request, $link, $pic_ba, $pic_phone, $pic_bank_name, $expired_date, $serial_number;

    public function render()
    {

        return view('livewire.asset-database.transferasset');
    }

  
    public function save()
    {
        $this->validate([
            'asset_type' => 'required',
            'asset_name' => 'required'
        ]);

        $user                           = \App\Models\Employee::where('user_id', Auth::user()->id)->first();
        $data                           = new \App\Models\AssetDatabase();
        $data->company_id               = Session::get('company_id');
        $data->client_project_id        = \App\Models\ClientProject::where('name', $this->project)->first()->id;
        $data->project                  = \App\Models\ClientProject::where('name', $this->project)->first()->id;
        
        $data->region                   = $this->region;
        // $data->pic                      = $this->employee_name;
        
        // $data->nik                      = $user->nik;
        $data->asset_type               = $this->asset_type;
        $data->asset_name               = $this->asset_name;
        $data->location                 = $this->location;
        
        $data->dimension                = $this->dimension;
        // $data->detail                   = $this->detail;
        // $data->reason_request           = $this->reason_request;
        
        // $this->validate([
        //     'file'=>'required|mimes:jpg,jpeg,png|max:51200' // 50MB maksimal
        // ]);

        // if($this->file){
        //     $reference_request = 'reference-request'.date('Ymd').'.'.$this->file->extension();
        //     $this->file->storePubliclyAs('public/Asset_database/',$reference_request);

        //     $data->reference_pic         = $reference_request;
        // }
        
        // $data->link                     = $this->link;
        $data->expired_date             = $this->expired_date;
        $data->save();

        // $notif = get_user_from_access('asset-database.hq-ga');
        // foreach($notif as $user){
        //     if($user->email){
        //         $message  = "<p>Dear {$user->name}<br />, Asset Request need Approval </p>";
        //         $message .= "<p>Nama Employee: {$data->name}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
        //         \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - Asset Request",$message));
        //     }
        // }

        session()->flash('message-success',"Asset Database Berhasil diinput");
        
        return redirect()->route('asset-database.index');
    }

  
}



