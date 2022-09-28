<?php

namespace App\Http\Livewire\PoTrackingMs;

use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\PoMsHuawei;

class Huawei extends Component
{
    protected $paginationTheme = 'bootstrap';
    use WithPagination;
    use WithFileUploads;
    public $file,$is_e2e,$is_service_manager,$is_have_deduction=0,$selected;
    public $approval_file,$pds_file,$pds_amount,$file_verification,$acceptance_doc,$invoice_doc;
    public $is_finance,$keyword,$field_active,$file_progress;
    protected $rules = [
        'file' => 'required',
    ];
    public function render()
    {
        $data = PoMsHuawei::orderBy('created_at', 'desc')->groupBy('po_no')
                            ->with('details')
                            ->withSum('details','total_amount')
                            ->withSum('details','deduction')
                            ->withSum('details','ehs_other_deduction')
                            ->withSum('details','rp_deduction')
                            ->withSum('details','pds_amount')
                            ->withSum('details','invoice_amount')
                            ->withSum('details','vat')
                            ->withSum('details','wht')
                            ->withCount('count_regional_recon')
                            ->withCount('count_customer_gm')
                            ->withCount('count_customer_gh')
                            ->withCount('count_customer_od')
                            ->withCount('count_verification')
                            ->withCount('details');
        
        if($this->keyword) {
                $data->where(function($table){
                foreach(\Illuminate\Support\Facades\Schema::getColumnListing('po_ms_huawei') as $column){
                    $table->orWhere('po_ms_huawei.'.$column,'LIKE',"%{$this->keyword}%");
                }
            });
        }
        
        return view('livewire.po-tracking-ms.huawei')->with(['data'=>$data->paginate(50)]);
    }

    public function mount()
    {
        $this->is_e2e = check_access('is-e2e');
        $this->is_service_manager = check_access('is-service-manager');
        $this->is_finance = check_access('is-finance');
    }
}
