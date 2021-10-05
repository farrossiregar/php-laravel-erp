<?php

namespace App\Http\Livewire\ContractRegistrationFlow;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ContractRegistrationFlow;

class Data extends Component
{
    public $date_start,$date_end,$keyword,$status,$data_id;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        // if(!check_access('po-tracking.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }

        $data = ContractRegistrationFlow::orderBy('id', 'DESC');
        
        // if($this->keyword) $data = $data->where(function($table){
        //     foreach(\Illuminate\Support\Facades\Schema::getColumnListing('po_tracking_reimbursement') as $column){
        //         $table->orWhere($column,'LIKE',"%{$this->keyword}%");
        //     }
        // });
        
        
        

        // if($this->status !="") $data->where('status',$this->status);
        // if($this->date_start and $this->date_end) $data = $data->whereBetween('created_at',[$this->date_start,$this->date_end]);

        return view('livewire.contract-registration-flow.data')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {

        $data = ContractRegistrationFlow::orderBy('id', 'DESC');

        foreach($data->get() as $item){
            $this->data_id[$item->id] = $item->id;
        }
    }

    public function checkdata($id)
    {
        $check = \App\Models\ContractRegistrationFlow::where('id',$id)->first();
        if($check->remarks == '1'){
            $check->remarks = '';
        }else{
            $check->remarks = '1';
        }
        $check->save();
        
    }
}



