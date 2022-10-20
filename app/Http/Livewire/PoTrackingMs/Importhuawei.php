<?php

namespace App\Http\Livewire\PoTrackingMs;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PoMsHuawei;

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
        
        return view('livewire.po-tracking-ms.importhuawei');
    }

    public function save()
    {        
        $this->validate([
            'file'=>'required|mimes:xls,xlsx|max:51200' // 50MB maksimal
        ]);

        $path           = $this->file->getRealPath();
        $reader         = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        $data           = $reader->load($path);
        $sheetDatas     = $data->getActiveSheet()->toArray();
        $sheetData      = $data->getActiveSheet();
        
        if(count($sheetDatas) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;
            $data_double = [];
            foreach($sheetDatas as $key => $i){
                if($key<1) continue; // skip header
                
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                $data = PoMsHuawei::where('po_line_shipment',$i[1])->first();
                if($data) {
                    $data_double[] = $i[1];$total_failed++;
                    continue;
                }

                $data = new PoMsHuawei();
                
                if($i[0]=="") continue;
                
                $data->po_no = $i[0];
                $data->po_line_shipment = $i[1];
                $data->region                           = $i[2];
                $data->site_id                          = $i[3];
                $data->site_name                        = $i[4];
                $data->po_period = @\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($i[5])->format('M-Y');
                $data->type_po                          = $i[6];
                $data->po_category                      = $i[7];
                $data->item_description                 = $i[8];
                $data->uom                              = $i[9];
                $data->qty                              = $i[10];
                $data->unit_price                       = $i[11];
                $data->total_amount                     = $i[12];
                $data->status                           = $i[13];
                $data->deduction                        = $i[20];
                $data->ehs_other_deduction              = $i[21];
                $data->rp_deduction                     = $i[22];
                $data->scar_no                          = $i[23];
                $data->status_ = 1;
                $data->save();

                $total_success++;
            }           
        } 
        
        session()->flash('message-success',"Upload PO Tracking MS Huawei success, Success : <strong>{$total_success}</strong>");
        if($total_failed>0){
            $failed_data ='Reject Data <ul>';
            foreach($data_double as $item){
                $failed_data .= "<li>{$item}</li>";
            }
            $failed_data .= '</ul>';
            session()->flash('message-error',$failed_data);
        }
            
        return redirect()->route('po-tracking-ms.huawei');  
         
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