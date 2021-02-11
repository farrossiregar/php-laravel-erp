<?php

namespace App\Http\Livewire\CustomerAssetManagement;

use Livewire\Component;
use Livewire\WithFileUploads;

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
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                $tanggal_submission = $i[1];
                $nama = $i[2];
                $nik = $i[3];
                $tower_index = $i[4];
                $site_id = $i[5];
                $site_name = $i[6];
                $cluster = $i[7];
                $region = $i[8];
                $region1 = $i[9];
                $apakah_di_site_ini_ada_battery = $i[10];
                $berapa_unit = $i[11];
                $merk_baterai = $i[12];
                $kapasitas_baterai = $i[13];    
                $kapan_baterai_dilaporkan_hilang = $i[14];    
                $apakah_baterai_pernah_direlokasi = $i[14];    
                $direlokasi_ke_site_id = $i[15];    
                $direlokasi_ke_site_name = $i[16];    
                $apakah_cabinet_baterai_dipasang_gembok = $i[17];    
                $apakah_dipasang_baterai_cage = $i[18];    
                $apakah_dipasang_cabinet_belting = $i[19];    
                $catatan = $i[20];    
                $check = $i[20];    
                $smartsheet_done_submit = $i[21];    
                
                $employee = \App\Models\Employee::where(['nik'=>$nik])->first();
                // find employee
                $data = new \App\Models\CustomerAssetManagement();
                if(!$employee){
                    if(!empty($nama) || !empty($nik)){
                        $employee = new \App\Models\Employee();
                        $employee->nik = $nik;
                        $employee->name = $nama;
                        $employee->save();
                        $data->employee_id = $employee->id;
                    }
                }
                $region_id = \App\Models\Region::where('region',$region)->first();
                if(!$region_id){
                    $region_id = new \App\Models\Region();
                    $region_id->region = $region;
                    // $region_id->region_code = $region;
                    $region_id->save();
                }
                // find cluster
                $cluster_id = \App\Models\Cluster::where(['region_id'=>$region_id->id,'name'=>$cluster])->first();
                if(!$cluster_id){
                    $cluster_id = new \App\Models\Cluster();
                    $cluster_id->name = $cluster;
                    $cluster_id->region_id = $region_id->id;
                    $cluster_id->save();
                }
                // find site
                $site = \App\Models\Site::where('site_id',$site_id)->first();
                if(!$site){
                    $site = new \App\Models\Site();
                    $site->site_id = $site_id;
                    $site->name = $site_name;
                    $site->region_id = $region_id->id;
                    $site->cluster_id = $cluster_id->id;
                    $site->save();
                }
                // find Tower
                $tower = \App\Models\Tower::where('name',$tower_index)->first();
                if(!$tower){
                    $tower = new \App\Models\Tower();
                    $tower->name = $tower_index;
                    $tower->site_id = $site->id;
                    $tower->save();
                }
                //
                if($direlokasi_ke_site_id){
                    $direlokasi_ke_site = \App\Models\Site::where('site_id',$direlokasi_ke_site_id)->first();
                    if(!$direlokasi_ke_site){
                        $direlokasi_ke_site = new \App\Models\Site();
                        $direlokasi_ke_site->site_id = $direlokasi_ke_site_id;
                        $direlokasi_ke_site->name = $direlokasi_ke_site_name;
                        $direlokasi_ke_site->save();
                    }
                    $direlokasi_ke_site_id = $direlokasi_ke_site->id;
                }
                if($tanggal_submission) $data->tanggal_submission = date('Y-m-d',strtotime($tanggal_submission));
                $data->user_id = \Auth::user()->id;
                $data->tower_id = $tower->id;
                $data->site_id = $site->id;
                $data->region_id = $region_id->id;
                $data->region_cluster_id = $cluster_id->id;
                $data->region_name = $region1;
                $data->apakah_di_site_ini_ada_battery = strtolower($apakah_di_site_ini_ada_battery) == 'yes'? 1 : 0; 
                $data->berapa_unit = $berapa_unit; 
                $data->merk_baterai = $merk_baterai; 
                $data->kapasitas_baterai = $kapasitas_baterai; 
                $data->kapan_baterai_dilaporkan_hilang = date('Y-m-d',strtotime($kapan_baterai_dilaporkan_hilang));
                $data->apakah_baterai_pernah_direlokasi = strtolower($apakah_baterai_pernah_direlokasi) == 'ya'? 1 : 0;
                $data->direlokasi_ke_site_id = $direlokasi_ke_site_id;
                $data->apakah_cabinet_baterai_dipasang_gembok = strtolower($apakah_cabinet_baterai_dipasang_gembok)=='yes' ? 1 : 0;
                $data->apakah_dipasang_baterai_cage = strtolower($apakah_dipasang_baterai_cage)=='yes' ? 1 : 0;
                $data->apakah_dipasang_cabinet_belting = strtolower($apakah_dipasang_cabinet_belting)=='yes' ? 1 : 0;
                $data->catatan = $catatan;
                $data->check = $check;
                $data->smartsheet_done_submit = strtolower($smartsheet_done_submit)=='yes' ? 1 : 0;
                $data->save();
                $total_success++;
            }
            session()->flash('message-success',"Upload success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            return redirect()->route('customer-asset-management.index');
        }
    }
}
