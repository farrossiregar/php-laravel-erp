<?php

function check_access($link){
    $cek = \App\Models\UserAccessModule::select('modules.*')
            ->where('user_access_modules.user_access_id',\Auth::user()->user_access_id)->where('modules_items.link',$link)
            ->join('modules_items','modules_items.id','=','user_access_modules.module_id')
            ->join('modules','modules.id','=','modules_items.module_id')
            ->groupBy('modules.id')
            ->first();
    if($cek) return $cek?true:false;
}

function check_access_controller($link){
    $cek = \App\Models\UserAccessModule::select('modules.*')
            ->where('user_access_modules.user_access_id',\Auth::user()->user_access_id)->where('modules_items.link',$link)
            ->join('modules_items','modules_items.id','=','user_access_modules.module_id')
            ->join('modules','modules.id','=','modules_items.module_id')
            ->groupBy('modules.id')
            ->first();
    if($cek){
        return true;
    }else{
        return false;
    }
}

function get_menu($user_access_id){
    $parent = \App\Models\UserAccessModule::select('modules.*')
                                            ->where('user_access_modules.user_access_id',$user_access_id)
                                            ->join('modules_items','modules_items.id','=','user_access_modules.module_id')
                                            ->join('modules','modules.id','=','modules_items.module_id')
                                            ->groupBy('modules.id')
                                            ->get();
    $menu = [];
    foreach($parent as $key => $item){
        $menu[$key]['id'] = $item->id;
        $menu[$key]['name'] = $item->name;
        $menu[$key]['prefix_link'] = $item->prefix_link;
        // find_sub menu
        $sub_menu = \App\Models\UserAccessModule::select('modules_items.*')
                                            ->where('user_access_modules.user_access_id',$user_access_id)->where('modules_items.type',1)->where('modules_items.module_id',$item->id)
                                            ->join('modules_items','modules_items.id','=','user_access_modules.module_id')
                                            ->join('modules','modules.id','=','modules_items.module_id')
                                            ->get();
        foreach($sub_menu as $key_sub => $sub){
            $menu[$key]['sub_menu'][$key_sub] = $sub;
            $menu[$key]['prefix_all'][$key_sub] = $sub->prefix_link;
        }
    }
    return $menu;
}
function format_idr($number)
{
    return number_format($number,0,0,'.');
}

function get_setting($key)
{
    $setting = \App\Models\Settings::where('key',$key)->first();

    if($setting)
    {
        if($key=='logo' || $key=='favicon' ){
            return  asset("storage/{$setting->value}");
        }

        return $setting->value;
    }
}
function update_setting($key,$value)
{
    $setting = \App\Models\Settings::where('key',$key)->first();
    if($setting){
        $setting->value = $value;
        $setting->save();
    }else{
        $setting = new \App\Models\Settings();
        $setting->key = $key;
        $setting->value = $value;
        $setting->save();
    }
}


function check_duplicate_sitelist($no){
    $cek = \App\Models\SiteListTrackingTemp::where('no_po', $no)->get();
    // return response()->json($data[0]->id);
    if($cek->count() > 0){
        return 'ada';
    }else{
        return 'g';
    }
}