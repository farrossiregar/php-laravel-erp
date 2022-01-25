<?php

namespace App\Http\Livewire\ConsumableItemDatabase;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Mail\GeneralEmail;
use Session;
use DateTime;
use Auth;


class Addreq extends Component
{
    use WithPagination;
    // public $date, $employee_id;
    protected $paginationTheme = 'bootstrap';
    
    use WithFileUploads;
    
    public $item_name, $category_item, $amount;
    public function render()
    {

        
        
        return view('livewire.consumable-item-database.addreq');
    }

  
    public function save()
    {

        $data                           = new \App\Models\ConsumableItemRequest();
        $data->item_name                = $this->item_name;
        $data->item_category            = $this->category_item;
        $data->stock                    = $this->amount;
        
        $data->save();
        

        // $notif = get_user_from_access('asset-database.hq-ga');
        // foreach($notif as $user){
        //     if($user->email){
        //         $message  = "<p>Dear {$user->name}<br />, Asset Request need Approval </p>";
        //         $message .= "<p>Nama Employee: {$data->name}<br />Project : {$data->project}<br />Region: {$data->region}</p>";
        //         \Mail::to($user->email)->send(new GeneralEmail("[PMT E-PM] - Asset Request",$message));
        //     }
        // }

        session()->flash('message-success',"Consumable Item Request Berhasil diinput");
        
        return redirect()->route('consumable-item-database.index');
    }

    public function weekOfMonth3($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }


}



