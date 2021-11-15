<?php

namespace App\Http\Livewire\ApplicationRoomRequest;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Importroomrequest extends Component
{

    use WithFileUploads;
    public $nik,$employee_id, $employee_name, $departement, $lokasi, $type_request, $request_room_detail;
    public $purpose, $participant, $start_date_booking, $start_time_booking, $end_date_booking, $end_time_booking;
    protected $listeners = ['set_selected_date'];

    public function render()
    {
        $user = \Auth::user();
        $this->employee_id = $user->id;
        $this->nik = $user->employee->nik;
        $this->employee_name = $user->name;
        $this->departement = get_position($user->user_access_id);
    
        return view('livewire.application-room-request.importroomrequest');        
    }

    public function mount()
    {
        $this->start_date_booking = date('Y-m-d');
    }

    public function set_selected_date($date)
    {
        $this->start_date_booking = date('Y-m-d',strtotime($date));
    }

    public function save()
    {
        $check = \App\Models\ApplicationRoomRequest::whereDate('start_booking', $this->start_date_booking)
                                                    ->where(DB::Raw('substring(start_booking, 12, 8)'), '>=', $this->start_time_booking.':00')
                                                    ->where(DB::Raw('substring(end_booking, 12, 8)'), '<=', $this->end_time_booking.':00')
                                                    ->where('request_room_detail', $this->request_room_detail)
                                                    ->get();
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
            $datamaster->duration                   = $this->duration($datamaster->end_booking, $datamaster->start_booking);
            $datamaster->purpose                    = $this->purpose;
            $datamaster->participant                = $this->participant;
            $datamaster->status                     = '2';
            $datamaster->note                       = '';
            $datamaster->created_at                 = date('Y-m-d H:i:s');
            $datamaster->updated_at                 = date('Y-m-d H:i:s');
            // dd($this->duration($datamaster->end_booking, $datamaster->start_booking));
            // dd($datamaster->end_booking.' - '.$datamaster->start_booking);
            $datamaster->save();
            session()->flash('message-success',"Success, <strong>Request Successfully Added</strong>");
            return redirect()->route('application-room-request.index');
        }else{
            session()->flash('message-danger',"Failed, <strong>Request Can Not be Saved, Try Another Room or Time</strong>");
            return redirect()->route('application-room-request.index');
        }
           

    }


    public function duration($start_time, $end_time){
        
        $diff = abs(strtotime($end_time) - strtotime($start_time));
        $years   = floor($diff / (365*60*60*24)); 
        $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
        $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
        $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
        
        if($hours > 0){
            $waktu = $hours.'.'.$minuts.' hours';
            // $waktu = $hours;
        }else{
            $waktu = $minuts.' minute';
            // $waktu = $minuts;
        }
        return $waktu;
    }
}