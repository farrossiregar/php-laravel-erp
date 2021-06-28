<?php

namespace App\Http\Livewire\Employee;

use Livewire\Component;
use App\Models\Employee;
use App\Models\ModulesItem;
use App\Models\UserAccessAndroid;

class Android extends Component
{
    public $data,$employee_access=[],$speed_warning_pic_id;

    public function render()
    {
        return view('livewire.employee.android');
    }

    public function update_employee_access($menu_id)
    {
        $check = UserAccessAndroid::where(['modules_item_id'=>$menu_id,'employee_id'=>$this->data->id])->first();
        if(!$check) {
            $check = new UserAccessAndroid();
            $check->modules_item_id = $menu_id;
            $check->employee_id = $this->data->id;
            $check->save();
        }else{
            $check->delete();
        }
    }

    public function updated($propertyName)
    {
        if($propertyName=='speed_warning_pic_id'){
            $this->data->speed_warning_pic_id = $this->$propertyName;
            $this->data->save();
        }
    }

    public function mount(Employee $data)
    {
        $this->data = $data;
        $parent = ModulesItem::where('link','mobile-apps.index')->first();   
        $this->speed_warning_pic_id = $this->data->speed_warning_pic_id; 
        foreach(ModulesItem::where('parent_id',$parent->id)->get() as $menu){
            $this->employee_access[$menu->id] =  UserAccessAndroid::where(['modules_item_id'=>$menu->id,'employee_id'=>$this->data->id])->first() ? 1 : 0;
        }
    }
}
