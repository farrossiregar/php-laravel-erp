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
        $raw = CustomerAssetManagement::paginate(40);
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
        $json['current_page'] = 1;
        $json['data'] = $data;

        return response(['status'=>200,'data'=>$data], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
