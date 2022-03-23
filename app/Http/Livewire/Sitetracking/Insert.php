<?php

namespace App\Http\Livewire\Sitetracking;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Region;
use Auth;

class Insert extends Component
{
    use WithFileUploads;
    public $file;
    public function render()
    {
        return view('livewire.sitetracking.insert');
    }

    public function save()
    {
        $this->validate([
            'file'=>'required|mimes:xlsx|max:51200' // 50MB maksimal
        ]);
        
        $users = Auth::user();
        $path = $this->file->getRealPath();
        $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $data = $reader->load($path);
        $sheetData = $data->getActiveSheet()->toArray();

        $data                   = new \App\Models\SiteListTrackingMaster();
        $data->name             = $users->name;
        $data->upload_by        = $users->name;
        $data->status           = '0';
        $data->client_project_id = session()->get('project_id');
        $data->save();
        
        if(count($sheetData) > 0){
            $countLimit = 1;
            $total_failed = 0;
            $total_success = 0;
            foreach($sheetData as $key => $i){
                if($key<1) continue; // skip header
                
                foreach($i as $k=>$a){ $i[$k] = trim($a); }
                $datadetail = new \App\Models\SiteListTrackingDetail();
                if($i[2]=="") continue; 
                
                $datadetail->id_site_master                         = $data->id;
                $datadetail->collection                             = @date_format(date_create($i[4]), 'm');;
                $datadetail->no_po                                  = $i[2];
                $datadetail->item_number                            = $i[3];
                $datadetail->date_po_release                        = @date_format(date_create($i[4]), 'Y-m-d');
                $datadetail->pic_rpm                                = $i[5];
                $datadetail->pic_sm                                 = $i[6];
                $datadetail->type                                   = $i[7];
                $datadetail->item_description                       = $i[8];
                if($i[9]) $datadetail->period = @date('Y-m-d',strtotime($i[9]));
                $datadetail->region                                 = $i[10];
                $datadetail->region1                                = $i[11];
                $datadetail->project                                = $i[12];
                $datadetail->penalty                                = $i[13];
                $datadetail->last_status                            = $i[14];
                $datadetail->remark                                 = $i[15];
                $datadetail->qty_po                                 = $i[16];
                $datadetail->actual_qty                             = $i[17];
                $datadetail->no_bast                                = $i[18];
                $datadetail->date_bast_approval                     = @date_format(date_create($i[19]), 'Y-m-d');
                $datadetail->date_bast_approval_by_system           = @date_format(date_create($i[20]), 'Y-m-d');
                $datadetail->date_gr_req                            = $i[21];
                $datadetail->no_gr                                  = $i[22];
                $datadetail->date_gr_share                          = $i[23];
                $datadetail->no_invoice                             = $i[24];
                $datadetail->inv_date                               = @date_format(date_create($i[25]), 'Y-m-d');
                $datadetail->payment_date                           = date_format(date_create($i[26]), 'Y-m-d');
                $datadetail->client_project_id = session()->get('project_id');

                // find region
                $region_ = Region::where('region',"LIKE","%{$i[10]}%")->first();
                if($region_) $datadetail->region_id = $region_->id; 

                $datadetailcek  = \App\Models\SiteListTrackingDetail::where('no_po', $i[2])->get();
                
                if($datadetailcek->count() > 0){
                    $datatemp       = new \App\Models\SiteListTrackingTemp();
                    $datatemp->id_site_master                         = $data->id;
                    $datatemp->collection                             = @date_format(date_create($i[4]), 'm');;
                    $datatemp->no_po                                  = $i[2];
                    $datatemp->item_number                            = $i[3];
                    $datatemp->date_po_release                        = @date_format(date_create($i[4]), 'Y-m-d');
                    $datatemp->pic_rpm                                = $i[5];
                    $datatemp->pic_sm                                 = $i[6];
                    $datatemp->type                                   = $i[7];
                    $datatemp->item_description                       = $i[8];
                    $datatemp->period                                 = @date_format(date_create($i[9]), 'Y-m');
                    $datatemp->region                                 = $i[10];
                    $datatemp->region1                                = $i[11];
                    $datatemp->project                                = $i[12];
                    $datatemp->penalty                                = $i[13];
                    $datatemp->last_status                            = $i[14];
                    $datatemp->remark                                 = $i[15];
                    $datatemp->qty_po                                 = $i[16];
                    $datatemp->actual_qty                             = $i[17];
                    $datatemp->no_bast                                = $i[18];
                    $datatemp->date_bast_approval                     = @date_format(date_create($i[19]), 'Y-m-d');
                    $datatemp->date_bast_approval_by_system           = @date_format(date_create($i[20]), 'Y-m-d');
                    $datatemp->date_gr_req                            = $i[21];
                    $datatemp->no_gr                                  = $i[22];
                    $datatemp->date_gr_share                          = $i[23];
                    $datatemp->no_invoice                             = $i[24];
                    $datatemp->inv_date                               = @date_format(date_create($i[25]), 'Y-m-d');
                    $datatemp->payment_date                           = @date_format(date_create($i[26]), 'Y-m-d');
                    $datatemp->client_project_id = session()->get('project_id');
                    $datatemp->save();
                }
                
                $datadetail->save();

                $total_success++;
            }
            session()->flash('message-success',"Upload success, Success : <strong>{$total_success}</strong>, Total Failed <strong>{$total_failed}</strong>");
     
            \LogActivity::add('[web] Site Tracking Upload');
    
            return redirect()->route('site-tracking.index');
        }
    }
}
