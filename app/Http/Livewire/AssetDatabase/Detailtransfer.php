<?php

namespace App\Http\Livewire\AssetDatabase;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;
use Auth;


class Detailtransfer extends Component
{
    protected $listeners = [
        'modaldetailtransfer'=>'modaldetailtransfer',
    ];

    use WithPagination;
    // public $date, $employee_id;
    protected $paginationTheme = 'bootstrap';
    
    
    public $selected_id, $project, $region, $nik, $pic;

    
    public function render()
    {
        // $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();
        
        // $this->employee_name = $user->name;
        // $this->position = get_position($user->user_access_id);

        // $this->dataproject = \App\Models\ClientProject::orderBy('id', 'desc')
        //                         ->where('company_id', Session::get('company_id'))
        //                         ->where('is_project', '1')
        //                         ->get();

        // $get_project = \App\Models\ClientProject::where('id', \App\Models\EmployeeProject::where('employee_id', Auth::user()->id)->first()->client_project_id)->first();
        // $this->project = $get_project->name;

        // $this->region = \App\Models\Region::where('id', $get_project->region_id)->first()->region_code;

        // $this->datalocation = \App\Models\Dophomebasemaster::where('status', '1')->where('project', $get_project->name)->where('region', $this->region)->orderBy('id', 'desc')->get();

        // if($this->asset_type){
        //     $this->dataassetname = \App\Models\AssetDatabase::where('asset_type', $this->asset_type)->get();
        // }else{
        //     $this->dataassetname = [];
        // }

        return view('livewire.asset-database.detailtransfer');
    }

    public function modaldetailtransfer($id)
    {
        $this->selected_id = $id;
        
        $data                   = \App\Models\AssetDatabase::where('id', $this->selected_id)->first();

        $this->pic              = $data->pic;
        $this->nik              = $data->nik;
        $this->project          = $data->project;
        $this->region           = $data->region;

        // $this->asset_type       = $data->asset_type;
        // $this->asset_name       = $data->asset_name;
        // $this->location         = $data->location;
        // $this->dimension        = $data->dimension;
        // $this->file             = $data->reference_pic;
        // $this->link             = $data->link;
        // $this->serial_number    = $data->serial_number;
        // $this->expired_date     = $data->expired_date;
        // $this->detail           = $data->detail;
        // $this->reason_request   = $data->reason_request;
        // $this->reference_pic    = $data->reference_pic;
        // $this->link             = $data->link;


        // $this->pr_no             = $data->pr_no;
        // $this->dana_from         = $data->dana_from;
        // $this->dana_amount       = $data->dana_amount;
        
        
    }

    public function save()
    {

        $data                           = \App\Models\AssetDatabase::where('id', $this->selected_id)->first();        
        
        $data->pic                      = $this->pic;
        $data->nik                      = $this->nik;
        $data->region                   = $this->region;
        $data->project                  = $this->project;
        $data->transfer_id              = 'TR'.date('ymdhis');
        
        
        $data->save();

        // $message  = "<p>Dear {$data->name}<br />, Asset Request is Approved </p>";
        // \Mail::to($data->email)->send(new GeneralEmail("[PMT E-PM] - Asset Request",$message));

        session()->flash('message-success',"Asset Transfer Berhasil diinput");
        
        return redirect()->route('asset-database.index');
    }



}



