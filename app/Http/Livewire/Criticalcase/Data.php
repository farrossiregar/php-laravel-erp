<?php

namespace App\Http\Livewire\Criticalcase;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Criticalcase;


class Data extends Component
{
    public $keyword,$region_id,$pic,$type;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['refresh-page' => '$refresh']; // fungsi untuk menangkap perubahan data di form Edit.php
    public function render()
    {
        if(!check_access('critical-case.index')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }

        $data = Criticalcase::orderBy('id', 'DESC');
        if($this->keyword) $data = $data->where(function($table){
            foreach(\Illuminate\Support\Facades\Schema::getColumnListing('critical_case_detail') as $column){
                $table->orWhere($column,'LIKE',"%{$this->keyword}%");
            }
        });
        if($this->pic) $ata = $data->where('pic',$this->pic);
        if($this->region_id) $ata = $data->where('region',$this->region_id);
        if($this->type) $ata = $data->where('type',$this->type);
        
        return view('livewire.criticalcase.data')->with(['data'=>$data->paginate(50)]);
    }
}



