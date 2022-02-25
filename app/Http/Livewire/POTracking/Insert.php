<?php

namespace App\Http\Livewire\POTracking;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PoTrackingReimbursement;
use App\Models\UserEpl;
use App\Models\PoTrackingReimbursementMaster;
use App\Mail\PoTrackingReimbursementUpload;
use App\Models\PoTrackingReimbursementAccdocupload;
use App\Models\PoTrackingReimbursementEsarupload;
use App\Models\PoTrackingReimbursementBastupload;
use PDF;
use DB;

class Insert extends Component
{
    use WithFileUploads;
    public $file;
    public function render()
    {
        return view('livewire.po-tracking.insert');
    }
    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xlsx|max:51200' // 50MB maksimal
        ]);

        $path = $this->file->getRealPath();
       
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        $data = $reader->load($path);
        $sheetData = $data->getActiveSheet()->toArray();

        $datamaster = new PoTrackingReimbursementMaster();
        $datamaster->save();

        if(count($sheetData) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;
            foreach($sheetData as $key => $i){
                if($key<1) continue; // skip header
                
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                $datapo = new PoTrackingReimbursement();
                if($i[0]=="" || $i[2]=="") continue;
                
                $datapo->cluster = $i[0];
                $datapo->sub_cluster = $i[1];
                $datapo->site_id = $i[2];
                $datapo->site_name = $i[3];
                $datapo->tt_number = $i[4];
                if($i[5]) $datapo->start_date = date('Y-m-d',strtotime($i[5]));
                if($i[6]) $datapo->end_date = date('Y-m-d',strtotime($i[6]));
                $datapo->duration = $i[7];
                $datapo->capacity_kva = $i[8];
                $datapo->std_fuel_consump = $i[9];
                $datapo->fuel_consumption_used = $i[10];
                if($i[11]) $datapo->date_refuel = date('Y-m-d',strtotime($i[11]));
                $datapo->fuel_refuel = $i[12];
                $datapo->bbm_type = $i[13];
                $datapo->article_code = $i[14];
                $datapo->price_liter = $i[15];
                $datapo->total_price = $i[16];
                $datapo->acceptable_amount = $i[17];
                $datapo->eid_check = $i[18];
                $datapo->id_po_tracking_master                   = $datamaster->id;
                $datapo->save();

                // $datapo->po_reimbursement_id                     = $i[0];
                // $datapo->change_history                          = $i[1];
                // $datapo->rep_office                              = $i[2];
                // $datapo->customer                                = $i[3];
                // $datapo->project_name                            = $i[4];
                // $datapo->project_code                            = $i[5];
                // $datapo->site_id                                 = $i[6];
                // $datapo->sub_contract_no                         = $i[7];
                // $datapo->pr_no                                   = $i[8];
                // $datapo->sales_contract_no                       = $i[9];
                // $datapo->po_status                               = $i[10];
                // $datapo->po_no                                   = $i[11];
                // $datapo->site_code                               = $i[12];
                // $datapo->site_name                               = $i[13];
                // $datapo->po_line_no                              = $i[14];
                // $datapo->shipment_no                             = $i[15];
                // $datapo->item_description                        = $i[16];
                // $datapo->requested_qty                           = $i[17];
                // $datapo->unit                                    = $i[18];
                // $datapo->unit_price                              = $i[19];
                // $datapo->center_area                             = $i[20];
                // $datapo->start_date                              = @date_format(date_create($i[22]), 'Y-m-d');
                // $datapo->end_date                                = @date_format(date_create($i[22]), 'Y-m-d');
                // $datapo->billed_qty                              = $i[23];
                // $datapo->due_qty                                 = $i[24];
                // $datapo->qty_cancel                              = $i[25];
                // $datapo->item_code                               = $i[26];
                // $datapo->version_no                              = $i[27];
                // $datapo->line_amount                             = $i[28];
                // $datapo->bidding_area                            = $i[29];
                // $datapo->tax_rate                                = $i[30];
                // $datapo->currency                                = $i[31];
                // $datapo->ship_to                                 = $i[32];
                // $datapo->engineering_code                        = $i[33];
                // $datapo->engineering_name                        = $i[34];
                // $datapo->payment_terms                           = $i[35];
                // $datapo->category                                = @$i[36];
                // $datapo->payment_method                          = @$i[37];
                // $datapo->product_category                        = @$i[38];
                // $datapo->bill_to                                 = @$i[39];
                // $datapo->subproject_code                         = @$i[40];
                // $datapo->expire_date                             = @date_format(date_create($i[41]), 'Y-m-d');
                // $datapo->publish_date                            = @date_format(date_create($i[42]), 'Y-m-d H:i:s');
                // $datapo->acceptance_date                         = @date_format(date_create($i[43]), 'Y-m-d');
                // $datapo->ff_buyer                                = @$i[44];
                // $datapo->note_to_receiver                        = @$i[45];
                // $datapo->fob_lookup_code                         = @$i[46];
                // $datapo->save();
                
                $total_success++;
            }

            $pono = [];
            $data_podetail = [];
            foreach(PoTrackingReimbursement::select('po_no')->where('id_po_tracking_master', $datamaster->id)->groupBy('po_no')->get() as $key => $item){
                $pono[$key] = $item->po_no;
                // $data_podetail = PoTrackingReimbursement::
                //                                             where('id_po_tracking_master', $datamaster->id)
                //                                             ->where('po_no', $pono[$key])
                //                                             ->get();

                $data_podetail = PoTrackingReimbursement::
                                                            where('id_po_tracking_master', $datamaster->id)
                                                            ->first();

                $pdf = \App::make('dompdf.wrapper');
                // $pdf->loadView('livewire.po-tracking.generate-esar',['po_tracking'=>$data_podetail,'potracking_master'=>$data_podetailmaster]);
                $pdf->loadView('livewire.po-tracking.generate-esar',['po_tracking'=>$data_podetail]);
                $pdf->stream();

                $output = $pdf->output();
                $filename = 'po-reimbursement'.$pono[$key];
                
                $destinationPath = public_path('\storage\po_tracking\AutoGeneratedEsar'.$filename);
                \Storage::put($destinationPath .'.pdf',$output);

                $insertesarupload                               = new PoTrackingReimbursementEsarupload();
                $insertesarupload->id_po_tracking_master        = $datamaster->id;
                $insertesarupload->po_no                        = $pono[$key];
                $insertesarupload->autogenerated_esar_filename  = $filename.'.pdf';
                $insertesarupload->po_tracking_reimbursement_id  = $data_podetail->id;
                $insertesarupload->save();

                $insertbastupload                               = new PoTrackingReimbursementBastupload();
                $insertbastupload->id_po_tracking_master        = $datamaster->id;
                $insertbastupload->po_no                        = $pono[$key];
                $insertbastupload->region                       = "";
                $insertbastupload->bast_filename                = "";
                $insertbastupload->bast_uploader_userid         = "";
                $insertbastupload->bast_date                    = "";
                $insertbastupload->po_tracking_reimbursement_id = $data_podetail->id;
                $insertbastupload->save();

                $insertaccdocupload                               = new PoTrackingReimbursementAccdocupload();
                $insertaccdocupload->id_po_tracking_master        = $datamaster->id;
                $insertaccdocupload->po_no                        = $pono[$key];
                $insertaccdocupload->po_tracking_reimbursement_id  = $data_podetail->id;
                $insertaccdocupload->save();
            }

            $regional = [];
            $regional_code = [];
            // $dataparam = 'Test PO Reimbursement';  
            //$dbpmt = 'pmt';      
            $dbpmt = env('DB_DATABASE');      
            //$dbepl = 'epl';      
            $dbepl = env('DB_DATABASE_EPL_PMT');      
            $potrackingarea = DB::table($dbpmt.'.po_tracking_reimbursement as po_tracking_reimbursement')
                                    ->join($dbepl.'.region as region', 'region.region_code', '=', 'po_tracking_reimbursement.bidding_area'); 
            $potrackingareaget = $potrackingarea->select('region.id', 'region.region_code','po_tracking_reimbursement.project_code','po_tracking_reimbursement.project_name')
                                                    ->where('po_tracking_reimbursement.id_po_tracking_master', $datamaster->id)
                                                    ->groupBy('po_tracking_reimbursement.bidding_area')
                                                    ->get();

            // $potrackingareaget = PoTrackingReimbursement::where('id_po_tracking_master',$datamaster->id)->groupBy('bidding_area')->get();

            foreach($potrackingareaget as $key => $item){
                $regional[$key] = $item->id;
                $regional_code[$key] = $item->region_code;
                // $regional_code[$key] = $item->region->region_code;
                // $regional[$key] = $item->bidding_area;

                //$epluser = UserEpl::select('name', 'phone', 'email')->where('region_cluster_id', $regional[$key])->get();
                $epluser = UserEpl::select('name', 'phone', 'email')->where('region_cluster_id', $regional[$key])->get();
            
                $nameuser = [];
                $emailuser = [];
                $phoneuser = [];
                
                foreach($epluser as $no => $itemuser){
                    $nameuser[$no] = $itemuser->name;
                    $emailuser[$no] = $itemuser->email;
                    $phoneuser[$no] = $itemuser->phone;
                    $message = "*Dear Operation Region ".$regional_code[$key]." - ".$nameuser[$no]."*\n\n";
                    $message .= "*PO Tracking Reimbursement Region ".$regional_code[$key]." Uploaded on ".date('d M Y H:i:s')."*\n\n";
                    send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);   

                    // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
                }    
            }

            session()->flash('message-success',"Upload success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            
            return redirect()->route('po-tracking.index');   
        }
    }
}
