<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PoTrackingNonms;
use App\Models\PoTrackingNonmsBast;
use App\Models\PoTrackingNonmsBoq;
use App\Models\WorkFlowManagement;
use App\Models\Notification;

class WorkOrderController extends Controller
{
    public function notification()
    {
        \LogActivity::add('[apps] Word Order Notification');

        $general_notification = Notification::where(['employee_id'=>\Auth::user()->employee->id,'is_read'=>0])->whereIn('type',[1,2,3])->whereDate('created_at',date('Y-m-d'))->get()->count();
        $general_notification += Notification::where(['employee_id'=>\Auth::user()->employee->id,'is_read'=>0])->whereNotIn('type',[1,2,3])->get()->count();

        $open_work_order = PoTrackingNonms::where('field_team_id',\Auth::user()->employee->id)->whereNull('bast_status')->where('is_accept_field_team',0)->count();
        $accepted_work_order = PoTrackingNonms::where('field_team_id',\Auth::user()->employee->id)->where('is_accept_field_team',1)
        ->where(function($table){
            $table->where('bast_status',1)->orWhere('bast_status',3)->orWhereNull('bast_status');
        })->count();
        $closed_work_order = PoTrackingNonms::where('field_team_id',\Auth::user()->employee->id)->where('bast_status',2)->count();
        $wfm = 0;//WorkFlowManagement::where('field_team_id',\Auth::user()->employee->id)->where('employee_id',\Auth::user()->employee->id)->where('status','<>',2)->get()->count();
        
        return response()->json(['message'=>'success','general_notification'=>$general_notification,'open_work_order'=>$open_work_order,'accepted_work_order'=>$accepted_work_order,'closed_work_order'=>$closed_work_order,'wfm'=>$wfm?$wfm:0], 200);
    }

    public function wo_accept(Request $r)
    {
        $data = PoTrackingNonms::find($r->id);
        $data->is_accept_field_team = 1 ;
        $data->save();

        return response()->json(['message'=>'submited'], 200);
    }

    public function workOrderGeneral()
    {
        $data = [];
        $key = 0;

        foreach(Notification::where(['employee_id'=>\Auth::user()->employee->id,'is_read'=>0])->whereIn('type',[1,2,3])->whereDate('created_at',date('Y-m-d'))->get() as $k => $item){
            $data[$key] = $item;
            $data[$key]['date'] = date('d-M-Y',strtotime($item->created_at));
            $key++;
        }
        
        foreach(Notification::where(['employee_id'=>\Auth::user()->employee->id,'is_read'=>0])->whereNotIn('type',[1,2,3])->get() as $k => $item){
            $data[$key] = $item;
            $data[$key]['date'] = date('d-M-Y',strtotime($item->created_at));
            $key++;
        }

        \LogActivity::add('[apps] Word Order General');
        
        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function workOrderOpen()
    {
        $data = [];
        $param = PoTrackingNonms::whereNull('bast_status')->where('is_accept_field_team',0)->where('field_team_id',\Auth::user()->employee->id)->orderBy('id','DESC')->get();
        
        foreach($param as $k => $item){
            $data[$k] = $item;
            $data[$k]['is_accept_field_team'] = $item->is_accept_field_team ? $item->is_accept_field_team : 0; 
            $data[$k]['region'] = $item->region?$item->region:'-';
            $data[$k]['type_doc_name'] = $item->type_doc==1?'STP' : 'Ericson';
            $data[$k]['site_id'] = $item->site_id?$item->site_id : '-';
            $data[$k]['site_name'] = $item->site_name?$item->site_name : '-';
            $data[$k]['region'] = $item->region?$item->region : '-';
            $data[$k]['no_tt'] = $item->no_tt?$item->no_tt : '-';
            $data[$k]['material'] = '-';
            $data[$k]['scoope_of_works'] = $item->scoope_of_works ? $item->scoope_of_works : '-';
            $material = '';
            foreach(PoTrackingNonmsBoq::where('id_po_nonms_master',$item->id)->get() as $wo){
                $material .= $wo->item_description."\n";
            }
        }
        
        \LogActivity::add('[apps] Word Order Open');

        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function workOrderAccepted()
    {
        $data = [];
        $param = PoTrackingNonms::where('is_accept_field_team',1)
                                ->where('field_team_id',\Auth::user()->employee->id)
                                ->where(function($table){
                                    $table->where('bast_status',1)->orWhere('bast_status',3)->orWhereNull('bast_status');
                                })->get();
        
        foreach($param as $k => $item){
            $data[$k] = $item;
            $data[$k]['scoope_of_works'] = $item->scoope_of_works ? $item->scoope_of_works : '-';
            $data[$k]['type_doc_name'] = $item->type_doc==1?'STP' : 'Ericson';
            $data[$k]['material'] = '-';
            $data[$k]['is_accept_field_team'] = $item->is_accept_field_team ? $item->is_accept_field_team : 0; 
            $data[$k]['region'] = $item->region?$item->region:'-';
            $data[$k]['type_doc_name'] = $item->type_doc==1?'STP' : 'Ericson';
            $data[$k]['site_id'] = $item->site_id?$item->site_id : '-';
            $data[$k]['site_name'] = $item->site_name?$item->site_name : '-';
            $data[$k]['region'] = $item->site_name?$item->region : '-';
            $data[$k]['no_tt'] = $item->no_tt?$item->no_tt : '-';
            $data[$k]['material'] = '-';
            $material = '';

            switch($item->bast_status){
                case '':
                    $data[$k]['bast_status']='Open';
                    break;
                case 1:
                    $data[$k]['bast_status']='Submitted';
                    break;
                case 2:
                    $data[$k]['bast_status']='Complete';
                    break;
                case 3:
                    $data[$k]['bast_status']='Revision';
                    break;
                default:
                    $data[$k]['bast_status']='-';
                    break;
            }

            foreach(PoTrackingNonmsBoq::where('id_po_nonms_master',$item->id)->get() as $wo){
                $material .= $wo->item_description."\n";
            }
        }

        \LogActivity::add('[apps] Word Order Accepted');

        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function workOrderClosed()
    {
        $data = [];
        $param = PoTrackingNonms::where('bast_status',2)->where('field_team_id',\Auth::user()->employee->id)->get();
        
        foreach($param as $k => $item){
            $data[$k] = $item;
            $data[$k]['region'] = $item->region?$item->region:'-';
            $data[$k]['type_doc_name'] = $item->type_doc==1?'STP' : 'Ericson';
            $data[$k]['material'] = '-';
            $data[$k]['po_status_mobile'] = '-';
            $material = '';

            switch($item->po_status_mobile){
                case 1:
                    $data[$k]['po_status_mobile']='Partial';
                    break;
                case 2:
                    $data[$k]['po_status_mobile']='Complete';
                    break;
                default:
                    $data[$k]['po_status_mobile']='-';
                    break;
            }

            switch($item->bast_status){
                case '':
                    $data[$k]['bast_status']='Open';
                    break;
                case 1:
                    $data[$k]['bast_status']='Submitted';
                    break;
                case 2:
                    $data[$k]['bast_status']='Complete';
                    break;
                case 3:
                    $data[$k]['bast_status']='Revision';
                    break;
                default:
                    $data[$k]['bast_status']='-';
                    break;
            }
            foreach(PoTrackingNonmsBoq::where('id_po_nonms_master',$item->id)->get() as $wo){
                $material .= $wo->item_description."\n";
            }
        }

        \LogActivity::add('[apps] Word Order Closed');

        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function data()
    {   
        $data = [];
        $param = PoTrackingNonms::get();
        
        foreach($param as $k => $item){
            $data[$k] = $item;
            $data[$k]['region'] = $item->region?$item->region:'-';
            $data[$k]['type_doc_name'] = $item->type_doc==1?'STP' : 'Ericson';
        }

        return response()->json(['message'=>'success','data'=>$data], 200);
    }

    public function uploadBastImage(Request $r)
    {
        $data = PoTrackingNonms::find($r->id);
        $bast = new PoTrackingNonmsBast();
        $bast->po_tracking_nonms_id = $data->id;
        $bast->description = $r->description;
        $bast->save();
        if($r->file){
            $this->validate($r, ['file' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048']); // validate image
            
            $name = $bast->id .".".$r->file->extension();
            $r->file->storeAs("public/po-tracking-nonms/{$data->id}", $name);
            $bast->image = "storage/po-tracking-nonms/{$data->id}/{$name}";
            $bast->save();
        }

        return response()->json(['message'=>'submited'], 200);
    }

    public function submitBast(Request $r)
    {
        $data = PoTrackingNonms::find($r->id);
        
        $count = PoTrackingNonmsBoq::where('id_po_nonms_master',$r->id)->whereNull('po_tracking_nonms_po_id')->get()->count();
        
        /**
         * 1 = Partial
         * 2 = Complete
         */
        $data->po_status_mobile = $count > 0 ? 1 : 2; 
        $data->bast_number  = str_pad((PoTrackingNonms::count()+1),6, '0', STR_PAD_LEFT)."/".date('m').'/HUP/'.date('Y');
        $data->status = 8;
        $data->bast_status = 1;
        $data->save();

        return response()->json(['message'=>'submited'], 200);
    }

    public function getBast($id)
    {
        $data = [];
        $temp = PoTrackingNonmsBast::where(['po_tracking_nonms_id'=>$id])->get();
        foreach($temp as $k => $item){
            $data[$k] = $item;
            $data[$k]['image'] =  asset($item->image);
        }
        return response()->json(['message'=>'success','data'=>$data], 200);
    }
}