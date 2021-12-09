<?php

namespace App\Http\Livewire\WorkFlowManagement;

use App\Models\Cluster;
use App\Models\Employee;
use App\Models\Region;
use App\Models\SubRegion;
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
                $nik = $i[9];
                
                if(empty($date) and empty($region) and empty($area)) continue;

                if($date) $data->date = date('Y-m-d',$date);
                $data->name = $name;
                $data->id_ = $signum;
                $data->region = $region;
                $data->servicearea4 = $i[3];

                // find region 
                $region = Region::where("region","LIKE", "%{$region}%")->orWhere('region_code',"LIKE","%{$region}%")->first();
                if($region) {
                    $sub_region = SubRegion::where("region_id",$region->id)->where('name',"LIKE","%{$area}%")->first();
                    if($sub_region){
                        $data->region_id = $region->id;
                        // find cluster
                        $cluster = Cluster::where(['region_id'=>$region->id,'sub_region_id'=>$sub_region->id])->where("name","LIKE", "%{$cluster}%")->first();
                        if(!$cluster) {
                            $cluster = new Cluster();
                            $cluster->region_id = $region->id;
                            $cluster->sub_region_id = $sub_region->id;
                            $cluster->name = $cluster;
                            $cluster->save();
                        }
                        $data->cluster_id = $cluster->id;
                    }
                }
                $employee = Employee::where('nik',$nik)->first();
                if($employee) $data->employee_id = $employee->id;
                if($region)$data->region_id = $region->id;
                $data->employee_id = $employee->id;
                $data->threshold = $treshold;
                $data->wo_close_manual = 1;
                $data->problem = $problem;
                $data->user_id = \Auth::user()->id;
                $data->save();

                if($data->threshold >=5) $data_notification[] = $data;
                
                $total_success++;
            }
            
            session()->flash('message-success',"Upload success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            
            \LogActivity::add('[web] WFM Upload');
            
            return redirect()->route('work-flow-management.index');
        }
    }
}
