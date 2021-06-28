<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Employee;
use App\Models\Notification;

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

                if($em->device_token){
                    push_notification_android($em->device_token,$daily->title,$daily->description);
                }
            }

            $ppe = Notification::where(['employee_id'=>$em->id,'type'=>2])->whereDate('created_at',date('Y-m-d'))->first();
            if(!$ppe){
                $notif = new Notification();
                $notif->employee_id = $em->id;
                $notif->type = 2; // PPE Check
                $notif->title = 'PPE Check';
                $notif->description = "Sudahkah anda melakukan PPE Check hari ini";
                $notif->save();
            }

            $vehicle = Notification::where(['employee_id'=>$em->id,'type'=>3])->whereDate('created_at',date('Y-m-d'))->first();
            if(!$vehicle){
                $notif = new Notification();
                $notif->employee_id = $em->id;
                $notif->type = 3; // Vechicle Check
                $notif->title = 'Vehicle Check';
                $notif->description = "Sudahkah anda melakukan Vehicle Check hari ini";
                $notif->save();
            }
        }

        return 0;
    }
}
