<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Employee;
use App\Models\User;
use App\Models\Region;
use App\Models\SubRegion;
use App\Models\UserAccess;
use App\Models\EmployeeProject;
use Illuminate\Support\Facades\Hash;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    protected $listeners = ['emit-delete-hide' => '$refresh'];
    public $keyword,$user_access_id,$department_sub_id,$department_id,$project_id;
    public $device_selected,$file_upload;
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

    public function updated()
    {
        $this->resetPage();
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
        $qq = send_wa(['phone'=> $emp->telepon,'message'=>$message]);
        
        $this->emit('message-success', "Username dan Password berhasil dikirim");
    }

    public function upload()
    {
        $this->validate([
            'file_upload'=>'required|mimes:xlsx|max:51200' // 50MB maksimal
        ]);

        $path = $this->file_upload->getRealPath();
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        $data = $reader->load($path);
        $sheetData = $data->getActiveSheet()->toArray();
        
        if(count($sheetData) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;
            $notif = get_user_from_access('duty-roster-dophomebase.approval');
            foreach($sheetData as $key => $i){
                if($key<1) continue; // skip header
                
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                
                $region = $i[0];
                $sub_region = $i[1];
                $position = $i[2];
                $nik = $i[3];
                $name = $i[4];
                $telepon = $i[5];
                $email = $i[6];
                if($nik=="") continue;
                $find_region = Region::where('region',$region)->first();
                if($find_region){
                    $region_id = $find_region->id;
                    $find_sub_region = SubRegion::where(['region_id'=>$region_id,'name'=>$sub_region])->first();
                    if($find_sub_region) $sub_region_id = $find_sub_region->id;
                }else{
                    $region_id = 0;
                    $sub_region_id = 0;
                }

                $find_user = User::where('email',$email)->first();
                if($find_user){
                    $find_employee = Employee::where('user_id',$find_user->id)->first();
                    if(!$find_employee) $find_user->delete();
                }
                // user access
                $find_user_access = UserAccess::where('name',$position)->first();
                if($find_user_access){
                    $user_access_id = $find_user_access->id;
                }else{
                    $user_access_id = 0;
                }

                $password = random_int(100000, 999999);;
                
                //insert table users
                $user = User::where('email',$email)->first();
                if($user){
                    $user->nik = $nik;
                    $user->save();
                }
                //if(!$user) $user = new User();
                
                // $user->user_access_id = $user_access_id;
                // $user->name = $name;
                // $user->email = $email;
                // $user->telepon = $telepon;
                // $user->password = Hash::make($password);
                // $user->save();

                // // Insert Employee
                // $employee = new Employee();
                // $employee->name = $name;
                // $employee->nik = $nik;
                // $employee->email = $email;
                // $employee->telepon = $telepon;
                // $employee->department_id = 4;
                // $employee->user_access_id = $user_access_id;
                // $employee->user_id = $user->id;
                // $employee->region_id = $region_id;
                // $employee->company_id = 1;
                // $employee->sub_region_id = $sub_region_id;
                // $employee->is_use_android = 1;
                // $employee->save();

                // $client_project_id = 25;
                // EmployeeProject::where(['employee_id'=>$employee->id])->delete();

                // $project = EmployeeProject::where(['client_project_id'=>$client_project_id,'employee_id'=> $employee->id])->first();
                // if(!$project){
                //     $project = new EmployeeProject();
                //     $project->employee_id = $employee->id;
                //     $project->client_project_id = $client_project_id;
                //     $project->save();
                // }

                // $message = "Hallo {$employee->name},\nBerikut username dan password login e-PM anda\n";
                // $message .= "NIK : ". $employee->nik;
                // $message .= "\nUsername : ". $employee->email;
                // $message .= "\nPassword : ". $password;
                // $message .= "\nDownload : https://play.google.com/store/apps/details?id=com.pmt.access";
                // $qq = send_wa(['phone'=> $employee->telepon,'message'=>$message]);
                
            }
        }

        \LogActivity::add('[web] Employee - Upload');

        session()->flash('message-success',"Upload success");
            
        return redirect()->route('employee.index');
    }
}