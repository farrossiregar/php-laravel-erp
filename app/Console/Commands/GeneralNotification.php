<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\Notification;
use App\Models\CommitmentDaily;
use App\Models\PpeCheck;
use App\Models\VehicleCheck;
use App\Models\HealthCheck;
use App\Models\EmployeeProject;

class GeneralNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'general_notification';

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
        echo "General Notification\n";
        $data_ = Employee::select('employees.*')->join('employee_projects','employee_projects.employee_id','=','employees.id')
                            ->where('is_use_android',1)
                            ->groupBy('employees.id')
                            ;
        foreach($data_->get() as $em){
            echo "Daily Commitment\n";   
            echo "Name : {$em->name}\n";   
            echo "==========================\n\n";
            
            $project = EmployeeProject::where('employee_id',$em->id)->first();

            $daily = Notification::where(['employee_id'=>$em->id,'type'=>1])->whereDate('created_at',date('Y-m-d'))->first();
            if(!$daily){
                $daily = new Notification();
                $daily->employee_id = $em->id;
                $daily->type = 1; // daily commitment
                $daily->title = 'Daily Commitment';
                $daily->description = "Sudahkah anda melakukan daily commitment hari ini";
                $daily->save();

                $find = CommitmentDaily::where('employee_id',$em->id)->whereDate('created_at',date('Y-m-d'))->first();
                if(!$find){
                    $commitemnt_daily  = new CommitmentDaily();
                    $commitemnt_daily->employee_id = $em->id;
                    if($project) $commitemnt_daily->client_project_id = $project->client_project_id; 
                    $commitemnt_daily->region_id = $em->region_id;
                    $commitemnt_daily->sub_region_id = $em->sub_region_id;
                    $commitemnt_daily->save();
                }
                
                if($em->device_token){
                    push_notification_android($em->device_token,$daily->title,$daily->description,1);
                }
            }

            if($em->user_access_id==85 || $em->user_access_id==84){
                $ppe = Notification::where(['employee_id'=>$em->id,'type'=>2])->whereDate('created_at',date('Y-m-d'))->first();
                if(!$ppe){
                    $ppe = new Notification();
                    $ppe->employee_id = $em->id;
                    $ppe->type = 2; // PPE Check
                    $ppe->title = 'PPE Check';
                    $ppe->description = "Sudahkah anda melakukan PPE Check hari ini";
                    $ppe->save();
                    
                    $find = PpeCheck::where('employee_id',$em->id)->whereDate('created_at',date('Y-m-d'))->first();
                    if(!$find){
                        $data = new PpeCheck();
                        $data->employee_id = $em->id;
                        if($project) $data->client_project_id = $project->client_project_id; 
                        $data->region_id = $em->region_id;
                        $data->sub_region_id = $em->sub_region_id;
                        $data->save();

                        if($em->device_token){
                            push_notification_android($em->device_token,$ppe->title,$ppe->description,2);
                        }
                    }
                }
            
                $vehicle = Notification::where(['employee_id'=>$em->id,'type'=>3])->whereDate('created_at',date('Y-m-d'))->first();
                if(!$vehicle){
                    $vehicle = new Notification();
                    $vehicle->employee_id = $em->id;
                    $vehicle->type = 3; // Vechicle Check
                    $vehicle->title = 'Vehicle Check';
                    $vehicle->description = "Sudahkah anda melakukan Vehicle Check hari ini";
                    $vehicle->save();

                    $find = VehicleCheck::where('employee_id',$em->id)->whereDate('created_at',date('Y-m-d'))->first();
                    if(!$find){
                        $data = new VehicleCheck();
                        $data->employee_id = $em->id;
                        if($project) $data->client_project_id = $project->client_project_id; 
                        $data->region_id = $em->region_id;
                        $data->sub_region_id = $em->sub_region_id;
                        $data->save();

                        if($em->device_token){
                            push_notification_android($em->device_token,$vehicle->title,$vehicle->description,3);
                        }
                    }
                }
            }

            $health = Notification::where(['employee_id'=>$em->id,'type'=>4])->whereDate('created_at',date('Y-m-d'))->first();
            if(!$health){
                $health = new Notification();
                $health->employee_id = $em->id;
                $health->type = 4; // Health Check
                $health->title = 'Healt Check';
                $health->description = "Lakukan Health Check hari ini";
                $health->save();
                
                $find = HealthCheck::where('employee_id',$em->id)->whereDate('created_at',date('Y-m-d'))->first();
                if(!$find){
                    $data = new HealthCheck();
                    $data->employee_id = $em->id;
                    if($project) $data->client_project_id = $project->client_project_id; 
                    $data->region_id = $em->region_id;
                    $data->sub_region_id = $em->sub_region_id;
                    $data->save();

                    if($em->device_token){
                        push_notification_android($em->device_token,$health->title,$health->description,4);
                    }
                }
            }
            
        }
	
        return 0;
    }
}
