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
        if(check_access_controller('company.index') == false){
            session()->flash('message-error','Access denied.');
            $this->redirect('/');
        }
        

        return view('livewire.company.index')->with(['data'=>$data->paginate(100)]);
    }
}
