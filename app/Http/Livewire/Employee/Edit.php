<?php

namespace App\Http\Livewire\Employee;

use App\Models\ClientProject;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\DepartmentSub;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class Edit extends Component
{
    public $data,$name,$nik,$email,$telepon,$address,$place_of_birth,$date_of_birth,$marital_status,$blood_type,$employee_status,$religion,$user_access_id,$department_sub_id;
    public $foto,$foto_ktp,$password,$confirm,$region_id,$company_id,$lokasi_kantor,$is_use_android,$employee_code,$is_noc,$ktp,$domisili,$postcode;
    public $showEditPassword=false,$department_id,$showProject=false,$projects=[],$project_id=[];
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
        $this->is_use_android = $this->data->is_use_android;
        $this->employee_code = $this->data->employee_code;
        $this->is_noc = $this->data->is_noc;
        $this->ktp = $this->data->ktp;
        $this->domisili = $this->data->domisili;
        $this->postcode = $this->data->postcode;
    }

    public function updated($propertyName)
    {
        if($this->department_id == 4 and $this->company_id){
            $this->showProject = true;
            $this->projects = ClientProject::where('company_id',$this->company_id)->orderBy('name','ASC')->get();
            $this->emit('load-project');
        }
        if($this->department_id != 4) $this->showProject = false;
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

    public function update_password()
    {
        $this->validate([
            'password' => 'required',
            'confirm'=>'required|same:password'
        ]);

        $user = User::find($this->data->user_id);
        if($user) {
            $user->password = Hash::make($this->password);
            $user->save();
        }

        $this->emit('message-success','Password saved');
        $this->showEditPassword = false;
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
            'user_access_id' => 'required',
            'employee_code' => 'required|unique:employees,employee_code,'.$this->data->id
        ]);
        $department = DepartmentSub::find($this->department_sub_id);
        $user = User::find($this->data->user_id);
        if(!$user) $user = new User();

        if($this->password) $user->password = \Illuminate\Support\Facades\Hash::make($this->password);
        $user->user_access_id = $this->user_access_id;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->telepon = $this->telepon;
        $user->save();

        if(empty($this->data->user_id))$this->data->user_id = $user->id;

        $this->data->is_use_android = $this->is_use_android;
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
        $this->data->department_id = $this->department_id;
        $this->data->department_sub_id = $this->department_sub_id;
        $this->data->user_access_id = $this->user_access_id;
        $this->data->user_id = $user->id;
        $this->data->region_id = $this->region_id;
        $this->data->company_id = $this->company_id;
        $this->data->lokasi_kantor = $this->lokasi_kantor;
        $this->data->employee_code = $this->employee_code;
        $this->data->is_noc = $this->is_noc;
        $this->data->ktp = $this->ktp;
        $this->data->domisili = $this->domisili;
        $this->data->postcode = $this->postcode;

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
