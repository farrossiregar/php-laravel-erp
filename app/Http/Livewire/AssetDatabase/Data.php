<?php

namespace App\Http\Livewire\AssetDatabase;

use Livewire\Component;
use Livewire\WithPagination;
use Session;
use DB;
use Auth;

class Data extends Component
{
    use WithPagination;
    public $project, $date, $region, $category, $employee_name,  $data_id;
    public $select=false, $is_regional=true;
    protected $paginationTheme = 'bootstrap';

    
    public function render()
    {
        if($this->is_regional == true){
            $region_user = \App\Models\Region::where('id', \App\Models\Employee::where('nik', \Auth::user()->nik)->first()->region_id)->first()->region;
            $data = \App\Models\AssetDatabase::where('region', $region_user)->where('company_id', Session::get('company_id'))->orderBy('created_at', 'desc');
        }else{
            $data = \App\Models\AssetDatabase::where('company_id', Session::get('company_id'))->orderBy('created_at', 'desc');
        }            
        
        if($this->date) $data->where(DB::Raw('date(created_at)'),$this->date);                        
        if($this->project) $data->where('project',$this->project);                        
        if($this->category) $data->where('asset_type',$this->category);                        
        if($this->region) $data->where('region',$this->region);                        
        
        return view('livewire.asset-database.data')->with(['data'=>$data->paginate(50)]);   
    }

    public function mount(){
        $data = \App\Models\AssetDatabase::where('company_id', Session::get('company_id'))->orderBy('created_at', 'desc');
        
        if($this->date) $data->where(DB::Raw('date(created_at)'),$this->date);                        
        if($this->project) $data->where('project',$this->project);                        
        if($this->category) $data->where('asset_type',$this->category);                        
        if($this->region) $data->where('region',$this->region);   
        foreach($data->where('remarks', '1')->get() as $item){
            $this->data_id[$item->id] = $item->id;
        }
    }


    public function selectasset(){
        $this->select = true;
    }

    public function checkdata($id)
    {
        $check = \App\Models\AssetDatabase::where('id',$id)->first();
        if($check->remarks == '1'){
            $check->remarks = '';

            $delete             = \App\Models\AssetTransferRequestdetail::where('user_id', \Auth::user()->id)->where('asset_id', $check->id)->first();
            $delete->delete();
        }else{
            $check->remarks = '1';

            $add                = new \App\Models\AssetTransferRequestdetail();
            $add->user_id       = \Auth::user()->id;
            $add->asset_id      = $id;
            $add->asset_name    = $check->asset_name;
            $add->save();
        }
        $check->save();
        
    }

    // public function addtransfer(){
    //     $this->select = true;
    // }

    public function closetransfer(){
        // $check = \App\Models\AssetDatabase::where('remarks', '=', 1)->update(array('remarks' => ''));
        // $check->save();

        $delete             = \App\Models\AssetTransferRequestDetail::where('user_id', \Auth::user()->id)->delete();
        
        // $delete->delete();


        
        
        $this->select = false;
    }
}