<?php

namespace App\Http\Livewire\CustomerAssetManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CustomerAssetManagementHistory;

class DataStolen extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $keyword,$employee_id,$date_submission;
    
    protected $listeners = ['refresh-page'=>'$refresh'];

    public function render()
    {
        $data = CustomerAssetManagementHistory::select('customer_asset_management_history.*','sites.site_owner',\DB::raw('sites.site_id as site_code'),\DB::raw('sites.name as site_name'))->orderBy('customer_asset_management_history.id','desc')
                    ->leftJoin('sites','sites.id','=','customer_asset_management_history.site_id')
                    ->where(['is_stolen'=>1]);

        if($this->keyword) $data = $data->where(function($table){
            foreach(\Illuminate\Support\Facades\Schema::getColumnListing('customer_asset_management_history') as $column){
                $table->orWhere('customer_asset_management_history.'.$column,'LIKE',"%{$this->keyword}%");
            }
        });

        if($this->employee_id) $data = $data->where('sites.employee_id',$this->employee_id);
        
        return view('livewire.customer-asset-management.data-stolen')->with(['data'=>$data->paginate(100)]);
    }
}
