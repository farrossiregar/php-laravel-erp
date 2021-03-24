<?php

namespace App\Http\Livewire\MobileApps;

use Livewire\Component;

use App\Models\Employee as EmployeeModel;

use Livewire\WithPagination;

class Employee extends Component
{
    use WithPagination;
    
    protected $paginationTheme = 'bootstrap';
    
    public $keyword,$employee_id;

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
