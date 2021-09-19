<?php

namespace App\Http\Livewire\ApplicationRoomRequest;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Importroomrequest extends Component
{

    use WithFileUploads;
    public $employee_id, $employee_name, $departement, $lokasi, $type_request, $request_room_detail;
    public $purpose, $participant, $start_date_booking, $start_time_booking, $end_date_booking, $end_time_booking;

    
    public function render()
    {
        $user = \Auth::user();
        $this->employee_id = $user->id;
        $this->employee_name = $user->name;
        $this->departement = get_position($user->user_access_id);
        // dd($user);
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        
        // return view('livewire.duty-roster-dophomebase.importdutyroster');
        return view('livewire.application-room-request.importroomrequest');
        
    }

  
    public function save()
    {

        $check = \App\Models\ApplicationRoomRequest::whereDate('start_booking', $this->start_date_booking)
                                                    ->where(DB::Raw('substring(start_booking, 12, 8)'), '>=', $this->start_time_booking.':00')
                                                    ->where(DB::Raw('substring(end_booking, 12, 8)'), '<=', $this->end_time_booking.':00')
                                                    ->where('request_room_detail', $this->request_room_detail)
                                                    ->get();
        // dd(count($check));
        
        if(count($check) < 1){
            $datamaster                             = new \App\Models\ApplicationRoomRequest();
            $datamaster->employee_id                = $this->employee_id;
            $datamaster->employee_name              = $this->employee_name;
            $datamaster->departement                = $this->departement;
            $datamaster->lokasi                     = $this->lokasi;
            $datamaster->type_request               = 'room';
            $datamaster->request_room_detail        = $this->request_room_detail;
            $datamaster->start_booking              = $this->start_date_booking.' '.$this->start_time_booking;
            $datamaster->end_booking                = $this->start_date_booking.' '.$this->end_time_booking;
            $datamaster->purpose                    = $this->purpose;
            $datamaster->participant                = $this->participant;
            $datamaster->status                     = '';
            $datamaster->note                       = '';
            $datamaster->created_at                 = date('Y-m-d H:i:s');
            $datamaster->updated_at                 = date('Y-m-d H:i:s');
            
            $datamaster->save();
            session()->flash('message-success',"Success, <strong>Request Successfully Added</strong>");
            return redirect()->route('application-room-request.index');
        }else{
            session()->flash('message-danger',"Failed, <strong>Request Can Not be Saved, Try Another Room or Time</strong>");
            return redirect()->route('application-room-request.index');
        }
           


        // $this->validate([
        //     'file'=>'required|mimes:xls,xlsx|max:51200' // 50MB maksimal
        // ]);
        
        // $users = Auth::user();

        // $path = $this->file->getRealPath();
       
        // $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        // $reader->setReadDataOnly(true);
        // $data = $reader->load($path);
        // $sheetData = $data->getActiveSheet()->toArray();

       

        // if(count($sheetData) > 0){
        //     $countLimit = 1;
        //     $total_failed = 0;
        //     $total_success = 0;

        //     // $datamaster                 = new \App\Models\ApplicationRoomRequest();
        //     // $datamaster->upload_by      = 'HRD - GA';
        //     // $datamaster->created_at     = date('Y-m-d H:i:s');
        //     // $datamaster->updated_at     = date('Y-m-d H:i:s');
        //     // $datamaster->status         = '';
        //     // $datamaster->save();


        //     // foreach($sheetData as $key => $i){
        //     //     if($key<2) continue; // skip header
                
        //     //     foreach($i as $k=>$a){ $i[$k] = trim($a); }
                    
        //     //         $data                           = new \App\Models\DutyrosterDophomebaseDetail();
        //     //         $data->id_master_dutyroster     = $datamaster->id;
        //     //         $data->nama_dop                 = $i[0];
        //     //         $data->project                  = $i[1];
        //     //         $data->region                   = $i[2];
        //     //         $data->alamat                   = $i[3];
        //     //         $data->long                     = $i[4];
        //     //         $data->lat                      = $i[5];
        //     //         $data->pemilik_dop              = $i[6];
        //     //         $data->telepon_pemilik          = $i[7];
        //     //         $data->opex_region_ga           = $i[8];
        //     //         $data->type_homebase_dop        = $i[9];
        //     //         $data->expired                  = $i[10];
        //     //         $data->budget                   = $i[11];
        //     //         $data->remarks                  = '';
        //     //         $data->created_at               = date('Y-m-d H:i:s');
        //     //         $data->updated_at               = date('Y-m-d H:i:s');
        //     //         $data->save();
                    
               

        //     //     $total_success++;
        //     // }

        //     // session()->flash('message-success',"Upload success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            
        //     return redirect()->route('application-room-request.index');   
        // }
    }
    
}
