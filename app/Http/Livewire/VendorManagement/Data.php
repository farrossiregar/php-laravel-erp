<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BusinessOpportunities;

class Data extends Component
{
    public $date_start,$date_end,$keyword,$status;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        // if(!check_access('po-tracking.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }

        $data = BusinessOpportunities::orderBy('id', 'DESC');
        
        // if($this->keyword) $data = $data->where(function($table){
        //     foreach(\Illuminate\Support\Facades\Schema::getColumnListing('po_tracking_reimbursement') as $column){
        //         $table->orWhere($column,'LIKE',"%{$this->keyword}%");
        //     }
        // });
        
        if($this->status !="") $data->where('status',$this->status);
        // if($this->date_start and $this->date_end) $data = $data->whereBetween('created_at',[$this->date_start,$this->date_end]);

        return view('livewire.vendor-management.data')->with(['data'=>$data->paginate(100)]);
    }
}



