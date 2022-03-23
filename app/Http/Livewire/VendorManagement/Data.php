<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\VendorManagement;

class Data extends Component
{
    public $supplier_name, $supplier_category, $sort;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        // if(!check_access('po-tracking.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }

        $data = VendorManagement::whereNotNull('created_at');
        
        
        if($this->supplier_category) $data->where('supplier_category',$this->supplier_category);
        if($this->supplier_name) $data->where('supplier_name', 'like', '%' . $this->supplier_name . '%');
        // if($this->sort){
        //     if($this->sort == '1'){
        //         $ata = $data->orderBy('created_at', 'DESC');
        //     }
            
        //     if($this->sort == '2'){
        //         $ata = $data->orderBy('scoring', 'DESC');
        //     }
        // }
        $data->orderBy('id','DESC');
        // if($this->date_start and $this->date_end) $data = $data->whereBetween('created_at',[$this->date_start,$this->date_end]);

        return view('livewire.vendor-management.data')->with(['data'=>$data->paginate(100)]);
    }
}



