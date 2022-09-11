<?php

namespace App\Http\Livewire\PoTrackingNonms\Huawei;

use Livewire\Component;
use App\Models\PoTrackingNonmsHuawei;

class Detail extends Component
{
    public $data;
    public $is_service_manager=false,$is_coordinator=false,$is_finance=false,$is_e2e=false,$is_pmg=false,$is_regional=false;
    protected $listeners = ['reload-page'=>'$refresh'];
    public function render()
    {
        return view('livewire.po-tracking-nonms.huawei.detail');
    }

    public function mount(PoTrackingNonmsHuawei $id)
    {
        $this->data = $id;
        $this->is_service_manager = check_access('is-service-manager');
        $this->is_coordinator = check_access('is-coordinator');
        $this->is_finance = check_access('is-finance');
        $this->is_e2e = check_access('is-e2e');
        $this->is_pmg = check_access('is-pmg');
        $this->is_regional = check_access('is-regional');
    }

    public function submit_regional()
    {
        if($this->data->margin<30)
            $this->data->status = 3;  // PMG Review karna profit dibawah 30%
        else
            $this->data->status = 1; // Finance review
        
        $this->data->save();

        \LogActivity::add("[web] PO Non MS Huawei - Submit Regional {$this->data->id}");

        session()->flash('message-success',"PO Nonms Submitted ");

        return redirect()->route('po-tracking-nonms.huawei.detail',$this->data->id);   
    }

    public function submit_finance_budget()
    {
        $this->data->status = 2; // Finance Approved
        $this->data->save();

        \LogActivity::add("[web] PO Non MS Huawei - Submit Finance Budget {$this->data->id}");

        session()->flash('message-success',"PO Nonms Finance Submit Budget");

        return redirect()->route('po-tracking-nonms.huawei.detail',$this->data->id);
    }
}
