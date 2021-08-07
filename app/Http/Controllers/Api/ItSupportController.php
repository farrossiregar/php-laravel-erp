<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TroubleTicket;
use App\Models\TroubleTicketFile;
use Illuminate\Http\Request;
use TroubleTicketHelper;

class ItSupportController extends Controller
{
    public function data()
    {
        $is_pic = false;
        if(check_access('trouble-ticket.pickup')){
            $data = TroubleTicket::where('employee_pic_id',\Auth::user()->employee->id)->orWhere('status',1);
            $is_pic = true;   
        }else
            $data = TroubleTicket::where('employee_id',\Auth::user()->employee->id);

        $param = [];
        foreach($data->orderBy('id','DESC')->paginate(10) as $k => $item){
            $param[$k]['id'] = $item->id;
            $param[$k]['description'] = $item->description;
            $param[$k]['created_at'] = date('d-M-Y H:i',strtotime($item->created_at));
            $param[$k]['start_date'] = date('d-M-Y H:i',strtotime($item->start_date));
            $param[$k]['end_date'] = date('d-M-Y H:i',strtotime($item->end_date));
            $param[$k]['status'] = $item->status;
            $param[$k]['approve_date'] = date('d-M-Y H:i',strtotime($item->approve_date));
            $param[$k]['trouble_ticket_number'] = $item->trouble_ticket_number;
            $param[$k]['pic_name'] = isset($item->pic->name) ? $item->pic->name : '';
            $param[$k]['category'] = $item->trouble_ticket_category;
            $param[$k]['trouble_ticket_category_others'] = $item->trouble_ticket_category_others;
            $param[$k]['file'] = $item->file ? asset($item->file) : null;
            $param[$k]['note'] = $item->note;
            $param[$k]['is_pic'] = $is_pic == true ? 1 : 0;
            
            $param[$k]['is_pick'] = 0;
            if($is_pic and $item->status ==1){
                $param[$k]['is_pick'] = 1;
            }

            $param[$k]['is_solved'] = 0;
            if($is_pic and $item->status ==2){
                $param[$k]['is_solved'] = 1;
            }

            $param[$k]['is_closed'] = 0;
            if(!$is_pic and $item->status ==3){
                $param[$k]['is_closed'] = 1;
            }   
        }
        
        return response()->json(['message'=>'success','data'=>$param], 200);
    }

    public function set_pickup(Request $r)
    {
        $data = TroubleTicket::find($r->id);
        $data->status = 2;
        $data->employee_pic_id = \Auth::user()->employee->id;
        $data->trouble_ticket_number = TroubleTicketHelper::generate_number();
        $data->start_date = date('Y-m-d H:i:s');
        $data->save();
        
        $description = "Pick-up By : ". \Auth::user()->employee->name ."\n";

        if(isset($data->employee->device_token)) 
            push_notification_android($data->employee->device_token,"TT Number #".$data->trouble_ticket_number ." Pick-up" ,$description,6);

        return response()->json(['message'=>'success'], 200);
    }

    public function set_solved(Request $r)
    {
        $data = TroubleTicket::find($r->id);
        $data->status = 3;
        $data->end_date = date('Y-m-d H:i:s');
        $data->note = $r->note;
        $data->save();
        
        $description = "Resolved By : ". \Auth::user()->employee->name ."\n";

        if(isset($data->employee->device_token)) 
            push_notification_android($data->employee->device_token,"TT Number #".$data->trouble_ticket_number ." Resolved" ,$description,6);

        return response()->json(['message'=>'success'], 200);
    }

    public function set_closed(Request $r)
    {
        $data = TroubleTicket::find($r->id);
        $data->status = 4;
        $data->approve_date = date('Y-m-d H:i:s');
        $data->save();
        
        $description = "Closed By : ". \Auth::user()->employee->name ."\n";

        if(isset($data->pic->device_token)) 
            push_notification_android($data->pic->device_token,"TT Number #".$data->trouble_ticket_number ." Closed" ,$description,6);

        return response()->json(['message'=>'success'], 200);
    }

    public function store(Request $r)
    {
        $data = new TroubleTicket();
        $data->employee_id = \Auth::user()->employee->id;
        $data->description = $r->description;
        $data->trouble_ticket_category = $r->problem_category;
        $data->trouble_ticket_category_others = $r->problem_category_others;
        $data->lokasi = $r->lokasi;
        $data->status = 1;
        $data->save();
        
        if(isset($r->image)) {
            $name = "image.".$r->image->extension();
            $r->image->storeAs("public/trouble-ticket/{$data->id}", $name);
            $data->file = "storage/trouble-ticket/{$data->id}/{$name}";
            $data->save();
        }

        // find IT Support
        $it = get_user_from_access('trouble-ticket.pickup');
        foreach($it as $user){
            push_notification_android($user->device_token,"Trouble Ticket #".\Auth::user()->employee->name ." - ". $r->problem_category ,$r->description,6);
        }

        return response()->json(['message'=>'submited'], 200);
   }
}