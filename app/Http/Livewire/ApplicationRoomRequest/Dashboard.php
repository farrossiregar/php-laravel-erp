<?php

namespace App\Http\Livewire\ApplicationRoomRequest;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingNonms;
use Auth;
use DB;


class Dashboard extends Component
{
    use WithPagination;
    public $date, $month, $year;
    public $labels;
    public $datasets;
    public $labelsapp;
    public $datasetsapp;
    public $title;
    public $startdate;
    public $enddate;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $this->generate_chart();
        return view('livewire.application-room-request.dashboard');
    }
    
    // public function updated($propertyName)
    public function updated()
    {
        // if($propertyName=='year') $this->month = '';
        $this->generate_chart();
    }
    
    public function generate_chart()
    {
        $this->labels = [];
        $this->datasets = [];
        $this->labelsapp = [];
        $this->datasetsapp = [];

        
        if($this->month){
            $this->month = $this->month;
        }else{
            $this->month = date('m');
        }

        if($this->year){
            $this->year = $this->year;
        }else{
            $this->year = date('Y');
        }

        $roomrequest = \App\Models\ApplicationRoomRequest::select('request_room_detail')
                                                            ->whereMonth('created_at', $this->month)
                                                            ->whereYear('created_at', $this->year)
                                                            ->where('type_request', 'room')
                                                            ->where('status', '2')
                                                            ->groupBy('request_room_detail')->get();
        $numbroomrequest = \App\Models\ApplicationRoomRequest::select(DB::Raw('count(request_room_detail) as jumlahrequest'))
                                                            ->whereMonth('created_at', $this->month)
                                                            ->whereYear('created_at', $this->year)
                                                            ->where('type_request', 'room')
                                                            ->where('status', '2')
                                                            ->groupBy('request_room_detail')->get();
        
        $apprequest = \App\Models\ApplicationRoomRequest::select('request_room_detail')
                                                            ->whereMonth('created_at', $this->month)
                                                            ->whereYear('created_at', $this->year)
                                                            ->where('type_request', 'application')
                                                            ->where('status', '2')
                                                            ->groupBy('request_room_detail')->get();
        $numbapprequest = \App\Models\ApplicationRoomRequest::select(DB::Raw('count(request_room_detail) as jumlahrequest'))
                                                            ->whereMonth('created_at', $this->month)
                                                            ->whereYear('created_at', $this->year)
                                                            ->where('type_request', 'application')
                                                            ->where('status', '2')
                                                            ->groupBy('request_room_detail')->get();
        

       
        $get_request_room = \App\Models\ApplicationRoomRequest::select('request_room_detail')->where('type_request', 'room')->get();
        $get_request_room_start = \App\Models\ApplicationRoomRequest::select('start_booking')->where('type_request', 'room')->get();
        $get_request_room_end = \App\Models\ApplicationRoomRequest::select('end_booking')->where('type_request', 'room')->get();
        

        $this->labels = json_encode($roomrequest);
        $this->datasets = json_encode($numbroomrequest);
        $this->labelsapp = json_encode($apprequest);
        $this->datasetsapp = json_encode($numbapprequest);
        $this->title = json_encode($get_request_room);        
        $this->startdate = json_encode($get_request_room_start);
        $this->enddate = json_encode($get_request_room_end);
        

        $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets,'labelsapp'=>$this->labelsapp,'datasetsapp'=>$this->datasetsapp, 'title'=>$this->title, 'startdate'=>$this->startdate, 'enddate'=>$this->enddate]);
    }


}



