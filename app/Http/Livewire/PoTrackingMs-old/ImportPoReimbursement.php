<?php

namespace App\Http\Livewire\POTrackingMs;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;

class ImportPoReimbursement extends Component
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
            'file'=>'required|mimes:xls,xlsx|max:51200' // 50MB maksimal
        ]);
        
        $users = Auth::user();

        $path = $this->file->getRealPath();
       
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $data = $reader->load($path);
        $sheetData = $data->getActiveSheet()->toArray();

        if(count($sheetData) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;
            foreach($sheetData as $key => $i){
                if($key<1) continue; // skip header
                
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                $data = new \App\Models\PoTrackingReimbursement();
                if($i[0]!="") 
                
                $data->po_reimbursement_id                     = $i[1];
                $data->change_history                          = $i[2];
                $data->rep_office                              = $i[3];
                $data->customer                                = $i[4];
                $data->project_name                            = $i[5];
                $data->project_code                            = $i[6];
                $data->site_id                                 = $i[7];
                $data->sub_contract_no                         = $i[8];
                $data->pr_no                                   = $i[9];
                $data->sales_contract_no                       = $i[10];
                $data->po_status                               = $i[11];
                $data->po_no                                   = $i[12];
                $data->site_code                               = $i[13];
                $data->site_name                               = $i[14];
                $data->po_line_no                              = $i[15];
                $data->shipment_no                             = $i[16];
                $data->item_description                        = $i[17];
                $data->requested_qty                           = $i[18];
                $data->unit                                    = $i[19];
                $data->unit_price                              = $i[20];
                $data->center_area                             = $i[21];
                $data->start_date                              = date_format(date_create($i[22]), 'Y-m-d');
                $data->end_date                                = date_format(date_create($i[23]), 'Y-m-d');
                $data->billed_qty                              = $i[24];
                $data->due_qty                                 = $i[25];
                $data->qty_cancel                              = $i[26];
                $data->item_code                               = $i[27];
                $data->version_no                              = $i[28];
                $data->line_amount                             = $i[29];
                $data->bidding_area                            = $i[30];
                $data->tax_rate                                = $i[31];
                $data->currency                                = $i[32];
                $data->ship_to                                 = $i[33];
                $data->engineering_code                        = $i[34];
                $data->engineering_name                        = $i[35];
                $data->payment_terms                           = $i[36];
                $data->category                                = $i[37];
                $data->payment_method                          = $i[38];
                $data->product_category                        = $i[39];
                $data->bill_to                                 = $i[40];
                $data->subproject_code                         = $i[41];
                $data->expire_date                             = date_format(date_create($i[42]), 'Y-m-d');
                $data->publish_date                            = date_format(date_create($i[43]), 'Y-m-d H:i:s');
                $data->acceptance_date                         = date_format(date_create($i[44]), 'Y-m-d');
                $data->ff_buyer                                = $i[45];
                $data->note_to_receiver                        = $i[46];
                $data->fob_lookup_code                         = $i[47];
                $data->created_at                              = date('Y-m-d H:i:s');
                $data->updated_at                              = date('Y-m-d H:i:s');
                

                $total_success++;
            }
            session()->flash('message-success',"Upload success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            
            return redirect()->route('site-tracking.index');   
        }
    }
}
