<?php

namespace App\Http\Livewire\DutyRosterDophomebase;

use Livewire\Component;
use Livewire\WithFileUploads;
use Auth;
use App\Models\DophomebaseImage;

class Uploadimage extends Component
{
    protected $listeners = [
        'modaluploadimage'=>'uploadimage',
    ];

    use WithFileUploads;
    
    public $selected_id;
    public $photo1, $photo2, $photo3, $photo4, $photo5, $photo6, $photo7, $photo8;

    
    public function render()
    {
        return view('livewire.duty-roster-dophomebase.uploadimage');
    }

    public function uploadimage($id)
    {
        $this->selected_id = $id;
    }

    public function save()
    {
       
        if($this->photo1) $validate['photo1']='mimes:jpg,jpeg,png|max:5120';
        if($this->photo2) $validate['photo2']='mimes:jpg,jpeg,png|max:5120';
        if($this->photo3) $validate['photo3']='mimes:jpg,jpeg,png|max:5120';
        if($this->photo4) $validate['photo4']='mimes:jpg,jpeg,png|max:5120';
        if($this->photo5) $validate['photo5']='mimes:jpg,jpeg,png|max:5120';
        if($this->photo6) $validate['photo6']='mimes:jpg,jpeg,png|max:5120';
        if($this->photo7) $validate['photo7']='mimes:jpg,jpeg,png|max:5120';
        if($this->photo8) $validate['photo8']='mimes:jpg,jpeg,png|max:5120';

        $this->validate($validate);

        $data = \App\Models\DophomebaseMaster::where('id', $this->selected_id)->first();

        if($this->photo1){
            $dataimage                          = new DopHomebaseImage();
            $dataimage->dop_homebase_id         = $this->selected_id;
            $dh                                 = 'dop-homebase'.$this->selected_id.'-1.'.$this->photo1->extension();
            $this->photo1->storePubliclyAs('public/Dop_Homebase/',$dh);
            $dataimage->image                   = $dh;
            $dataimage->created_at              = date('Y-m-d H:i:s');
            $dataimage->updated_at              = date('Y-m-d H:i:s');
            $dataimage->save();
        }
        

        if($this->photo2){
            $dataimage                          = new DophomebaseImage();
            $dataimage->dop_homebase_id         = $this->selected_id;
            $dh                                 = 'dop-homebase'.$this->selected_id.'-2.'.$this->photo2->extension();
            $this->photo2->storePubliclyAs('public/Dop_Homebase/',$dh);
            $dataimage->image                   = $dh;
            $dataimage->created_at              = date('Y-m-d H:i:s');
            $dataimage->updated_at              = date('Y-m-d H:i:s');
            $dataimage->save();
        }
        

        if($this->photo3){
            $dataimage                          = new DophomebaseImage();
            $dataimage->dop_homebase_id      = $this->selected_id;
            $dh                                 = 'dop-homebase'.$this->selected_id.'-3.'.$this->photo3->extension();
            $this->photo3->storePubliclyAs('public/Dop_Homebase/',$dh);
            $dataimage->image                   = $dh;
            $dataimage->created_at              = date('Y-m-d H:i:s');
            $dataimage->updated_at              = date('Y-m-d H:i:s');
            $dataimage->save();
        }
        

        if($this->photo4){
            $dataimage                          = new DophomebaseImage();
            $dataimage->dop_homebase_id      = $this->selected_id;
            $dh                                 = 'dop-homebase'.$this->selected_id.'-4.'.$this->photo4->extension();
            $this->photo4->storePubliclyAs('public/Dop_Homebase/',$dh);
            $dataimage->image                   = $dh;
            $dataimage->created_at              = date('Y-m-d H:i:s');
            $dataimage->updated_at              = date('Y-m-d H:i:s');
            $dataimage->save();
        }
        

        if($this->photo5){
            $dataimage                          = new DophomebaseImage();
            $dataimage->dop_homebase_id      = $this->selected_id;
            $dh                                 = 'dop-homebase'.$this->selected_id.'-5.'.$this->photo5->extension();
            $this->photo5->storePubliclyAs('public/Dop_Homebase/',$dh);
            $dataimage->image                   = $dh;
            $dataimage->created_at              = date('Y-m-d H:i:s');
            $dataimage->updated_at              = date('Y-m-d H:i:s');
            $dataimage->save();
        }
        

        if($this->photo6){
            $dataimage                          = new DophomebaseImage();
            $dataimage->dop_homebase_id      = $this->selected_id;
            $dh                                 = 'dop-homebase'.$this->selected_id.'-6.'.$this->photo6->extension();
            $this->photo6->storePubliclyAs('public/Dop_Homebase/',$dh);
            $dataimage->image                   = $dh;
            $dataimage->created_at              = date('Y-m-d H:i:s');
            $dataimage->updated_at              = date('Y-m-d H:i:s');
            $dataimage->save();
        }
        

        if($this->photo7){
            $dataimage                          = new DophomebaseImage();
            $dataimage->dop_homebase_id      = $this->selected_id;
            $dh                                 = 'dop-homebase'.$this->selected_id.'-7.'.$this->photo7->extension();
            $this->photo7->storePubliclyAs('public/Dop_Homebase/',$dh);
            $dataimage->image                   = $dh;
            $dataimage->created_at              = date('Y-m-d H:i:s');
            $dataimage->updated_at              = date('Y-m-d H:i:s');
            $dataimage->save();
        }
        

        if($this->photo8){
            $dataimage                          = new DophomebaseImage();
            $dataimage->dop_homebase_id      = $this->selected_id;
            $dh                                 = 'dop-homebase'.$this->selected_id.'-8.'.$this->photo8->extension();
            $this->photo8->storePubliclyAs('public/Dop_Homebase/',$dh);
            $dataimage->image                   = $dh;
            $dataimage->created_at              = date('Y-m-d H:i:s');
            $dataimage->updated_at              = date('Y-m-d H:i:s');
            $dataimage->save();
        }

        session()->flash('message-success',"Latitude updated success");
        
        return redirect()->route('duty-roster-dophomebase.index');
    }
}
