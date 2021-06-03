<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    public $data,$name,$nik,$email,$telepon,$address,$place_of_birth,$date_of_birth,$marital_status,$blood_type,$employee_status,$religion,$user_access_id,$department_sub_id;
    public $foto,$foto_ktp,$password,$confirm,$region_id,$company_id,$lokasi_kantor;
    use WithFileUploads;
    public function render()
    {
        return view('livewire.employee.edit');
    }
    public function mount($id)
    {
        $this->data = \App\Models\Employee::find($id);
        $this->nik = $this->data->nik;
        $this->name = $this->data->name;
        $this->email = $this->data->email;
        $this->telepon = $this->data->telepon;
        $this->address = $this->data->address;
        $this->place_of_birth = $this->data->place_of_birth;
        $this->date_of_birth = $this->data->date_of_birth;
        $this->marital_status = $this->data->marital_status;
        $this->blood_type = $this->data->blood_type;
        $this->employee_status = $this->data->employee_status;
        $this->religion = $this->data->religion;
        $this->user_access_id = $this->data->user_access_id;
        $this->department_sub_id = $this->data->department_sub_id;
        $this->region_id = $this->data->region_id;
        $this->company_id = $this->data->company_id;
        $this->lokasi_kantor = $this->data->lokasi_kantor;
    }

    public function updatedFoto()
    {
        $this->validate(
            [
                'foto' => 'image|max:1024'
            ]);
    }
    public function updatedFoto_ktp()
    {
        $this->validate(
            [
                'foto_ktp' => 'image|max:1024'
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
            'employee_status' => 'required',
            'telepon' => 'required',
            'religion' => 'required',
            'address' => 'required',
            'department_sub_id' => 'required',
            'user_access_id' => 'required'
        ]);
        $department = \App\Models\DepartmentSub::find($this->department_sub_id);
        $user = \App\Models\User::find($this->data->user_id);
        if(!$user) $user = new \App\Models\User();

        if($this->password) $user->password = \Illuminate\Support\Facades\Hash::make($this->password);
        $user->user_access_id = $this->user_access_id;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->telepon = $this->telepon;
        $user->save();
        if(empty($this->data->user_id))$this->data->user_id = $user->id;

        $this->data->name = $this->name;
        $this->data->nik = $this->nik;
        $this->data->place_of_birth = $this->place_of_birth;
        $this->data->date_of_birth = $this->date_of_birth;
        $this->data->marital_status = $this->marital_status;
        $this->data->blood_type = $this->blood_type;
        $this->data->email = $this->email;
        $this->data->employee_status = $this->employee_status;
        $this->data->telepon = $this->telepon;
        $this->data->religion = $this->religion;
        $this->data->address = $this->address;
        $this->data->department_id = $department->department_id;
        $this->data->department_sub_id = $this->department_sub_id;
        $this->data->user_access_id = $this->user_access_id;
        $this->data->user_id = $user->id;
        $this->data->region_id = $this->region_id;
        $this->data->company_id = $this->company_id;
        $this->data->lokasi_kantor = $this->lokasi_kantor;
        if($this->foto!=""){
            $foto = 'foto'.date('Ymdhis').'.'.$this->foto->extension();
            $this->foto->storePubliclyAs('public/foto/'.$user->id,$foto);
            $this->data->foto = $foto;
        }
        if($this->foto_ktp!=""){
            $foto_ktp = 'foto_ktp'.date('Ymdhis').'.'.$this->foto_ktp->extension();
            $this->foto_ktp->storePubliclyAs('public/foto/'.$user->id,$foto_ktp);
            $this->data->foto_ktp = $foto_ktp;
        }
        $this->data->save();
        
        session()->flash('message-success',__('Data saved successfully'));
        return redirect()->to('employee');
    }
}
