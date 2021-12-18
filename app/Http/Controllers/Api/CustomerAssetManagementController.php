<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CustomerAssetManagement;
use App\Models\CustomerAssetManagementHistory;
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
                                        ->orWhere('sites.site_id','LIKE',"%{$keyword}%")
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
                'status' => $item->status,
                'qty_module_1' => $item->qty_module_1,
                'battery_brand_1' => $item->battery_brand_1,
                'battery_qty_1' => $item->battery_qty_1,
                'qty_module_2' => $item->qty_module_2,
                'battery_brand_2' => $item->battery_brand_2,
                'battery_qty_2' => $item->battery_qty_2,
                'qty_module_3' => $item->qty_module_3,
                'battery_brand_3' => $item->battery_brand_3,
                'battery_qty_3' => $item->battery_qty_3,
                'photo_kondition' => $item->photo_kondition ? asset($item->photo_kondition) : null,
                'last_update' => date('d-M-Y',strtotime($item->updated_at))
            ];
        }
        
        \LogActivity::add('[apps] Customer Asset Data');

        return response(['keyword'=>$keyword,'status'=>200,'data'=>$data], 200);
    }

    public function submit(Request $r)
    {
        $find = CustomerAssetManagement::find($r->id);
        if($r->is_stolen=='Ya') $find->is_stolen = 1;
        $find->tanggal_submission = date('Y-m-d');
        $find->save();

        $data = new CustomerAssetManagementHistory();
        $data->employee_id = \Auth::user()->employee->id;
        $data->region_name = $find->region_name;
        $data->tower_id = $find->tower_id;
        $data->region_cluster_id = $find->region_cluster_id;
        $data->customer_asset_management_id = $r->id;
        $data->site_id = $find->site_id;
        $data->status = $r->is_stolen=='Ya' ? 1 : 2;
        $data->is_stolen = $r->is_stolen=='Ya' ? 1 : 2;
        $data->qty_module_1 = $r->qty_module_1;
        $data->battery_brand_1 = $r->battery_brand_1;
        $data->battery_qty_1 = $r->battery_qty_1;
        $data->qty_module_2 = $r->qty_module_2;
        $data->battery_brand_2 = $r->battery_brand_2;
        $data->battery_qty_2 = $r->battery_qty_2;
        $data->qty_module_3 = $r->qty_module_3;
        $data->battery_brand_3 = $r->battery_brand_3;
        $data->battery_qty_3 = $r->battery_qty_3;
        $data->catatan = $r->catatan;   
        if(isset($r->photo)){
            $name = "photo.".$r->photo->extension();
            $r->photo->storeAs("public/customer-asset-management/{$r->id}", $name);
            $data->photo_kondition = "storage/customer-asset-management/{$r->id}/{$name}";
        }
        $data->save();
        
        if($find and $r->is_stolen=='Ya'){
            if(isset($find->site->site_id)){
                $message = "Customer Asset Stolen : *".(isset($find->tower->name)?$find->tower->name : '')."*\n\n";
                $message .= "Site : ".(isset($find->site->name) ? $find->site->name : '')."\n";
                $message .= "Region : ".(isset($find->region->region) ? $find->region->region : '')."\n";
                $message .= "Cluster : ".(isset($find->cluster->name) ? $find->cluster->name : '')."\n";
                
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

        return response(['status'=>200,'message'=>'success'],200);
    }
}
