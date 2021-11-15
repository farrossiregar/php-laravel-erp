<?php

namespace App\Http\Livewire\CommitmentLetter;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\CommitmentLetter;
use Auth;
use DB;


class Add extends Component
{
    use WithPagination;
    public $date, $employee_id;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $dataproject, $company_name, $project, $region, $region_area, $ktp_id, $nik_pmt, $leader, $employee_name;
    // public $date, $employee_id, $klasifikasi_insiden, $jenis_insiden, $jenis_insiden2, $nikdannama, $rincian,$show_jenis_insiden2=false;
    // public $photo1, $photo2, $photo3, $photo4, $photo5, $photo6, $photo7, $photo8;
    public function render()
    {
        // if(!check_access('accident-report.input')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }
        $dataproject = \App\Models\ProjectEpl::orderBy('projects.id', 'desc')
                                    ->select('projects.*', 'region.region_code')
                                    ->join(env('DB_DATABASE').'.region', env('DB_DATABASE_EPL_PMT').'.projects.region_id', '=', env('DB_DATABASE').'.region.id' )->get();
        // dd($dataproject);
        return view('livewire.commitment-letter.add');
    }

  
    public function save()
    {
        // $validate = [
        //     'site_id' => 'required',
        //     'employee_id' => 'required',
        //     'date' => 'required',
        //     'klasifikasi_insiden' => 'required',
        //     'jenis_insiden' => 'required',
        //     'rincian' => 'required',
        //     'nikdannama' => 'required',
        //     'photo1'=>'required|mimes:jpg,jpeg,png|max:5120', // 5MB maksimal
        // ];

        $data                   = new CommitmentLetter();
        $data->company_name     = $this->company_name;
        $data->project          = $this->project;
        $data->region           = $this->region;
        $data->region_area      = $this->region_area;
        $data->ktp_id           = $this->ktp_id;
        $data->nik_pmt          = $this->nik_pmt;
        $data->leader           = $this->leader;
        $data->employee_name    = $this->employee_name;

        $data->save();

        // if($this->photo2) $validate['photo2']='mimes:jpg,jpeg,png|max:5120';
        // if($this->photo3) $validate['photo3']='mimes:jpg,jpeg,png|max:5120';
        // if($this->photo4) $validate['photo4']='mimes:jpg,jpeg,png|max:5120';
        // if($this->photo5) $validate['photo5']='mimes:jpg,jpeg,png|max:5120';
        // if($this->photo6) $validate['photo6']='mimes:jpg,jpeg,png|max:5120';
        // if($this->photo7) $validate['photo7']='mimes:jpg,jpeg,png|max:5120';
        // if($this->photo8) $validate['photo8']='mimes:jpg,jpeg,png|max:5120';

        // $this->validate($validate);
        
      

        // if($this->photo1){
        //     $dataimage                          = new AccidentReportImage();
        //     $dataimage->accident_report_id      = $data->id;
        //     $ar                                 = 'accident-report'.$data->id.'-1.'.$this->photo1->extension();
        //     $this->photo1->storePubliclyAs('public/Accident_Report/web/',$ar);
        //     $dataimage->image                   = $ar;
        //     $dataimage->created_at              = date('Y-m-d H:i:s');
        //     $dataimage->updated_at              = date('Y-m-d H:i:s');
        //     $dataimage->save();
        // }
        



        session()->flash('message-success',"Commitment Letter Berhasil diinput");
        
        return redirect()->route('commitment-letter.index');
    }


}



