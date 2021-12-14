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
        // $employee = Employee::where('nik',1319153)->first();
        $employee = Employee::where('nik',1111)->first();
        if($employee){
            echo $employee->device_token."\n";
            push_notification_android($employee->device_token,"Trouble Ticket","Testing Trouble Ticket",6,1,1);
        }

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
