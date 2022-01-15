<?php

namespace App\Http\Livewire\HotelFlightTicket;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;
use Auth;
use DB;


class Add extends Component
{
    use WithPagination;
    // public $date, $employee_id;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $dataproject, $company_name, $project, $client_project_id, $region, $employee_name, $date, $ticket_type, $tickettype;
    public $departure_airport, $arrival_airport, $meeting_location, $file, $claim_category, $limit, $position;

    public function render()
    {

        $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();
        
        $this->employee_name = $user->name;
        $this->project = \App\Models\ClientProject::where('id', $user->project)->first()->name;
        $this->region = \App\Models\Region::where('id', $user->region_id)->first()->region_code;
        $this->position = \App\Models\UserAccess::where('id', \App\Models\Employee::where('user_id', Auth::user()->id)->first()->user_access_id)->first()->name;

        if($this->ticket_type == '1'){
            $this->tickettype = true;
        }else{
            $this->tickettype = false;
        }

        if($this->claim_category){
            $check = \App\Models\ClaimingProcessLimit::where('user_access', $user->user_access_id)->where('claim_category', $this->claim_category)->where('year', date('Y'))->first();
            
            if($check){
                $usedlimit = count(\App\Models\HotelFlightTicket::where('position', $user->user_access_id)->where('category', $this->claim_category)->whereYear('date', date('Y'))->get());
                $this->limit = $check->limit - $usedlimit;
            }else{
                $this->limit = 0;
            }
        }
       

        return view('livewire.hotel-flight-ticket.add');
    }

  
    public function save()
    {
        $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();

        $data                           = new \App\Models\HotelFlightTicket();
        $data->company_name             = Session::get('company_id');
        $data->project                  = $this->project;
        $data->client_project_id        = \App\Models\ClientProject::where('name', $this->project)->first()->id;
        $data->ticket_id                = 'hf'.date('ymd').$this->getNextId();
        
        // $dataemployee                   = explode(" - ",$this->employee_name);
        $data->region                   = $this->region;
        $data->name                     = $this->employee_name;
        $data->nik                      = $user->nik;
        $data->position                 = $user->user_access_id;
        // $data->employee_id              = $dataemployee[2];
        
        $data->category                 = $this->claim_category;
        $data->ticket_type              = $this->ticket_type;
        $data->meeting_location         = $this->meeting_location;
        
        $this->validate([
            'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
        ]);

        if($this->file){
            $hotelflightticket = 'hotel-flight-ticket'.date('Ymd').'.'.$this->file->extension();
            $this->file->storePubliclyAs('public/hotel_flight_ticket/',$hotelflightticket);

            $data->attachment               = $hotelflightticket;
        }
        
        $data->date                     = $this->date;
        $data->departure_airport        = $this->departure_airport;
        $data->arrival_airport          = $this->arrival_airport;
        $data->save();

        // $notif = get_user_from_access('hotel-flight-ticket.noc-manager');
        // foreach($notif as $user){
        //     if($user->email){
        //         $message  = "<p>Dear {$user->name}<br />, Team Schedule need Approval </p>";
        //         $message .= "<p>Nama Employee: {$data->name}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
        //         \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - NOC Team Schedule",$message));
        //     }
        // }

       


        session()->flash('message-success',"Request Hotel & Flight Ticket Berhasil diinput");
        
        return redirect()->route('hotel-flight-ticket.index');
    }

    public function getNextId() 
    {
        $statement = DB::select("show table status like 'hotel_flight_ticket_request'");
        return $statement[0]->Auto_increment;
    }

    public function weekOfMonth3($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }


}



