<?php

namespace App\Http\Livewire\Migration;

use App\Models\ClientProject;
use App\Models\Employee;
use App\Models\EmployeeProject;
use App\Models\User;
use App\Models\UserAccess;
use App\Models\Region;
use App\Models\RegionCluster;
use App\Models\SubRegion;
use App\Models\ClientProjectRegion;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Hash;

class Index extends Component
{
    use WithFileUploads;

    public $file;

    public function render()
    {
        return view('livewire.migration.index');
    }

    public function save()
    {
        set_time_limit(100000); // 
        $path = $this->file->getRealPath();
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        $data = $reader->load($path);
        $sheetData = $data->getActiveSheet()->toArray();
        $bulan = ['januari' => 'January','februari' => 'February','maret'=>'March','april'=>'April','mei'=>'May','juni'=>'June','juli'=>'July','agustus'=>'August','september'=>'September','oktober'=>'October','november'=>'November','desember'=>'December'];
        if(count($sheetData) > 0){
            foreach($sheetData as $key => $i){
                if($key<1) continue; // skip header
                
                $company  = strtoupper($i[0]);
                $project  = $i[1];
                $region  = $i[2];
                $sub_region  = $i[3];
                $name  = $i[4];
                $no_ktp  = $i[5];
                $nik  = $i[6];
                $employee_status  = $i[7];
                $rule  = $i[8];
                $no_telepon1  = $i[9];
                $no_telepon2  = $i[10];
                $email = $i[11];
                $lokasi_kantor = $i[12];

                if($company=='PT HARAPAN UTAMA PRIMA')
                    $company = 1;
                else 
                    $company = 2;
                
                //$position = $i[8];
                //$date_join = ($i[9]) ? @\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($i[9])->format('Y-m-d') : '';
                //$password = random_int(100000, 999999);
                 
                // $user_access = UserAccess::where('name',$rule)->first();
                // if(!$user_access){
                //     $user_access = new UserAccess;
                //     $user_access->name = $rule;
                //     $user_access->save();
                // }

                $employee = Employee::where('email',$email)->first();
                
                if($employee){
                    if($region){
                        $find_region = Region::where('region',$region)->first();
                        // if(!$find_region){
                        //     $find_region = new Region();
                        //     $find_region->region = $region;
                        //     $find_region->region_code = $region;
                        //     $find_region->save();
                        // }
                        if($find_region){
                            $employee->region_id = $find_region->id;
                        }

                        // find sub region
                        $find_sub_region = SubRegion::where(['region_id'=>$find_region->id,'name'=>$sub_region])->first();
                        // if(!$find_sub_region){
                        //     $find_sub_region = new SubRegion();
                        //     $find_sub_region->region_id = $find_region->id;
                        //     $find_sub_region->name = $sub_region;
                        //     $find_sub_region->save();
                        // }

                        if($find_sub_region) $employee->region_cluster_id = $find_sub_region->id;
                    }

                    if($project){
                        $find_project = ClientProject::where('name',$project)->first();
                        // if(!$find_project){
                        //     $find_project = new ClientProject();
                        //     $find_project->name = $project;
                        //     $find_project->region_id = $find_region->id;
                        //     $find_project->region_cluster_id = $find_sub_region->id;
                        //     $find_project->save();
                        // }
                        if($find_project){
                            if($find_region) $find_project->region_id = $find_region->id;
                            if($find_sub_region)$find_project->region_cluster_id = $find_sub_region->id;
                            $find_project->save();
                        }
                        

                        $find_employee_project = EmployeeProject::where(['employee_id'=>$employee->id,'client_project_id'=>$find_project->id])->first();
                        if(!$find_employee_project){
                            $find_employee_project = new EmployeeProject();
                            $find_employee_project->employee_id = $employee->id;
                            $find_employee_project->client_project_id = $find_project->id;
                            $find_employee_project->save();
                        }
                        // relation client_project_region
                        // $find_client_project_region = ClientProjectRegion::where(['client_project_id'=>$find_project->id,'region_id'=>$find_region->id,'region_cluster_id'=>$find_sub_region->id])->first();
                        // if(!$find_client_project_region){
                        //     $find_client_project_region = new ClientProjectRegion();
                        //     $find_client_project_region->client_project_id = $find_project->id;
                        //     $find_client_project_region->region_id = $find_region->id;
                        //     $find_client_project_region->region_cluster_id = $find_sub_region->id; 
                        //     $find_client_project_region->save();
                        // }
                    }
                    
                    $employee->name  = $name;
                    $employee->telepon  = $no_telepon1;
                    $employee->telepon2  = $no_telepon2;
                    $employee->lokasi_kantor  = $lokasi_kantor;
                    $employee->ktp = $no_ktp;
                    $employee->company_id = $company;
                    $employee->email = $email;
                    $employee->employee_status = 1;
                    $employee->department_id = 4;
                    // $employee->user_access_id = $user_access->id;
                    $employee->save();

                    // $user = User::find($employee->user_id);
                    // if($user){
                    //     $user->user_access_id = $user_access->id;
                    //     $user->nik = $nik;
                    //     $user->save();
                    // }
                }

                continue;

                // find region 
                // $region_  = Region::where('region',$region)->first();

                // $check = Employee::where('email',$email)->where(function($table) use($no_telepon1,$no_telepon2){
                //     $table->where('telepon',$no_telepon1)
                //         ->orWhere('telepon2',$no_telepon2)
                //         ->orWhere('telepon',$no_telepon1)
                //         ->orWhere('telepon2',$no_telepon2);
                // })->first();

                // if($check) continue;
                
                // $user_access = UserAccess::where('name',$position)->first();
                // if(!$user_access){
                //     $user_access = new UserAccess;
                //     $user_access->name = $position;
                //     $user_access->save();
                // }
                
                // $find_user = User::where('email',$email)->first();
                // if($find_user) continue;

                // $data = new User();
                // $data->name = $name;
                // $data->email = $email;
                // $data->password = Hash::make($password);
                // $data->user_access_id = $user_access->id;
                // $data->save();

                // $emp = new Employee();
                // $emp->user_access_id = $user_access->id;
                // $emp->position = $position;
                // $emp->user_id = $data->id;
                // $emp->name = $name;
                // $emp->nik = $nik;
                // $emp->telepon = $no_telepon1;
                // $emp->telepon2 = $no_telepon2;
                // $emp->ktp = $no_ktp;
                // if($date_join) $emp->join_date = $date_join;
                // if($region_) $emp->region_id = $region_->id;
                // $emp->is_flm_engineer = 1;
                // $emp->is_use_android = 1;
                // $emp->save();

                // $message = "Hallo {$name},\nBerikut username dan password login e-PM anda\n";
                // $message .= "Username : ". $email;
                // $message .= "\nPassword : ". $password;
                // $message .= "\nDownload : https://play.google.com/store/apps/details?id=com.pmt.access";
                // send_wa(['phone'=> $no_telepon1,'message'=>$message]);

                // $project  = $i[0];
                // $region  = $i[1];
                // $name  = $i[2];
                // $cluster  = $i[3];
                // $sub_cluster  = $i[4];
                // $nik  = $i[5];
                // $email = $i[6];
                // $no_telepon1 = $i[7];
                // $no_telepon2 = $i[8];
                // $no_ktp = $i[9];
                // $type_sim = $i[10];
                // $no_sim = $i[11];
                // $position = $i[12];
                // $account_mateline = $i[13];
                // $date_join = ($i[14]) ? @\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($i[14])->format('Y-m-d') : '';
                // $status_synergy = $i[15];
                // $no_pass_id = $i[16];
                // $training_k3 = $i[17];
                // $total_site = $i[18];
                // $sim_expired = ($i[19]) ? @\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($i[19])->format('Y-m-d') : '';
                // $password = random_int(100000, 999999);
                
                // $user = User::where('email',$email)->first();
                // if($user){
                //     $user->user_access_id = 31; // Field Team
                //     $user->save();

                //     $employee = Employee::where('user_id',$user->id)->first();
                //     if($employee){
                //         // find region 
                //         $region_  = Region::where('region',$region)->first();
                //         if($region_) $employee->region_id = $region_->id;
                        
                //         $employee->email = $email;
                //         $employee->employee_code = $account_mateline;
                //         $employee->user_access_id = 31;
                //         $employee->save();
                //     }
                // }
                // continue;

                // $check = Employee::where('email',$email)->where(function($table) use($no_telepon1,$no_telepon2){
                //     $table->where('telepon',$no_telepon1)
                //         ->orWhere('telepon2',$no_telepon2)
                //         ->orWhere('telepon',$no_telepon1)
                //         ->orWhere('telepon2',$no_telepon2);
                // })->first();

                // if($check) continue;

                // $data = new User();
                // $data->name = $name;
                // $data->email = $email;
                // $data->password = Hash::make($password);
                // $data->save();

                // $emp = new Employee();
                // $emp->status_synergy = $status_synergy;
                // $emp->position = $position;
                // $emp->account_mateline = $account_mateline;
                // $emp->user_id = $data->id;
                // $emp->name = $name;
                // $emp->nik = $nik;
                // $emp->telepon = $no_telepon1;
                // $emp->telepon2 = $no_telepon2;
                // $emp->ktp = $no_ktp;
                // if($date_join) $emp->join_date = $date_join;
                // if($sim_expired) $emp->sim_expired = $sim_expired;
                // $emp->type_sim = $type_sim; 
                // $emp->no_sim = $no_sim; 
                // $emp->is_flm_engineer = 1;
                // $emp->no_pass_id = $no_pass_id;
                // $emp->training_k3 = $training_k3;
                // $emp->total_site = $total_site;
                // $emp->is_use_android = 1;
                // $emp->save();

                // $message = "Hallo {$name},\nBerikut username dan password login e-PM anda\n";
                // $message .= "Username : ". $email;
                // $message .= "\nPassword : ". $password;
                // $message .= "\nDownload : https://play.google.com/store/apps/details?id=com.pmt.access";
                // send_wa(['phone'=> $no_telepon1,'message'=>$message]);
            }
        }
        
        session()->flash('message-success',__('Data berhasil di upload'));

        return redirect()->route('migration.index');
    }
}
