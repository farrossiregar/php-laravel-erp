<?php

namespace App\Http\Livewire\MainKpi;

use Livewire\Component;

class Index extends Component
{
    public $layout_chart_parent,$layout_chart_parent_id,$layout_chart,$layout_chart_init_refresh;
    public $year,$region,$month, $view_index;
    public function render()
    {
        $data = \App\Models\WorkFlowManagement::orderBy('updated_at','DESC');

        return view('livewire.main-kpi.index')->with(['data'=>$data->paginate(100)]);
    }

    public function updated($propertyName)
    {
        if($propertyName == 'year') $this->emit('emit-year',$this->year);
        if($propertyName == 'month') $this->emit('emit-month',$this->month);
        if($propertyName == 'region') $this->emit('emit-region',$this->region);
    }

    public function mount()
    {
        if(isset($this->project_id)) session()->put('project_id',$this->project_id);
        $this->view_index = 'site-tracking';
        $this->layout_chart_parent_id = 1;
        $this->layout_chart_parent = 'wo-never-assigned';
        $this->layout_chart =[2=>'assigned-never-accept-wo',3=>'accept-never-close-wo-manual',4=>'total-ft-never-close-manual'];
        $this->layout_chart_init_refresh =['wo-never-assigned'=>'chart','assigned-never-accept-wo'=>'init-chart-assigned-never-accept-wo','accept-never-close-wo-manual'=>'init-chart-accept-never-close-wo-manual','total-ft-never-close-manual'=>'init-chart-total-ft-never-close-manual'];
    }

    public function set_layout($view,$id)
    {
        $temp = [];
        $parent_before = $this->layout_chart_parent;
        foreach($this->layout_chart as $id => $v){
            if($view == $v)
                $temp[date('his')] = $this->layout_chart_parent;
            else
                $temp[$id] = $v;
        }
        $this->layout_chart = $temp;
        $this->layout_chart_parent_id = date('his')+1;
        $this->layout_chart_parent = $view;

        $this->emit($this->layout_chart_init_refresh[$parent_before]);
        $this->emit($this->layout_chart_init_refresh[$this->layout_chart_parent]);
    }
}
