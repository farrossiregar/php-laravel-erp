<?php

namespace App\Http\Livewire\WorkFlowManagement;

use Livewire\Component;
use Livewire\WithPagination;
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $layout_chart_parent,$layout_chart_parent_id,$layout_chart,$layout_chart_init_refresh;
    public $year,$region,$month;
    protected $listeners = ['refresh-page'=>'$refresh'];
    public function render()
    {
        if(!check_access('work-flow-management.index')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }
        $data = \App\Models\WorkFlowManagement::orderBy('updated_at','DESC');
        return view('livewire.work-flow-management.index')->with(['data'=>$data->paginate(100)]);
    }
    public function updated($propertyName)
    {
        if($propertyName == 'year') $this->emit('emit-year',$this->year);
        if($propertyName == 'month') $this->emit('emit-month',$this->month);
        if($propertyName == 'region') $this->emit('emit-region',$this->region);
    }
    public function mount()
    {
        $this->layout_chart_parent_id = 1;
        $this->layout_chart_parent = 'total-ft-never-close-manual';
        $this->layout_chart =[2=>'assigned-never-accept-wo',3=>'accept-never-close-wo-manual',4=>'wo-never-assigned'];
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
