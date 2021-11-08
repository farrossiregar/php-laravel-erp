<?php

namespace App\Http\Livewire\VendorManagement;

use Livewire\Component;
use Auth;
use DB;

class Historiinitteamavailability extends Component
{    
    // protected $listeners = [
    //     'modalcriteriateamavailability'=>'criteriateamavailability',
    // ];
    public $selected_id, $date, $data, $datavm;

    
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
        return view('livewire.vendor-management.historiteamavailability');        
    }

    public function mount()
    {
        // dd(\App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '1')->first());
        $this->team1 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '1')->first()->team;
        
        $this->team2 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '2')->first()->team;
        $this->team3 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '3')->first()->team;
        $this->team4 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '4')->first()->team;
        $this->team5 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '5')->first()->team;
        $this->team6 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '6')->first()->team;
        $this->team7 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '7')->first()->team;
        $this->team8 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '8')->first()->team;
        $this->team9 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '9')->first()->team;
        $this->team10 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '10')->first()->team;
        $this->team11 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '11')->first()->team;
        $this->team12 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '12')->first()->team;
        $this->team13 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '13')->first()->team;
        $this->team14 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '14')->first()->team;
        

        $this->tech1 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '1')->first()->tech;
        $this->tech2 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '2')->first()->tech;
        $this->tech3 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '3')->first()->tech;
        $this->tech4 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '4')->first()->tech;
        $this->tech5 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '5')->first()->tech;
        $this->tech6 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '6')->first()->tech;
        $this->tech7 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '7')->first()->tech;
        $this->tech8 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '8')->first()->tech;
        $this->tech9 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '9')->first()->tech;
        $this->tech10 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '10')->first()->tech;
        $this->tech11 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '11')->first()->tech;
        $this->tech12 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '12')->first()->tech;
        $this->tech13 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '13')->first()->tech;
        $this->tech14 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '14')->first()->tech;
        

        $this->eng1 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '1')->first()->eng;
        $this->eng2 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '2')->first()->eng;
        $this->eng3 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '3')->first()->eng;
        $this->eng4 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '4')->first()->eng;
        $this->eng5 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '5')->first()->eng;
        $this->eng6 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '6')->first()->eng;
        $this->eng7 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '7')->first()->eng;
        $this->eng8 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '8')->first()->eng;
        $this->eng9 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '9')->first()->eng;
        $this->eng10 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '10')->first()->eng;
        $this->eng11 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '11')->first()->eng;
        $this->eng12 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '12')->first()->eng;
        $this->eng13 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '13')->first()->eng;
        $this->eng14 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '14')->first()->eng;
        
        $this->rigger1 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '1')->first()->rigger;
        $this->rigger2 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '2')->first()->rigger;
        $this->rigger3 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '3')->first()->rigger;
        $this->rigger4 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '4')->first()->rigger;
        $this->rigger5 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '5')->first()->rigger;
        $this->rigger6 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '6')->first()->rigger;
        $this->rigger7 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '7')->first()->rigger;
        $this->rigger8 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '8')->first()->rigger;
        $this->rigger9 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '9')->first()->rigger;
        $this->rigger10 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '10')->first()->rigger;
        $this->rigger11 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '11')->first()->rigger;
        $this->rigger12 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '12')->first()->rigger;
        $this->rigger13 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '13')->first()->rigger;
        $this->rigger14 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '14')->first()->rigger;
        
        $this->helper1 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '1')->first()->helper;
        $this->helper2 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '2')->first()->helper;
        $this->helper3 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '3')->first()->helper;
        
        $this->helper4 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '4')->first()->helper;
        $this->helper5 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '5')->first()->helper;
        $this->helper6 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '6')->first()->helper;
        $this->helper7 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '7')->first()->helper;
        $this->helper8 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '8')->first()->helper;
        $this->helper9 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '9')->first()->helper;
        $this->helper10 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '10')->first()->helper;
        $this->helper11 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '11')->first()->helper;
        $this->helper12 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '12')->first()->helper;
        $this->helper13 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '13')->first()->helper;
        $this->helper14 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '14')->first()->helper;
        

        $this->other1 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '1')->first()->other;
        $this->other2 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '2')->first()->other;
        $this->other3 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '3')->first()->other;
        $this->other4 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '4')->first()->other;
        $this->other5 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '5')->first()->other;
        $this->other6 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '6')->first()->other;
        $this->other7 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '7')->first()->other;
        $this->other8 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '8')->first()->other;
        $this->other9 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '9')->first()->other;
        $this->other10 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '10')->first()->other;
        $this->other11 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '11')->first()->other;
        $this->other12 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '12')->first()->other;
        $this->other13 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '13')->first()->other;
        $this->other14 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '14')->first()->other;
        


        $this->year1 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '1')->first()->year;
        $this->year2 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '2')->first()->year;
        $this->year3 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '3')->first()->year;
        $this->year4 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '4')->first()->year;
        $this->year5 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '5')->first()->year;
        $this->year6 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '6')->first()->year;
        $this->year7 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '7')->first()->year;
        $this->year8 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '8')->first()->year;
        $this->year9 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '9')->first()->year;
        $this->year10 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '10')->first()->year;
        $this->year11 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '11')->first()->year;
        $this->year12 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '12')->first()->year;
        $this->year13 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '13')->first()->year;
        $this->year14 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '14')->first()->year;
        

        $this->invoice1 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '1')->first()->invoice;
        $this->invoice2 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '2')->first()->invoice;
        $this->invoice3 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '3')->first()->invoice;
        $this->invoice4 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '4')->first()->invoice;
        $this->invoice5 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '5')->first()->invoice;
        $this->invoice6 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '6')->first()->invoice;
        $this->invoice7 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '7')->first()->invoice;
        $this->invoice8 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '8')->first()->invoice;
        $this->invoice9 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '9')->first()->invoice;
        $this->invoice10 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '10')->first()->invoice;
        $this->invoice11 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '11')->first()->invoice;
        $this->invoice12 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '12')->first()->invoice;
        $this->invoice13 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '13')->first()->invoice;
        $this->invoice14 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '14')->first()->invoice;
        
        $this->service_type14 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '14')->first()->id_detail_title;

        $this->data = \App\Models\VendorManagement::where('id', $this->selected_id)->first();

        $this->service_type7 = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', '7')->first()->id_detail_title;
    }




    public function save()
    {
        $user = \Auth::user();
        for($i = 1; $i < 15; $i++){
            $data                                       = \App\Models\VendorManagementta::where('id_supplier', $this->selected_id)->where('id_detail', $i)->first();
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

            // $sumteam = \App\Models\VendorManagementta::select(DB::Raw('sum(team) as countteam'))->where('id_supplier', $this->selected_id)->groupBy('id_supplier')->first();
            
        

        session()->flash('message-success',"Criteria Team Availability Successfully Evaluate!!!");
        
        // return redirect()->route('vendor-management.index');
        return view('livewire.vendor-management.historiteamavailability');     
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