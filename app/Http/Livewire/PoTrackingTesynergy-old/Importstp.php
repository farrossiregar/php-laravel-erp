<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;
use \App\Models\PoTrackingNonms;
use \App\Models\UserEpl;
use \App\Models\Employee;

class Importstp extends Component
{
    protected $listeners = [
        'modal-stp'=>'datastp',
    ];

    use WithFileUploads;
    public $file;
    public $selected_id;

    protected $rules = [
        'file' => 'required',
    ];
    public function render()
    {
        return view('livewire.po-tracking-nonms.importstp');
    }

    public function datastp($id)
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


        $site_exp       = explode(" / ", substr($sheetData->getCell('F3')->getValue(), 2));

        $site_id        = $site_exp[0];
        $site_name      = $site_exp[1];

        $datamaster                 = new \App\Models\PoTrackingNonms();
        $datamaster->po_no          = '';
        $datamaster->region         = substr($sheetData->getCell('F5')->getValue(), 2);
        $datamaster->site_id        = $site_id;
        $datamaster->site_name      = $site_name;
        $datamaster->no_tt          = substr($sheetData->getCell('F6')->getValue(), 2);
        $datamaster->status         = '';
        $datamaster->type_doc       = '1'; //STP
        $datamaster->pekerjaan      = substr($sheetData->getCell('F7')->getValue(), 2);
        $datamaster->created_at     = date('Y-m-d H:i:s');
        $datamaster->updated_at     = date('Y-m-d H:i:s');
        $datamaster->save();

        
        $datamaster_latest = \App\Models\PoTrackingNonms::select('id')->orderBy('id', 'DESC')->first();
        if(count($sheetDatas) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;
            foreach($sheetDatas as $key => $i){
                
                // dd($datamaster_latest->id);
                if($key<11) continue; // skip header
                if($key>12) break;
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                $potrackingstp                          = new \App\Models\PoTrackingNonmsStp();
                if($i[0]!="") 
                
                
                
                $potrackingstp->material                   = $i[4];
                $potrackingstp->item_code                  = $i[8];
                $potrackingstp->qty                        = $i[9];
                $potrackingstp->unit                       = $i[10];
                $potrackingstp->price                      = str_replace(",", "", str_replace('Rp ', '', $i[11]));
                $potrackingstp->total_price                = str_replace(",", "", str_replace('Rp ', '', $i[12]));
                $potrackingstp->id_po_nonms_master         = $datamaster_latest->id + 0;

                $potrackingstp->created_at                 = date('Y-m-d H:i:s');
                $potrackingstp->updated_at                 = date('Y-m-d H:i:s');
                $potrackingstp->save();

                $total_success++;
            }
           
        }

        $user = \Auth::user();
        // $region_user = DB::table(env('DB_DATABASE').'.employees as employees')
        //                         ->where('employees.user_access_id', '29')
        //                         ->join(env('DB_DATABASE_EPL_PMT').'.region as region', 'region.id', '=', 'employees.region_id')
        //                         ->where('region.region_code', $datamaster->region)->get();

        // if(count($region_user) > 0){
        //     $epluser = Employee::select('name', 'telepon', 'email')->where('region_id', $region_user[0]->region_id)->get();

            $epluser = check_access_data('po-tracking-nonms.notif-regional', $datamaster->region);
                
            $nameuser = [];
            $emailuser = [];
            $phoneuser = [];
            
            foreach($epluser as $no => $itemuser){
                $nameuser[$no] = $itemuser->name;
                $emailuser[$no] = $itemuser->email;
                $phoneuser[$no] = $itemuser->telepon;
                $message = "*Dear Operation Region ".$datamaster->region." - ".$nameuser[$no]."*\n\n";
                $message .= "*PO Tracking Non MS STP Region ".$datamaster->region." Uploaded on ".date('d M Y H:i:s')."*\n\n";
                send_wa(['phone'=> $phoneuser[$no],'message'=>$message]);   

                // \Mail::to($emailuser[$no])->send(new PoTrackingReimbursementUpload($item));
            }
        // }

        session()->flash('message-success',"Upload PO Tracking Non MS STP success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
            
        return redirect()->route('po-tracking-nonms.index');  
         
    }
}
