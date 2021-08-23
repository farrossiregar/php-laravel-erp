<?php

namespace App\Http\Livewire\DutyRosterFlmengineer;

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

    public $labelsorgflm;
    public $datasetsorgflm;

    public $labelsorgmanagement;
    public $datasetsorgmanagement;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $this->generate_chart();
        return view('livewire.duty-roster-flmengineer.dashboard');
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

        $this->labelsorgflm = [];
        $this->datasetsorgflm = [];

        $this->labelsorgmanagement = [];
        $this->datasetsorgmanagement = [];

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


        $master_dutyroster_flmengineer = \App\Models\Employee::select('level')
                                                                            ->where(DB::Raw('year(resign_date)'), $this->year)
                                                                            ->where(DB::Raw('month(resign_date)'), $this->month)
                                                                            ->groupBy('level')
                                                                            ->get();
        foreach($master_dutyroster_flmengineer as $k => $item){
            // $this->labels[] = date('F', mktime(0, 0, 0, $item->month, 10));
            $this->labels[] = $item->level;
        }
        $lvl = array('FLM Engineer Active Personel', 'Management Active Personel', 'Resign Team This Month');
        $this->labels = array('FLM Engineer Active Personel', 'Management Active Personel', 'Resign Team This Month');

        // dd($this->labels);
        
        $color = ['#ffb1c1','#4b89d6','#add64b','#80b10a','#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
        $this->datasets[] = [];
      
       
        $flmengineeractive = \App\Models\Employee::select(DB::Raw('count(*) as activeflm'), 'name', 'level')
                                                    ->whereNull('resign_date')
                                                    ->where('level', 'FLM Engineer')
                                                    ->groupBy('level')
                                                    ->first();

        $this->datasets[0]['label'] = 'FLM Engineer Active Personel';
        $this->datasets[0]['backgroundColor'] = $color[0];
        $this->datasets[0]['fill'] = 'boundary';
        // $this->datasets[0]['data'][] = $flmengineeractive->activeflm;
        


        $managementactive = \App\Models\Employee::select(DB::Raw('count(*) as activemanagement'), 'name', 'level')
                                                    
                                                    ->whereNull('resign_date')
                                                    ->where('level', 'Management')
                                                    ->groupBy('level')
                                                    ->first();

        $this->datasets[1]['label'] = 'Management Active Personel';
        $this->datasets[1]['backgroundColor'] = $color[0];


        $resignteam = \App\Models\Employee::select(DB::Raw('count(*) as jumlah_resign'))
                                                    ->where(DB::Raw('year(resign_date)'), $this->year)
                                                    ->where(DB::Raw('month(resign_date)'), $this->month)
                                                    ->first();
        
        $this->datasets[2]['label'] = 'Resign Team This Month';
        $this->datasets[2]['backgroundColor'] = $color[0];
      

        $this->datasets[0]['data'] = array($flmengineeractive->activeflm, $managementactive->activemanagement, $resignteam->jumlah_resign);


        $orgchartflm = \App\Models\Employee::select('user_access.name as name')
                                                ->leftjoin('user_access', 'user_access.id', 'employees.user_access_id')
                                                ->groupBy('employees.user_access_id')
                                                ->whereNotNull('employees.user_access_id')
                                                ->where('employees.level', 'FLM Engineer')
                                                ->get();
        foreach($orgchartflm as $k => $item){
            // $this->labels[] = date('F', mktime(0, 0, 0, $item->month, 10));
            $this->labelsorgflm[] = $item->name;
        }

        // dd($this->labelsorgflm);

        foreach($orgchartflm as $k => $item){
            $color = ['#ffb1c1','#4b89d6','#add64b','#80b10a','#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
            
            $jumlah_employee_active_flm = \App\Models\Employee::select(DB::Raw('count(employees.id) as jumlah'), 'user_access.name as position')
                                                            ->leftjoin('user_access', 'user_access.id', 'employees.user_access_id')
                                                            // ->groupBy('employees.user_access_id')
                                                            ->where('user_access.name', $item->name)
                                                            ->where('employees.level', 'FLM Engineer')
                                                            ->whereNull('employees.resign_date')
                                                            ->get();
            foreach($jumlah_employee_active_flm as $l => $items){    

                $this->datasetsorgflm[$k]['label'] = $items->position;
                $this->datasetsorgflm[$k]['backgroundColor'] = $color[0];
                $this->datasetsorgflm[$k]['fill'] = 'boundary';
                $this->datasetsorgflm[$l]['data'][] = $items->jumlah;
     
            }

        }
        

        // dd($this->datasetsorgflm);




        $orgchartmanagement = \App\Models\Employee::select('user_access.name as name')
                                                ->leftjoin('user_access', 'user_access.id', 'employees.user_access_id')
                                                ->groupBy('employees.user_access_id')
                                                ->whereNotNull('employees.user_access_id')
                                                ->where('employees.level', 'Management')
                                                ->get();
        foreach($orgchartmanagement as $k => $item){
            $this->labelsorgmanagement[] = $item->name;
        }

        // dd($this->labelsorgmanagement);

        foreach($orgchartmanagement as $k => $item){
            $color = ['#ffb1c1','#4b89d6','#add64b','#80b10a','#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];
            

            $this->datasetsorgmanagement[$k]['label'] = $item->name;
            $this->datasetsorgmanagement[$k]['backgroundColor'] = $color[0];
            $this->datasetsorgmanagement[$k]['fill'] = 'boundary';
            
            $jumlah_employee_active_management = \App\Models\Employee::select(DB::Raw('count(employees.id) as jumlah'), 'user_access.name as position')
                                                            ->leftjoin('user_access', 'user_access.id', 'employees.user_access_id')
                                                            // ->groupBy('employees.user_access_id')
                                                            ->where('user_access.name', $item->name)
                                                            ->where('employees.level', 'Management')
                                                            ->whereNull('employees.resign_date')
                                                            ->get();
            foreach($jumlah_employee_active_management as $l => $items){    
       
                $this->datasetsorgmanagement[$l]['data'][] = $items->jumlah;
     
            }

        }
        

       
        $this->labels = json_encode($this->labels);
        // dd($this->labels);

        $this->datasets = json_encode($this->datasets);
        // dd($this->datasets);

        $this->labelsorgflm = json_encode($this->labelsorgflm);
        // dd($this->labelsorgflm);

        $this->datasetsorgflm = json_encode($this->datasetsorgflm);
        // dd($this->datasetsorgflm);

        $this->labelsorgmanagement = json_encode($this->labelsorgmanagement);
        // dd($this->labelsorgmanagement);

        $this->datasetsorgmanagement = json_encode($this->datasetsorgmanagement);
        // dd($this->datasetsorgmanagement);

        $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets,'labelsorgflm'=>$this->labelsorgflm,'datasetsorgflm'=>$this->datasetsorgflm,'labelsorgmanagement'=>$this->labelsorgmanagement,'datasetsorgmanagement'=>$this->datasetsorgmanagement]);
    }


}



