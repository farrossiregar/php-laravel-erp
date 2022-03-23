<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;
use App\Models\Employee as EmployeeModel;
use App\Models\ModulesItem;
use App\Models\UserAccessAndroid;
use Livewire\WithPagination;

class Employee extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $keyword,$employee_id,$employee_access=[];

    public function render()
    {
        $data = EmployeeModel::orderBy('id','DESC')->where('is_use_android',1);

        if($this->keyword) $data = $data->where(function($table){
            foreach(\Illuminate\Support\Facades\Schema::getColumnListing('employees') as $column){
                $table->orWhere($column,'LIKE',"%{$this->keyword}%");
            }
        });

        return view('livewire.mobile-apps.employee')->with(['data'=>$data->paginate(100)]);
    }

    public function mount()
    {
        $data = EmployeeModel::orderBy('id','DESC')->where('is_use_android',1)->get();
        $parent = ModulesItem::where('link','mobile-apps.index')->first();   
        
        foreach(ModulesItem::where('parent_id',$parent->id)->get() as $menu){
            foreach($data as $k => $item){
                $this->employee_access[$item->id.$menu->id] =  UserAccessAndroid::where(['modules_item_id'=>$menu->id,'employee_id'=>$item->id])->first() ? 1 : 0;
            }
        }
    }

    public function update_employee_access($employee_id,$menu_id)
    {
        $check = UserAccessAndroid::where(['modules_item_id'=>$menu_id,'employee_id'=>$employee_id])->first();
        if(!$check) {
            $check = new UserAccessAndroid();
            $check->modules_item_id = $menu_id;
            $check->employee_id = $employee_id;
            $check->save();
        }else{
            $check->delete();
        }
    }

    public function set_employee()
    {
        $this->validate([
            'employee_id' => 'required'
        ]);

        EmployeeModel::find($this->employee_id)->update(['is_use_android'=>1]);

        session()->flash('message-success',__('Data saved successfully'));

        return redirect()->route('mobile-apps.index');
    }
}
