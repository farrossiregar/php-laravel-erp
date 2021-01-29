<?php

namespace App\Http\Livewire\WorkFlowManagement;

use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perpage=100,$keyword,$created_at,$region;
    public function render()
    {
        if(!check_access('work-flow-management.index')){
            session()->flash('error-message','Access denied !');
            $this->redirect('/');
        }
        $data = \App\Models\WorkFlowManagement::orderBy('updated_at','DESC');
        if($this->keyword) $data  = $data->where(function($table){
                                        $table->where('name','LIKE',"{$this->keyword}")
                                            ->orWhere('id_','LIKE',"{$this->keyword}")
                                            ->orWhere('servicearea4','LIKE',"{$this->keyword}")
                                            ->orWhere('city','LIKE',"{$this->keyword}")
                                            ->orWhere('servicearea2','LIKE',"{$this->keyword}")
                                            ->orWhere('region','LIKE',"{$this->keyword}")
                                            ->orWhere('asp','LIKE',"{$this->keyword}")
                                            ->orWhere('region_dan_asp_info','LIKE',"{$this->keyword}")
                                            ->orWhere('skills','LIKE',"{$this->keyword}")
                                            ->orWhere('wo_assign','LIKE',"{$this->keyword}")
                                            ->orWhere('wo_accept','LIKE',"{$this->keyword}")
                                            ->orWhere('wo_close_manual','LIKE',"{$this->keyword}")
                                            ->orWhere('wo_close_auto','LIKE',"{$this->keyword}")
                                            ->orWhere('mttr','LIKE',"{$this->keyword}")
                                            ->orWhere('remark_wo_assign','LIKE',"{$this->keyword}")
                                            ->orWhere('remark_wo_accept','LIKE',"{$this->keyword}")
                                            ->orWhere('remark_wo_close_manual','LIKE',"{$this->keyword}")
                                            ->orWhere('final_remark','LIKE',"{$this->keyword}");
                                        });
        if($this->created_at) $data = $data->whereDate('created_at',$this->created_at);
        if($this->region) $data = $data->where('region',$this->region);
        return view('livewire.work-flow-management.data')->with(['data'=>$data->paginate($this->perpage)]);
    }
}
