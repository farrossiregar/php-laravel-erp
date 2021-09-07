<?php

namespace App\Http\Livewire\Migration;

use App\Models\Employee;
use App\Models\User;
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
                $cluster  = $i[3];
                $sub_cluster  = $i[4];
                $nik  = $i[5];
                $email = $i[6];
                $no_telepon1 = $i[7];
                $no_telepon2 = $i[8];
                $no_ktp = $i[9];
                $type_sim = $i[10];
                $no_sim = $i[11];
                $position = $i[12];
                $account_mateline = $i[13];
                $date_join = ($i[14]) ? @\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($i[14])->format('Y-m-d') : '';
                $status_synergy = $i[15];
                $no_pass_id = $i[16];
                $training_k3 = $i[17];
                $total_site = $i[18];
                $sim_expired = ($i[20]) ? @\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($i[20])->format('Y-m-d') : '';
                $password = random_int(100000, 999999);
                
                $check = Employee::where('email',$email)->orWhere('telepon',$no_telepon1)->first();
                if($check) continue;

                $data = new User();
                $data->name = $name;
                $data->email = $email;
                $data->password = Hash::make($password);
                $data->save();

                $emp = new Employee();
                $emp->status_synergy = $status_synergy;
                $emp->position = $position;
                $emp->account_mateline = $account_mateline;
                $emp->user_id = $data->id;
                $emp->name = $name;
                $emp->nik = $nik;
                $emp->telepon = $no_telepon1;
                $emp->telepon2 = $no_telepon2;
                $emp->ktp = $no_ktp;
                if($date_join) $emp->join_date = $date_join;
                if($sim_expired) $emp->sim_expired = $sim_expired;
                $emp->type_sim = $type_sim; 
                $emp->no_sim = $no_sim; 
                $emp->is_flm_engineer = 1;
                $emp->no_pass_id = $no_pass_id;
                $emp->training_k3 = $training_k3;
                $emp->total_site = $total_site;
                $emp->is_use_android = 1;
                $emp->save();

                $message = "Hallo {$name},\nBerikut username dan password untuk masuk ke dalam aplikasi EPL e-PM\n";
                $message .= "Username : ". $email;
                $message .= "\nPassword : ". $password;
                $message .= "\nDownload : https://play.google.com/store/apps/details?id=com.pmt.access";
                send_wa(['phone'=> $no_telepon1,'message'=>$message]);
            }
        }
        
        session()->flash('message-success',__('Data berhasil di upload'));

        return redirect()->route('migration.index');
    }
}
