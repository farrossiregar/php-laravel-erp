<?php

namespace App\Http\Livewire\AssetDatabase;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;
use Auth;


class Detailrequest extends Component
{
    protected $listeners = [
        'modaldetailrequest'=>'modaldetailrequest',
    ];

    use WithPagination;
    // public $date, $employee_id;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $selected_id, $dana_from, $pr_no, $prno, $dana_amount;
    public $dataproject, $company_name, $project, $client_project_id, $region, $employee_name, $position, $datalocation, $dataassetname;
    public $asset_type, $asset_name, $location, $quantity, $dimension, $detail, $file, $reason_request, $link, $expired_date;

    public function render()
    {
        $this->dataproject = \App\Models\ClientProject::orderBy('id', 'desc')
                                                ->where('company_id', Session::get('company_id'))
                                                ->where('is_project', '1')
                                                ->get();

        $get_project = \App\Models\ClientProject::where('id', \App\Models\EmployeeProject::where('employee_id', Auth::user()->id)->first()->client_project_id)->first();
        $this->project = $get_project->name;

        $this->region = \App\Models\Region::where('id', $get_project->region_id)->first()->region_code;

        $this->datalocation = \App\Models\Dophomebasemaster::where('status', '1')->where('project', $get_project->name)->where('region', $this->region)->orderBy('id', 'desc')->get();

        if($this->asset_type){
        $this->dataassetname = \App\Models\AssetDatabase::where('asset_type', $this->asset_type)->get();
        }else{
        $this->dataassetname = [];
        }
        if($this->dana_from == '1'){
            $this->prno = '1';
        }
        return view('livewire.asset-database.detailrequest');
    }

    public function modaldetailrequest($id)
    {

        $this->selected_id      = $id;
        $data                   = \App\Models\AssetDatabase::where('id', $this->selected_id)->first();
        $this->asset_type       = $data->asset_type;
        $this->asset_name       = $data->asset_name;
        $this->location         = $data->location;
        $this->dimension        = $data->dimension;
        $this->file             = $data->reference_pic;
        $this->link             = $data->link;
        // $this->serial_number    = $data->serial_number;
        $this->expired_date     = $data->expired_date;
        $this->detail           = $data->detail;
        $this->reason_request   = $data->reason_request;
        
    }

    public function save()
    {

        $data                           = \App\Models\AssetDatabase::where('id', $this->selected_id)->first();        
        $data->reason_request           = $this->reason_request;
        $this->validate([
            'file'=>'required|mimes:jpg,jpeg,png|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $reference_request = 'reference-request'.date('Ymd').'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/Asset_database/',$reference_request);

            $data->reference_pic         = $reference_request;
        }
        $data->location                 = $this->location;
        $data->dimension                = $this->dimension;
        $data->detail                   = $this->detail;
        // $data->dana_from                = $this->dana_from;
        // $data->pr_no                    = $this->pr_no;
        // $data->dana_amount              = $this->dana_amount;
        // $data->serial_number            = 'ar'.date('ymd').$this->selected_id;
        $data->request_id               = 'REQ'.date('ymdhis');
        
        $data->save();

        // $message  = "<p>Dear {$data->name}<br />, Asset Request is Approved </p>";
        // \Mail::to($data->email)->send(new GeneralEmail("[PMT E-PM] - Asset Request",$message));

        session()->flash('message-success',"Asset Request Berhasil diinput");
        
        return redirect()->route('asset-database.index');
    }



}



