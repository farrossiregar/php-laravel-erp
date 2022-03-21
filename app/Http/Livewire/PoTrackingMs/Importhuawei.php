<?php

namespace App\Http\Livewire\PoTrackingMs;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;

class Importhuawei extends Component
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
        
        
        return view('livewire.po-tracking-ms.importhuawei');
        
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
                $data                                   = new \App\Models\PoMsHuawei();
                if($i[0]!="") 
                
                // dd($this->explode_date(2, $i[14]).'-'.$this->explode_date(1, $i[14]).'-'.$this->explode_date(0, $i[14]));
                // dd($this->explode_date(1, $i[14]));
                // dd($this->explode_date(2, $i[14]));

                $data->po_no                            = $i[0];
                $data->po_line_shipment                 = $i[1];
                $data->region                           = $i[2];
                $data->site_id                          = $i[3];
                $data->site_name                        = $i[4];
                $data->po_period                        = $i[5];
                $data->type_po                          = $i[6];
                $data->po_category                      = $i[7];
                $data->item_description                 = $i[8];
                $data->uom                              = $i[9];
                $data->qty                              = $i[10];
                $data->unit_price                       = $i[11];
                $data->total_amount                     = $i[12];
                $data->status                           = $i[13];
                $data->bos_approved                     = $this->explode_date(2, $i[14]).'-'.$this->explode_date(1, $i[14]).'-'.$this->explode_date(0, $i[14]);
                $data->gm_approved                      = $this->explode_date(2, $i[15]).'-'.$this->explode_date(1, $i[15]).'-'.$this->explode_date(0, $i[15]);
                $data->gh_approved                      = $this->explode_date(2, $i[16]).'-'.$this->explode_date(1, $i[16]).'-'.$this->explode_date(0, $i[16]);
                $data->director_approved                = $this->explode_date(2, $i[17]).'-'.$this->explode_date(1, $i[17]).'-'.$this->explode_date(0, $i[17]);
                $data->verification                     = $this->explode_date(2, $i[18]).'-'.$this->explode_date(1, $i[18]).'-'.$this->explode_date(0, $i[18]);
                $data->acceptance                       = $this->explode_date(2, $i[19]).'-'.$this->explode_date(1, $i[19]).'-'.$this->explode_date(0, $i[19]);
                $data->deduction                        = $i[20];
                $data->ehs_other_deduction              = $i[21];
                $data->rp_deduction                     = $i[22];
                $data->scar_no                          = $i[23];
                

                $data->created_at                       = date('Y-m-d H:i:s');
                $data->updated_at                       = date('Y-m-d H:i:s');
                $data->save();

                $total_success++;
            }
           
        }

       

        session()->flash('message-success',"Upload PO Tracking MS Huawei success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            
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
    
}
