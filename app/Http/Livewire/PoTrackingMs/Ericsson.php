<?php

namespace App\Http\Livewire\PoTrackingMs;

use Livewire\Component;
use Livewire\WithFileUploads;

class Ericsson extends Component
{
    use WithFileUploads;
    public $file;

    protected $rules = [
        'file' => 'required',
    ];

    public function render()
    {
        return view('livewire.po-tracking-ms.ericsson');
    }

    public function save()
    {
        dd('import ericsson');
        $this->validate([
            'file'=>'required|mimes:xls,xlsx|max:51200' // 50MB maksimal
        ]);

        $path           = $this->file->getRealPath();
       
        $reader         = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $data           = $reader->load($path);
        $sheetDatas     = $data->getActiveSheet()->toArray();
        $sheetData      = $data->getActiveSheet();


        // $site_exp       = explode(" / ", substr($sheetData->getCell('F3')->getValue(), 2));

        // $site_id        = $site_exp[0];
        // $site_name      = $site_exp[1];

        // $datamaster                 = new \App\Models\PoMsEricsson();
        // $datamaster->po_no          = '';
        // $datamaster->region         = substr($sheetData->getCell('F5')->getValue(), 2);
        // $datamaster->site_id        = $site_id;
        // $datamaster->site_name      = $site_name;
        // $datamaster->no_tt          = substr($sheetData->getCell('F6')->getValue(), 2);
        // $datamaster->status         = '';
        // $datamaster->type_doc       = '1'; //STP
        // $datamaster->pekerjaan      = substr($sheetData->getCell('F7')->getValue(), 2);
        // $datamaster->created_at     = date('Y-m-d H:i:s');
        // $datamaster->updated_at     = date('Y-m-d H:i:s');
        // $datamaster->save();

        
        // $datamaster_latest = \App\Models\PoTrackingNonms::select('id')->orderBy('id', 'DESC')->first();
        if(count($sheetDatas) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;
            foreach($sheetDatas as $key => $i){
                
                // dd($datamaster_latest->id);
                if($key<11) continue; // skip header
                if($key>12) break;
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                $data                          = new \App\Models\PoMsEricsson();
                if($i[0]!="") 
                
                $data->po_no                            = $i[0];
                $data->item_number                      = $i[1];
                $data->po_line_item                     = $i[2];
                $data->date_po_released                 = $i[3];
                $data->type                             = $i[4];
                $data->item_description                 = $i[5];
                $data->period                           = $i[6];
                $data->region                           = $i[7];
                $data->last_status                      = $i[8];
                $data->no_bast                          = $i[9];
                $data->qty_po                           = $i[10];
                $data->qty_po_penagihan_60              = $i[11];
                $data->gap_100_60                       = $i[12];
                $data->actual_qty                       = $i[13];
                $data->pm_w                             = $i[14];
                $data->pm_ny                            = $i[15];
                $data->site_po_deduction                = $i[16];
                $data->price_unit                       = $i[17];
                $data->po_amount_actual                 = $i[18];
                $data->po_amount_after_deduction        = $i[19];
                $data->penalty                          = $i[20];
                $data->amount_penalty                   = $i[21];
                $data->no_cn                            = $i[22];
                $data->date_submit_cn                   = $i[23];

                $data->date_bast_approval               = $i[24];
                $data->date_bast_approval_system        = $i[25];
                $data->date_gr_req                      = $i[26];
                $data->no_gr                            = $i[27];
                $data->date_gr_share                    = $i[28];
                $data->invoice_amount                   = $i[29];
                $data->no_inv                           = $i[30];
                $data->inv_date                         = $i[31];

                $data->payment_date                     = $i[32];

                $data->date_bast_approval2              = $i[33];
                $data->date_bast_approval_system2       = $i[34];
                $data->date_gr_req2                     = $i[35];
                $data->no_gr2                           = $i[36];
                $data->date_gr_share2                   = $i[37];
                $data->invoice_amount2                  = $i[38];
                $data->no_inv2                          = $i[39];
                $data->inv_date2                        = $i[40];

                $data->qty_site_hold                    = $i[41];
                $data->type2                            = $i[42];
                $data->amount_hold_payment              = $i[43];
                $data->closing_site                     = $i[44];
                $data->no_bast2                         = $i[45];
                $data->claim                            = $i[46];

                $data->date_bast_approval3              = $i[47];
                $data->date_bast_approval_system3       = $i[48];
                $data->req_gr                           = $i[49];
                $data->gr_number                        = $i[50];
                $data->date_gr_number_share             = $i[51];
                $data->no_inv3                          = $i[52];
                $data->inv_date3                        = $i[53];

                $data->status_claim_hold_payment        = $i[54];
                $data->amount_closing_site_hold_payment = $i[55];

                $data->no_bast3                         = $i[56];
                $data->closing_site2                    = $i[57];
                $data->claim2                           = $i[58];
                $data->status_backlog_h1                = $i[59];
                $data->no_gr3                           = $i[60];
                $data->date_gr_share3                   = $i[61];
                $data->no_inv_backlog_h1                = $i[62];
                $data->date_inv_backlog_h1              = $i[63];
                $data->amount_closing_site_backlog_h1   = $i[64];
                
                // $data->material                   = $i[4];
                // $data->item_code                  = $i[8];
                // $data->qty                        = $i[9];
                // $data->unit                       = $i[10];
                // $data->price                      = str_replace(",", "", str_replace('Rp ', '', $i[11]));
                // $data->total_price                = str_replace(",", "", str_replace('Rp ', '', $i[12]));
                // $data->id_po_nonms_master         = $datamaster_latest->id + 0;

                $data->created_at                 = date('Y-m-d H:i:s');
                $data->updated_at                 = date('Y-m-d H:i:s');
                $data->save();

                $total_success++;
            }
           
        }

       

        session()->flash('message-success',"Upload PO Tracking MS Ericsson success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            
        return redirect()->route('po-tracking-ms.index');  
         
    }
}
