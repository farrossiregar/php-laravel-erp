<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\WorkFlowManagement;
use App\Models\Employee;

class SyncronWfm extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wfm:notif';

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
        $notif_coordinator = WorkFlowManagement::select("*")->where('status',0)->where(\DB::raw("DATE_FORMAT(notif_coordinator,'%H:%i')"),date('H:i'))->whereDate('notif_coordinator',date('Y-m-d'))->first();
        if($notif_coordinator){
            if(isset($notif_coordinator->employee->name)){
                $message = $notif_coordinator->employee->nik." / ". $notif_coordinator->employee->name."\n";
                $message = $notif_coordinator->servicearea4 ." - ". $notif_coordinator->region. "\nWaiting pickup field team";
                if(isset($notif_coordinator->coordinator->device_token)) push_notification_android($notif_coordinator->coordinator->device_token,"Work Force Management" ,$message,9);
            }
        }

        $notif_sm = WorkFlowManagement::where('status',0)->where(\DB::raw("DATE_FORMAT(notif_sm,'%H:%i')"),date('H:i'))->whereDate('notif_sm',date('Y-m-d'))->first();
        if($notif_sm){
            if(isset($notif_sm->employee->name)){
                $message = $notif_sm->employee->nik." / ". $notif_sm->employee->name."\n";
                $message = $notif_sm->servicearea4 ." - ". $notif_sm->region. "\nWaiting pickup field team";
                if(isset($notif_sm->sm->device_token)) push_notification_android($notif_sm->sm->device_token,"Work Force Management" ,$message,9);
            }
        }

        $notif_osm = WorkFlowManagement::where('status',0)->where(\DB::raw("DATE_FORMAT(notif_osm,'%H:%i')"),date('H:i'))->whereDate('notif_osm',date('Y-m-d'))->first();
        if($notif_osm){
            echo $notif_osm->servicearea4 ."\n";
            if(isset($notif_osm->employee->name)){
                $message = $notif_osm->employee->nik." / ". $notif_osm->employee->name."\n";
                $message = $notif_osm->servicearea4 ." - ". $notif_osm->region. "\nWaiting pickup field team";
                
                if(isset($notif_osm->coordinator->device_token)) push_notification_android($notif_osm->coordinator->device_token,"Work Force Management" ,$message,9);
                if(isset($notif_osm->sm->device_token)) push_notification_android($notif_osm->sm->device_token,"Work Force Management" ,$message,9);
                if(isset($notif_osm->osm->device_token)) push_notification_android($notif_osm->osm->device_token,"Work Force Management" ,$message,9);
            }
        }

        return Command::SUCCESS;
    }
}