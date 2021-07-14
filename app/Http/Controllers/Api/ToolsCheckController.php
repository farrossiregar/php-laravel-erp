<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Toolbox;
use App\Models\ToolsCheck;
use App\Models\ToolsCheckUpload;
use Illuminate\Http\Request;
 
class ToolsCheckController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeStolen(Request $r)
    {
        $find  = ToolsCheckUpload::find($r->id);
        if($find){  
            $find->status = 1; // Status Stolen
            $find->note = $r->note;
            $find->save();
            $find->image = asset($find->image);
        }
        
        return response()->json(['message'=>'submited','data'=>$find], 200);
    }

    public function get_toolbox()
    {
        $data = Toolbox::get();
        
        return response()->json(['message'=>'success','data'=>$data], 200);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function storeBroken(Request $r)
    {
        $find  = ToolsCheckUpload::find($r->id);
        if($find){  
            $find->status = 2; // Status Broken
            $find->note = $r->note;
            $find->save();
        }

        return response()->json(['message'=>'submited','data'=>$find], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $find = ToolsCheck::where(['employee_id'=>\Auth::user()->employee->id,'tahun'=>date('Y'),'bulan'=>date('m')])->first();
        $find = ToolsCheck::where(['employee_id'=>\Auth::user()->employee->id])->whereDate('created_at',date('Y-m-d'))->first();
        if(!$find){
            $find = new ToolsCheck();
            $find->tahun = date('Y');
            $find->bulan = date('m');
            $find->employee_id = \Auth::user()->employee->id;
            $find->save();
        }
        
        $find->is_submit  = 1;
        $find->save();

        return response()->json(['message'=>'submited'], 200);
    }

    public function storeImage(Request $request)
    {
        // $find = ToolsCheck::where(['employee_id'=>\Auth::user()->employee->id,'tahun'=>date('Y'),'bulan'=>date('m')])->first();
        $find = ToolsCheck::where(['employee_id'=>\Auth::user()->employee->id])->whereDate('created_at',date('Y-m-d'))->first();
        if(!$find){
            $find = new ToolsCheck();
            $find->tahun = date('Y');
            $find->bulan = date('m');
            $find->employee_id = \Auth::user()->employee->id;
            $find->save();
        }

        $upload = new ToolsCheckUpload();
        $upload->tools_check_id = $find->id;
        $upload->tools_check_item_id = $request->tools_check_item_id;
        $upload->lat = $request->lat;
        $upload->lng = $request->lng;
        $upload->note = $request->note;
        $upload->save();

        if($request->image) {
            $name = $upload->id.".".$request->image->extension();
            $request->image->storeAs("public/tools-check/{$find->id}/{$request->tools_check_item_id}", $name);
            $upload->image = "storage/tools-check/{$find->id}/{$request->tools_check_item_id}/{$name}";
        }
        
        $upload->save();
        
        return response()->json(['message'=>'submited'], 200);
    }

    public function getImage($id)
    {
        $data = [];
        // $find = ToolsCheck::where(['employee_id'=>\Auth::user()->employee->id,'tahun'=>date('Y'),'bulan'=>date('m')])->first();
        $find = ToolsCheck::where(['employee_id'=>\Auth::user()->employee->id])->whereDate('created_at',date('Y-m-d'))->first();
        if($find){  
            $param = ToolsCheckUpload::where(['tools_check_id'=>$find->id,'tools_check_item_id'=>$id])->get();
            foreach($param as $k => $item){
                $data[$k] = $item;
                $data[$k]['image'] = $item->image ? asset($item->image) : null ;
            }
        }

        return response()->json(['message'=>'submited','data'=>$data], 200);
    }

    public function getImageByParent(Request $r)
    {   
        $data = [];
        $param = ToolsCheckUpload::where(['tools_check_id'=>$r->tools_check_id,'tools_check_item_id'=>$r->tools_check_item_id])->get();
        foreach($param as $k => $item){
            $data[$k] = $item;
            $data[$k]['image'] = $item->image ? asset($item->image) : null;
        }

        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function deleteImage(Request $r)
    {
        ToolsCheckUpload::find($r->id)->delete();

        return response()->json(['message'=>'success'], 200);
    }

    public function data(Request $request)
    {
        $data = ToolsCheckUpload::orderBy('id','DESC')->where(['tools_check_item_id'=>$request->tools_check_item_id])->get();

        if($request->year and $request->month){
            $find = ToolsCheck::where(['tahun'=>$request->year,'bulan'=>$request->month])->first();
            if($find) 
            $data = ToolsCheckUpload::orderBy('id','DESC')->where(['tools_check_item_id'=>$request->tools_check_item_id,'tools_check_id' => $find->id])->get();
        }

        $result = [];
        foreach($data as $k => $item){
            $result[$k] = $item;
            $result[$k]['image'] = asset($item->image);
        }
        
        return response()->json(['message'=>'submited','data'=>$data], 200);
    }

    public function history()
    {
        $param = ToolsCheck::orderBy('id','DESC')->get();
        $data = [];
        foreach($param as $k => $item){
            $data[$k] = $item;
            $data[$k]['bulan'] = date('F', mktime(0, 0, 0, $item->bulan, 10));;
        }

        return response()->json(['message'=>'success','data'=>$data], 200);
    }
}