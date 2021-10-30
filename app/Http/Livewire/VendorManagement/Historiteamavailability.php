<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Auth;
use DB;

class Historiteamavailability extends Component
{    
    // protected $listeners = [
    //     'modalcriteriateamavailability'=>'criteriateamavailability',
    // ];
    public $selected_id, $data, $datavm;

    
    public $id_detail, $team;
    public $service_type1, $service_type2, $service_type3, $service_type4, $service_type5, $service_type6, $service_type7, $service_type8, $service_type9, $service_type10, $service_type11, $service_type12, $service_type13, $service_type14;
    public $team1, $team2, $team3, $team4, $team5, $team6, $team7, $team8, $team9, $team10, $team11, $team12, $team13, $team14;
    public $eng1, $eng2, $eng3, $eng4, $eng5, $eng6, $eng7, $eng8, $eng9, $eng10, $eng11, $eng12, $eng13, $eng14;
    public $rigger1, $rigger2, $rigger3, $rigger4, $rigger5, $rigger6, $rigger7, $rigger8, $rigger9, $rigger10, $rigger11, $rigger12, $rigger13, $rigger14;
    public $tech1, $tech2, $tech3, $tech4, $tech5, $tech6, $tech7, $tech8, $tech9, $tech10, $tech11, $tech12, $tech13, $tech14;
    public $helper1, $helper2, $helper3, $helper4, $helper5, $helper6, $helper7, $helper8, $helper9, $helper10, $helper11, $helper12, $helper13, $helper14;
    public $other1, $other2, $other3, $other4, $other5, $other6, $other7, $other8, $other9, $other10, $other11, $other12, $other13, $other14;
    public $year1, $year2, $year3, $year4, $year5, $year6, $year7, $year8, $year9, $year10, $year11, $year12, $year13, $year14;
    public $invoice1, $invoice2, $invoice3, $invoice4, $invoice5, $invoice6, $invoice7, $invoice8, $invoice9, $invoice10, $invoice11, $invoice12, $invoice13, $invoice14;
    
    public function render()
    {
        // for($i = 1; $i < 15; $i++){
        //     // $team[$i] = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->first()->team;
        //     // $this->idteam[$i] = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->first()->team;
        //     $team = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->first()->team;
        //     if($team){
        //         $this->team[$i] = (int)$team;
        //     }else{
        //         $this->team[$i] = 0;
        //     }
        //     // $this->team4 = 3;
        //     // dd($this->team);
        //     // $this->test = '88';

        // }
        return view('livewire.vendor-management.criteriateamavailability');        
    }




    public function save()
    {
        $user = \Auth::user();
      
            $check = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->first();
            // dd($check);
            if(!$check){
                for($i = 1; $i < 15; $i++){
                    $data                                       = new \App\Models\VendorManagementta();
                    $data->id_supplier                          = $this->selected_id;
                    $data->id_detail                            = $i;
                    $data->id_detail_title                      = $this->valueconcat('service_type', $i);
                    $data->team                                 = $this->valueconcat('team', $i);
                    $data->eng                                  = $this->valueconcat('eng', $i);
                    $data->tech                                 = $this->valueconcat('tech', $i);
                    $data->rigger                               = $this->valueconcat('rigger', $i);
                    $data->helper                               = $this->valueconcat('helper', $i);
                    $data->other                                = $this->valueconcat('other', $i);
                    $data->year                                 = $this->valueconcat('year', $i);
                    $data->invoice                              = $this->valueconcat('invoice', $i);
                    
                    $data->save();
                }
               
            }
            

            // $sumteam = \App\Models\VendorManagementta::select(DB::Raw('sum(team) as countteam'))->where('id_supplier', $this->selected_id)->groupBy('id_supplier')->first();
            
        

        session()->flash('message-success',"Criteria Team Availability Successfully Evaluate!!!");
        
        // return redirect()->route('vendor-management.index');
    }

    public function valueconcat($field, $i){
        $fields = $field.$i;
        return $this->$fields;
    }
    
    public function updatedata($field, $id)
    {
        $check = \App\Models\VendorManagementta::where('id_supplier',$this->selected_id)->where('id_detail', $id)->first();
        // dd($check);
        if($field == 'team'){
            $check->team = $this->valueconcat('team', $id);
        }

        if($field == 'tech'){
            $check->tech = $this->valueconcat('tech', $id);
        }

        if($field == 'eng'){
            $check->eng = $this->valueconcat('eng', $id);
        }

        if($field == 'rigger'){
            $check->rigger = $this->valueconcat('rigger', $id);
        }

        if($field == 'helper'){
            $check->helper = $this->valueconcat('helper', $id);
        }

        if($field == 'other'){
            $check->other = $this->valueconcat('other', $id);
        }

        if($field == 'year'){
            $check->year = $this->valueconcat('year', $id);
        }

        if($field == 'invoice'){
            $check->invoice = $this->valueconcat('invoice', $id);
        }
        
        $check->save();

        $sumteam = \App\Models\VendorManagementta::select(DB::Raw('sum(team) as countteam'))->where('id_supplier', $this->selected_id)->groupBy('id_supplier')->first();
        // $sumcap = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->whereNotNull('year')->get();
        // $sumcap = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('year', NULL)->orwhere('year', 0)->get();
        $sumcap = count(\App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('year', NULL)->get()) + count(\App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('year', '0')->get());
        // dd(count($sumcap));
        $update = \App\Models\VendorManagement::where('id',$this->selected_id)->first();
        if($update->supplier_category != 'Material Supplier'){
            if((int)$sumteam->countteam < 5){
                $score = 20;
            }

            if((int)$sumteam->countteam > 5 && (int)$sumteam->countteam < 10){
                $score = 30;
            }

            if((int)$sumteam->countteam >= 10){
                $score = 40;
            }
        }else{
            $score = 20;
        }

        $sc = 14 - $sumcap;

        // dd($sumcap);
        if($sc == 1){
            $scorecap = 40;
        }elseif($sc == 2){
            $scorecap = 50;
        }else{
            if($sc > 2){
                $scorecap = 60;
            }else{
                $scorecap = 0;
            }
            
        }
        // dd($score);
        $update->ta_team_qty = $score;
        $update->ta_capability = $scorecap;
        $update->team_availability_capability = $score + $scorecap;
        $update->save();
        // dd((int)$sumteam->countteam);
        
        return view('livewire.vendor-management.criteriateamavailability');        
    }

    
    public function duration($start_time, $end_time){
        
        $diff = abs(strtotime($end_time) - strtotime($start_time));
        $years   = floor($diff / (365*60*60*24)); 
        $months  = floor(($diff - $years * 365*60*60*24) / (30*60*60*24)); 
        $days    = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
        $hours   = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24)/ (60*60)); 
        $minuts  = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24 - $days*60*60*24 - $hours*60*60)/ 60); 
        
        // if($hours > 0){
        //     $waktu = $hours.'.'.$minuts.' hours';
        //     // $waktu = $hours;
        // }else{
        //     $waktu = $minuts.' minute';
        //     // $waktu = $minuts;
        // }

        $waktu = '';
        if($months > 0){
            $waktu .= $months.' month ';
        }else{
            $waktu .= '';
        }

        if($days > 0){
            $waktu .= $days.' days';
        }else{
            $waktu .= '';
        }
        return $waktu;
    }
}