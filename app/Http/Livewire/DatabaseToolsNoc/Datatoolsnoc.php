<?php

namespace App\Http\Livewire\DatabaseToolsNoc;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ToolsNoc;
use App\Models\EmployeeNoc;

class Datatoolsnoc extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $keyword,$is_resign, $filterweek, $filtermonth, $filteryear, $filtertools, $filtersoftware, $selected;

    public function render()
    {
        // $data = ToolsNoc::select('*')
        //                 ->where('employees.is_noc',1)
        //                 ->join('employees', 'tools_noc.name', '=', 'employees.name')
        //                 ->orderBy('employees.id','DESC');

        // $data = \App\Models\Employee::select('employees.*', 'tools_noc.tools as tools', 'tools_noc.software as software')
        //                                 ->where('employees.is_noc',1)
        //                                 ->join('tools_noc', 'tools_noc.nik', '=', 'employees.nik')
        //                                 ->orderBy('employees.id','DESC');

        $data = \App\Models\Employee::where('is_noc',1)->orderBy('id','ASC');
                                        
        
        // if($this->keyword) $data->where(function($table){
        //     foreach(\Illuminate\Support\Facades\Schema::getColumnListing('employees') as $column){
        //         $table->orWhere($column,'LIKE',"%{$this->keyword}%");
        //     }
        // });

        if($this->keyword) $data->where(function($table){
            $table->Where('name',"LIKE","%{$this->keyword}%")
                        ->orWhere('nik',"LIKE","%{$this->keyword}%");
        });
  
        return view('livewire.database-tools-noc.datatoolsnoc')->with(['data'=>$data->paginate(50)]);   
    }

    public function set_id($data)
    {
        $this->selected = $data;
        return $this->selected;
    }

    // public function updateResign(Employee $id)
    // {   
    //     $noc = new EmployeeNoc();
    //     $noc->employee_id = $id->id;
    //     $noc->is_resign = 1;
    //     $noc->month = date('m');
    //     $noc->year = date('Y');
    //     $noc->save();

    //     $id->is_resign_temp  = 1;
    //     $id->is_approve_admin_noc = 0;
    //     $id->employee_noc_id = $noc->id;
    //     $id->save();
    // }

    // public function updateAktif(Employee $id)
    // {   
    //     $noc = new EmployeeNoc();
    //     $noc->employee_id = $id->id;
    //     $noc->is_resign = 0;
    //     $noc->month = date('m');
    //     $noc->year = date('Y');
    //     $noc->save();

    //     $id->is_resign_temp  = 0;
    //     $id->is_approve_admin_noc = 0;
    //     $id->employee_noc_id = $noc->id;
    //     $id->save();
    // }

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
 
        
        session()->flash('message-success',"Berhasil, Database Tools NOC berhasil dihapus!!!");
        return redirect()->route('database-tools-noc.index');
    }
}