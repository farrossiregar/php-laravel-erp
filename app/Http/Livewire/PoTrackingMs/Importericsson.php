<?php

namespace App\Http\Livewire\PoTrackingMs;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Importericsson extends Component
{

    use WithFileUploads;
    public $employee_id, $employee_name, $departement, $lokasi, $type_request, $request_room_detail;
    public $purpose, $participant, $start_date_booking, $start_time_booking, $end_date_booking, $end_time_booking;
    public $file;

    
    public function render()
    {
        $user = \Auth::user();
        $this->employee_id = $user->id;
        $this->employee_name = $user->name;
        $this->departement = get_position($user->user_access_id);
        // dd($user);
        // if(!check_access('accident-report.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        
        
        return view('livewire.po-tracking-ms.importericsson');
        
    }

  
    public function save()
    {
        
        $this->validate([
            'file'=>'required|mimes:xls,xlsx|max:51200' // 50MB maksimal
        ]);

        $path           = $this->file->getRealPath();
       
        $reader         = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $data           = $reader->load($path);
        $sheetDatas     = $data->getActiveSheet()->toArray();
        $sheetData      = $data->getActiveSheet();
        
        if(count($sheetDatas) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;
            foreach($sheetDatas as $key => $i){
                
                // dd($datamaster_latest->id);
                if($key<1) continue; // skip header
                // if($key>12) break;
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                $data                                   = new \App\Models\PoMsEricsson();
                if($i[0]!="") 
                
                $data->po_no                            = $i[0];
                $data->item_number                      = $i[1];
                $data->po_line_item                     = $i[2];
                $data->date_po_released                 = @$this->explode_date(2, $i[3]).'-'.@$this->explode_date(1, $i[3]).'-'.@$this->explode_date(0, $i[3]);
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

                $data->date_bast_approval               = @$this->explode_date2(2, $i[24]).'-'.@$this->explode_date2(0, $i[24]).'-'.@$this->explode_date2(1, $i[24]);
                $data->date_bast_approval_system        = @$this->explode_date2(2, $i[25]).'-'.@$this->explode_date2(0, $i[25]).'-'.@$this->explode_date2(1, $i[25]);
                $data->date_gr_req                      = @$this->explode_date2(2, $i[26]).'-'.@$this->explode_date2(0, $i[26]).'-'.@$this->explode_date2(1, $i[26]);
                $data->no_gr                            = $i[27];
                $data->date_gr_share                    = @$this->explode_date2(2, $i[28]).'-'.@$this->explode_date2(0, $i[28]).'-'.@$this->explode_date2(1, $i[28]);
                $data->invoice_amount                   = $i[29];
                $data->no_inv                           = $i[30];
                $data->inv_date                         = @$this->explode_date2(2, $i[31]).'-'.@$this->explode_date2(0, $i[31]).'-'.@$this->explode_date2(1, $i[31]);

                $data->payment_date                     = @$this->explode_date2(2, $i[32]).'-'.@$this->explode_date2(0, $i[32]).'-'.@$this->explode_date2(1, $i[32]);
                // dd($data->payment_date);
                $data->date_bast_approval2              = @$this->explode_date2(2, $i[33]).'-'.@$this->explode_date2(0, $i[33]).'-'.@$this->explode_date2(1, $i[33]);
                $data->date_bast_approval_system2       = @$this->explode_date2(2, $i[34]).'-'.@$this->explode_date2(0, $i[34]).'-'.@$this->explode_date2(1, $i[34]);
                $data->date_gr_req2                     = @$this->explode_date2(2, $i[35]).'-'.@$this->explode_date2(0, $i[35]).'-'.@$this->explode_date2(1, $i[35]);
                $data->no_gr2                           = $i[36];
                $data->date_gr_share2                   = @$this->explode_date2(2, $i[37]).'-'.@$this->explode_date2(0, $i[37]).'-'.@$this->explode_date2(1, $i[37]);
                $data->invoice_amount2                  = $i[38];
                $data->no_inv2                          = $i[39];
                $data->inv_date2                        = @$this->explode_date2(2, $i[40]).'-'.@$this->explode_date2(0, $i[40]).'-'.@$this->explode_date2(1, $i[40]);

                $data->qty_site_hold                    = $i[41];
                $data->type2                            = $i[42];
                $data->amount_hold_payment              = $i[43];
                $data->closing_site                     = $i[44];
                $data->no_bast2                         = $i[45];
                $data->claim                            = $i[46];

                $data->date_bast_approval3              = @$this->explode_date2(2, $i[47]).'-'.@$this->explode_date2(0, $i[47]).'-'.@$this->explode_date2(1, $i[47]);
                $data->date_bast_approval_system3       = @$this->explode_date2(2, $i[48]).'-'.@$this->explode_date2(0, $i[48]).'-'.@$this->explode_date2(1, $i[48]);
                $data->req_gr                           = $i[49];
                $data->gr_number                        = $i[50];
                $data->date_gr_number_share             = @$this->explode_date2(2, $i[51]).'-'.@$this->explode_date2(0, $i[51]).'-'.@$this->explode_date2(1, $i[51]);
                $data->no_inv3                          = $i[52];
                $data->inv_date3                        = @$this->explode_date2(2, $i[53]).'-'.@$this->explode_date2(0, $i[53]).'-'.@$this->explode_date2(1, $i[53]);

                $data->status_claim_hold_payment        = $i[54];
                $data->amount_closing_site_hold_payment = $i[55];

                $data->no_bast3                         = $i[56];
                $data->closing_site2                    = $i[57];
                $data->claim2                           = $i[58];
                $data->status_backlog_h1                = $i[59];
                $data->no_gr3                           = $i[60];
                $data->date_gr_share3                   = @$this->explode_date2(2, $i[61]).'-'.@$this->explode_date2(0, $i[61]).'-'.@$this->explode_date2(1, $i[61]);
                $data->no_inv_backlog_h1                = $i[62];
                $data->date_inv_backlog_h1              = @$this->explode_date2(2, $i[63]).'-'.@$this->explode_date2(0, $i[63]).'-'.@$this->explode_date2(1, $i[63]);
                $data->amount_closing_site_backlog_h1   = $i[64];
                
                // $data->material                   = $i[4];
                // $data->item_code                  = $i[8];
                // $data->qty                        = $i[9];
                // $data->unit                       = $i[10];
                // $data->price                      = str_replace(",", "", str_replace('Rp ', '', $i[11]));
                // $data->total_price                = str_replace(",", "", str_replace('Rp ', '', $i[12]));
                // $data->id_po_nonms_master         = $datamaster_latest->id + 0;

                $data->status_ = 1; // Regional
                $data->save();

                $total_success++;
            }
           
        }

       

        session()->flash('message-success',"Upload PO Tracking MS Ericsson success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            
        return redirect()->route('po-tracking-ms.index');  
         
    }

    public function explode_date($pos, $date){
        $exp = explode("-", $date);

        if($pos == 2){
            $result = '20'.$exp[2];
        }

        if($pos == 1){
            $date = date('Y').'-'.$exp[1].'-'.date('d');
            $result = date('m', strtotime($date));
        }

        if($pos == 0){
            $result = $exp[0];
        }

        return $result;
    }

    public function explode_date2($pos, $date){
        $exp = explode("/", $date);

        $result = $exp[$pos];

        return $result;
    }
    
}
