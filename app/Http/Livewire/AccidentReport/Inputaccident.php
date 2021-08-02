<?php

namespace App\Http\Livewire\AccidentReport;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use DB;
use DateTime;

class Inputaccident extends Component
{

    use WithFileUploads;
    public $site_id, $date, $employee_id, $klasifikasi_insiden, $jenis_insiden, $jenis_insiden2, $nikdannama, $rincian,$show_jenis_insiden2=false;
    public $photo1, $photo2, $photo3, $photo4, $photo5, $photo6, $photo7, $photo8;

    
    public function render()
    {
        
        if(!check_access('accident-report.input')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }
        
        return view('livewire.accident-report.inputaccidentreport');
        
    }

    public function updated($propertyName)
    {
        if($propertyName=='jenis_insiden')  $this->show_jenis_insiden2 = $this->$propertyName=='Jenis Insiden lain yang tidak disebutkan diatas:  *Free Text*' ? true : false;
    }
  
    public function save()
    {
        $this->validate([
            
            'photo1'=>'required|mimes:jpg,jpeg,png|max:5120', // 5MB maksimal
            'photo2'=>'required|mimes:jpg,jpeg,png|max:5120', // 5MB maksimal
            'photo3'=>'required|mimes:jpg,jpeg,png|max:5120', // 5MB maksimal
            'photo4'=>'required|mimes:jpg,jpeg,png|max:5120', // 5MB maksimal
            'photo5'=>'required|mimes:jpg,jpeg,png|max:5120', // 5MB maksimal
            'photo6'=>'required|mimes:jpg,jpeg,png|max:5120', // 5MB maksimal
            'photo7'=>'required|mimes:jpg,jpeg,png|max:5120', // 5MB maksimal
            'photo8'=>'required|mimes:jpg,jpeg,png|max:5120', // 5MB maksimal
        ]);
        
        
        $data                           = new \App\Models\AccidentReport();
        $data->employee_id              = $this->employee_id;
        $data->site_id                  = $this->site_id;
        $data->date                     = $this->date;

        $pubdate                        = date_format(date_create($this->date), 'Y-m-d');
        $data->week                     = $this->weekOfMonth3($pubdate);

        $data->klasifikasi_insiden      = $this->klasifikasi_insiden;
        
        if($this->jenis_insiden == 'Jenis Insiden lain yang tidak disebutkan diatas:  *Free Text*'){
            $data->jenis_insiden            = $this->jenis_insiden2;
        }else{
            $data->jenis_insiden            = $this->jenis_insiden;
        }
        $data->rincian_kronologis       = $this->rincian;
        $data->nik_and_nama             = $this->nikdannama;
        $data->created_at               = date('Y-m-d H:i:s');
        $data->updated_at               = date('Y-m-d H:i:s');
        $data->save();

        // for($i=1; $i<=8;$i++){
            if($this->photo1){
                $dataimage                          = new \App\Models\AccidentReportImage();
                $dataimage->accident_report_id      = $data->id;
                $ar                                 = 'accident-report'.$data->id.'-1.'.$this->photo1->extension();
                $this->photo1->storePubliclyAs('public/Accident_Report/web/',$ar);
                $dataimage->image                   = $ar;
                $dataimage->created_at              = date('Y-m-d H:i:s');
                $dataimage->updated_at              = date('Y-m-d H:i:s');
                $dataimage->save();
            }
           

            if($this->photo2){
                $dataimage                          = new \App\Models\AccidentReportImage();
                $dataimage->accident_report_id      = $data->id;
                $ar                                 = 'accident-report'.$data->id.'-2.'.$this->photo2->extension();
                $this->photo2->storePubliclyAs('public/Accident_Report/web/',$ar);
                $dataimage->image                   = $ar;
                $dataimage->created_at              = date('Y-m-d H:i:s');
                $dataimage->updated_at              = date('Y-m-d H:i:s');
                $dataimage->save();
            }
         

            if($this->photo3){
                $dataimage                          = new \App\Models\AccidentReportImage();
                $dataimage->accident_report_id      = $data->id;
                $ar                                 = 'accident-report'.$data->id.'-3.'.$this->photo3->extension();
                $this->photo3->storePubliclyAs('public/Accident_Report/web/',$ar);
                $dataimage->image                   = $ar;
                $dataimage->created_at              = date('Y-m-d H:i:s');
                $dataimage->updated_at              = date('Y-m-d H:i:s');
                $dataimage->save();
            }
           

            if($this->photo4){
                $dataimage                          = new \App\Models\AccidentReportImage();
                $dataimage->accident_report_id      = $data->id;
                $ar                                 = 'accident-report'.$data->id.'-4.'.$this->photo4->extension();
                $this->photo4->storePubliclyAs('public/Accident_Report/web/',$ar);
                $dataimage->image                   = $ar;
                $dataimage->created_at              = date('Y-m-d H:i:s');
                $dataimage->updated_at              = date('Y-m-d H:i:s');
                $dataimage->save();
            }
           

            if($this->photo5){
                $dataimage                          = new \App\Models\AccidentReportImage();
                $dataimage->accident_report_id      = $data->id;
                $ar                                 = 'accident-report'.$data->id.'-5.'.$this->photo5->extension();
                $this->photo5->storePubliclyAs('public/Accident_Report/web/',$ar);
                $dataimage->image                   = $ar;
                $dataimage->created_at              = date('Y-m-d H:i:s');
                $dataimage->updated_at              = date('Y-m-d H:i:s');
                $dataimage->save();
            }
            

            if($this->photo6){
                $dataimage                          = new \App\Models\AccidentReportImage();
                $dataimage->accident_report_id      = $data->id;
                $ar                                 = 'accident-report'.$data->id.'-6.'.$this->photo6->extension();
                $this->photo6->storePubliclyAs('public/Accident_Report/web/',$ar);
                $dataimage->image                   = $ar;
                $dataimage->created_at              = date('Y-m-d H:i:s');
                $dataimage->updated_at              = date('Y-m-d H:i:s');
                $dataimage->save();
            }
            

            if($this->photo7){
                $dataimage                          = new \App\Models\AccidentReportImage();
                $dataimage->accident_report_id      = $data->id;
                $ar                                 = 'accident-report'.$data->id.'-7.'.$this->photo7->extension();
                $this->photo7->storePubliclyAs('public/Accident_Report/web/',$ar);
                $dataimage->image                   = $ar;
                $dataimage->created_at              = date('Y-m-d H:i:s');
                $dataimage->updated_at              = date('Y-m-d H:i:s');
                $dataimage->save();
            }
            

            if($this->photo8){
                $dataimage                          = new \App\Models\AccidentReportImage();
                $dataimage->accident_report_id      = $data->id;
                $ar                                 = 'accident-report'.$data->id.'-8.'.$this->photo8->extension();
                $this->photo8->storePubliclyAs('public/Accident_Report/web/',$ar);
                $dataimage->image                   = $ar;
                $dataimage->created_at              = date('Y-m-d H:i:s');
                $dataimage->updated_at              = date('Y-m-d H:i:s');
                $dataimage->save();
            }
           
        // }
      

        session()->flash('message-success',"Accident Report Berhasil diinput");
        
        return redirect()->route('accident-report.index');
    }

    public function weekOfMonth3($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }
}
