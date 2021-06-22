<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingNonms;
use App\Models\PoTrackingNonmsBast;
use Auth;
use DB;


class Detailfoto extends Component
{
    use WithPagination;
    public $data, $datadoc;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        // if(!check_access('po-tracking-nonms.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }

        // $user = \Auth::user();
        
        // if(check_access('po-tracking-nonms.index-regional')){
        // // if($user->user_access_id == '22' || $user->user_access_id == '23'){ // Regional & Finance Regional
        //     $region_user = DB::table('pmt.employees as employees')
        //                         ->where('employees.user_access_id', $user->user_access_id)
        //                         ->join('epl.region as region', 'region.id', '=', 'employees.region_id')
        //                         ->where('employees.user_id', $user->id)->get();

        //     $data = PoTrackingNonms::where('region', $region_user[0]->region_code)
                                    
        //                             ->orderBy('id', 'DESC'); 
        // }else{
        //     $data = PoTrackingNonms::orderBy('id', 'DESC');
        // }
        
        // if($this->date) $ata = $data->whereDate('created_at',$this->date);
        
        // $data = json_encode($data);
        $data = $this->data;
        $datadoc = $this->datadoc;
        // return view('livewire.po-tracking-nonms.index')->with(['data'=>$data->paginate(50)]);
        // return view('livewire.po-tracking-nonms.detailfoto')->with(['data'=>$data]);
        return view('livewire.po-tracking-nonms.detailfoto');
       
    }


    public function mount($id){
        // $this->id = $id;

        $this->data     = PoTrackingNonmsBast::where('po_tracking_nonms_id', $id)->orderBy('id', 'DESC')->get();
        $this->datadoc  = PoTrackingNonms::where('id', $id)->orderBy('id', 'DESC')->first();
    }


}



