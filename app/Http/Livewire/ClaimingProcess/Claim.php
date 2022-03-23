<?php

namespace App\Http\Livewire\ClaimingProcess;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;
use Auth;
use DB;

class Claim extends Component
{
    protected $listeners = [
        'modalclaimticket'=>'modalclaimticket',
    ];

    use WithPagination;
    // public $date, $employee_id;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    

    public $claim_category, $position;

    public $company_name, $project, $client_project_id, $region, $employee_name, $date, $ticket_type, $tickettype, $meeting_location, $file;
    public $departure_airport, $arrival_airport, $departure_time, $arrival_time, $airline, $agency, $flight_price;
    public $hotel_price, $hotel_name, $hotel_location, $ticket_id, $nik;
    public $entertainment, $medical, $transport, $parking;
    public $claim_ent, $claim_med, $claim_trans, $claim_parking;

    public function render()
    {

       

        return view('livewire.claiming-process.claim');
    }

    public function modalclaimticket($id)
    {
        // $this->selected_id = $id;
        // $user = \App\Models\Employee::where('user_id', Auth::user()->id)->first();
        
        // $this->employee_name        = $user->name;
        // $this->position             = get_position($user->user_access_id);
        

        $this->selected_id              = $id;
        $data                           = \App\Models\HotelFlightTicket::where('id', $this->selected_id)->first();
    
        $this->ticket_id                = $data->ticket_id;
        $this->employee_name            = $data->name;
        $this->project                  = $data->project;
        $this->date                     = $data->date;
        $this->meeting_location         = $data->meeting_location;
        $this->region                   = $data->region;
        $this->claim_category           = $data->category;
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
        $this->nik                      = $data->nik;

        $datalimit                      = \App\Models\ClaimingProcessLimit::where('nik', $data->nik)->first();
        $limitent                       = json_decode(\App\Models\ClaimingProcess::select(DB::Raw('sum(entertainment) as entertainment'))->where('nik', $data->nik)->where('status', '3')->groupBy('nik')->get())[0]->entertainment;
        $limitmed                       = json_decode(\App\Models\ClaimingProcess::select(DB::Raw('sum(medical) as medical'))->where('nik', $data->nik)->where('status', '3')->groupBy('nik')->get())[0]->medical;
        $limittrans                     = json_decode(\App\Models\ClaimingProcess::select(DB::Raw('sum(transport) as transport'))->where('nik', $data->nik)->where('status', '3')->groupBy('nik')->get())[0]->transport;
        $limitpark                      = json_decode(\App\Models\ClaimingProcess::select(DB::Raw('sum(parking) as parking'))->where('nik', $data->nik)->where('status', '3')->groupBy('nik')->get())[0]->parking;
        // dd($datalimit->entertainment - $limitent);
        $this->entertainment            = $datalimit->entertainment - $limitent;
        $this->medical                  = $datalimit->medical - $limitmed;
        $this->transport                = $datalimit->transport - $limittrans;
        $this->parking                  = $datalimit->parking - $limitpark;
    }

  
    public function save()
    {

        // $datareq                        = \App\Models\HotelFlightTicket::where('id', $this->selected_id)->first();

        $data                           = new \App\Models\ClaimingProcess();
        $data->ticket_id                = $this->ticket_id;
        $data->nik                      = $this->nik;
        $data->claim_category           = $this->claim_category;
        $data->entertainment            = $this->claim_ent;
        $data->medical                  = $this->claim_med;
        $data->transport                = $this->claim_trans;
        $data->parking                  = $this->claim_parking;
        $data->save();
        
        
        

        // $notif = get_user_from_access('asset-request.hq-ga');
        // foreach($notif as $user){
        //     if($user->email){
        //         $message  = "<p>Dear {$user->name}<br />, Asset Request need Approval </p>";
        //         $message .= "<p>Nama Employee: {$data->name}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
        //         \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - Asset Request",$message));
        //     }
        // }

        session()->flash('message-success',"Claim Request Berhasil diinput");
        
        return redirect()->route('claiming-process.index');
    }

    public function weekOfMonth3($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }


}



