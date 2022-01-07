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
    public $dataproject, $company_name, $project, $client_project_id, $region, $employee_name, $position, $datalocation;
    public $asset_type, $asset_name, $location, $quantity, $dimension, $detail, $file, $reason_request, $link;

    public function render()
    {

        $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();
        
        $this->employee_name = $user->name;
        $this->position = get_position($user->user_access_id);
        // $this->project = \App\Models\ClientProject::where('id', $user->project)->first()->name;
        // $this->region = \App\Models\Region::where('id', $user->region_id)->first()->region_code;

        $this->dataproject = \App\Models\ClientProject::orderBy('id', 'desc')
                                ->where('company_id', Session::get('company_id'))
                                ->where('is_project', '1')
                                ->get();

        

        $get_project = \App\Models\ClientProject::where('id', \App\Models\EmployeeProject::where('employee_id', Auth::user()->id)->first()->client_project_id)->first();
        $this->project = $get_project->name;

        $this->region = \App\Models\Region::where('id', $get_project->region_id)->first()->region_code;

        $this->datalocation = \App\Models\Dophomebasemaster::where('status', '1')->where('project', $get_project->name)->where('region', $this->region)->orderBy('id', 'desc')->get();

        // if($this->project){
        //     $getproject = \App\Models\ClientProject::where('id', $this->project)
        //                                             ->where('company_id', Session::get('company_id'))
        //                                             ->where('is_project', '1')
        //                                             ->first();

        //     if($getproject){
        //         if($getproject->region_id){
        //             $this->region = \App\Models\Region::where('id', $getproject->region_id)->first()->region_code;
        //         }else{
        //             $this->region = '';
        //         }
        //     }else{
        //         $this->region = '';
        //     }

        //     if($this->region){
        //         $this->datalocation = \App\Models\Dophomebasemaster::where('project', $getproject->name)
        //                                                             ->where('region', $this->region)
        //                                                             ->where('status', '1')
        //                                                             ->orderBy('id', 'desc')->get();
        //     }
        // }
        
        return view('livewire.asset-request.add');
    }

  
    public function save()
    {

        $user                           = \App\Models\Employee::where('user_id', Auth::user()->id)->first();
        $data                           = new \App\Models\AssetRequest();
        $data->company_name             = Session::get('company_id');
        $data->client_project_id         = \App\Models\ClientProject::where('name', $this->project)->first()->id;
        $data->project                  = $this->project;
        
        
        $data->region                   = $this->region;
        $data->name                     = $this->employee_name;
        $data->nik                      = $user->nik;
        $data->asset_type               = $this->asset_type;
        $data->asset_name               = $this->asset_name;
        $data->location                 = $this->location;
        $data->quantity                 = $this->quantity;
        $data->dimension                = $this->dimension;
        $data->detail                   = $this->detail;
        $data->quantity                 = $this->quantity;
        $data->reason_request           = $this->reason_request;
        
        $this->validate([
            'file'=>'required|mimes:jpg,jpeg,png|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $reference_request = 'reference-request'.date('Ymd').'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/reference_request/',$reference_request);

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



