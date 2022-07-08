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
    public $data_asset, $company_name, $project, $client_project_id, $region, $employee_name, $position, $datalocation, $dataassetname;
    public $asset_type, $asset_name, $location, $quantity, $dimension, $detail, $file, $reason_request, $link, $pic_ba, $pic_phone, $pic_bank_name, $expired_date, $serial_number;
    public $transfer_reason, $pic_asset, $transfer_from;

    public function render()
    {
        $this->data_asset = \App\Models\AssetTransferRequestDetail::select('asset_transfer_request_detail.*', 'asset_database.asset_type', 'asset_database.serial_number', 'asset_database.project', 'asset_database.region', 'asset_database.location')->join('asset_database', 'asset_database.id', '=', 'asset_transfer_request_detail.asset_id')
                                                                ->where('asset_transfer_request_detail.user_id', \Auth::user()->id)
                                                                ->whereNull('id_transfer')
                                                                ->get();
        return view('livewire.asset-database.transferasset');
    }

  
    public function save()
    {

        $data                                   = new \App\Models\AssetTransferRequest();
        $data->transfer_from                    = $this->transfer_from;
        $data->transfer_to                      = $this->pic_asset;
        $data->transfer_reason                  = $this->transfer_reason;
        $data->company_name                     = Session::get('company_id');
        // $data->client_project_id                = $this->client_project_id;
        // $data->project                          = $this->project;
        // $data->region                           = $this->region;
        $data->transfer_id                      = 'trid'.date('ymdhis');
        $data->location                         = $this->location;
  
      
        $data->save();

        
        $updateremarks  = \App\Models\AssetDatabase::where('remarks', '=', 1)->update(array('remarks' => ''));
        $updateasset                = \App\Models\AssetTransferRequestDetail::where('user_id', \Auth::user()->id)->whereNull('id_transfer')->update(array('id_transfer' => $data->transfer_id));
        $updatepic      = \App\Models\AssetTransferRequestDetail::leftjoin('asset_database', 'asset_database.id', '=', 'asset_transfer_request_detail.asset_id')
                                                    ->where('asset_transfer_request_detail.id_transfer', $data->transfer_id)
                                                    ->update(array('asset_database.pic' => $this->pic_asset));
        

        // $notif = get_user_from_access('asset-database.hq-ga');
        // foreach($notif as $user){
        //     if($user->email){
        //         $message  = "<p>Dear {$user->name}<br />, Asset Request need Approval </p>";
        //         $message .= "<p>Nama Employee: {$data->name}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
        //         \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - Asset Request",$message));
        //     }
        // }

        session()->flash('message-success',"Asset Berhasil ditransfer");
        
        return redirect()->route('asset-database.index');
    }

  
}



