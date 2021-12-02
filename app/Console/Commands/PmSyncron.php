<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\PreventiveMaintenance;
use App\Models\PreventiveMaintenanceSow;

class PmSyncron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pm:syncron';

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
        $history = PreventiveMaintenance::whereMonth('created_at',date('m',strtotime('-1 month')))->whereYear('created_at',date('Y',strtotime('-1 month')))->get();
        foreach($history as $key => $item){
            echo "Key : ".$key ."\n";
            echo "Site ID : ".$item->site_id ."\n";

            $data = new PreventiveMaintenance();
            $data->site_id = $item->site_id;
            $data->site_name = $item->site_name;
            // $data->description  = $item->description;
            $data->site_category  = $item->site_category;
            $data->site_type  = $item->site_type;
            $data->pm_type  = $item->pm_type;
            $data->region_id  = $item->region_id;
            $data->sub_region_id  = $item->sub_region_id;
            $data->cluster  = $item->cluster;
            $data->sub_cluster  = $item->sub_cluster;
            $data->employee_id  = $item->employee_id;
            $data->admin_project_id = $item->admin_project_id;
            $data->project_id = $item->project_id;
            $data->status = 0;
            $data->save();
        }
        
        // setting SOW
        $histoy_sow = PreventiveMaintenanceSow::where('bulan',date('m',strtotime('-1 month')))->where('tahun',date('Y',strtotime('-1 month')))->get();
        
        foreach($histoy_sow as $item){
            $find = PreventiveMaintenanceSow::where([
                'site_type'=>$item->site_type,
                'pm_type'=>$item->pm_type,
                'region_id'=>$item->region_id,
                'sub_region_id'=>$item->sub_region_id,
                'bulan'=>date('m'),
                'tahun'=>date('Y')
                ])->first();
            
            if(!$find){
                echo "{$item->bulan} / {$item->tahun}\n";
                $data = new PreventiveMaintenanceSow();
                $data->region_id = $item->region_id;
                $data->sub_region_id = $item->sub_region_id;
                $data->sow = $item->sow;
                $data->site_type = $item->site_type;
                $data->pm_type = $item->pm_type;
                $data->bulan = date('m');
                $data->tahun = date('Y');
                $data->save();
            }
        }

        return Command::SUCCESS;
    }
}
