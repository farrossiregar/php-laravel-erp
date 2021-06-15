<?php

namespace App\Http\Livewire\Project;

use Livewire\Component;
use App\Models\Project;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    public $keyword;
    public function render()
    {
        if(!check_access('project')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }
        $data = Project::select('projects.*')->orderBy('id','DESC');

        return view('livewire.project.index')
                    ->with(['data'=>$data->paginate(100)]);
    }
}
