<?php

namespace App\Http\Livewire\Module;

use Livewire\Component;
use App\Models\ModulesItem;

class DeleteSub extends Component
{
    public $data;

    public function render()
    {
        return <<<'blade'
            <div>
                <a href="javascript:;" wire:click="delete" class="text-danger"><i class="fa fa-trash"></i></a>
            </div>
blade;
    }

    public function mount(ModulesItem $data)
    {
        $this->data = $data;
    }

    public function delete()
    {
        $this->data->delete();
        
        $this->emit('refresh-page');
    }
}
