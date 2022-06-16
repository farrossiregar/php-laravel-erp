<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\PoTrackingNonms;
use App\Models\PoTrackingNonmsBoq;
use \App\Models\Employee;

class Importboq extends Component
{
    protected $listeners = [
        'modal-boq'=>'databoq',
    ];

    use WithFileUploads;
    public $file;
    public $selected_id,$wo_number;

    protected $rules = [
        'file' => 'required',
    ];
    public function render()
    {
        return view('livewire.po-tracking-nonms.importboq');
    }

    public function databoq($id)
    {
        $this->selected_id = $id;
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

            foreach($sheetDatas as $key => $i){
                if($key<1) continue; // skip header
                
                foreach($i as $k=>$a){ $i[$k] = trim($a); }

                $no_wo = $i[0];
                $region = $i[1];
                $site_id = $i[2];
                $site_name = $i[3];
                $category_material = $i[4];
                $item_code = $i[5];
                $item_material = $i[6];
                $uom = $i[7];
                $qty = $i[8];
                $unit_price = $i[9];
                $total = $i[10];
                $sno_material = $i[11];
                $sno_rectification = $i[12];
                $po_line = $i[13];

                if(!$no_wo) continue; // jika tidak ada data maka skip

                $data = PoTrackingNonms::where('no_tt',$no_wo)->where(function($table){
                    $table->whereNull('status')->orWhere('status',0);
                })->whereNull('po_tracking_nonms_po_id')->first();
                
                if(!$data){
                    $data = new PoTrackingNonms();
                    $data->no_tt = $no_wo;
                    $data->region = $region;
                    $data->site_id = $site_id;
                    $data->site_name = $site_name;
                    $data->type_doc = 2;
                    $data->save();
                }

                /**
                 * check SNO Material /  SNO Rectification / Item code
                 * tidak boleh sama persis jika sama persis dihitung double
                 * */ 
                $potrackingboq = PoTrackingNonmsBoq::where('id_po_nonms_master',$data->id)
                                                    ->where('item_code',$item_code)
                                                    ->where('sno_material',$sno_material)
                                                    ->where('sno_rectification',$sno_rectification)
                                                    ->where('po_line_item',$po_line)
                                                    ->first();
                if($potrackingboq) {
                    $potrackingboq->qty = $potrackingboq->qty + $qty;
                    // $double_data++;
                    // continue;
                }else{
                    $potrackingboq = new PoTrackingNonmsBoq();
                    $potrackingboq->qty = $qty;
                }

                $potrackingboq->category_material = $category_material;
                $potrackingboq->item_code = $item_code;
                $potrackingboq->item_description = $item_material;
                $potrackingboq->uom = $uom;
                $potrackingboq->price = $unit_price;
                $potrackingboq->total_price = $total;
                $potrackingboq->sno_material = $sno_material;
                $potrackingboq->sno_rectification = $sno_rectification;
                $potrackingboq->po_line_item = $po_line;
                $potrackingboq->id_po_nonms_master = $data->id;
                $potrackingboq->save();
                $total_success++;
            }
        }
        session()->flash('message-success',"Upload PO Tracking Non MS Ericson success, Success : <strong>{$total_success}</strong>, Double Data <strong>{$double_data}</strong>");
        return redirect()->route('po-tracking-nonms.index');   
    }
}