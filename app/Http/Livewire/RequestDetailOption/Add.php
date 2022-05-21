<?php

namespace App\Http\Livewire\RequestDetailOption;

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
    // public $dataproject, $company_name, $project, $client_project_id, $region, $employee_name, $position, $datalocation, $dataassetname, $stock;
    // public $asset_type, $asset_name, $location, $quantity, $dimension, $detail, $file, $reason_request, $link, $reference_pic;
    public $request_type, $subrequest_type;

    public function render()
    {

        // $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();
        
        // $this->employee_name        = $user->name;
        // $this->position             = get_position($user->user_access_id);
        // $this->location             = '';
        // // $this->project = \App\Models\ClientProject::where('id', $user->project)->first()->name;
        // // $this->region = \App\Models\Region::where('id', $user->region_id)->first()->region_code;

        // // $this->stock = 0;
        // $this->dataproject = \App\Models\ClientProject::orderBy('id', 'desc')
        //                         ->where('company_id', Session::get('company_id'))
        //                         ->where('is_project', '1')
        //                         ->get();

        

        // $get_project = \App\Models\ClientProject::where('id', \App\Models\EmployeeProject::where('employee_id', Auth::user()->id)->first()->client_project_id)->first();
        // $this->project = $get_project->name;

        // $this->region = \App\Models\Region::where('id', $get_project->region_id)->first()->region_code;

        // $this->datalocation = \App\Models\DophomebaseMaster::where('status', '1')->where('project', $get_project->name)->where('region', $this->region)->orderBy('id', 'desc')->get();

        // if($this->asset_type){
        //     $this->dataassetname = \App\Models\AssetDatabase::where('asset_type', $this->asset_type)->get();
        // }else{
        //     $this->dataassetname = [];
        // }

        // if($this->asset_name){
        //     $getasset = \App\Models\AssetDatabase::where('asset_name', $this->asset_name)->first();
        //     $this->location             = @\App\Models\DophomebaseMaster::where('id', $getasset->location)->first()->nama_dop;
        //     $this->dimension            = @$getasset->dimension;
        //     $this->detail               = $getasset->detail;
        //     $this->stock                = (int)$getasset->stok;
        //     $this->reference_pic        = $getasset->reference_pic;
            
        // }else{
        //     $this->location             = '';
        //     $this->dimension            = '';
        //     $this->detail               = '';
        //     $this->Stock                = 0;
        //     $this->reference_pic        = '';
        // }

        return view('livewire.request-detail-option.add');
    }

  
    public function save()
    {
        $data                           = new \App\Models\RequestDetailOption();
        $data->id_request_type          = $this->request_type;

        // dd( \App\Models\RequestDetailOption::where('id_request_type', $this->request_type)->orderBy('id_request_detail_option', 'DESC')->first());

        if($this->request_type == "1"){  $data->request_type    = "Petty Cash"; }
        if($this->request_type == "2"){  $data->request_type    = "Weekly Opex"; }
        if($this->request_type == "3"){  $data->request_type    = "Other Opex"; }
        if($this->request_type == "4"){  $data->request_type    = "Rectification"; }
        if($this->request_type == "5"){  $data->request_type    = "Subcont"; }
        if($this->request_type == "6"){  $data->request_type    = "Site Keeper"; }
        if($this->request_type == "7"){  $data->request_type    = "HQ Administration"; }
        if($this->request_type == "8"){  $data->request_type    = "Payroll"; }
        
        $latest_id_request_detail_option    = \App\Models\RequestDetailOption::where('id_request_type', $this->request_type)->orderBy('id_request_detail_option', 'DESC')->first();
        if($latest_id_request_detail_option == null){
            $data->id_request_detail_option     = 0 + 1;
        }else{
            $data->id_request_detail_option     = $latest_id_request_detail_option->id_request_detail_option + 1;
        }
        
        $data->request_detail_option        = $this->subrequest_type;
        
        
        $data->save();

        session()->flash('message-success',"Request Detail Option Berhasil diinput");
        return redirect()->route('request-detail-option.index');
    }

    public function weekOfMonth3($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }


}



