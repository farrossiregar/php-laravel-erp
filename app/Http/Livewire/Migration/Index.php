<?php

namespace App\Http\Livewire\Migration;

use App\Models\Employee;
use App\Models\User;
use App\Models\UserAccess;
use App\Models\Region;
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
                if($key<2) continue; // skip header
                
                $project  = $i[0];
                $region  = $i[1];
                $name  = $i[2];
                $nik  = $i[3];
                $no_telepon1  = $i[4];
                $no_telepon2  = $i[5];
                $email = $i[6];
                $no_ktp = $i[7];
                $position = $i[8];
                $date_join = ($i[9]) ? @\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($i[9])->format('Y-m-d') : '';
                $password = random_int(100000, 999999);

                $user = User::where('email',$email)->first();
                if($user){
                    $employee = Employee::where('user_id',$user->id)->first();
                    if($employee){
                        
                        $employee->email = $email;
                        $employee->save();
                    }
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
