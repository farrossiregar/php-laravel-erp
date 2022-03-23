<?php

namespace App\Http\Livewire\Sites;

use Livewire\Component;
use App\Models\Site;
use App\Models\Region;
use App\Models\Cluster;
use App\Models\RegionClusterSub;
use Livewire\WithFileUploads;

class Upload extends Component
{
    public $file;
    use WithFileUploads;
    public function render()
    {
        return view('livewire.sites.upload');
    }

    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xls,xlsx,csv|max:51200' // 50MB maksimal
        ]);

        $path = $this->file->getRealPath();
       
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        $data = $reader->load($path);
        $sheetData = $data->getActiveSheet()->toArray();
        if(count($sheetData) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;
            foreach($sheetData as $key => $i){
                if($key<1) continue; // skip header

                $find = Site::where('site_id', $i[1])->first();
                if(!$find) $find  = new Site();

                $find->site_id = $i[1];
                $find->name = $i[2];
                $find->site_technology = $i[3];
                $find->site_owner = $i[4];
                $find->tlp_company = $i[5];
                $find->site_category = $i[6];
                $find->site_type = $i[7];
                $find->regional = $i[8];

                if($i[9]){
                    # find regional / service area manager
                    $region = Region::where('region',$i[9])->first();
                    if(!$region){
                        $region = new Region();
                        $region->region_code = $i[9];
                        $region->region = $i[9];
                        $region->save();
                    }

                    $find->region_id =$region->id;
                }
                
                if($i[10] and isset($region)){
                    # find cluster
                    $cluster = Cluster::where(['region_id'=>$region->id,'name'=>$i[10]])->first();
                    if(!$cluster){
                        $cluster = new Cluster();
                        $cluster->region_id = $region->id;
                        $cluster->name = $i[10];
                        $cluster->save();
                    }
                    $find->cluster_id = $cluster->id;
                }

                if($i[11] and isset($cluster) and isset($region)){
                    # find cluster
                    $sub_cluster = RegionClusterSub::where(['region_id'=>$region->id,'region_cluster_id'=>$cluster->id,'name'=>$i[11]])->first();
                    if(!$sub_cluster){
                        $sub_cluster = new RegionClusterSub();
                        $sub_cluster->region_id = $region->id;
                        $sub_cluster->region_cluster_id = isset($cluster->id) ? $cluster->id : '';
                        $sub_cluster->name = $i[11];
                        $sub_cluster->save();
                    }
                    $find->sub_cluster_id = $sub_cluster->id;
                }

                $find->save();
            }
        }

        session()->flash('message-success',"Upload success");

        return redirect()->route('sites.index');
    }
}
