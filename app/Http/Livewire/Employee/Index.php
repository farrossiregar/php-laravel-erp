<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['emit-delete-hide' => '$refresh'];
    public $keyword,$user_access_id,$department_sub_id,$department_id,$project_id;
    public $device_selected;
    public function render()
    {
        $data = Employee::select('employees.*')->with('company','department','access','employee_project.project')->orderBy('employees.id','DESC')
            ->leftJoin('employee_projects','employee_projects.employee_id','=','employees.id')->groupBy('employees.id');

        if($this->department_id) $data->where('department_id',$this->department_id);
        if($this->project_id) $data->where('employee_projects.client_project_id',$this->project_id);
        if($this->keyword) $data = $data->where(function($table){
            foreach(\Illuminate\Support\Facades\Schema::getColumnListing('employees') as $column){
                $table->orWhere('employees.'.$column,'LIKE',"%{$this->keyword}%");
            }
        });

        if($this->user_access_id) $data = $data->where('user_access_id',$this->user_access_id);
        
        return view('livewire.employee.index')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        \LogActivity::add('[web] Employee');
    }

    public function set_device($id)  
    {
        $employee = Employee::find($id);
        $this->device_selected = $employee->device;
    }

    public function generate_login_password(Employee $emp)
    {
        $user = User::find($emp->user_id);
        $password = random_int(100000, 999999);

        if($user){
            $user->password = Hash::make($password);
            $user->save();    
        }
        
        \LogActivity::add('[web] Employee Generate Password');

        $message = "Hallo {$emp->name},\nBerikut username dan password login e-PM anda\n";
        $message .= "NIK : ". $emp->nik;
        $message .= "\nUsername : ". $emp->email;
        $message .= "\nPassword : ". $password;
        $message .= "\nDownload : https://play.google.com/store/apps/details?id=com.pmt.access";
        send_wa(['phone'=> $emp->telepon,'message'=>$message]);

        $this->emit('message-success', "Username dan Password berhasil dikirim");
    }
}