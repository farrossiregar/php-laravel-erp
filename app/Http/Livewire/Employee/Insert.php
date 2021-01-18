<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use Livewire\WithFileUploads;

class Insert extends Component
{
    use WithFileUploads;
    public $name,$nik,$place_of_birth,$date_of_birth,$marital_status,$blood_type,$email,$join_date,$employee_status,$telepon,$npwp_number,$bpjs_number,$religion,$address,$department_sub_id,$foto,$foto_ktp;
    public $password,$confirm,$user_id,$user_access_id;
    public function render()
    {
        return view('livewire.employee.insert');
    }
    public function updatedFoto()
    {
        $this->validate(
            [
                'foto' => 'image|max:1024'
            ]);
    }
    public function save()
    {   
        $this->validate([
            'name' => 'required',
            'nik' => 'required',
            'place_of_birth' => 'required',
            'date_of_birth' => 'required',
            'marital_status' => 'required',
            'blood_type' => 'required',
            'email' => 'required',
            //'join_date' => 'required',
            'employee_status' => 'required',
            'telepon' => 'required',
            'religion' => 'required',
            'address' => 'required',
            'department_sub_id' => 'required',
            'user_access_id' => 'required',
            'password' => 'required|string|min:8',
            'confirm'=>'required|same:password'
        ]);
        $department = \App\Models\DepartmentSub::find($this->department_sub_id);
        // insert table users
        $user = new \App\Models\User();
        $user->user_access_id = $this->user_access_id;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->telepon = $this->telepon;
        $user->password = \Illuminate\Support\Facades\Hash::make($this->password);
        $user->save();
        // Insert Employee
        $employee = new \App\Models\Employee();
        $employee->name = $this->name;
        $employee->nik = $this->nik;
        $employee->place_of_birth = $this->place_of_birth;
        $employee->date_of_birth = $this->date_of_birth;
        $employee->marital_status = $this->marital_status;
        $employee->blood_type = $this->blood_type;
        $employee->email = $this->email;
        $employee->join_date = $this->join_date;
        $employee->employee_status = $this->employee_status;
        $employee->telepon = $this->telepon;
        $employee->religion = $this->religion;
        $employee->address = $this->address;
        $employee->department_id = $department->department_id;
        $employee->department_sub_id = $this->department_sub_id;
        $employee->user_access_id = $this->user_access_id;
        $employee->user_id = $user->id;
        if($this->foto!=""){
            $foto = 'foto'.date('Ymdhis').'.'.$this->foto->extension();
            $this->foto->storePubliclyAs('public',$foto);
            $employee->foto = $foto;
        }
        if($this->foto_ktp!=""){
            $foto_ktp = 'foto_ktp'.date('Ymdhis').'.'.$this->foto_ktp->extension();
            $this->foto_ktp->storePubliclyAs('public',$foto_ktp);
            $employee->foto_ktp = $foto_ktp;
        }
        $employee->save();
        
        session()->flash('message-success',__('Data saved successfully'));
        return redirect()->to('employee');
    }
}
