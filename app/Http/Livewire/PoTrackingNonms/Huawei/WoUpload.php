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
                $supplier = $i[14];
                $current_pic = $i[15];
                $system = $i[16];
                $change_history = $i[17];
                $rep_office = $i[18];
                $customer = $i[19];
                $project_code = $i[20];
                $site_id = $i[21];
                $sub_contract_no = $i[22];
                $pr_no = $i[23];
                $po_line_no = $i[24];
                $shipment_no = $i[25];
                $version_no = $i[26];
                $item_code = $i[27];
                $project_name = $i[28];
                $site_code = $i[29];
                $site_name = $i[30];
                $item_description = $i[31];
                $requested = $i[32];
                $due_qty = $i[33];
                $billed_qty = $i[34];
                $qty_cancel = $i[35];
                $unit = $i[36];
                $unit_price = $i[37];
                $line_amount = $i[38];
                $center_area = $i[39];
                $bidding_area = $i[40];
                $publish_date = $i[41];
                $acceptance_date = $i[42];
                $note_to_receiver = $i[43];
                $pds_categori = $i[44];
                $pds_amount = $i[45];

                // $data = PoTrackingNonmsHuawei::where('po_no',$po_no)->first();
                // if(!$data) $data = new PoTrackingNonmsHuawei();

                // $data->slo_no = $slo_no;
                // $data->po_no = $po_no;
                // $data->pic_project = $pic_project;
                // $data->po_amount = $po_amount;
                // $data->save();

                $data_item = new PoTrackingNonmsHuaweiItem();
                // $data_item->po_tracking_nonms_huawei_id = $data->id;
                $data_item->po_no = $po_no;
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
