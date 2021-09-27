<?php

namespace App\Http\Livewire\DutyRosterDophomebase;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Approvedutyroster extends Component
{
    protected $listeners = [
        'modalapprovedutyroster'=>'approvedutyroster',
    ];

    use WithFileUploads;
    public $selected_id;    
    public $usertype;

    
    public function render()
    {
        return view('livewire.duty-roster-dophomebase.approvedutyroster');
    }

    public function approvedutyroster($id)
    {
        $this->selected_id = $id;
    }

  
    public function save()
    {
        $data = \App\Models\DopHomebaseMaster::where('id', $this->selected_id)->first();
        $data->status = '1';
        $data->save();

        // $check_detail = \App\Models\DutyrosterDophomebaseDetail::where('id_master_dutyroster', $this->selected_id)->get();
        // foreach($check_detail as $item_detail){
        //     // dd($item_detail->nama_dop);
        //     $check = \App\Models\DophomebaseMaster::where('nama_dop', $item_detail->nama_dop)->first();
        //     if($check){
        //         $data               = \App\Models\DophomebaseMaster::where('nama_dop', $item_detail->nama_dop)->first();
        //     }else{
        //         $data               = new \App\Models\DophomebaseMaster();
        //     }
        
        //     $data->nama_dop                 = $item_detail->nama_dop;
        //     $data->project                  = $item_detail->project;
        //     $data->region                   = $item_detail->region;
        //     $data->alamat                   = $item_detail->alamat;
        //     $data->long                     = $item_detail->long;
        //     $data->lat                      = $item_detail->lat;
        //     $data->pemilik_dop              = $item_detail->pemilik_dop;
        //     $data->telepon_pemilik          = $item_detail->telepon_pemilik;
        //     $data->opex_region_ga           = $item_detail->opex_region_ga;
        //     $data->type_homebase_dop        = $item_detail->type_homebase_dop;
        //     $data->expired                  = $item_detail->expired;
        //     $data->budget                   = $item_detail->budget;
        //     $data->remarks                  = '';
        //     $data->created_at               = date('Y-m-d H:i:s');
        //     $data->updated_at               = date('Y-m-d H:i:s');
        //     $data->save();
        // }

    
        $notif = check_access_data('duty-roster-dophomebase.notif-approve', '');
        $nameuser = [];
        $emailuser = [];
        $phoneuser = [];
        foreach($notif as $no => $itemuser){
            $nameuser[$no] = $itemuser->name;
            $emailuser[$no] = $itemuser->email;
            $phoneuser[$no] = $itemuser->telepon;

            $message = "*Dear SRM *\n\n";
            $message .= "*Duty Roster DOP - Homebase dengan id ".$this->selected_id." telah diapprove oleh Finance. Rental is Paid *\n\n";
            send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);    

            // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        }


        session()->flash('message-success',"Berhasil, Duty Roster DOP - Homebase sudah diapprove!!!");
        
        return redirect()->route('duty-roster-dophomebase.index');
    }
}
