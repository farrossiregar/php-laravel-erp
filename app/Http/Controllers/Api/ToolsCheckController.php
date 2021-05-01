<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $find = ToolsCheck::where(['employee_id'=>\Auth::user()->employee->id,'tahun'=>date('Y'),'bulan'=>date('m')])->first();
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
        $upload->save();

        if($request->image) {
            $name = $upload->id.".".$request->image->extension();
            $request->image->storeAs("public/tools-check/{$find->id}", $name);
            $upload->image = "storage/tools-check/{$find->id}/{$name}";
        }
        
        $upload->save();
        
        $data = ToolsCheckUpload::orderBy('id','DESC')->where(['tools_check_item_id'=>$request->tools_check_item_id])->get();
        $result = [];
        foreach($data as $k => $item){
            $result[$k] = $item;
            $result[$k]['image'] = asset($item->image);
        }
        
        return response()->json(['message'=>'submited','data'=>$data], 200);
    }

    public function data(Request $request)
    {
        $data = ToolsCheckUpload::orderBy('id','DESC')->where(['tools_check_item_id'=>$request->tools_check_item_id])->get();
        $result = [];
        foreach($data as $k => $item){
            $result[$k] = $item;
            $result[$k]['image'] = asset($item->image);
        }
        
        return response()->json(['message'=>'submited','data'=>$data], 200);
    }
}
