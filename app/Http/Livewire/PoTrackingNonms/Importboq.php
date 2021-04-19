<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;
use \App\Models\PoTrackingNonms;
use \App\Models\UserEpl;
use \App\Models\Employee;

class Importboq extends Component
{
    protected $listeners = [
        'modal-boq'=>'databoq',
    ];

    use WithFileUploads;
    public $file;
    public $selected_id;

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
            'file'=>'required|mimes:xls,xlsx|max:51200' // 50MB maksimal
        ]);

        $path           = $this->file->getRealPath();
       
        $reader         = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $data           = $reader->load($path);
        $sheetDatas     = $data->getActiveSheet()->toArray();
        $sheetData      = $data->getActiveSheet();

        // $site_exp       = explode(" / ", substr($sheetData->getCell('F3')->getValue(), 2));

        // $site_id        = $sheetData->getCell('F3')->getValue();
        // $site_name      = $site_exp[1];

        $datamaster                 = new \App\Models\PoTrackingNonms();
        $datamaster->po_no          = '';
        $datamaster->region         = $sheetData->getCell('D7')->getValue();
        $datamaster->site_id        = '';
        $datamaster->site_name      = '';
        $datamaster->no_tt          = $sheetData->getCell('D6')->getValue();
        $datamaster->status         = '';
        $datamaster->type_doc       = '2'; //BOQ
        $datamaster->pekerjaan      = $sheetData->getCell('D11')->getValue();
        $datamaster->created_at     = date('Y-m-d H:i:s');
        $datamaster->updated_at     = date('Y-m-d H:i:s');
        $datamaster->save();

        $datamaster_latest = \App\Models\PoTrackingNonms::select('id')->orderBy('id', 'DESC')->first();
        if(count($sheetDatas) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;
            foreach($sheetDatas as $key => $i){
                
                
                if($key<13) continue; // skip header
                if($key>14) break;
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                $potrackingboq                          = new \App\Models\PoTrackingNonmsBoq();
                if($i[0]!="") 
                
                
                $potrackingboq->site_id                    = $i[4];
                $potrackingboq->site_name                  = $i[5];
                $potrackingboq->item_description           = $i[6];
                $potrackingboq->uom                        = $i[7];
                $potrackingboq->qty                        = $i[8];
                $potrackingboq->supplier                   = $i[9];
                $potrackingboq->region                     = $i[10];
                $potrackingboq->remark                     = $i[11];
                $potrackingboq->reff                       = $i[12];
                $potrackingboq->price                      = str_replace(",", "", str_replace('Rp ', '', $i[13]));
                $potrackingboq->total_price                = str_replace(",", "", str_replace('Rp ', '', $i[14]));
                $potrackingboq->id_po_nonms_master         = $datamaster_latest->id + 0;

                $potrackingboq->created_at                 = date('Y-m-d H:i:s');
                $potrackingboq->updated_at                 = date('Y-m-d H:i:s');
                $potrackingboq->save();

                $total_success++;
            }
           
        }


        $user = \Auth::user();
        $region_user = DB::table('pmt.employees as employees')
                                ->where('employees.user_access_id', '29')
                                ->join('epl.region as region', 'region.id', '=', 'employees.region_id')
                                ->where('region.region_code', $datamaster->region)->get();

        $epluser = Employee::select('name', 'telepon', 'email')->where('region_id', $region_user[0]->region_id)->get();
            
        $nameuser = [];
        $emailuser = [];
        $phoneuser = [];
        
        foreach($epluser as $no => $itemuser){
            $nameuser[$no] = $itemuser->name;
            $emailuser[$no] = $itemuser->email;
            $phoneuser[$no] = $itemuser->telepon;
            $message = "*Dear Operation Region ".$datamaster->region." - ".$nameuser[$no]."*\n\n";
            $message .= "*PO Tracking Non MS BOQ Region ".$datamaster->region." Uploaded on ".date('d M Y H:i:s')."*\n\n";
            send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);   

            // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
        }

        session()->flash('message-success',"Upload PO Tracking Non MS BOQ success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
         
        return redirect()->route('po-tracking-nonms.index');   
    }
}
