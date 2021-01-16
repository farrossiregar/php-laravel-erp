<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;

class Insert extends Component
{
    public $name,$nik,$place_of_birth,$date_of_birth,$marital_status,$blood_type,$email,$join_date,$employee_status,$telepon,$npwp_number,$bpjs_number,$religion,$address,$department_sub_id,$foto,$foto_ktp;
    public $user_id,$user_access_id;
    public function render()
    {
        return view('livewire.employee.insert');
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
            'join_date' => 'required',
            'employee_status' => 'required',
            'telepon' => 'required',
            'religion' => 'required',
            'address' => 'required',
            'department_sub_id' => 'required',
            'user_access_id' => 'required'
        ]);

        // insert table users
        $user = new \App\Models\User();
        $user->user_access_id = $this->user_access_id;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->telepon = $this->telepon;
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
        $employee->department_sub_id = $this->department_sub_id;
        $employee->user_id = $data->id;
        $employee->save();

        session()->flash('message-success',__('Data saved successfully'));
        return redirect()->to('employee');
    }
}
