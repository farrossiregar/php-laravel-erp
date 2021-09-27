<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\Notification;
use App\Models\CommitmentDaily;
use App\Models\PpeCheck;
use App\Models\VehicleCheck;
use App\Models\HealthCheck;

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

        foreach(Employee::where(['is_use_android'=>1])->get() as $em){
            echo "Daily Commitment\n";   
            echo "Name : {$em->name}\n";   
            echo "==========================\n\n";
            
            $daily = Notification::where(['employee_id'=>$em->id,'type'=>1])->whereDate('created_at',date('Y-m-d'))->first();
            if(!$daily){
                $daily = new Notification();
                $daily->employee_id = $em->id;
                $daily->type = 1; // daily commitment
                $daily->title = 'Daily Commitment';
                $daily->description = "Sudahkah anda melakukan daily commitment hari ini";
                $daily->save();

                $commitemnt_daily  = new CommitmentDaily();
                $commitemnt_daily->employee_id = $em->id;
                $commitemnt_daily->save();

                if($em->device_token){
                    push_notification_android($em->device_token,$daily->title,$daily->description,1);
                }
            }

            $ppe = Notification::where(['employee_id'=>$em->id,'type'=>2])->whereDate('created_at',date('Y-m-d'))->first();
            if(!$ppe){
                $ppe = new Notification();
                $ppe->employee_id = $em->id;
                $ppe->type = 2; // PPE Check
                $ppe->title = 'PPE Check';
                $ppe->description = "Sudahkah anda melakukan PPE Check hari ini";
                $ppe->save();

                $data = new PpeCheck();
                $data->employee_id = $em->id;
                $data->save();

                if($em->device_token){
                    push_notification_android($em->device_token,$ppe->title,$ppe->description,2);
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

                $data = new VehicleCheck();
                $data->employee_id = $em->id;
                $data->save();

                if($em->device_token){
                    push_notification_android($em->device_token,$vehicle->title,$vehicle->description,3);
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

                $data = new HealthCheck();
                $data->employee_id = $em->id;
                $data->save();

                if($em->device_token){
                    push_notification_android($em->device_token,$vehicle->title,$vehicle->description,4);
                }
            }
        }
	
        return 0;
    }
}
