<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Toolbox;
use App\Models\ToolboxLaptop;
use App\Models\ToolboxCheck;
use App\Models\ToolboxCheckLaptop;
use App\Models\ToolsCheck;
use App\Models\ToolsCheckUpload;
use Illuminate\Http\Request;
 
class ToolsCheckController extends Controller
{
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
        $laptopType = ToolboxLaptop::get();
        
        return response()->json(['message'=>'success','data'=>$data,'laptop_type'=> $laptopType], 200);
    }

    public function get_toolbox_check(ToolsCheck $id)
    {
        $data = ToolboxCheck::where(['tools_check_id'=>$id->id])->get();
        $toolbox = [];
        foreach($data as $k => $item){
            $toolbox[$k]['id'] = $item->id;
            $toolbox[$k]['name'] = isset($item->toolbox->name) ? $item->toolbox->name : '';
            $toolbox[$k]['qty'] = $item->qty;
            $toolbox[$k]['status'] = $item->status;
            $toolbox[$k]['image'] = $item->image ? asset($item->image) : null;
            $toolbox[$k]['note'] = $item->note;
        }

        $laptopType = ToolboxLaptop::get();
        return response()->json(['message'=>'success','data'=>$toolbox,'laptop_type'=> $laptopType], 200);
    }

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
        $find = ToolsCheck::where(['employee_id'=>\Auth::user()->employee->id])->whereDate('created_at',date('Y-m-d'))->first();
        if(!$find){
            $find = new ToolsCheck();
            $find->tahun = date('Y');
            $find->bulan = date('m');
            $find->employee_id = \Auth::user()->employee->id;
            $find->save();
        }
        
        $toolBox = Toolbox::get();
        foreach($toolBox as $item){
            $new = new ToolboxCheck();

            $qty = "qty_{$item->id}";
            if(isset($request->$qty)) $new->qty = $request->$qty;
            
            $note = "note_{$item->id}";
            if(isset($request->$note)) $new->note = $request->$note;

            $condition = "condition_{$item->id}";
            if(isset($request->$condition)) $new->status = $request->$condition;

            $img = "image_{$item->id}";
            if(isset($request->$img)){
                $name = $item->id.".".$request->$img->extension();
                $request->$img->storeAs("public/tools-check/{$find->id}/{$item->id}", $name);
                $new->image = "storage/tools-check/{$find->id}/{$item->id}/{$name}";
            }
            
            $new->tools_check_id = $find->id;
            $new->toolbox_id = $item->id;
            $new->save();
        }

        $laptop = new ToolboxCheckLaptop();
        $laptop->tools_check_id = $find->id;
        $laptop->status = $request->laptop_condition;
        if(isset($request->laptop_image)){
            $name = "laptop.".$request->laptop_image->extension();
            $request->laptop_image->storeAs("public/tools-check/{$find->id}", $name);
            $laptop->image = "storage/tools-check/{$find->id}/{$name}";
        }
        $laptop->note = $request->laptop_condition_note;
        $laptop->serial_number = $request->laptop_serial_number;
        $laptop->qty = $request->laptop_qty;
        $laptop->toolbox_laptop_id = $request->laptop_type;
        $laptop->save();

        $find->is_submit  = 1;
        $find->save();

        return response()->json(['message'=>'submited'], 200);
    }

    public function storeImage(Request $request)
    {
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