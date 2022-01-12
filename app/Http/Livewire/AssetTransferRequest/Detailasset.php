<?php

namespace App\Http\Livewire\AssetTransferRequest;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;
use Auth;


class Detailasset extends Component
{
    protected $listeners = [
        'modaldetailassetrequest'=>'detailassetrequest',
    ];

    use WithPagination;
    // public $date, $employee_id;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $selected_id, $transfer_from, $transfer_to, $transfer_reason;
    public $dataproject, $company_name, $project, $client_project_id, $region, $employee_name, $position, $datalocation;
    public $asset_type, $asset_name, $location, $quantity, $dimension, $detail, $file, $reason_request, $link, $reference_pic;

    public function render()
    {
       
       
        return view('livewire.asset-transfer-request.detailasset');
    }

    public function detailassetrequest($id)
    {
        $this->selected_id = $id;
        $data                           = \App\Models\AssetRequest::where('id', $this->selected_id)->first();
        // dd($data);
        $this->company_name             = Session::get('company_id');
        $this->client_project_id        = @$data->client_project_id;
        $this->project                  = @$data->project;
        $this->employee_name            = $data->name;
        $this->position                 = \App\Models\UserAccess::where('id', Auth::user()->id)->first()->name;
        $this->region                   = $data->region;
        $this->name                     = $data->employee_name;
        $this->nik                      = $data->nik;
        if($data->asset_type == '1'){
            $asset_type = 'Air Conditioner & Fan';
        }

        if($data->asset_type == '2'){
            $asset_type = 'Furniture & Fixture';
        }

        if($data->asset_type == '3'){
            $asset_type = 'Computer Equipment';
        }

        if($data->asset_type == '4'){
            $asset_type = 'Printer & Device';
        }

        $this->asset_type               = $asset_type;
        $this->asset_name               = $data->asset_name;
        $this->location                 = @\App\Models\DophomebaseMaster::where('id', $data->location)->first()->nama_dop;
        // $this->location                 = @$data->location;
        $this->quantity                 = $data->quantity;
        $this->dimension                = $data->dimension;
        $this->detail                   = $data->detail;
        $this->quantity                 = $data->quantity;
        $this->reason_request           = $data->reason_request;
        $this->reference_pic            = $data->reference_pic;
        $this->link                     = $data->link;
        
    }

  

}



