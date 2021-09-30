<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CommitmentDaily;
use App\Models\EmployeeProject;
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
        $commitmentDaily = CommitmentDaily::get();
        foreach($commitmentDaily as $item){
            if($item->employee->region_id){
                echo "Sinkron Commitment Daily : {$item->employee->name}\n";
                $project = EmployeeProject::where('employee_id',$item->employee_id)->first();
                if($project) $item->client_project_id = $project->client_project_id; 

                $item->region_id = $item->employee->region_id;
                $item->sub_region_id = $item->employee->sub_region_id;
                $item->save();
            }
        }

        $commitmentDaily = PpeCheck::get();
        foreach($commitmentDaily as $item){
            if($item->employee->region_id){
                echo "Sinkron PPE Check : {$item->employee->name}\n";
                $project = EmployeeProject::where('employee_id',$item->employee_id)->first();
                if($project) $item->client_project_id = $project->client_project_id; 

                $item->region_id = $item->employee->region_id;
                $item->sub_region_id = $item->employee->sub_region_id;
                $item->save();
            }
        }

        $commitmentDaily = VehicleCheck::get();
        foreach($commitmentDaily as $item){
            if($item->employee->region_id){
                echo "Sinkron Vehicle Check : {$item->employee->name}\n";
                $project = EmployeeProject::where('employee_id',$item->employee_id)->first();
                if($project) $item->client_project_id = $project->client_project_id; 

                $item->region_id = $item->employee->region_id;
                $item->sub_region_id = $item->employee->sub_region_id;
                $item->save();
            }
        }

        $commitmentDaily = HealthCheck::get();
        foreach($commitmentDaily as $item){
            if($item->employee->region_id){
                echo "Sinkron Health Check : {$item->employee->name}\n";
                $project = EmployeeProject::where('employee_id',$item->employee_id)->first();
                if($project) $item->client_project_id = $project->client_project_id; 

                $item->region_id = $item->employee->region_id;
                $item->sub_region_id = $item->employee->sub_region_id;
                $item->save();
            }
        }
        // return 0;
    }
}
