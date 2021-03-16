<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\CustomerAssetManagement;
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
        $raw = CustomerAssetManagement::orderBy('id','DESC')->whereNotNull('site_id')->whereNotNull('tower_id')->paginate(40);
        $data = [];
        foreach($raw as $k => $item){
            $var = [];
            if(!isset($item->tower->name) or $item->tower->name=="") continue;
            $var['id'] = $item->id;
            $var['uploader'] = date('d-M-Y',strtotime($item->created_at));
            $var['tower'] = $item->tower->name;
            $var['site_id'] = isset($item->site->site_id) ? $item->site->site_id : '';
            $var['site'] = isset($item->site->name) ? $item->site->name : '';
            $var['region'] = $item->region_name;
            $var['cluster'] = isset($item->cluster->name) ? $item->cluster->name : '';
            $var['status'] = $item->status;
            $data[] = $var;
        }
        $json['data'] = $data;

        return response(['status'=>200,'data'=>$data], 200);
    }

    public function submit(Request $r)
    {
        $param['status'] = 1;
        $param['tanggal_submission'] = date('Y-m-d');
        $param['apakah_di_site_ini_ada_battery'] = $r->apakah_di_site_ini_ada_battery;
        $param['berapa_unit'] = $r->berapa_unit;
        $param['merk_baterai'] = $r->merk_baterai;
        $param['kapasitas_baterai'] = $r->kapasitas_baterai;
        $param['kapan_baterai_dilaporkan_hilang'] = $r->kapan_baterai_dilaporkan_hilang;
        $param['apakah_baterai_pernah_direlokasi'] = $r->apakah_baterai_pernah_direlokasi;
        $param['direlokasi_ke_site_id'] = $r->direlokasi_ke_site_id;
        $param['apakah_cabinet_baterai_dipasang_gembok'] = $r->apakah_cabinet_baterai_dipasang_gembok;
        $param['apakah_dipasang_baterai_cage'] = $r->apakah_dipasang_baterai_cage;
        $param['apakah_dipasang_cabinet_belting'] = $r->apakah_dipasang_cabinet_belting;
        $param['catatan'] = $r->catatan;

        CustomerAssetManagement::where('id',$r->id)->update($param);

        return response(['status'=>200,'message'=>'success','user'=>\Auth::user()->id],200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CustomerAssetManagement  $customerAssetManagement
     * @return \Illuminate\Http\Response
     */
    public function show(CustomerAssetManagement $customerAssetManagement)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CustomerAssetManagement  $customerAssetManagement
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CustomerAssetManagement $customerAssetManagement)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CustomerAssetManagement  $customerAssetManagement
     * @return \Illuminate\Http\Response
     */
    public function destroy(CustomerAssetManagement $customerAssetManagement)
    {
        //
    }
}
