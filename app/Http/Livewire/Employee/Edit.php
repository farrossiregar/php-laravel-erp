<?php

namespace App\Http\Livewire\Employee;

use App\Models\ClientProject;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\EmployeeProject;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Employee;
use App\Models\Region;
use App\Models\RegionCluster;
use App\Models\ClientProjectRegion;
use Illuminate\Support\Arr;
use App\Models\LogActivity;
use Livewire\WithPagination;


class Edit extends Component
{
    public $data,$name,$nik,$email,$telepon,$address,$place_of_birth,$date_of_birth,$marital_status,$blood_type,$employee_status,$religion,$user_access_id,$department_sub_id;
    public $foto,$foto_ktp,$password,$confirm,$region_id,$company_id,$lokasi_kantor,$is_use_android,$employee_code,$is_noc,$ktp,$domisili,$postcode,$sub_region_id;
    public $showEditPassword=false,$department_id,$showProject=false,$projects=[],$project_id=[],$employee_project=[],$regions=[],$sub_regions=[],$region_cluster_id,$client_project_ids=[],$speed_warning_pic_id;
    public $app_site_list,$app_daily_commitment,$app_health_check,$app_vehicle_check,$app_ppe_check,$app_tools_check,$app_location_of_field_team,$app_speed_warning,$app_preventive_maintenance,$app_customer_asset,$app_work_order,$app_drug_test,$app_training_material,$app_it_support;
    public $is_project=0,$sub_department_id;
    use WithFileUploads;
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public function render()
    {
        $history = LogActivity::where('user_id',$this->data->user_id)->orderBy('id','DESC')->paginate(100);

        return view('livewire.employee.edit')->with(['history'=>$history]);
    }

    public function mount($id)
    {
        $this->data = Employee::find($id);
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
        $this->department_id = $this->data->department_id;
        $this->region_id = $this->data->region_id;
        $this->company_id = $this->data->company_id;
        $this->lokasi_kantor = $this->data->lokasi_kantor;
        $this->is_use_android = $this->data->is_use_android;
        $this->employee_code = $this->data->employee_code;
        $this->is_noc = $this->data->is_noc;
        $this->ktp = $this->data->ktp;
        $this->domisili = $this->data->domisili;
        $this->postcode = $this->data->postcode;
        $this->employee_project = EmployeeProject::where(['employee_id'=>$this->data->id])->get();
        $this->region_cluster_id = $this->data->region_cluster_id;
        $this->sub_region_id = $this->data->sub_region_id;

        $this->app_site_list = $this->data->app_site_list;
        $this->app_daily_commitment = $this->data->app_daily_commitment;
        $this->app_health_check = $this->data->app_health_check;
        $this->app_vehicle_check = $this->data->app_vehicle_check;
        $this->app_ppe_check = $this->data->app_ppe_check;
        $this->app_tools_check = $this->data->app_tools_check;
        $this->app_location_of_field_team = $this->data->app_location_of_field_team;
        $this->app_speed_warning = $this->data->app_speed_warning;
        $this->app_preventive_maintenance = $this->data->app_preventive_maintenance;
        $this->app_customer_asset = $this->data->app_customer_asset;
        $this->app_work_order = $this->data->app_work_order;
        $this->app_drug_test = $this->data->app_drug_test;
        $this->app_training_material = $this->data->app_training_material;
        $this->app_it_support = $this->data->app_it_support;

        
        if($this->department_id==4){
            $this->showProject = true;
            $this->is_project = 1;
            $this->projects = ClientProject::where(['company_id'=>$this->company_id,'is_project'=>1])->orderBy('name','ASC')->get();
            // $this->emit('load-project');
        }
        
        $this->client_project_ids = Arr::pluck(EmployeeProject::select('client_project_id')->where(['employee_id'=>$this->data->id])->get()->toArray(),'client_project_id');
        $this->regions = ClientProjectRegion::select('region.id','region.region')->join('region','region.id','=','client_project_region.region_id')->whereIn('client_project_region.client_project_id',$this->client_project_ids)->groupBy('region.id')->get();
        $this->sub_regions = RegionCluster::where('region_id', $this->data->region_id)->get();
        
    }

    public function updated($propertyName)
    {
        if($this->department_id == 4 and $this->company_id){
            $this->showProject = true;
            $this->projects = ClientProject::where(['company_id'=>$this->company_id,'is_project'=>1])->orderBy('name','ASC')->get();
            $this->employee_project = EmployeeProject::where('employee_id',$this->data->id)->get();
            $this->emit('load-project');
        }
        if($this->department_id != 4) {
            $this->showProject = false;
            $this->is_project=0;
        }else 
            $this->is_project = 1;

        if($propertyName=='project_id') $this->client_project_ids = $this->project_id;
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
            //'place_of_birth' => 'required',
            //'date_of_birth' => 'required',
            //'marital_status' => 'required',
            //'blood_type' => 'required',
            'email' => 'required',
            //'employee_status' => 'required',
            'telepon' => 'required',
            //'religion' => 'required',
            //'address' => 'required',
            //'department_sub_id' => 'required',
            'user_access_id' => 'required',
            //'employee_code' => 'required|unique:employees,employee_code,'.$this->data->id
        ]);
        $user = User::find($this->data->user_id);
        if(!$user) $user = new User();

        if($this->password) $user->password = \Illuminate\Support\Facades\Hash::make($this->password);
        $user->user_access_id = $this->user_access_id;
        $user->name = $this->name;
        $user->email = $this->email;
        $user->telepon = $this->telepon;
        $user->nik = $this->nik;
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
        $this->data->sub_region_id = $this->sub_region_id;
        $this->data->speed_warning_pic_id = $this->speed_warning_pic_id;

        $this->data->app_site_list = $this->app_site_list;
        $this->data->app_daily_commitment = $this->app_daily_commitment;
        $this->data->app_health_check = $this->app_health_check;
        $this->data->app_vehicle_check = $this->app_vehicle_check;
        $this->data->app_ppe_check = $this->app_ppe_check;
        $this->data->app_tools_check = $this->app_tools_check;
        $this->data->app_location_of_field_team = $this->app_location_of_field_team;
        $this->data->app_speed_warning = $this->app_speed_warning;
        $this->data->app_preventive_maintenance = $this->app_preventive_maintenance;
        $this->data->app_customer_asset = $this->app_customer_asset;
        $this->data->app_work_order = $this->app_work_order;
        $this->data->app_drug_test = $this->app_drug_test;
        $this->data->app_training_material = $this->app_training_material;
        $this->data->app_it_support = $this->app_it_support;

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
        
        if($this->project_id){
            EmployeeProject::where(['employee_id'=>$this->data->id])->delete();

            foreach($this->project_id as $k => $id){
                $project = EmployeeProject::where(['client_project_id'=>$id,'employee_id'=> $this->data->id])->first();
                if(!$project){
                    $project = new EmployeeProject();
                    $project->employee_id = $this->data->id;
                    $project->client_project_id = $id;
                    $project->save();
                }
            }
        }

        session()->flash('message-success',__('Data saved successfully'));
        return redirect()->route('employee.edit',['id'=>$this->data->id]);
    }
}
