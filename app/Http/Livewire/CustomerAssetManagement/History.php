<?php

namespace App\Http\Livewire\CustomerAssetManagement;

use Livewire\Component;
use App\Models\CustomerAssetManagement;
use App\Models\CustomerAssetManagementHistory;

class History extends Component
{
    public $region,$keyword,$created_at,$employee_id;
    public function render()
    {
        $history = CustomerAssetManagementHistory::where('customer_asset_management_id',$this->data->id)
                                    ->select('customer_asset_management_history.*','sites.site_owner',\DB::raw('sites.site_id as site_code'),\DB::raw('sites.name as site_name'))
                                    ->leftJoin('sites','sites.id','=','customer_asset_management_history.site_id');

        if($this->region) $data = $history->where('customer_asset_management_history.region_name',$this->region);
        if($this->keyword) $data = $data->where(function($table){
            foreach(\Illuminate\Support\Facades\Schema::getColumnListing('customer_asset_management_history') as $column){
                $table->orWhere('customer_asset_management_history.'.$column,'LIKE',"%{$this->keyword}%");
            }
        });
        
        if($this->created_at) $data = $data->whereDate('customer_asset_management_history.created_at',$this->created_at);
        if($this->employee_id) $data = $data->where('sites.employee_id',$this->employee_id);

        return view('livewire.customer-asset-management.history')->with(['history'=>$history->paginate(100)]);
    }

    public function mount(CustomerAssetManagement $data)
    {
        $this->data = $data;
    }
}