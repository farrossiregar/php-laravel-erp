<?php

namespace App\Http\Livewire\UserAccess;

use Livewire\Component;

class Edit extends Component
{
    public $module_id,$name,$description,$keyword,$data;
    public function render()
    {
        return view('livewire.user-access.edit');
    }
    public function mount($id)
    {
        $this->data = \App\Models\UserAccess::find($id);
        $this->name = $this->data->name;
        $this->description = $this->data->description;
        $this->keyword = $this->data->keyword;
        
        foreach(\App\Models\UserAccessModule::where('user_access_id',$this->data->id)->get() as  $module){
            $this->module_id[$module->module_id]=$module->module_id;
        } 
    }
    public function save()
    {
        $this->validate([
            'name'=>'required'
        ]);
        $this->data->name = $this->name;
        $this->data->description = $this->description;
        $this->data->save();
        session()->flash('message-success',__('Data saved successfully'));

        return redirect()->route('user-access.edit',['id'=>$this->data->id]);
    }
    public function checkmodule($id)
    {
        $check = \App\Models\UserAccessModule::where('module_id',$id)->where('user_access_id',$this->data->id)->first();
        
        if($check){
            $check->delete();            
        }else{
            $check = new \App\Models\UserAccessModule();
            $check->module_id = $id;
            $check->user_access_id = $this->data->id;
            $check->save();
        }
    }
}