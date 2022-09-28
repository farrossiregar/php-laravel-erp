<?php

namespace App\Http\Livewire\PoTrackingNonms\Huawei;

use Livewire\Component;
use App\Models\PoTrackingNonmsHuawei;
use App\Models\PoTrackingNonmsHuaweiItem;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $is_service_manager=false,$is_coordinator=false,$is_finance=false,$is_e2e=false,$is_pmg=false,$is_regional=false;
    public $field_teams,$keyword;
    protected $paginationTheme = 'bootstrap',$listeners = ['reload-page'=>'$refresh'];
    public function render()
    {
        $data = PoTrackingNonmsHuaweiItem::orderBy('id','DESC');

        if($this->keyword) $data = $data->where(function($table){
            foreach(\Illuminate\Support\Facades\Schema::getColumnListing('po_tracking_nonms_huawei_item') as $column){
                $table->orWhere('po_tracking_nonms_huawei_item.'.$column,'LIKE',"%{$this->keyword}%");
            }
        });

        return view('livewire.po-tracking-nonms.huawei.index')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {        
        $this->is_e2e = check_access('is-e2e');
        $this->is_service_manager = check_access('is-service-manager');
        $this->is_coordinator = check_access('is-coordinator');
        $this->is_finance = check_access('is-finance');
        $this->is_pmg = check_access('is-pmg');
        $this->is_regional = check_access('is-regional');
    }

    public function submit_finance_budget(PoTrackingNonmsHuaweiItem $data)
    {
        $data->status = 2; // Finance Approved
        $data->save();

        \LogActivity::add("[web] PO Non MS Huawei - Submit Finance Budget {$data->id}");

        session()->flash('message-success',"PO Nonms Finance Submit Budget");

        return redirect()->route('po-tracking-nonms.huawei');
    }
}