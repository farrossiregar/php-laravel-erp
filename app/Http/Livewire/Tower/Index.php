<?php

namespace App\Http\Livewire\Tower;

use Livewire\Component;
use Livewire\WithPagination;
class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap',$listeners = ['refresh-page'=>'$refresh'];
    public $keyword;
    public function render()
    {
        $data = \App\Models\Tower::select('towers.*')->orderBy('towers.name','ASC')
                                    ->join('sites','sites.id','=','towers.site_id');
        if($this->keyword) $data = $data->where('towers.name',"LIKE","%{$this->keyword}%")
                                        ->orWhere('sites.site_id','LIKE',"%{$this->keyword}%")
                                        ->orWhere('sites.name','LIKE',"%{$this->keyword}%")
                                        ;

        return view('livewire.tower.index')->with(['data'=>$data->paginate(100)]);
    }
    public function delete($id)
    {
        \App\Models\Tower::find($id)->delete();
    }
}
