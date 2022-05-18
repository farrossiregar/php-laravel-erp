<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CommitmentDaily;
use App\Models\EmployeeProject;
use App\Models\Employee;
use App\Models\PpeCheck;
use App\Models\VehicleCheck;
use App\Models\HealthCheck;
use App\Models\LogActivity;
use App\Models\Notification;

class Sinkron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sinkron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach(Employee::where('nik',1111)->get() as $em){

            exec('df -h', $usage);
            $msg = "\n*Disk Information* :  \n";
            foreach($usage as $val){
                $msg .= $val."\n";
            }

            exec('du -sh /var/www/*', $erp_storage);
            $msg .= "\n*Storage Web* \n";
            foreach($erp_storage as $val){
                $msg .= $val."\n";
            }

            $msg .= "\n*Total Backup* : ";
            exec('du -sh /home/backup', $total_backup);
            foreach($total_backup as $val){
                $msg .= $val ."\n";
            }

            exec('du -sh /home/backup/*', $backup);
            $msg .="*Backup Item*\n";
            foreach($backup as $val){
                $msg .= $val."\n";
            }

            send_wa(['phone'=>'087775365856','message'=> $msg]);
            push_notification_android($em->device_token,"Notification",'Notifikasi berhasil dikirim',1);
        }
        

        echo "test sinkron\n";
        // $employee = \App\Models\Employee::select('employees.*')
        //     ->with('company','department','access','employee_project.project')
        //     ->orderBy('employees.id','DESC')
        //     ->leftJoin('employee_projects','employee_projects.employee_id','=','employees.id')
        //     ->groupBy('employees.id','employee_projects.client_project_id')
        //     ->where('employees.user_access_id',65)
        //     ->where('employee_projects.client_project_id',25)
        //     ->get();
        // foreach($employee as $item){
        //     $item->user_access_id = 84;
        //     $item->save();
        //     echo "NIK : {$item->nik}\n";
        // }


        // $temp = \App\Models\VehicleCheck::whereNotNull('plat_nomor')
        //                                 ->where('client_project_id',8)
        //                                 // ->whereNotIn('plat_nomor',$notIn)
        //                                 ->orderBy('id','DESC')
        //                                 ->get();
        // foreach($temp as $k=>$vehicle_check){
        //     $no_polisi =  ltrim($vehicle_check->plat_nomor);
        //     $no_polisi =  rtrim($no_polisi);

        //     echo "No {$k}\n";
        //     echo "No Polisi : {$no_polisi}\n====================\n";
        //     $vehicle_vendor = \App\Models\EPL\VehicleVendor::where('no_polisi',$no_polisi)->first();

        //     $vehicle_syncron = \App\Models\VehicleSyncron::where('no_polis',$no_polisi)->first();
        //     if(!$vehicle_syncron){
        //         $vehicle_syncron = new \App\Models\VehicleSyncron();
        //         $vehicle_syncron->client_project_id = 8;
        //     } 
            
        //     $vehicle_syncron->erp_vehicle_check_id = $vehicle_check->id;
        //     $vehicle_syncron->no_polis = $no_polisi;
        //     if($vehicle_vendor){
        //         $vehicle_syncron->epl_vehicle_id = $vehicle_vendor->id;
        //         $vehicle_syncron->vendor = isset($vehicle_vendor->vendor->name)?$vehicle_vendor->vendor->name:'';
        //         $vehicle_syncron->brand = isset($vehicle_vendor->vehicle->brand)?$vehicle_vendor->vehicle->brand:'';
        //         $vehicle_syncron->type = isset($vehicle_vendor->vehicle->type)?$vehicle_vendor->vehicle->type:'';
        //         $vehicle_syncron->merk = isset($vehicle_vendor->vehicle->merk)?$vehicle_vendor->vehicle->merk:'';
        //         $vehicle_syncron->tahun = isset($vehicle_vendor->vehicle->tahun)?$vehicle_vendor->vehicle->tahun:'';
        //     }
        //     // $vehicle_syncron->employee_id = \Auth::user()->employee->id;
        //     $vehicle_syncron->car_motorcycle = 1;
        //     $vehicle_syncron->is_syncron = 1;
        //     $vehicle_syncron->region_id = $vehicle_check->region_id;
        //     $vehicle_syncron->sub_region_id = $vehicle_check->sub_region_id;
        //     $vehicle_syncron->driver_employee_id = $vehicle_check->employee_id;       
        //     $vehicle_syncron->save();

        //     // check vehicle
        //     $vehicle = \App\Models\Vehicle::where('no_polisi',$no_polisi)->first();
        //     if(!$vehicle) $vehicle = new \App\Models\Vehicle();
        //     $vehicle->no_polisi = $no_polisi;
        //     $vehicle->employee_id = $vehicle_check->employee_id;
        //     $vehicle->client_project_id = 8;
        //     $vehicle->region_id = $vehicle_check->region_id;
        //     $vehicle->sub_region_id = $vehicle_check->sub_region_id;
        //     $vehicle->save();
        // }

        // // $employee = Employee::where('nik',1319153)->first();
        // $employee = Employee::where('nik',1111)->first();
        // if($employee){
        //     echo $employee->device_token."\n";
        //     push_notification_android($employee->device_token,"Trouble Ticket","Testing Trouble Ticket",6,1,1);
        // }

        // $count = 0;
        // foreach(Employee::select('employees.*')->join('employee_projects','employee_projects.employee_id','=','employees.id')->where('is_use_android',1)->groupBy('employees.id')->get() as $em){
        //     if($em->user_access_id==85 || $em->user_access_id==84){
        //         echo "Name : {$em->name}\n";   
        //         echo "==========================\n\n";
        //         $project = EmployeeProject::where('employee_id',$em->id)->first();
                
        //         $data = PpeCheck::where('employee_id',$em->id)->whereDate('created_at',date('Y-m-d'))->orderBy('id','DESC')->first();
        //         if($data) continue;
                
        //         $ppe = Notification::where(['employee_id'=>$em->id,'type'=>2])->whereDate('created_at',date('Y-m-d'))->first();
        //         if(!$ppe){
        //             $ppe = new Notification();
        //             $ppe->employee_id = $em->id;
        //             $ppe->type = 2; // PPE Check
        //             $ppe->title = 'PPE Check';
        //             $ppe->description = "Sudahkah anda melakukan PPE Check hari ini";
        //             $ppe->save();
                    
        //             $find = PpeCheck::where('employee_id',$em->id)->whereDate('created_at',date('Y-m-d'))->first();
        //             if(!$find){
        //                 $data = new PpeCheck();
        //                 $data->employee_id = $em->id;
        //                 if($project) $data->client_project_id = $project->client_project_id; 
        //                 $data->region_id = $em->region_id;
        //                 $data->sub_region_id = $em->sub_region_id;
        //                 $data->save();

        //                 if($em->device_token){
        //                     //push_notification_android($em->device_token,$ppe->title,$ppe->description,2);
        //                 }
        //             }
        //         }

        //         $count++;
        //     }
        // }


        // echo "\nCount : {$count}\n\n";
        // $data = LogActivity::whereDate('created_at',date('Y-m-d'))->where('subject','Submit PPE Check')->get();
        // foreach($data as $k => $item){
        //     echo "Key : {$k}\n"; 
        //     echo "User ID : {$item->user_id}\n";
        //     echo "------------------------\n";
            
        //     $em = Employee::where('user_id',$item->user_id)->first();
        //     $data = PpeCheck::where('employee_id',$em->id)->whereDate('created_at',date('Y-m-d'))->orderBy('id','DESC')->first();
        //     if($data) continue;
            
        //     $prev_data = PpeCheck::where('employee_id',$em->id)->whereDate('created_at','2021-11-10')->orderBy('id','DESC')->first();
            
        //     if($prev_data){
        //         $data = new PpeCheck(); 
        //         $project = EmployeeProject::where('employee_id',$em->id)->first();
                
        //         if($project) $data->client_project_id = $project->client_project_id; 
        //         $data->region_id = $em->region_id;
        //         $data->sub_region_id = $em->sub_region_id;
        //         $data->employee_id = $em->id;
        //         $data->is_submit = 1;
        //         $data->ppe_lengkap = $prev_data->ppe_lengkap;
        //         $data->ppe_alasan_tidak_lengkap = $prev_data->ppe_alasan_tidak_lengkap;
        //         $data->banner_lengkap = $prev_data->banner_lengkap;
        //         $data->banner_alasan_tidak_lengkap = $prev_data->banner_alasan_tidak_lengkap;
        //         $data->sertifikasi_alasan_tidak_lengkap = $prev_data->sertifikasi_alasan_tidak_lengkap;
        //         $data->site_id = $prev_data->site_id;
        //         $data->site_name = $prev_data->site_name;
        //         $data->foto_dengan_ppe = $prev_data->foto_dengan_ppe;;
        //         $data->foto_banner = $prev_data->foto_banner;
        //         $data->foto_wah = $prev_data->foto_wah;
        //         $data->foto_elektrikal = $prev_data->foto_elektrikal;
        //         $data->foto_first_aid = $prev_data->foto_first_aid;
        //         $data->save();
        //         $count++;
        //     }
        // }

        // echo "\n\nTotal : {$count}";

        // $msg = "This testing notification ".date('Y-m-d H:i:s')."\n";
        // push_notification_android('dZcCN3jiRz61ym255Zvjtb:APA91bE9QTXJT_BHp9ItTysMoEY1wJ9zX8I3Wcw0w5kEjrC9kPukTIGvpDjKPAGe-4cJBpA5kIyOfHh1zPART60k_xUuuuzRymq67xtygMKJ4Ba9Nd5UOy-NVTiPfuH5ZotGLUOj1iSx',"Testing Notification",$msg,10);
        // return;
        // foreach(Employee::select('employees.*')->join('employee_projects','employee_projects.employee_id','=','employees.id')->where('is_use_android',1)->groupBy('employees.id')->get() as $em){
        //     if($em->device_token){
        //         echo "Employee : {$em->name}\n";
        //         echo "Token : {$em->device_token}\n";
        //         echo "==============================\n";
        //         $msg = "Update PMT e-PM Application\n
        //         - update speed warning with notification with sound\n
        //         - update preventive maintenance layout\n";
        //         push_notification_android($em->device_token,"New Update Apps",$msg,10);
        //     }
        // }

        /*
        $commitmentDaily = CommitmentDaily::whereDate('created_at',date('Y-m-d'))->where('is_submit',0)->get();
        foreach($commitmentDaily as $item){
            $project = EmployeeProject::where('employee_id',$item->employee_id)->first();
            echo "Sinkron Commitment Daily : {$item->employee->name}\n";

            if(!$project) $item->delete();
            //if($item->employee->region_id){
              //  echo "Sinkron Commitment Daily : {$item->employee->name}\n";
                // if($project) $item->client_project_id = $project->client_project_id; 

                // $item->region_id = $item->employee->region_id;
                // $item->sub_region_id = $item->employee->sub_region_id;
                // $item->save();
            //}
        }

        $commitmentDaily = PpeCheck::whereDate('created_at',date('Y-m-d'))->where('is_submit',0)->get();
        foreach($commitmentDaily as $item){

            $project = EmployeeProject::where('employee_id',$item->employee_id)->first();
            echo "Sinkron PPE Check : {$item->employee->name}\n";

            if(!$project) $item->delete();
            // if($item->employee->region_id){
            //     echo "Sinkron PPE Check : {$item->employee->name}\n";
            //     $project = EmployeeProject::where('employee_id',$item->employee_id)->first();
            //     if($project) $item->client_project_id = $project->client_project_id; 

            //     $item->region_id = $item->employee->region_id;
            //     $item->sub_region_id = $item->employee->sub_region_id;
            //     $item->save();
            // }
        }

        $commitmentDaily = VehicleCheck::whereDate('created_at',date('Y-m-d'))->where('is_submit',0)->get();
        foreach($commitmentDaily as $item){
            $project = EmployeeProject::where('employee_id',$item->employee_id)->first();
            echo "Sinkron Vehicle Check : {$item->employee->name}\n";

            if(!$project) $item->delete();
            // if($item->employee->region_id){
            //     echo "Sinkron Vehicle Check : {$item->employee->name}\n";
            //     $project = EmployeeProject::where('employee_id',$item->employee_id)->first();
            //     if($project) $item->client_project_id = $project->client_project_id; 

            //     $item->region_id = $item->employee->region_id;
            //     $item->sub_region_id = $item->employee->sub_region_id;
            //     $item->save();
            // }
        }

        $commitmentDaily = HealthCheck::whereDate('created_at',date('Y-m-d'))->where('is_submit',0)->get();
        foreach($commitmentDaily as $item){
            $project = EmployeeProject::where('employee_id',$item->employee_id)->first();
            echo "Sinkron Health Check : {$item->employee->name}\n";

            if(!$project) $item->delete();
            // if($item->employee->region_id){
            //     echo "Sinkron Health Check : {$item->employee->name}\n";
            //     $project = EmployeeProject::where('employee_id',$item->employee_id)->first();
            //     if($project) $item->client_project_id = $project->client_project_id; 

            //     $item->region_id = $item->employee->region_id;
            //     $item->sub_region_id = $item->employee->sub_region_id;
            //     $item->save();
            // }
            
        }*/
        // return 0;
    }
}
