<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CommitmentDaily;
use App\Models\EmployeeProject;
use App\Models\Employee;
use App\Models\PpeCheck;
use App\Models\VehicleCheck;
use App\Models\HealthCheck;

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
        foreach(Employee::select('employees.*')->join('employee_projects','employee_projects.employee_id','=','employees.id')->where('is_use_android',1)->groupBy('employees.id')->get() as $em){
            if($em->device_token){
                echo "Employee : {$em->name}\n";
                echo "Token : {$em->device_token}\n";
                echo "==============================\n";
                $msg = "Update PMT e-PM Application\n
                - update speed warning with notification with sound\n
                - update preventive maintenance layout\n";
                push_notification_android($em->device_token,"New Update Apps",$msg,10);
            }
        }

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
