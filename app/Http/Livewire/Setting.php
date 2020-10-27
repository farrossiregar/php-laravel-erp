<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Setting extends Component
{
    use WithFileUploads;

    public $logoUrl;
    public $logo;
    public $message;
    public $company;
    public $email;
    public $phone;

    public function render()
    {
        return view('livewire.setting')->with(['title'=>'General']);
    }

    public function mount()
    {
        $this->logoUrl = get_setting('logo');
    }

    public function save()
    {
        $this->validate([
            'logo' => 'image:max:1024', // 1Mb Max
        ]);
        $name = 'logo.'.$this->logo->extension();
        $this->logo->storePubliclyAs('public',$name);

        update_setting('logo',$name);
    }
}