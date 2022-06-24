<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PreventiveMaintenance;
use App\Models\PreventiveMaintenancePunchlist;

class PunchlistController extends Controller
{
    public function history()
    {
        $data = [];
        $param = PreventiveMaintenance::where('employee_id',\Auth::user()->employee->id)
                                        ->where(['is_punch_list'=>1,'site_type'=>'TMG'])
                                        ->orderBy('updated_at','DESC');
        
        if(isset($_GET['keyword']) and $_GET['keyword']!="") $param->where(function($table){
                                            foreach(\Illuminate\Support\Facades\Schema::getColumnListing('preventive_maintenance') as $column){
                                                if(in_array($column,['id','employee_id','admin_project_id'])) continue;
                                                $table->orWhere($column,'LIKE',"%{$this->keyword}%");
                                            }
                                        });
        if(isset($_GET['status']) and $_GET['status']!=""){
            if($_GET['status']=='Open') $param->where('status_',0);
            if($_GET['status']=='In Progress') $param->where('status',1);
            if($_GET['status']=='Submitted') $param->where('status',2);
        }

        foreach($param->get() as $k => $item){
            $data[$k]['id'] = $item->id;
            $data[$k]['status'] = $item->status_punch_list_tmg;
            $data[$k]['user_signum'] = isset($item->employee->employee_code) ? $item->employee->employee_code : '';
            $data[$k]['user_name'] = \Auth::user()->employee->name;
            $data[$k]['resource_id'] = '-';
            $data[$k]['vendor_code'] = '-';
            $data[$k]['user_circle'] = isset($item->site->region->region) ? $item->site->region->region : '-';;
            $data[$k]['site_id'] = isset($item->site_id) ? $item->site_id : '-';
            $data[$k]['site_name'] = isset($item->site_name) ? $item->site_name : '-';
            $data[$k]['site'] = isset($item->site_name) ? $item->site_name : '-';
            $data[$k]['site_lat_lng'] = isset($item->site->lat) ? $item->site->lat .'/'. $item->site->long : '-';
            $data[$k]['user_lat_lng'] = isset($item->employee->lat) ? $item->employee->lat .'/'. $item->employee->lng : '-';
            $data[$k]['site_distance'] = '-';
            $data[$k]['approver_signum'] = '-';
            $data[$k]['date'] = '-';
            $data[$k]['work_order_number'] = $item->work_order_number; 
            // $data[$k]['site'] = isset($item->site->name) ? $item->site->name : '';
            $data[$k]['region'] = isset($item->site->region->region) ? $item->site->region->region : '';
            $data[$k]['project'] = isset($item->project->name) ? $item->project->name : '';
            $data[$k]['description'] = $item->description;
            $data[$k]['due_date'] = date('d F Y',strtotime($item->due_date));
            $data[$k]['start_date'] = date('d/M/Y',strtotime($item->start_date));
            $data[$k]['end_date'] = date('d/M/Y',strtotime($item->end_date)); 
            $data[$k]['site_owner'] = isset($item->site->site_owner) ? $item->site->site_owner : '-';
            $data[$k]['site_category'] = isset($item->site_category) ? $item->site_category : '-';
            $data[$k]['site_type'] = isset($item->site_type) ? $item->site_type : '-';
            $data[$k]['pm_type'] = isset($item->pm_type) ? $item->pm_type : '-';
            $data[$k]['region'] = isset($item->region->region) ? $item->region->region : '-';
            $data[$k]['sub_region'] = isset($item->sub_region->name) ? $item->sub_region->name : '-';
            $data[$k]['cluster'] = isset($item->cluster) ? $item->cluster : '-';
            $data[$k]['sub_cluster'] = isset($item->sub_cluster) ? $item->sub_cluster : '-';
            $data[$k]['admin_project'] = isset($item->admin->name) ? $item->admin->name : '-';
            $data[$k]['assign_date'] = '-';
            
            if($item->status_punch_list_tmg==0) $data[$k]['assign_date'] = date('d-M-Y',strtotime($item->updated_at));
            if($item->status_punch_list_tmg==1) $data[$k]['assign_date'] = date('d-M-Y',strtotime($item->updated_at));
            if($item->status_punch_list_tmg==2) $data[$k]['assign_date'] = date('d-M-Y',strtotime($item->updated_at));
        }

        \LogActivity::add('[apps] PM Data');

        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function uploadImage(Request $r)
    {
        $data = PreventiveMaintenance::find($r->id);

        if($data){
            $upload = new PreventiveMaintenancePunchlist();
            $upload->preventive_maintenance_id = $data->id;
            $upload->save();

            if($r->file){
                $this->validate($r, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']); // validate image
                
                $name = $upload->id .".".$r->file->extension();
                $r->file->storeAs("public/preventive-maintenance/{$data->id}/punch-list", $name);
                $upload->file = "storage/preventive-maintenance/{$data->id}/punch-list/{$name}";
                $upload->note = $r->description;
                $upload->type = $r->type;
                $upload->save();
            }
        }

        return response()->json(['message'=>'submited'], 200);
    }

    public function getImage($id)
    {
        $data = [];
        $temp = PreventiveMaintenancePunchlist::where(['preventive_maintenance_id'=>$id,'type'=>$_GET['type']])->get();
        foreach($temp as $k => $item){
            $data[$k] = $item;
            $data[$k]['image'] = $item->file ? asset($item->file) : null;
        }
        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function submit(Request $r)
    {
        $data = PreventiveMaintenance::find($r->id);
        
        if($r->type==1) {
            $data->status_punch_list_tmg = 1;
            $data->boq_evidence_created = date('Y-m-d');
            \LogActivity::add('[apps] Punch List Submit Evidence');
        }

        if($r->type==2) {
            $data->status_punch_list_tmg = 3;
            $data->rec_feat_created = date('Y-m-d');
            \LogActivity::add('[apps] Punch List Submit Rectification');
        }

        $data->save();

        return response()->json(['message'=>'submited','data'=>$data], 200);
    }

    public function setPickup(Request $r)
    {
        $data = PreventiveMaintenance::find($r->id);
        $data->status = 1;
        $data->start_date = date('Y-m-d');
        $data->save();
        
        if(isset($data->admin->device_token)) {
            $message = "Pick-up By : ". \Auth::user()->employee->name ."\n";
            $message .= "Site ID : {$data->site_id}\nSite Name : {$data->site_name}\n";
            $message .= "Description : {$data->description}\n";
            $message .= "Site Category : {$data->site_category}\n";
            $message .= "Site Type : {$data->site_type}\n";
            $message .= "PM Type : {$data->pm_type}\n";
            $message .= "Region : ".(isset($data->region->region) ? $data->region->region : '')."\n";
            $message .= "PIC : ".(isset($data->employee->name) ? $data->employee->name : '')."\n";
            push_notification_android($data->admin->device_token,"Preventive Maintenance Pick-up" ,$message,7);
        }
        
        \LogActivity::add('[apps] PM Pickup');

        return response()->json(['message'=>'success'], 200);
    }

    public function setSolved(Request $r)
    {
        $data = PreventiveMaintenance::find($r->id);
        $data->status = 2;
        $data->end_date = date('Y-m-d');
        $data->note = $r->note;
        $data->save();
        
        if(isset($data->admin->device_token)) {
            $message = "Pick-up By : ". \Auth::user()->employee->name ."\n";
            $message .= "Site ID : {$data->site_id}\nSite Name : {$data->site_name}\n";
            $message .= "Description : {$data->description}\n";
            $message .= "Site Category : {$data->site_category}\n";
            $message .= "Site Type : {$data->site_type}\n";
            $message .= "PM Type : {$data->pm_type}\n";
            $message .= "Region : ".(isset($data->region->region) ? $data->region->region : '')."\n";
            $message .= "PIC : ".(isset($data->employee->name) ? $data->employee->name : '')."\n";
            push_notification_android($data->admin->device_token,"Preventive Maintenance Resolved" ,$message,7);
        }
        
        \LogActivity::add('[apps] PM Solved');

        return response()->json(['message'=>'success'], 200);
    }

}