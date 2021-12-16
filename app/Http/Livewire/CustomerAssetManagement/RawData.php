<?php

namespace App\Http\Livewire\CustomerAssetManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CustomerAssetManagement;

class RawData extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $keyword,$employee_id,$created_at,$region;
    
    protected $listeners = ['refresh-page'=>'$refresh'];

    public function render()
    {
        $data = CustomerAssetManagement::select('customer_asset_management.*','sites.site_owner',\DB::raw('sites.site_id as site_code'),\DB::raw('sites.name as site_name'))
                    ->leftJoin('sites','sites.id','=','customer_asset_management.site_id')
                    ->where('is_stolen',0)
                    ->orderBy('tanggal_submission','DESC');
        if($this->region) $data = $data->where('customer_asset_management.region_name',$this->region);
        if($this->keyword) $data = $data->where(function($table){
            foreach(\Illuminate\Support\Facades\Schema::getColumnListing('customer_asset_management') as $column){
                $table->orWhere('customer_asset_management.'.$column,'LIKE',"%{$this->keyword}%");
            }
        });
        
        if($this->created_at) $data = $data->whereDate('customer_asset_management.created_at',$this->created_at);
        if($this->employee_id) $data = $data->where('sites.employee_id',$this->employee_id);

        return view('livewire.customer-asset-management.raw-data')->with(['data'=>$data->paginate(100)]);
    }
}
