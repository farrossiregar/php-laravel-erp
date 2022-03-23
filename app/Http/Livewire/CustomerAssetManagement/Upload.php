<?php

namespace App\Http\Livewire\CustomerAssetManagement;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Employee;
use App\Models\CustomerAssetManagement;
use App\Models\Region;
use App\Models\SubRegion;
use App\Models\Cluster;
use App\Models\Site;
use App\Models\Tower;

class Upload extends Component
{
    use WithFileUploads;
    public $file;
    public function render()
    {
        return view('livewire.customer-asset-management.upload');
    }
    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx|max:51200' // 50MB maksimal
        ]);
        
        \LogActivity::add('[web] Customer Asset Management - Upload');

        $path = $this->file->getRealPath();
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $data = $reader->load($path);
        $sheetData = $data->getActiveSheet()->toArray();
        if(count($sheetData) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;
            $data_notification = [];
            foreach($sheetData as $key => $i){
                if($key<1) continue; // skip header
                foreach($i as $k=>$a){$i[$k] = trim($a);}
                $tanggal_submission = $i[1];
                $nik = $i[2];
                $tower_index = $i[3];
                $site_id = $i[4];
                $site_name = $i[5];
                $region = $i[6];
                $sub_region = $i[7];
                $cluster = $i[8];
                $coordinator = $i[9];
                
                $employee = Employee::where(['nik'=>$nik])->first();
                // find employee
                $data = new CustomerAssetManagement();
                if($employee) $data->employee_id = $employee->id;
                
                $coordinator = Employee::where('nik',$coordinator)->first();
                if($coordinator) $data->coordinator_id = $coordinator->id;

                $region_id = Region::where('region',$region)->first();
                if($region_id) $data->region_id = $region_id->id;

                if($region_id){
                    $sub_region_id = SubRegion::where(['region_id'=>$region_id->id,'name'=>$sub_region])->first();
                    if($sub_region_id){
                        $data->sub_region_id = $sub_region_id->id;
                        $cluster_id = Cluster::where(['region_id'=>$region_id->id,'sub_region_id'=>$sub_region_id->id,'name'=>$cluster])->first();
                        if(!$cluster_id){
                            $cluster_id = new Cluster();
                            $cluster_id->name = $cluster;
                            $cluster_id->region_id = $region_id->id;
                            $cluster_id->sub_region_id = $sub_region_id->id;
                            $cluster_id->save();
                        }
                        $data->region_cluster_id = $cluster_id->id;
                    }
                }
                
                // find site
                $site = Site::where('site_id',$site_id)->first();
                if(!$site){
                    $site = new Site();
                    if($employee) $site->employee_id = $employee->id;
                    $site->site_id = $site_id;
                    $site->name = $site_name;
                    $site->region_id = $region_id->id;
                    $site->cluster_id = $cluster_id->id;
                    $site->save();
                }
                
                if($employee) $site->employee_id = $employee->id;
                $site->save();

                $data->site_id = $site->id;
                // find Tower
                if(!empty($tower_index)){
                    $tower = Tower::where('name',$tower_index)->first();
                    if(!$tower){
                        $tower = new Tower();
                        $tower->name = $tower_index;
                        $tower->site_id = $site->id;
                        $tower->save();
                    }
                    $data->tower_id = $tower->id;
                }

                $data->user_id = \Auth::user()->employee->id;
                $data->site_id = $site->id;
                $data->client_project_id = session()->get('project_id');
                $data->save();
                $total_success++;
            }
            session()->flash('message-success',"Upload success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            return redirect()->route('customer-asset-management.index');
        }
    }
}
