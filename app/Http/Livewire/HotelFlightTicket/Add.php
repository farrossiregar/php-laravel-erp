<?php

namespace App\Http\Livewire\HotelFlightTicket;

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
    public $dataproject, $company_name, $project, $client_project_id, $region, $employee_name, $date, $ticket_type, $tickettype, $departure_airport, $arrival_airport, $meeting_location, $file;

    public function render()
    {

        $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();
        
        $this->employee_name = $user->name;
        $this->project = \App\Models\ClientProject::where('id', $user->project)->first()->name;
        $this->region = \App\Models\Region::where('id', $user->region_id)->first()->region_code;

        if($this->ticket_type == '1'){
            $this->tickettype = true;
        }else{
            $this->tickettype = false;
        }
       

        return view('livewire.hotel-flight-ticket.add');
    }

  
    public function save()
    {

        $data                           = new \App\Models\HotelFlightTicket();
        $data->company_name             = Session::get('company_id');
        $data->project                  = $this->project;
        $data->client_project_id        = \App\Models\ClientProject::where('name', $this->project)->first()->id;
        
        // $dataemployee                   = explode(" - ",$this->employee_name);
        $data->region                   = $this->region;
        $data->name                     = $this->employee_name;
        // $data->nik                      = $dataemployee[1];
        // $data->employee_id              = $dataemployee[2];
        
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

    public function weekOfMonth3($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }


}



