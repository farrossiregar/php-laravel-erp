<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PpeCheck;
use App\Models\Notification;
use Illuminate\Http\Request;
 
class PpeCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function history()
    {
        $data = [];
        $params = PpeCheck::where('employee_id',\Auth::user()->employee->id)->orderBy('id','DESC')->paginate(20);
        foreach($params as $k => $item){
            $data[$k] = $item;
            $data[$k]['date'] = date('d F Y',strtotime($item->created_at));
            $data[$k]['foto_dengan_ppe'] = $item->foto_dengan_ppe ? asset($item->foto_dengan_ppe) :null;
            $data[$k]['foto_banner'] = $item->foto_banner ? asset($item->foto_banner) : null;
            $data[$k]['foto_wah'] = $item->foto_wah ? asset($item->foto_wah) : null;
            $data[$k]['foto_elektrikal'] = $item->foto_elektrikal ? asset($item->foto_elektrikal) : null;
            $data[$k]['foto_first_aid'] = $item->foto_first_aid ? asset($item->foto_first_aid) : null;
        }

        return response()->json(['message'=>'success','data'=>$data], 200);    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $data = PpeCheck::where('employee_id',\Auth::user()->employee->id)->orderBy('id','DESC')->first();
        if(!$data) $data = new PpeCheck(); 

        $data->employee_id = isset(\Auth::user()->employee->id) ? \Auth::user()->employee->id : '';
        $data->is_submit = 1;
        $data->ppe_lengkap = $request->ppe_lengkap;
        $data->ppe_alasan_tidak_lengkap = $request->ppe_alasan_tidak_lengkap;
        $data->banner_lengkap = $request->banner_lengkap;
        $data->banner_alasan_tidak_lengkap = $request->banner_alasan_tidak_lengkap;
        $data->sertifikasi_alasan_tidak_lengkap = $request->sertifikasi_alasan_tidak_lengkap;
        $data->save();

        if($request->foto_dengan_ppe){
            $name = "foto_dengan_ppe.".$request->foto_dengan_ppe->extension();
            $request->foto_dengan_ppe->storeAs("public/ppe-check/{$data->id}", $name);
            $data->foto_dengan_ppe = "storage/ppe-check/{$data->id}/{$name}";
        }

        if($request->foto_banner){
            $name = "foto_banner.".$request->foto_banner->extension();
            $request->foto_banner->storeAs("public/ppe-check/{$data->id}", $name);
            $data->foto_banner = "storage/ppe-check/{$data->id}/{$name}";
        }
        
        if(isset($request->foto_wah)) {
            $name = "foto_wah.".$request->foto_wah->extension();
            $request->foto_wah->storeAs("public/ppe-check/{$data->id}", $name);
            $data->foto_wah = "storage/ppe-check/{$data->id}/{$name}";
        }

        if(isset($request->foto_elektrikal)) {
            $name = "foto_elektrikal.".$request->foto_wah->extension();
            $request->foto_elektrikal->storeAs("public/ppe-check/{$data->id}", $name);
            $data->foto_elektrikal = "storage/ppe-check/{$data->id}/{$name}";
        }

        if(isset($request->foto_first_aid)) {
            $name = "foto_first_aid.".$request->foto_first_aid->extension();
            $request->foto_first_aid->storeAs("public/ppe-check/{$data->id}", $name);
            $data->foto_first_aid = "storage/ppe-check/{$data->id}/{$name}";
        }

        $data->save();

        // find notification
        $notification = Notification::whereDate('created_at',date('Y-m-d'))->where(['employee_id'=>\Auth::user()->employee->id,'type'=>2])->first();
        if($notification){
            $notification->is_read = 1;
            $notification->save();
        }      

        return response()->json(['message'=>'submited'], 200);
    }

    public function upload(Request $r)
    {
        $find = PpeCheck::where('employee_id',\Auth::user()->employee->id)->whereDate('created_at',date('Y-m-d'))->first();
        if(!$find){
            $find = new PpeCheck();
            $find->employee_id = \Auth::user()->employee->id;
            $find->save();
        }   

        if($r->type==1){
            if($r->file){
                $name = "foto_dengan_ppe.".$r->foto_dengan_ppe->extension();
                $r->foto_dengan_ppe->storeAs("public/ppe-check/{$find->id}", $name);
                $find->foto_dengan_ppe = "storage/ppe-check/{$find->id}/{$name}";
                $find->save();
            }
        }

        if($r->type==2){
            if($r->file){
                $name = "foto_banner.".$r->foto_banner->extension();
                $r->foto_banner->storeAs("public/ppe-check/{$find->id}", $name);
                $find->foto_banner = "storage/ppe-check/{$find->id}/{$name}";
                $find->save();
            }
        }

        if($request->foto_wah) {
            $name = "foto_wah.".$request->foto_wah->extension();
            $request->foto_wah->storeAs("public/ppe-check/{$data->id}", $name);
            $data->foto_wah = "storage/ppe-check/{$data->id}/{$name}";
        }

        if($request->foto_elektrikal) {
            $name = "foto_elektrikal.".$request->foto_wah->extension();
            $request->foto_elektrikal->storeAs("public/ppe-check/{$data->id}", $name);
            $data->foto_elektrikal = "storage/ppe-check/{$data->id}/{$name}";
        }

        if($request->foto_first_aid) {
            $name = "foto_first_aid.".$request->foto_first_aid->extension();
            $request->foto_first_aid->storeAs("public/ppe-check/{$data->id}", $name);
            $data->foto_first_aid = "storage/ppe-check/{$data->id}/{$name}";
        }
        return response()->json(['message'=>'submited'], 200);
    }

    public function getDetail()
    {
        $data = PpeCheck::where('employee_id',\Auth::user()->employee->id)->whereDate('created_at',date('Y-m-d'))->first();
        $data->foto_dengan_ppe = $data->foto_dengan_ppe ? asset($data->foto_dengan_ppe) : '';
        $data->foto_banner = $data->foto_banner ? asset($data->foto_banner) : '';
        $data->foto_wah = $data->foto_wah ? asset($data->foto_wah) : '';
        $data->foto_elektrikal = $data->foto_elektrikal ? asset($data->foto_elektrikal) : '';
        $data->foto_first_aid = $data->foto_first_aid ? asset($data->foto_first_aid) : '';

        return response()->json(['message'=>'success','data'=>$data], 200);
    }
}
