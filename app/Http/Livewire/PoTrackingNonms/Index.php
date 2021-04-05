<?php

namespace App\Http\Livewire\PoTrackingNonms;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PoTrackingPds;
use App\Models\PoTrackingNonms;
use Auth;
use DB;


class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
    
    public function render()
    {
        // if(!check_access('po-tracking.index')){
        //     session()->flash('message-error','Access denied, you have no permission please contact your administrator.');
        //     $this->redirect('/');
        // }

        $user = \Auth::user();
        

        if($user->user_access_id == '22' || $user->user_access_id == '23'){ // Regional & Finance Regional
            $region_user = DB::table('pmt.employees as employees')
                                ->where('employees.user_access_id', $user->user_access_id)
                                ->join('epl.region as region', 'region.id', '=', 'employees.region_id')
                                ->where('employees.user_id', $user->id)->get();

            $data = PoTrackingNonms::where('region', $region_user[0]->region_code)
                                    ->orderBy('id', 'DESC');
        }elseif($user->user_access_id == '20'){ // E2E
            $data = PoTrackingNonms::orderBy('id', 'DESC');
        }else{
            $data = PoTrackingNonms::orderBy('id', 'DESC');
        }
        
        
        
        
        return view('livewire.po-tracking-nonms.index')->with(['data'=>$data->paginate(50)]);
        // return view('livewire.po-tracking-nonms.index')->with(compact('data'));
        
    }


}



