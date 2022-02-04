<?php

namespace App\Http\Livewire\ClaimingProcess;

use Livewire\Component;
use Livewire\WithFileUploads;
use DateTime;

use Session;

class Detail extends Component
{
    protected $listeners = [
        'modaldetailticket'=>'modaldetailticket',
    ];

    use WithFileUploads;
    public $selected_id, $data;
    // public $dataproject, $company_name, $project, $region, $employeelist, $employee_name, $date_plan, $start_time_plan, $end_time_plan;
    public $dataproject, $company_name, $project, $client_project_id, $region, $employee_name, $date, $ticket_type, $tickettype, $meeting_location, $file;
    public $departure_airport, $arrival_airport, $departure_time, $arrival_time, $airline, $agency, $flight_price;
    public $hotel_price, $hotel_name, $hotel_location, $confirmation_flight;

    
    public function render()
    {

        return view('livewire.claiming-process.detail');
        
    }

    public function modaldetailticket($id){
        $this->selected_id              = $id;
        $data                           = \App\Models\HotelFlightTicket::where('id', $this->selected_id)->first();
    
        $this->employee_name            = $data->name;
        $this->project                  = $data->project;
        $this->date                     = $data->date;
        $this->meeting_location         = $data->meeting_location;
        // $this->project                  = get_project_company($data->project, $data->company_name);
        $this->region                   = $data->region;
        // $this->region                   = \App\Models\Region::where('id', $data->region)->first()->region_code;
        // $data->company_name             = Session::get('company_id');
        // $data->ticket_type              = $this->ticket_type;
        if($data->ticket_type == '1'){
            $this->tickettype = true;
        }else{
            $this->tickettype = false;
        }

        $this->departure_airport        = $data->departure_airport;
        $this->arrival_airport          = $data->arrival_airport;
        $this->departure_time           = date_format(date_create($data->departure_time), 'H:i');
        $this->arrival_time             = date_format(date_create($data->arrival_time), 'H:i');
        $this->airline                  = $data->airline;
        $this->agency                   = $data->agency;
        $this->flight_price             = $data->flight_price;

        $this->hotel_price              = $data->hotel_price;
        $this->hotel_name               = $data->hotel_name;
        $this->hotel_location           = $data->hotel_location;
        $this->file                     = $data->confirmation_flight;
        
        
        
       
    }
  
    // public function save()
    // {
    //     $data                           = \App\Models\HotelFlightTicket::where('id', $this->selected_id)->first();
       
    //     $data->departure_airport        = $this->departure_airport;
    //     $data->arrival_airport          = $this->arrival_airport;
    //     $data->departure_time           = $data->date.' '.$this->departure_time.':00';
    //     $data->arrival_time             = $data->date.' '.$this->arrival_time.':00';
    //     $data->airline                  = $this->airline;
    //     $data->agency                   = $this->agency;
    //     $data->flight_price             = $this->flight_price;

    //     $data->hotel_price              = $this->hotel_price;
    //     $data->hotel_name               = $this->hotel_name;
    //     $data->hotel_location           = $this->hotel_location;

    //     $this->validate([
    //         'file'=>'required|mimes:xls,xlsx,pdf|max:51200' // 50MB maksimal
    //     ]);

    //     if($this->file){
    //         $confirmationflight = 'confirmation-flight'.$data->id.'.'.$this->file->extension();
    //         $this->file->storePubliclyAs('public/hotel_flight_ticket/',$confirmationflight);

    //         $data->confirmation_flight               = $confirmationflight;
    //     }
      
    //     $data->save();

    //     // $notif = \App\Models\Employee::where('name', $data->name)->first();
    //     // foreach($notif as $user){
    //     //     if($user->email){
    //     //         $message  = "<p>Dear {$notif->name}<br />, Hotel & Flight request is Approved </p>";
    //     //         if($data->ticket_type == '1'){
    //     //             $message .= "<p>Flight Time: {date_format(date_create($data->departure_time), 'H:i')} - {date_format(date_create($data->departure_time), 'H:i')}<br />Airline : {$data->airline}<br /></p>";
    //     //         }

    //     //         $message .= "<p>Hotel Name: {$data->hotel_name}<br />Hotel Location : {$data->hotel_location}<br /></p>";
                
    //     //         \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - NOC Team Schedule",$message));
    //     //     }
    //     // }
        
        
    //     session()->flash('message-success',"Hotel & Flight Ticket Berhasil diupdate");
        
    //     return redirect()->route('hotel-flight-ticket.index');
        
    // }

    
}
