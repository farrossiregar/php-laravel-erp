<?php

namespace App\Http\Livewire\PoTracking;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PoTrackingReimbursement;
use App\Mail\PoTrackingReimbursementUpload;
use Auth;
use PDF;

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
            'file'=>'required|mimes:xls,xlsx,csv|max:51200' // 50MB maksimal
        ]);
        
        $users = Auth::user();

        $path = $this->file->getRealPath();
       
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $data = $reader->load($path);
        $sheetData = $data->getActiveSheet()->toArray();

        $datamaster = new \App\Models\PoTrackingReimbursementMaster();
        $datamaster->created_at = date('Y-m-d H:i:s');
        $datamaster->updated_at = date('Y-m-d H:i:s');
        $datamaster->save();

        if(count($sheetData) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;
            foreach($sheetData as $key => $i){
                if($key<1) continue; // skip header
                
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                $data = new \App\Models\PoTrackingReimbursement();
                if($i[0]!="") 
                
                $data->id_po_tracking_master                   = $datamaster->id;
                $data->po_reimbursement_id                     = $i[0];
                $data->change_history                          = $i[1];
                $data->rep_office                              = $i[2];
                $data->customer                                = $i[3];
                $data->project_name                            = $i[4];
                $data->project_code                            = $i[5];
                $data->site_id                                 = $i[6];
                $data->sub_contract_no                         = $i[7];
                $data->pr_no                                   = $i[8];
                $data->sales_contract_no                       = $i[9];
                $data->po_status                               = $i[10];
                $data->po_no                                   = $i[11];
                $data->site_code                               = $i[12];
                $data->site_name                               = $i[13];
                $data->po_line_no                              = $i[14];
                $data->shipment_no                             = $i[15];
                $data->item_description                        = $i[16];
                $data->requested_qty                           = $i[17];
                $data->unit                                    = $i[18];
                $data->unit_price                              = $i[19];
                $data->center_area                             = $i[20];
                $data->start_date                              = @date_format(date_create($i[22]), 'Y-m-d');
                $data->end_date                                = @date_format(date_create($i[22]), 'Y-m-d');
                $data->billed_qty                              = $i[23];
                $data->due_qty                                 = $i[24];
                $data->qty_cancel                              = $i[25];
                $data->item_code                               = $i[26];
                $data->version_no                              = $i[27];
                $data->line_amount                             = $i[28];
                $data->bidding_area                            = $i[29];
                $data->tax_rate                                = $i[30];
                $data->currency                                = $i[31];
                $data->ship_to                                 = $i[32];
                $data->engineering_code                        = $i[33];
                $data->engineering_name                        = $i[34];
                
                $data->payment_terms                           = $i[35];
                $data->category                                = @$i[36];
                $data->payment_method                          = @$i[37];
                $data->product_category                        = @$i[38];
                $data->bill_to                                 = @$i[39];
                $data->subproject_code                         = @$i[40];
                $data->expire_date                             = @date_format(date_create($i[41]), 'Y-m-d');
                $data->publish_date                            = @date_format(date_create($i[42]), 'Y-m-d H:i:s');
                $data->acceptance_date                         = @date_format(date_create($i[43]), 'Y-m-d');
                $data->ff_buyer                                = @$i[44];
                $data->note_to_receiver                        = @$i[45];
                $data->fob_lookup_code                         = @$i[46];
                $data->created_at                              = date('Y-m-d H:i:s');
                $data->updated_at                              = date('Y-m-d H:i:s');
                $data->save();
                

                $total_success++;
            }


            $pono = [];
            // $data_podetail = [];
            foreach(PoTrackingReimbursement::select('po_no')
                                                        ->where('id_po_tracking_master', $datamaster->id)
                                                        ->groupBy('po_no')
                                                        ->get() as $key => $item){
                                                            $pono[$key] = $item->po_no;
                                $data_podetail = PoTrackingReimbursement::
                                                                            where('id_po_tracking_master', $datamaster->id)
                                                                            ->where('po_no', $pono[$key])
                                                                            ->get();

                                $data_podetailmaster = PoTrackingReimbursement::
                                                                            where('id_po_tracking_master', $datamaster->id)
                                                                            ->first();
                                                                            // dd($pono[$key]);


                                $pdf = \App::make('dompdf.wrapper');
                                $pdf->loadView('livewire.po-tracking.generate-esar',['po_tracking'=>$data_podetail, 'potracking_master'=>$data_podetailmaster ]);
                                $pdf->stream();
                                $output = $pdf->output();
                                \Storage::put("po_tracking\autogeneratedesar\po-tracking-reimbursement{$pono[$key]}.pdf",$output);
                                //$destinationPath = public_path('po_tracking\autogeneratedesar\po-tracking-reimbursement'.$pono[$key]);
                                
                                //file_put_contents( $destinationPath .'.pdf', $output);
            }

            $regional = [];
            $dataparam = 'Test PO Reimbursement';
            foreach(PoTrackingReimbursement::select('bidding_area','project_name','project_code')
                                                        ->where('id_po_tracking_master', $datamaster->id)
                                                        ->groupBy('bidding_area')
                                                        ->get() as $key => $item){
                                                            $regional[$key] = $item->bidding_area;

                                                            $message = "*Dear Operation Region ".$regional[$key]."*\n\n";
                                                            $message = "*PO Tracking Reimbursement Region ".$regional[$key]." Uploaded on ".date('d M Y H:i:s')."*\n\n";
                                                            send_wa(['phone'=>'087775365856','message'=>$message]);   

                                                            \Mail::to('ramdoni@stalavista.com')->send(new PoTrackingReimbursementUpload($item));
            }
           
            session()->flash('message-success',"Upload success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            
            return redirect()->route('po-tracking.index');   
        }
    }
}
