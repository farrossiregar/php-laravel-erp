<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CustomerAssetManagement;
use App\Mail\CustomerAssetStolenEmail;
use Illuminate\Http\Request;

class CustomerAssetManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $raw = CustomerAssetManagement::select('customer_asset_management.*')
                                    ->orderBy('customer_asset_management.id','DESC')
                                    ->leftJoin('towers','towers.id','=','customer_asset_management.tower_id')
                                    ->leftJoin(env('DB_DATABASE_EPL_PMT').'.region_cluster',env('DB_DATABASE_EPL_PMT').'.region_cluster.id','=','customer_asset_management.region_cluster_id')
                                    ->join('sites','sites.id','=','customer_asset_management.site_id')
                                    ->where('towers.name','<>','0')
                                    ->whereNotNull('customer_asset_management.tower_id')
                                    ->whereNotNull('customer_asset_management.site_id')
                                    ->where('sites.employee_id', \Auth::user()->employee->id);
        
        $keyword = isset($_GET['keyword']) ? $_GET['keyword'] : '';
        if($keyword) $raw = $raw->where(function($table) use ($keyword) {
                                    $table->where('towers.name',"LIKE","%{$keyword}%")
                                        ->orWhere('customer_asset_management.region_name','LIKE',"%{$keyword}%")
                                        ->orWhere('region_cluster.name','LIKE',"%{$keyword}%")
                                        ;
                                });

        $data = [];
        foreach($raw->paginate(100) as $k => $item){
            $data[] = [
                'id' => $item->id,
                'uploader' => date('d-M-Y',strtotime($item->created_at)),
                'tower' => $item->tower->name,
                'site_id' => isset($item->site->site_id) ? $item->site->site_id : '',
                'site' => isset($item->site->name) ? $item->site->name : '',
                'region' => $item->region_name,
                'cluster' => isset($item->cluster->name) ? $item->cluster->name : '',
                'status' => $item->status
            ];
        }

        return response(['keyword'=>$keyword,'status'=>200,'data'=>$data], 200);
    }

    public function submit(Request $r)
    {
        $param['status'] = $r->kapan_baterai_dilaporkan_hilang ? 1 : 4;
        $param['tanggal_submission'] = date('Y-m-d');
        $param['apakah_di_site_ini_ada_battery'] = $r->apakah_di_site_ini_ada_battery;
        $param['berapa_unit'] = $r->berapa_unit;
        $param['merk_baterai'] = $r->merk_baterai;
        $param['kapasitas_baterai'] = $r->kapasitas_baterai;
        $param['kapan_baterai_dilaporkan_hilang'] = $r->kapan_baterai_dilaporkan_hilang;
        $param['apakah_baterai_pernah_direlokasi'] = $r->apakah_baterai_pernah_direlokasi;
        $param['direlokasi_ke_site_id'] = $r->direlokasi_ke_site_id;
        $param['apakah_cabinet_baterai_dipasang_gembok'] = $r->apakah_cabinet_baterai_dipasang_gembok=='YES'? 1  : 0;
        $param['apakah_dipasang_baterai_cage'] = $r->apakah_dipasang_baterai_cage=='YES' ? 1 : 0;
        $param['apakah_dipasang_cabinet_belting'] = $r->apakah_dipasang_cabinet_belting=='YES' ? 1 : 0;
        $param['catatan'] = $r->catatan;
        $param['device'] = $r->device;
        $param['long'] = $r->long;
        $param['lat'] = $r->lat;

        $find = CustomerAssetManagement::find($r->id);
        if($find and $param['kapan_baterai_dilaporkan_hilang']){
            if(isset($find->site->site_id)){
                $message = "Customer Asset Stolen : *".(isset($find->tower->name)?$find->tower->name : '')."*\n\n";
                $message .= "Site : ".(isset($find->site->name) ? $find->site->name : '')."\n";
                $message .= "Region : ".(isset($find->region->region) ? $find->region->region : '')."\n";
                $message .= "Cluster : ".(isset($find->cluster->name) ? $find->cluster->name : '')."\n";
                $message .= "Date : {$param['kapan_baterai_dilaporkan_hilang']}\n";
                
                if($find->site->site_owner =='TMG'){
                    foreach(get_user_from_access('customer-asset-management.asset-stolen-verify-and-acknowldge-tmg') as $user){
                        send_wa(['phone'=>$user->telepon,'message'=>"*[TMG]* ".$message]);
                        \Mail::to($user->email)->send(new CustomerAssetStolenEmail($find));
                    }
                }

                if($find->site->site_owner =='TLP'){
                    foreach(get_user_from_access('customer-asset-management.asset-stolen-acknowledge-tlp') as $user){
                        send_wa(['phone'=>$user->telepon,'message'=>"*[TLP]* ".$message]);
                        \Mail::to($user->email)->send(new CustomerAssetStolenEmail($find));
                    }
                }

            }
        }

        CustomerAssetManagement::where('id',$r->id)->update($param);

        return response(['status'=>200,'message'=>'success'],200);
    }
}
