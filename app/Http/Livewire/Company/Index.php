<?php

namespace App\Http\Livewire\Company;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Company;
use App\Helpers\GeneralHelper;

class Index extends Component
{
    public $keyword;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $data = Company::orderBy('id','DESC');
        if(!check_access('company.index')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }
        return view('livewire.company.index')->with(['data'=>$data->paginate(100)]);
    }
}
