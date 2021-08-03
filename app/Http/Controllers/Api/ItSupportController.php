<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\TroubleTicket;
use Illuminate\Http\Request;
use TroubleTicketHelper;
use App\Models\TrainingMaterialFile;

class ItSupportController extends Controller
{
   public function store(Request $r)
   {

    // if($this->show_category_others){
    //     $new_category = new TroubleTicketCategory();
    //     $new_category->name = $this->trouble_ticket_category_others;
    //     $new_category->employee_id = isset(\Auth::user()->employee->id) ? \Auth::user()->employee->id : '';
    //     $new_category->save();

    //     $this->trouble_ticket_category_id = $new_category->id;
    // }

        $data = new TroubleTicket();
        $data->trouble_ticket_number = TroubleTicketHelper::generate_number();
        $data->employee_id = \Auth::user()->employee->id;
        // $data->trouble_ticket_category_id = $this->trouble_ticket_category_id;
        $data->description = $this->description;
        $data->save();
        
        if(!empty($this->file)){
            foreach($this->file as $file){
                $new_file = new TrainingMaterialFile();
                $new_file->training_material_id = $data->id;
                $name = $file->getClientOriginalName();
                $file->storeAs("public/training-material/{$data->id}", $name);
                $new_file->file = "storage/training-material/{$data->id}/{$name}";
                $new_file->name = $file->getClientOriginalName();
                $new_file->file_ext = $file->extension();
                $new_file->save();
            }
        }

        return response()->json(['message'=>'submited'], 200);

   }
}