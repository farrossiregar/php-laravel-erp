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
    
    public $keyword,$user_access_id,$department_sub_id;
    
    public function render()
    {
        $data = Employee::with('company','department','access')->orderBy('id','DESC');

        if($this->keyword) $data = $data->where(function($table){
            foreach(\Illuminate\Support\Facades\Schema::getColumnListing('employees') as $column){
                $table->orWhere($column,'LIKE',"%{$this->keyword}%");
            }
        });

        if($this->user_access_id) $data = $data->where('user_access_id',$this->user_access_id);

        return view('livewire.employee.index')->with(['data'=>$data->paginate(100)]);
    }

    public function generate_login_password(Employee $emp)
    {
        $user = User::find($emp->user_id);
        $password = random_int(100000, 999999);

        if($user){
            $user->password = Hash::make($password);
            $user->save();    
        }
        
        $message = "Hallo {$emp->name},\nBerikut username dan password login e-PM anda\n";
        $message .= "Username : ". $emp->email;
        $message .= "\nPassword : ". $password;
        $message .= "\nDownload : https://play.google.com/store/apps/details?id=com.pmt.access";
        send_wa(['phone'=> $emp->telepon,'message'=>$message]);

        $this->emit('message-success', "Username dan Password berhasil dikirim");
    }
}