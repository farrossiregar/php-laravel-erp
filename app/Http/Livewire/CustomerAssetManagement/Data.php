<?php

namespace App\Http\Livewire\CustomerAssetManagement;

use Livewire\Component;
use Livewire\WithPagination;

class Data extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $perpage=100,$keyword;
    protected $listeners = ['refresh-page'=>'$refresh'];
    public function render()
    {
        $data = \App\Models\CustomerAssetManagement::orderBy('id','desc');
        if($this->keyword) $data = $data->where(function($table){
            foreach(\Illuminate\Support\Facades\Schema::getColumnListing('customer_asset_management') as $column){
                $table->orWhere($column,'LIKE',"%{$this->keyword}%");
            }
        });
        
        return view('livewire.customer-asset-management.data')->with(['data'=>$data->paginate($this->perpage)]);
    }
}
