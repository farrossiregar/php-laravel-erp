<?php

namespace App\Http\Livewire\Project;

use Livewire\Component;
use App\Models\ClientProject;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap',$listeners = ['reload'=>'$refresh'];
    public $keyword,$code,$name,$selected;
    public function render()
    {
        if(!check_access('project')){
            session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
            $this->redirect('/');
        }
        $data = ClientProject::where('is_project',1)->orderBy('id','DESC');

        return view('livewire.project.index')
                    ->with(['data'=>$data->paginate(100)]);
    }

    public function delete(ClientProject $data)
    {
        $data->delete();
        $this->emit('reload');
    }

    public function set_id(ClientProject $selected)
    {
        $this->selected = $selected;
        $this->code = $selected->code;
        $this->name = $selected->name;
    }

    public function update()
    {
        $this->selected->code = $this->code;
        $this->selected->name = $this->name;
        $this->selected->save();
        
        $this->emit('message-success','Data updated.');
        $this->emit('modal','hide');
    }
}