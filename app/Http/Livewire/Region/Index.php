<?php

namespace App\Http\Livewire\Region;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Region;
use App\Models\SubRegion;
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $keyword,$name_insert_sub_region;
    protected $listeners = ['emit-insert-hide' => '$refresh','emit-edit-hide' => '$refresh','emit-delete-hide' => '$refresh'];
    public function render()
    {
        if(!check_access('region.index')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }
        $data = Region::orderBy('id','DESC');
        if($this->keyword) $data = $data->where('region','LIKE',"%{$this->keyword}%")->orWhere('region_code','LIKE',"%{$this->keyword}%");

        return view('livewire.region.index')
                    ->with(['data'=>$data->paginate(100)]);
    }
    
    public function insert_sub_region($id)
    {
        $sub = new SubRegion();
        $sub->region_id= $id;
        $sub->name = $this->name_insert_sub_region;
        $sub->save();
        $this->reset('name_insert_sub_region');
    }
}
