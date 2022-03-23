<?php

namespace App\Http\Livewire\AssetDatabase;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;
use Auth;


class Detailimage extends Component
{
    protected $listeners = [
        'modaldetailimage'=>'detailimage',
    ];

    use WithPagination;
    // public $date, $employee_id;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    public $selected_id, $dana_from, $pr_no, $prno, $dana_amount;
    public $reference_pic, $link;

    public function render()
    {
       
       
        return view('livewire.asset-database.detailimage');
    }

    public function detailimage($id)
    {
        $this->selected_id = $id;
        $data = \App\Models\AssetDatabase::where('id', $this->selected_id)->first();
        $this->reference_pic = $data->reference_pic;
        $this->link = $data->link;
        
        
    }



}



