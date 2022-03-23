<?php

namespace App\Http\Livewire\ConsumableItemDatabase;

use Livewire\Component;
use Livewire\WithFileUploads;
use DateTime;

use Session;

class Edititem extends Component
{
    protected $listeners = [
        'modaleditconsumableitemdatabase'=>'modaleditconsumableitemdatabase',
    ];

    use WithFileUploads;
    public $selected_id, $data;
    
    public $item_name, $item_category, $price, $stock;

    
    public function render()
    {

        return view('livewire.consumable-item-database.edititem');
        
    }

    public function modaleditconsumableitemdatabase($id){
        $this->selected_id              = $id;
        $data                           = \App\Models\ConsumableItemDatabase::where('id', $this->selected_id)->first();
    
        $this->item_name                = $data->item_name;
        if($data->item_category == '1'){
            $this->item_category = 'Stationary';
        }

        if($data->item_category == '2'){
            $this->item_category = 'Pantry Supplies';
        }

        if($data->item_category == '3'){
            $this->item_category = 'Electric Supplies';
        }

        if($data->item_category == '4'){
            $this->item_category = 'Office Supplies';
        }
        
        $this->stock                    = $data->stock;
        $this->price                    = $data->price;
        
    }
  
    public function save()
    {
        $data                   = \App\Models\ConsumableItemDatabase::where('id', $this->selected_id)->first();
       
        $data->item_name        = $this->item_name;
        if($this->item_category == 'Stationary'){
            $data->item_category = '1';
        }

        if($this->item_category == 'Pantry Supplies'){
            $data->item_category = '2';
        }

        if($this->item_category == 'Electric Supplies'){
            $data->item_category = '3';
        }

        if($this->item_category == 'Office Supplies'){
            $data->item_category = '4';
        }
        
        $data->stock            = $this->stock;
        $data->price            = $this->price;
      
        $data->save();
        
        session()->flash('message-success',"Cosnumable Item Database Berhasil diupdate");
        
        return redirect()->route('consumable-item-database.index');
        
    }

    public function weekOfMonth3($strDate) {
		$dateArray = explode("-", $strDate);
		$date = new DateTime();
		$date->setDate($dateArray[0], $dateArray[1], $dateArray[2]);
		return floor((date_format($date, 'j') - 1) / 7) + 1;  
	  }


    public function yearborn($year){
        if($year > substr(date('Y'), 2, 2)){
            return '19'.$year;
        }else{
            return '20'.$year;
        }

    }
}
