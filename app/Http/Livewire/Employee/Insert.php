<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ClientProject;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use App\Models\EmployeeProject;
use App\Models\SubRegion;
use Illuminate\Validation\Rule;

class Insert extends Component
{
    use WithFileUploads;
    public $name,$nik,$place_of_birth,$date_of_birth,$marital_status,$blood_type,$email,$join_date,$employee_status,$telepon,$npwp_number,$bpjs_number,$religion,$address,$department_sub_id,$foto,$foto_ktp;
    public $password,$confirm,$user_id,$user_access_id,$region_id,$is_noc=0,$lokasi_kantor,$employee_code,$ktp,$company_id,$postcode,$domisili,$sub_region_id;
    public $department_id="",$showProject=false,$projects=[],$project_id=[],$employee_project=[],$sub_regions=[],$is_project=0,$is_use_android=0,$speed_warning_pic_id;
    public $app_site_list,$app_daily_commitment,$app_health_check,$app_vehicle_check,$app_ppe_check,$app_tools_check,$app_location_of_field_team,$app_speed_warning,$app_preventive_maintenance,$app_customer_asset,$app_work_order,$app_drug_test,$app_training_material,$app_it_support;
    public $client_project_ids=[],$sub_department_id="";
    public function render()
    {
        return view('livewire.employee.insert');
    }

    public function updated($propertyName)
    {
        if($this->department_id == 4 and $this->company_id){
            $this->is_project = 1;
            $this->showProject = true;
            $this->projects = ClientProject::where(['company_id'=>$this->company_id,'is_project'=>1])->orderBy('name','ASC')->get();
            $this->emit('load-project');
        }

        if($this->department_id == 4) $this->is_project = 1;
        if($this->department_id != 4) {
            $this->showProject = false;
            $this->is_project = 0;
        }
        if($propertyName == 'project_id'){
            $this->client_project_ids = $this->project_id;
        }

        $this->$propertyName = $this->$propertyName;
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
            'nik' => ['required',Rule::unique('employees')->whereNull('deleted_at')],
            // 'place_of_birth' => 'required',
            // 'date_of_birth' => 'required',
            // 'marital_status' => 'required',
            // 'blood_type' => 'required',
            'email' => ['required','email',Rule::unique('employees')->whereNull('deleted_at')],
            //'join_date' => 'required',
            //'employee_status' => 'required',
            'telepon' => 'required',
            // 'religion' => 'required',
            // 'address' => 'required',
            'department_id' => 'required',
            'user_access_id' => 'required',
            //'password' => 'required|string|min:8',
            //'confirm'=>'required|same:password',

        ]);

        $find_user = User::where('email',$this->email)->first();
        if($find_user){
            $find_employee = Employee::where('user_id',$find_user->id)->first();
            if(!$find_employee) $find_user->delete();
        }

        $this->password = random_int(100000, 999999);

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
        $employee->department_sub_id = $this->sub_department_id;
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
        $employee->sub_region_id = $this->sub_region_id;
        $employee->is_use_android = $this->is_use_android;
        $employee->speed_warning_pic_id = $this->speed_warning_pic_id;

        if($this->app_site_list) $employee->app_site_list = $this->app_site_list;
        if($this->app_daily_commitment)$employee->app_daily_commitment = $this->app_daily_commitment;
        if($this->app_health_check) $employee->app_health_check = $this->app_health_check;
        if($this->app_vehicle_check) $employee->app_vehicle_check = $this->app_vehicle_check;
        if($this->app_ppe_check) $employee->app_ppe_check = $this->app_ppe_check;
        if($this->app_tools_check) $employee->app_tools_check = $this->app_tools_check;
        if($this->app_location_of_field_team) $employee->app_location_of_field_team = $this->app_location_of_field_team;
        if($this->app_speed_warning) $employee->app_speed_warning = $this->app_speed_warning;
        if($this->app_preventive_maintenance) $employee->app_preventive_maintenance = $this->app_preventive_maintenance;
        if($this->app_customer_asset) $employee->app_customer_asset = $this->app_customer_asset;
        if($this->app_work_order) $employee->app_work_order = $this->app_work_order;
        if($this->app_drug_test) $employee->app_drug_test = $this->app_drug_test;
        if($this->app_training_material) $employee->app_training_material = $this->app_training_material;
        if($this->app_it_support) $employee->app_it_support = $this->app_it_support;
        
        if($this->foto!=""){
            $foto = 'foto'.date('Ymdhis').'.'.$this->foto->extension();
            $this->foto->storePubliclyAs('public/photo/'.$user->id,$foto);
            $employee->foto = "storage/photo/{$this->data->id}/{$foto}";
        }
        if($this->foto_ktp!=""){
            $foto_ktp = 'foto_ktp'.date('Ymdhis').'.'.$this->foto_ktp->extension();
            $this->foto_ktp->storePubliclyAs('public/photo/'.$user->id,$foto_ktp);
            $employee->foto_ktp = "storage/photo/{$this->data->id}/{$foto_ktp}";;

        }
        $employee->save();
        
        // send notifikasi wa
        if($employee->telepon){
            $message = "Hallo {$employee->name},\nBerikut username dan password login ERP anda\n";
            $message .= "NIK : ". $employee->nik;
            $message .= "\nUsername : ". $employee->email;
            $message .= "\nPassword : ". $this->password;
            $message .= "\nLink : https://erp.pmt.co.id";
            send_wa(['phone'=> $employee->telepon,'message'=>$message]);
        }
        
        if($this->project_id){
            EmployeeProject::where(['employee_id'=>$employee->id])->delete();

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
