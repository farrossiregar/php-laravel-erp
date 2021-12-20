<?php

namespace App\Http\Livewire\HotelFlightTicket;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ApplicationRoomRequest;
use DB;

class Dashboard extends Component
{
    use WithPagination;
    public $project, $filterproject, $filterweek, $filtermonth, $filteryear, $employee_name;
    public $labels;
    public $datasets;
    public $labelsapp;
    public $datasetsapp;
    public $title;
    public $startdate;
    public $enddate,$date_active,$data_room;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['set_selected_date'];
    // public function render()
    // {
    //     $this->generate_chart();
    //     return view('livewire.hotel-flight-ticket.dashboard');
    // }


    public function render()
    {
        $data = \App\Models\TeamScheduleNoc::where('status', '2')->orderBy('created_at', 'desc')->groupBy('name');
        
        // if($keyword) $temp->where(function($table) use ($keyword){
        //     foreach(\Illuminate\Support\Facades\Schema::getColumnListing('sites') as $column){
        //         $table->orWhere($column,'LIKE',"%{$keyword}%");
        //     }
        // });
        // if($this->date) $ata = $data->whereDate('created_at',$this->date);
        
        
        if($this->filteryear) $ata = $data->whereYear('start_schedule',$this->filteryear);
        if($this->filtermonth) $ata = $data->whereMonth('start_schedule',$this->filtermonth);                
        if($this->filterweek) $ata = $data->where('week',$this->filterweek);
        if($this->filterproject) $ata = $data->where('project',$this->filterproject);   

        return view('livewire.hotel-flight-ticket.dashboard')->with(['data'=>$data->paginate(50)]);
    }

    public function cancel_room(ApplicationRoomRequest $data)
    {
        \LogActivity::add('Cancel Room');

        $data->status = 3;
        $data->save();
        $this->data_room = ApplicationRoomRequest::where('type_request','room')->whereDate('start_booking',date('Y-m-d'))->get();

        $this->emit('message-success',"Request successfully canceled");
    }

    public function set_selected_date($date)
    {
        $this->date_active = date('d/M/Y',strtotime($date));
        $this->data_room = ApplicationRoomRequest::where('type_request','room')->whereDate('start_booking',date('Y-m-d',strtotime($date)))->get();
    }

    public function mount()
    {
        $this->date_active = date('d/M/Y');
        $this->employee_id = \Auth::user()->id;
        $this->data_room = ApplicationRoomRequest::where('type_request','room')->whereDate('start_booking',date('Y-m-d'))->get();
    }
    
    // public function updated()
    // {
    //     $this->generate_chart();
    // }
    
    // public function generate_chart()
    // {
    //     $this->labels = [];
    //     $this->datasets = [];
    //     $this->labelsapp = [];
    //     $this->datasetsapp = [];

        
    //     if($this->month){
    //         $this->month = $this->month;
    //     }else{
    //         $this->month = date('m');
    //     }

    //     if($this->year){
    //         $this->year = $this->year;
    //     }else{
    //         $this->year = date('Y');
    //     }

    //     $roomrequest = \App\Models\ApplicationRoomRequest::select('request_room_detail')
    //                                                         ->whereMonth('created_at', $this->month)
    //                                                         ->whereYear('created_at', $this->year)
    //                                                         ->where('type_request', 'room')
    //                                                         ->where('status', '2')
    //                                                         ->groupBy('request_room_detail')->get();
    //     $numbroomrequest = \App\Models\ApplicationRoomRequest::select(DB::Raw('count(request_room_detail) as jumlahrequest'))
    //                                                         ->whereMonth('created_at', $this->month)
    //                                                         ->whereYear('created_at', $this->year)
    //                                                         ->where('type_request', 'room')
    //                                                         ->where('status', '2')
    //                                                         ->groupBy('request_room_detail')->get();
        
    //     $apprequest = \App\Models\ApplicationRoomRequest::select('request_room_detail')
    //                                                         ->whereMonth('created_at', $this->month)
    //                                                         ->whereYear('created_at', $this->year)
    //                                                         ->where('type_request', 'application')
    //                                                         ->where('status', '2')
    //                                                         ->groupBy('request_room_detail')->get();
    //     $numbapprequest = \App\Models\ApplicationRoomRequest::select(DB::Raw('count(request_room_detail) as jumlahrequest'))
    //                                                         ->whereMonth('created_at', $this->month)
    //                                                         ->whereYear('created_at', $this->year)
    //                                                         ->where('type_request', 'application')
    //                                                         ->where('status', '2')
    //                                                         ->groupBy('request_room_detail')->get();
        

       
    //     $get_request_room = \App\Models\ApplicationRoomRequest::select('request_room_detail')->where('type_request', 'room')->get();
    //     $get_request_room_start = \App\Models\ApplicationRoomRequest::select('start_booking')->where('type_request', 'room')->get();
    //     $get_request_room_end = \App\Models\ApplicationRoomRequest::select('end_booking')->where('type_request', 'room')->get();
        

    //     $this->labels = json_encode($roomrequest);
    //     $this->datasets = json_encode($numbroomrequest);
    //     $this->labelsapp = json_encode($apprequest);
    //     $this->datasetsapp = json_encode($numbapprequest);
    //     $this->title = json_encode($get_request_room);        
    //     $this->startdate = json_encode($get_request_room_start);
    //     $this->enddate = json_encode($get_request_room_end);
        

    //     $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets,'labelsapp'=>$this->labelsapp,'datasetsapp'=>$this->datasetsapp, 'title'=>$this->title, 'startdate'=>$this->startdate, 'enddate'=>$this->enddate]);
    // }


}



