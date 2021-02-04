<?php

namespace App\Http\Livewire\Criticalcase;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Criticalcase;


class Index extends Component
{
    public $keyword,$region_id,$pic;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        $data = Criticalcase::orderBy('id', 'DESC');
        if($this->keyword) $ata = $data->where('name','LIKE',"{$this->keyword}");
        if($this->pic) $ata = $data->where('pic',$this->pic);
        if($this->region_id) $ata = $data->where('region',$this->region_id);
        
        // if(check_access_controller('critical-case.index') == false){
        //     session()->flash('message-error','Access denied.');
        //     $this->redirect('/');
        // }

       

        return view('livewire.criticalcase.index')->with(['data'=>$data->paginate(50)]);
    }
}



