<?php

namespace App\Http\Livewire\DatabaseToolsNoc;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ToolsNoc;
use App\Models\EmployeeNoc;

class Dataescalationrecord extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $keyword,$is_resign, $filterweek, $filtermonth, $filteryear, $filtertools, $filtersoftware;

    public function render()
    {
      
        $data = \App\Models\Employee::where('is_noc',1)->orderBy('id','ASC');
      

        if($this->keyword) $data->where(function($table){
            $table->Where('name',"LIKE","%{$this->keyword}%")
                        ->orWhere('nik',"LIKE","%{$this->keyword}%");
        });
        
      

        return view('livewire.database-tools-noc.dataescalationrecord')->with(['data'=>$data->paginate(50)]);   
    }

    

    public function approve(Employee $id)
    {
        $noc = EmployeeNoc::find($id->employee_noc_id);
        $noc->status = 1;
        $noc->save();
        
        $id->is_resign  = $id->is_resign_temp; 
        $id->is_resign_temp  = null;
        $id->is_approve_admin_noc = null;
        $id->save();

        $notif_user_psm = check_access_data('database-noc.notif-psm', '');
        foreach($notif_user_psm as $no => $itemuser){
            $message = "*Dear PSM *\n\n";
            $message .= "*Database Tools NOC ".date('M')."-".date('Y')." telah diapprove oleh Admin NOC *\n\n";
            send_wa(['phone'=> $itemuser->telepon,'message'=>$message]);    
        }

        // $notif_user_hr = check_access_data('database-noc.notif-hr', '');
        // foreach($notif_user_hr as $no => $itemuser){
        //     $message = "*Dear HRD *\n\n";
        //     $message .= "*Database NOC ".date('M')."-".date('Y')." telah diapprove oleh Admin NOC *\n\n";
        //     send_wa(['phone'=> $itemuser->telepon,'message'=>$message]);    
        // }
    }

    public function reject(Employee  $id)
    {
        $noc = EmployeeNoc::find($id->employee_noc_id);
        $noc->status = 2;
        $noc->save();
        
        $id->is_resign  = $id->is_resign_temp; 
        $id->is_resign_temp  = null;
        $id->is_approve_admin_noc = null;
        $id->save();
    }

    public function deletedata($id)
    {
        $check = \App\Models\ToolsNoc::where('id',$id)->delete();
        
        // dd($id);
        // $check->tools = '';
        // $check->software = '';
        // $check->delete();
        
        session()->flash('message-success',"Berhasil, Data Escalation Record berhasil dihapus!!!");
        return redirect()->route('database-tools-noc.index');
    }
}