<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ClientProject;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use App\Models\EmployeeProject;

class Insert extends Component
{
    use WithFileUploads;
    public $name,$nik,$place_of_birth,$date_of_birth,$marital_status,$blood_type,$email,$join_date,$employee_status,$telepon,$npwp_number,$bpjs_number,$religion,$address,$department_sub_id,$foto,$foto_ktp;
    public $password,$confirm,$user_id,$user_access_id,$region_id,$is_noc=0,$lokasi_kantor,$employee_code,$ktp,$company_id,$postcode,$domisili;
    public $department_id,$showProject=false,$projects=[],$project_id=[],$employee_project=[];
    public function render()
    {
        return view('livewire.employee.insert');
    }

    public function mount()
    {

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
            'department_id' => 'required',
            'user_access_id' => 'required',
            'password' => 'required|string|min:8',
            'confirm'=>'required|same:password'
        ]);

        // insert table users
        $user = new User();
        $user->user_access_id = $this->user_access_id;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->telepon = $this->telepon;
        $user->password = Hash::make($this->password);
        $user->save();
        // Insert Employee
        $employee = new Employee();
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
        $employee->department_id = $this->department_id;
        $employee->user_access_id = $this->user_access_id;
        $employee->user_id = $user->id;
        $employee->region_id = $this->region_id;
        $employee->is_noc = $this->is_noc;
        $employee->lokasi_kantor = $this->lokasi_kantor;
        $employee->employee_code = $this->employee_code;
        $employee->ktp = $this->ktp;
        $employee->company_id = $this->company_id;
        $employee->postcode = $this->postcode;
        $employee->domisili = $this->domisili;
        
        if($this->foto!=""){
            $foto = 'foto'.date('Ymdhis').'.'.$this->foto->extension();
            $this->foto->storePubliclyAs('public/foto/'.$user->id,$foto);
            $employee->foto = $foto;
        }
        if($this->foto_ktp!=""){
            $foto_ktp = 'foto_ktp'.date('Ymdhis').'.'.$this->foto_ktp->extension();
            $this->foto_ktp->storePubliclyAs('public/foto/'.$user->id,$foto_ktp);
            $employee->foto_ktp = $foto_ktp;
        }
        $employee->save();
        
        if($this->project_id){
            EmployeeProject::where(['employee_id'=>$employee->id])->truncate();

            foreach($this->project_id as $k => $id){
                $project = EmployeeProject::where(['client_project_id'=>$id,'employee_id'=> $employee->id])->first();
                if(!$project){
                    $project = new EmployeeProject();
                    $project->employee_id = $employee->id;
                    $project->client_project_id = $id;
                    $project->save();
                }
            }
        }

        session()->flash('message-success',__('Data saved successfully'));
        
        return redirect()->route('employee.edit',['id'=>$employee->id]);
    }
}
