<?php

namespace App\Http\Livewire\TimesheetRecord;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\EmployeeNoc;
use DB;
use Session;

class Dashboard extends Component
{
    use WithPagination;
    public $date, $month, $year, $type, $company_name, $region, $project;
    public $labels;
    public $datasets;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $this->generate_chart();
        return view('livewire.timesheet-record.dashboard');
    }

    public function mount()
    {
        $this->year = date('Y');
    }

    public function updated()
    {
        $this->generate_chart();
    }
    
    public function generate_chart()
    {
        $this->labels = [];
        $this->datasets = [];

        if($this->year){
            $this->year = $this->year;
        }else{
            $this->year = date('Y');
        }

        if($this->month){
            $this->month = $this->month;
        }else{
            $this->month = date('m');
        }

        $color = ['#ffb1c1','#4b89d6', '#007bff','#28a745','#333333'];
        // $weeks = ['Week 1', 'Week 2', 'Week 3', 'Week 4', 'Week 5'];
        $weeks = ['1', '2', '3', '4', '5'];

        foreach(\App\Models\TeamScheduleNoc::whereYear('start_actual',$this->year)->where('status', '2')->where('company_name', Session::get('company_id'))->where('region', $this->region)->where('project', $this->project)->groupBy(DB::Raw('month(start_actual)'))->orderBy('week', 'asc')->get() as $k => $item){
            // foreach(\App\Models\TeamScheduleNoc::whereYear('start_actual',$this->year)->where('status', '2')->where('company_name', $this->company_name)->groupBy(DB::Raw('month(start_actual)'))->groupBy('region')->groupBy('project')->orderBy('week', 'asc')->get() as $k => $item){
        // foreach(\App\Models\ToolsNoc::where('year',$this->year)->where('type', $this->type)->where('status', '1')->groupBy('month')->get() as $k => $item){
            $this->labels[$k] = date('F', mktime(0, 0, 0, (int)$item->month, 10));
        }
        

        

        foreach(\App\Models\TeamScheduleNoc::whereYear('start_actual',$this->year)->where('status', '2')->where('company_name', Session::get('company_id'))->where('region', $this->region)->where('project', $this->project)->groupBy(DB::Raw('month(start_actual)'))->orderBy('week', 'asc')->get() as $k => $item){
        // foreach(\App\Models\ToolsNoc::where('year',$this->year)->where('type', $this->type)->where('status', '1')->groupBy('month')->get() as $k => $item){
            
            foreach($weeks as $j => $itemstatus){ 
                
                // $this->datasets[$k]['label'] = 'Week '.$weeks[$j];
                $this->datasets[$j]['label'] = 'Week '.$weeks[$j];
                // $this->datasets[$k]['label'] = date('F', mktime(0, 0, 0, (int)$item->month, 10));
                // $this->datasets[$k]['label'] = '1';
                $this->datasets[$j]['backgroundColor'] = $color[$j];
                $this->datasets[$k]['fill'] = 'boundary';
                $this->datasets[$j]['data'][] = count(\App\Models\TeamScheduleNoc::where('week', $weeks[$j])->where('status', '2')->where('company_name', $item->company_name)->where('project', $item->project)->where('region', $item->region)->get());
                // $this->datasets[$k]['data'][] = \App\Models\ToolsNoc::where('year',$item->year)->where('month',$item->month)->where('week',$weeks[$j])->where('status','1')->first();
                
            }

        }
       
    
        $this->labels = json_encode($this->labels);
        $this->datasets = json_encode($this->datasets);

        $this->emit('init-chart',['labels'=>$this->labels,'datasets'=>$this->datasets]);
    }


}



