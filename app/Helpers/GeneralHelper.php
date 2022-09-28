<?php

use Illuminate\Support\Facades\DB;


function HumanSize($Bytes)
{
  $Type=array("", "kilo", "mega", "giga", "tera", "peta", "exa", "zetta", "yotta");
  $Index=0;
  while($Bytes>=1024)
  {
    $Bytes/=1024;
    $Index++;
  }
  return("".$Bytes." ".$Type[$Index]."bytes");
}

function count_notif($type){
    if($type=='po-tracking-ms.index'){
        $is_e2e = check_access('is-e2e');
        $is_service_manager = check_access('is-service-manager');
        $is_finance = check_access('is-finance');
        $num = 0;
        if($is_e2e){
            $num += \App\Models\PoMsEricsson::where('status_',2)->orWhere('status_',3)->count();
            $num += \App\Models\PoMsHuawei::where('status_',2)->orWhere('status_',3)->count();
        }
        if($is_service_manager){
            $num += \App\Models\PoMsEricsson::where('status_',1)->count();
            $num += \App\Models\PoMsHuawei::where('status_',1)->count();
        }
        if($is_finance){
            $num += \App\Models\PoMsEricsson::where('status_',4)->count();
            $num += \App\Models\PoMsHuawei::where('status_',4)->count();
        }
        return $num;
    }

    if($type=='po-tracking-nonms.index'){
        $client_project_ids = Arr::pluck(\App\Models\EmployeeProject::select('client_project_id')->where(['employee_id'=>\Auth::user()->employee->id])->get()->toArray(),'client_project_id');

        $coordinators = get_user_from_access('is-coordinator',$client_project_ids,\Auth::user()->employee->region_id);
        $field_teams = get_user_from_access('is-field-team',$client_project_ids,\Auth::user()->employee->region_id);
        $is_service_manager = check_access('is-service-manager');
        $is_coordinator = check_access('is-coordinator');
        $is_finance = check_access('is-finance');
        
        $num = 0;
        if($is_service_manager) $num += \App\Models\PoTrackingNonms::where('status',0)->orWhereNull('status')->count();
        if($is_finance) $num += \App\Models\PoTrackingNonms::where('status',1)->orWhere('status',2)->count();
        
        return $num;
    }

}

/**
* Converts an integer into the alphabet base (A-Z).
*
* @param int $n This is the number to convert.
* @return string The converted number.
* @author Theriault
* 
*/
function num2alpha($n) {
    $r = '';
    for ($i = 1; $n >= 0 && $i < 10; $i++) {
        $r = chr(0x41 + ($n % pow(26, $i) / pow(26, $i - 1))) . $r;
        $n -= pow(26, $i);
    }
    return $r;
}

function calculate_aging($date)
{
    $date = date('Y-m-d',strtotime($date ." -1 days"));
    $start_date = new \DateTime($date);
    $today = new \DateTime("today");
    if ($start_date > $today) { 
        return 0;
    }

    $date1=date_create($date);
    $date2=date_create();
    $diff=date_diff($date1,$date2);
    return $diff->format("%R%a days");
}

function get_setting_sow($item)
{
    $data = \App\Models\PreventiveMaintenanceSow::where(
            ['region_id'=>$item->region_id,
            'sub_region_id'=>$item->sub_region_id,
            'pm_type'=>$item->pm_type,
            'site_type'=>$item->site_type,
            'bulan'=>strlen(date('m'))==1?'0'.date('m') : date('m'),
            'tahun'=>date('Y')])->first();
    
    return $data ? $data->sow : 0;
}

function setInterval($f, $milliseconds)
{
    $seconds=(int)$milliseconds/1000;
    while(true)
    {
        $f();
        sleep($seconds);
    }
}

function table_history($table='',$key="",$type="",$value=""){
    if($table){
        $data = new \App\Models\TableHistory();
        $data->table = $table;
        $data->key_id = $key;
        $data->value = $value;
        $data->type = $type;
        $data->save();
    }
}

function marital_status($status){
    foreach(config('vars.marital_status') as $k => $i) 
        if($k==$status) return $i;

    return '';
}

function push_notification_android($device_id,$title,$message,$type,$vibrate=0,$sound=0){
    /*api_key available in:
    Firebase Console -> Project Settings -> CLOUD MESSAGING -> Server key*/    
    $api_key = 'AAAA4LyBl1Y:APA91bFLf-2oSt9e2GMNIsoOiBBHH3tER5vk45_f6xwZESuZzl1s_6F0ZLkDO8QVOlzPHWto-kkCLl0dctRpjvt30IN7AMvxrGV-keRxn8TBG-DyROqzvGSN8YQN1l7qVVBW9T4BN2_g';
   
    //API URL of FCM
    $url = 'https://fcm.googleapis.com/fcm/send';
    $fields = array (
        'registration_ids' => array (
                $device_id
        ),
        'notification' => array (
            "title" => $title,
            "body" => $message,
            "sound"=> "default"
        ),
        'data' => array(
            'type' => $type ,
            'vibrate'	=> $vibrate,
	        'sound'		=> $sound,
            'volume' => 5
        )
    );

    //header includes Content type and api key
    $headers = array(
        'Content-Type:application/json',
        'Authorization:key='.$api_key
    );
                
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
    $result = curl_exec($ch);
    if ($result === FALSE) {
        die('FCM Send Error: ' . curl_error($ch));
    }
    curl_close($ch);
    
    return $result;
}

function check_yes_no($value)
{
    return $value==1?'YES':'NO';
}

/**
 * Replace first string
 */
function str_replace_first($search, $replace, $subject) {
    $pos = strpos($subject, $search);
    if ($pos !== false) {
        return substr_replace($subject, $replace, $pos, strlen($search));
    }
    return $subject;
}

function replace_phone_id($phone)
{
    $number = str_replace_first('0','62', $phone);
    $number = str_replace('-', '', $number);

    return $number;
}

function send_wa($param)
{
    $message = strip_tags($param['message']) ."\n\n_Do not reply to this message, as it is generated by system._";
    $message = $message;
    $number = str_replace_first('0','62', $param['phone']);
    $number = str_replace('-', '', $number);
    $number = str_replace('+', '', $number);
    
    $curl = curl_init(); 
    $token = "HioVXgQTselUx6alx9GmtfcJgpySCDnH3FCZh2tARb0C7vRtQon5shmOwx0KmGl1";
    // $token = "uhZrgyuk3EbEMCVXHrILrxBIO1bV6FSj4BYMWniXBGeybCtnyLDPmm2rwzHBnBxT";
    $data = [
        'phone' => $number,
        'message' => $message,
    ];

    curl_setopt($curl, CURLOPT_HTTPHEADER,
        array(
            "Authorization: ". $token,
        )
    );
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
    curl_setopt($curl, CURLOPT_URL, "https://solo.wablas.com/api/send-message");
    curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    $result = curl_exec($curl);
    curl_close($curl);

    return $result;
}

function get_user_from_access($link,$client_project_id=null,$region_id=null)
{
    $cek = \App\Models\UserAccessModule::select('users.*',\DB::raw('employees.id as employee_id'),\DB::raw('employees.name as employee_name'),'employees.device_token',\DB::raw('employees.email as email_employee'))
            ->where('modules_items.link',$link)
            ->join('modules_items','modules_items.id','=','user_access_modules.module_id')
            ->join('modules','modules.id','=','modules_items.module_id')
            ->join('users','users.user_access_id','=','user_access_modules.user_access_id')
            ->join('employees','employees.user_id','=','users.id')
            ->groupBy('users.id');

    if($region_id) $cek->where('employees.region_id',$region_id);
    if($client_project_id){
        $cek->leftJoin('employee_projects','employee_projects.employee_id','=','employees.id');
        if(is_array($client_project_id))
            $cek->whereIn('employee_projects.client_project_id',$client_project_id);
        else    
            $cek->where('employee_projects.client_project_id',$client_project_id);
    }
        
    
    return $cek->get();
}

function check_access($link,$type=1){
    
    $cek = \App\Models\UserAccessModule::select('modules.*')
            ->where('user_access_modules.user_access_id',\Auth::user()->user_access_id)
            ->where('modules_items.link',$link)
            ->join('modules_items','modules_items.id','=','user_access_modules.module_id')
            ->join('modules','modules.id','=','modules_items.module_id')
            ->groupBy('modules.id')
            ->first();
    if($cek) return $cek?true:false;
}


function check_access_data($link, $reg = ''){
    $reg_id = \App\Models\Region::where('region_code', $reg)->orWhere('region',$reg)->first();
    if($reg_id){
        $cek = DB::table('user_access_modules as user_access_modules')
                    ->where('modules_items.link',$link)
                    ->where('employees.region_id',$reg_id->id)
                    ->join('modules_items','modules_items.id','=','user_access_modules.module_id')
                    ->join('modules','modules.id','=','modules_items.module_id')
                    ->join('employees','employees.user_access_id','=','user_access_modules.user_access_id')
                    ->get();
    }else{
        $cek = DB::table('user_access_modules as user_access_modules')
                    ->select('*', \DB::raw('employees.id as employee_id'))
                    ->where('modules_items.link',$link)
                    ->join('modules_items','modules_items.id','=','user_access_modules.module_id')
                    ->join('modules','modules.id','=','modules_items.module_id')
                    ->join('employees','employees.user_access_id','=','user_access_modules.user_access_id')
                    ->get();
    }
    
    if($cek){
        return $cek;
    }else{
        return false;
    }
}


function check_list_user_acc($link, $project){
    $cek = DB::table('user_access_modules as user_access_modules')
                    ->where('modules_items.link',$link)
                    ->where('employees.project',$project)
                    ->join('modules_items','modules_items.id','=','user_access_modules.module_id')
                    ->join('modules','modules.id','=','modules_items.module_id')
                    ->join('employees','employees.user_access_id','=','user_access_modules.user_access_id')
                    ->get();
    
    if($cek){
        return $cek;
    }else{
        return false;
    }
}

function get_project_company($project, $company){
    // $data = \App\Models\ProjectEpl::select('name')->where('id', $project)->where('type', $company)->first();
    $data = \App\Models\ClientProject::select('name')->where('id', $project)->where('company_id', $company)->first();
    if($data){
        return $data->name;
    }else{
        return false;
    }
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

function format_idr($number,$decimal=0)
{
    return $number ? number_format($number,$decimal,',','.') : 0;
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


function check_sitelist_temp($id_site_master){
    $data = \App\Models\SiteListTrackingTemp::where('id_site_master', $id_site_master)->get();
    return $data;
}


function get_username_byid($user_id){
    $data = \App\Models\User::select('name')->where('id', $user_id)->first();
    $dd = json_encode($data);
    return $dd;
    
}

function get_extra_budget($id){
    $data             = \App\Models\PoTrackingNonms::where('id', $id)->first();  
        
    if($data->type_doc == '1'){
        $data_detail = \App\Models\PoTrackingNonmsStp::where('id_po_nonms_master', $id);
    }else{
        $data_detail = \App\Models\PoTrackingNonmsBoq::where('id_po_nonms_master', $id);
    }   

    $total_before     = $data_detail->select(DB::raw("SUM(price) as price"))    
                                    ->groupBy('id_po_nonms_master')  
                                    ->get();  

    $total_after      = $data_detail->select(DB::raw("SUM(input_price) as input_price"))    
                                    ->groupBy('id_po_nonms_master')  
                                    ->get();  


    $total_before = json_decode($total_before);
    $total_before = @$total_before[0]->price;
    $total_after = json_decode($total_after);
    $total_after = @$total_after[0]->input_price;

    $extra_budget = $total_before - $total_after;

    return $extra_budget;

}


function get_total_price($id){
    $data             = \App\Models\PoTrackingNonms::where('id', $id)->first();  
        
    if($data->type_doc == '1'){
        $data_detail = \App\Models\PoTrackingNonmsStp::where('id_po_nonms_master', $id);
    }else{
        $data_detail = \App\Models\PoTrackingNonmsBoq::where('id_po_nonms_master', $id);
    }   

    $total_after      = $data_detail->select(DB::raw("SUM(input_price) as input_price"))    
                                    ->groupBy('id_po_nonms_master')  
                                    ->get();  


    $total_after = json_decode($total_after);
    $total_after = @$total_after[0]->input_price;

    return $total_after;

}

function get_total_actual_price($id){
    $data             = \App\Models\PoTrackingNonms::where('id', $id)->first();  
        
    if($data->type_doc == '1'){
        $data_detail = \App\Models\PoTrackingNonmsStp::where('id_po_nonms_master', $id);
    }else{
        $data_detail = \App\Models\PoTrackingNonmsBoq::where('id_po_nonms_master', $id);
    }   

    $total_before     = $data_detail
                                    //->select(DB::raw("SUM(price) as price"),DB::raw("SUM(qty) as total_qty"))    
                                    // ->groupBy('id_po_nonms_master')  
                                    ->get();  
    
    $total_ = 0;
    foreach($total_before as $item){
        $total_ += $item->price * $item->qty;
    }
    $total_before = json_decode($total_before);
    // $total_before = @$total_before[0]->price*$total_before[0]->total_qty;

    return $total_;

}

function get_position($id){
    $pos = \App\Models\UserAccess::where('id', $id)->first();
    return $pos->name;
}

function get_data_flmengineer($id, $type){
    $data = \App\Models\Employee::where('id', $id)->first();
    return $data->$type;
}

function get_detail_supplier($id){
    $data = \App\Models\VendorManagement::where('id', $id)->first();
    return $data;
}