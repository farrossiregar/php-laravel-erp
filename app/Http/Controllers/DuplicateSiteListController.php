<?php

namespace App\Http\Controllers;

use App\Models\SiteListTrackingTemp;
use App\Models\SiteListTrackingDetail;
use Illuminate\Http\Request;
use Auth;

class DuplicateSiteListController extends Controller
{
    public function deleteoriginal(Request $request){
        $no_po = $request->no_po;
        

        $ori = SiteListTrackingDetail::where('no_po', $no_po)->get();
        $temp = SiteListTrackingTemp::where('no_po', $no_po)->get();
        $inserttoori = new SiteListTrackingDetail();

        
        $inserttoori->id_site_master                         = $ori[0]->id_site_master;
        $inserttoori->collection                             = $temp[0]->collection;
        $inserttoori->no_po                                  = $temp[0]->no_po;
        $inserttoori->item_number                            = $temp[0]->item_number;
        $inserttoori->date_po_release                        = $temp[0]->date_po_release;
        $inserttoori->pic_rpm                                = $temp[0]->pic_rpm;
        $inserttoori->pic_sm                                 = $temp[0]->pic_sm;
        $inserttoori->type                                   = $temp[0]->type;
        $inserttoori->item_description                       = $temp[0]->item_description;
        $inserttoori->period                                 = $temp[0]->period;
        $inserttoori->region                                 = $temp[0]->region;
        $inserttoori->region1                                = $temp[0]->region1;
        $inserttoori->project                                = $temp[0]->project;
        $inserttoori->penalty                                = $temp[0]->penalty;
        $inserttoori->last_status                            = $temp[0]->last_status;
        $inserttoori->remark                                 = $temp[0]->remark;
        $inserttoori->qty_po                                 = $temp[0]->qty_po;
        $inserttoori->actual_qty                             = $temp[0]->actual_qty;
        $inserttoori->no_bast                                = $temp[0]->no_bast;
        $inserttoori->date_bast_approval                     = $temp[0]->date_bast_approval;
        $inserttoori->date_bast_approval_by_system           = $temp[0]->date_bast_approval_by_system;
        $inserttoori->date_gr_req                            = $temp[0]->date_gr_req;
        $inserttoori->no_gr                                  = $temp[0]->no_gr;
        $inserttoori->date_gr_share                          = $temp[0]->date_gr_share;
        $inserttoori->no_invoice                             = $temp[0]->no_invoice;
        $inserttoori->inv_date                               = $temp[0]->inv_date;
        $inserttoori->payment_date                           = $temp[0]->payment_date;
        $inserttoori->created_at                             = $temp[0]->created_at;
        $inserttoori->updated_at                             = $temp[0]->updated_at;
        SiteListTrackingDetail::where('no_po', $no_po)->delete();
        $inserttoori->save();
        
        SiteListTrackingTemp::where('no_po', $no_po)->delete();
        
        
        return response()->json('berhasil delete');
        
    }

    public function deleteduplicate(Request $request){
        $no_po = $request->no_po;
        SiteListTrackingTemp::where('no_po', $no_po)->delete();
        return response()->json('berhasil');
        
    }


    public function cekdataTemp(Request $request){
        $no_po = $request->no_po;
        $data = SiteListTrackingTemp::where('no_po', $no_po)->get();
        return response()->json($data);
        
    }

    public function cekdataOri(Request $request){
        $no_po = $request->no_po;
        $data = SiteListTrackingDetail::where('no_po', $no_po)->get();
        return response()->json($data);
        
    }
}
