<?php

namespace App\Http\Livewire\WorkFlowManagement;

use App\Models\Cluster;
use App\Models\Employee;
use App\Models\Region;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\WorkFlowManagement;

class Upload extends Component
{
    use WithFileUploads;
    public $file;
    public function render()
    {
        return view('livewire.work-flow-management.upload');
    }
    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx|max:51200' // 50MB maksimal
        ]);
        
        $path = $this->file->getRealPath();
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        $data = $reader->load($path);
        $sheetData = $data->getActiveSheet()->toArray();
        
        if(count($sheetData) > 0){
            $total_failed = 0;
            $total_success = 0;
            $data_notification = [];
            foreach($sheetData as $key => $i){
                if($key<1) continue; // skip header
                
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                $data = new WorkFlowManagement();
            
                $date = $i[1]? @\PhpOffice\PhpSpreadsheet\Shared\Date::excelToTimestamp($i[1]):'';
                $region = $i[2];
                $area = $i[3];
                $cluster = $i[4];
                $signum = $i[5];
                $name = $i[6];
                $problem = $i[7];
                $treshold = $i[8];

                if($date) $data->date = date('Y-m-d',$date);
                $data->region = $region;
                $data->servicearea4 = $i[3];

                // find region 
                $region = Region::where("region","LIKE", "%{$region}%")->first();
                if(!$region){
                    $new_region = new Region();
                    $new_region->region = $region;
                    $new_region->save();
                    $region = $new_region;
                }

                // find cluster
                $cluster = Cluster::where('region_id',$region->id)->where("name","LIKE", "%{$cluster}%")->first();
                if(!$cluster){
                    $new_cluster = new Cluster();
                    $new_cluster->region_id = $region->id;
                    $new_cluster->name = $cluster;
                    $new_cluster->save();
                    $cluster = $new_cluster;
                }   

                $employee = Employee::where('employee_code',$signum)->first();
                if(!$employee){
                    $new_employee = new Employee();
                    $new_employee->employee_code = $signum;
                    $new_employee->name = $name;
                    $new_employee->save();
                    $employee = $new_employee;
                }

                $data->region_id = $region->id;
                $data->cluster_id = $cluster->id;
                $data->employee_id = $employee->id;
                $data->threshold = $treshold;
                
                if($problem=='FT not assigned WO') $data->wo_assign = 1;

                if($problem=='FT assigned WO but never accept') $data->wo_accept = 1;
                
                if($problem=='FT never close manual' || $problem=='FT accept but never close manual') {
                    $data->wo_close_manual = 1;
                }    
                
                // $data->name = $i[1];
                // $data->id_ = $i[2];
                // $data->city = $i[4];
                // $data->servicearea2 = $i[5];
                // $data->asp = $i[7];
                // $data->region_dan_asp_info = $i[8];
                // $data->skills = $i[9];
                // $data->wo_close_auto = $i[13];
                // $data->wo_close_auto = $i[13];

                // if($i[14]) $data->mttr = round($i[14] * 100,2);
                
                // $data->remark_wo_assign = $i[15];
                // $data->remark_wo_accept = $i[16];
                // $data->remark_wo_close_manual = $i[17];
                // $data->final_remark = $i[19];
                $data->user_id = \Auth::user()->id;
                $data->save();

                if($data->threshold >=5) $data_notification[] = $data;
                
                $total_success++;
            }
            
            session()->flash('message-success',"Upload success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            
            return redirect()->route('work-flow-management.data');
        }
    }
}
