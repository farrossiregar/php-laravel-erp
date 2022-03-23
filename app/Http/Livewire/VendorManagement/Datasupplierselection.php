<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\VendorManagementCreateProject;

class Datasupplierselection extends Component
{
    public $date_start,$date_end,$keyword,$status, $supplier1_id, $supplier2_id, $supplier3_id;

    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        // if(!check_access('po-tracking.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }

        $data = VendorManagementCreateProject::orderBy('id', 'DESC');
        
        if($this->status !="") $data->where('status',$this->status);
        // if($this->date_start and $this->date_end) $data = $data->whereBetween('created_at',[$this->date_start,$this->date_end]);

        return view('livewire.vendor-management.datasupplierselection')->with(['data'=>$data->paginate(100)]);
    }

    public function addsupplier1($id)
    {
        $check = \App\Models\VendorManagementCreateProject::where('id',$id)->first();
        
        $d = json_encode($this->supplier1_id);
        // dd(substr($d, 6, 1));
        $check->supplier1_id = substr($d, 6, 1);
        $check->save();
        
        return redirect()->route('vendor-management.index');
    }

    public function delsupplier1($id)
    {
        $check = \App\Models\VendorManagementCreateProject::where('id',$id)->first();
        
        $d = json_encode($this->supplier1_id);
        $check->supplier1_id = '';
        $check->save();
        
        return redirect()->route('vendor-management.index');
    }

    public function addsupplier2($id)
    {
        $check = \App\Models\VendorManagementCreateProject::where('id',$id)->first();
        
        $d = json_encode($this->supplier2_id);
        $check->supplier2_id = substr($d, 6, 1);
        $check->save();
        
        return redirect()->route('vendor-management.index');
    }

    public function delsupplier2($id)
    {
        $check = \App\Models\VendorManagementCreateProject::where('id',$id)->first();
        
        $check->supplier2_id = '';
        $check->save();
        
        return redirect()->route('vendor-management.index');
    }

    public function addsupplier3($id)
    {
        $check = \App\Models\VendorManagementCreateProject::where('id',$id)->first();
        
        $d = json_encode($this->supplier3_id);
        // dd(substr($d, 6, 1));
        $check->supplier3_id = substr($d, 6, 1);
        $check->save();
        
        return redirect()->route('vendor-management.index');
    }

    public function delsupplier3($id)
    {
        $check = \App\Models\VendorManagementCreateProject::where('id',$id)->first();
        
        $check->supplier3_id = '';
        $check->save();
        
        return redirect()->route('vendor-management.index');
    }
}



