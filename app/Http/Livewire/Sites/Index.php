<?php

namespace App\Http\Livewire\Sites;

use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $keyword;
    public function render()
    {
        $data = \App\Models\Site::orderBy('name','ASC');
        if($this->keyword) $data = $data->where('site_id',"LIKE","%{$this->keyword}%")
                                        ->orWhere('name',"LIKE","%{$this->keyword}%");
        return view('livewire.sites.index')->with(['data'=>$data->paginate(100)]);
    }
}
