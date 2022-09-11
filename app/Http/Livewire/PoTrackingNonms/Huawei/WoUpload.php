<?php

namespace App\Http\Livewire\PoTrackingNonms\Huawei;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PoTrackingNonmsHuawei;
use App\Models\PoTrackingNonmsHuaweiItem;

class WoUpload extends Component
{
    use WithFileUploads;
    public $file;
    public function render()
    {
        return view('livewire.po-tracking-nonms.huawei.wo-upload');
    }

    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xlsx|max:51200' // 50MB maksimal
        ]);

        $path           = $this->file->getRealPath();
        $reader         = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $reader->setReadDataOnly(true);
        $data_xls           = $reader->load($path);
        $sheetDatas     = $data_xls->getActiveSheet()->toArray();
        if(count($sheetDatas) > 0){
            $double_data = 0;
            $total_success = 0;

            $is_double = false;

            foreach($sheetDatas as $key => $i){
                if($key<1) continue; // skip header
                
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                if($i[1]=="") continue;
                $slo_no = $i[0];
                $po_no = $i[1];
                $po_detail = $i[2];
                $po_aging = $i[3];
                $po_aging_by_category = $i[4];
                $po_aging_by_month = $i[5];
                $po_month_creation = $i[6];
                $po_amount = $i[7];
                $pic_project = $i[8];
                $project_code = $i[9];
                $region_code = $i[10];
                $account_drop_down = $i[11];
                $sub_account = $i[12];
                $project_type = $i[13];
                $current_pic = $i[14];
                $system = $i[15];
                $change_history = $i[16];
                $rep_office = $i[17];
                $customer = $i[18];
                $project_code = $i[19];
                $site_id = $i[20];
                $sub_contract_no = $i[21];
                $pr_no = $i[22];
                $po_line_no = $i[23];
                $shipment_no = $i[24];
                $version_no = $i[25];
                $item_code = $i[26];
                $project_name = $i[27];
                $site_code = $i[28];
                $site_name = $i[29];
                $item_description = $i[30];
                $requested = $i[31];
                $due_qty = $i[32];
                $billed_qty = $i[33];
                $qty_cancel = $i[34];
                $unit = $i[35];
                $unit_price = $i[36];
                $line_amount = $i[37];
                $center_area = $i[38];
                $bidding_area = $i[39];
                $publish_date = $i[40];
                $acceptance_date = $i[41];
                $note_to_receiver = $i[42];
                $pds_categori = $i[43];
                $pds_amount = $i[44];

                $data = PoTrackingNonmsHuawei::where('po_no',$po_no)->first();
                if(!$data) $data = new PoTrackingNonmsHuawei();

                $data->slo_no = $slo_no;
                $data->po_no = $po_no;
                $data->pic_project = $pic_project;
                $data->po_amount = $po_amount;
                $data->save();

                $data_item = new PoTrackingNonmsHuaweiItem();
                $data_item->po_tracking_nonms_huawei_id = $data->id;
                $data_item->po_detail = $po_detail;
                $data_item->po_aging = $po_aging;
                $data_item->po_aging_by_category = $po_aging_by_category;
                $data_item->po_aging_by_month = $po_aging_by_month;
                $data_item->po_aging_by_month = $po_aging_by_month;
                if($po_month_creation) $data_item->po_month_creation = @\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($po_month_creation)->format('Y-m-d');
                $data_item->po_amount = $po_amount;
                $data_item->pic_project = $pic_project;
                $data_item->project_code = $project_code;
                $data_item->region_code = $region_code;
                $data_item->account_drop_down = $account_drop_down;
                $data_item->sub_account = $sub_account;
                $data_item->project_type = $project_type;
                $data_item->current_pic_handler = $current_pic;
                $data_item->system_dropdown = $system;
                $data_item->change_history = $change_history;
                $data_item->rep_office = $rep_office;
                $data_item->customer = $customer;
                $data_item->site_id = $site_id;
                $data_item->sub_contract = $sub_contract_no;
                $data_item->pr_no = $pr_no;
                $data_item->po_line_no = $po_line_no;
                $data_item->shipment_no = $shipment_no;
                $data_item->version_no = $version_no;
                $data_item->item_code = $item_code;
                $data_item->project_name = $project_name;
                $data_item->site_code = $site_code;
                $data_item->site_name = $site_name;
                $data_item->item_description = $item_description;
                $data_item->request_qty = $requested;
                $data_item->due_qty = $due_qty;
                $data_item->billed_qty = $billed_qty;
                $data_item->qty_cancel = $qty_cancel;
                $data_item->unit = $unit;
                $data_item->unit_price = $unit_price;
                $data_item->line_amount = $line_amount;
                $data_item->center_area = $center_area;
                $data_item->bidding_area = $bidding_area;
                if($publish_date) $data_item->publish_date = @\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($publish_date)->format('Y-m-d');
                if($acceptance_date) $data_item->acceptance_date = @\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($acceptance_date)->format('Y-m-d');
                $data_item->note_to_receiver = $note_to_receiver;
                $data_item->pds_category = $pds_categori;
                $data_item->pds_amount = $pds_amount;
                $data_item->save();

                $total_success++;
            }
        }
        
        session()->flash('message-success',"Upload PO Tracking Non MS Ericson success, Success : <strong>{$total_success}</strong>, Double Data <strong>{$double_data}</strong>");
        return redirect()->route('po-tracking-nonms.huawei');
    }
}
