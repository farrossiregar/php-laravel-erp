<?php

namespace App\Http\Livewire\User;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\User;
use App\Models\UserAccessModule;
use App\Http\Livewire\Home;

use Auth;
class Index extends Component
{
    public $keyword;
    public $user_access_id;
    public $active_id;

    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $data = User::orderBy('id','desc');

        if($this->keyword) $data = $data->where('name','LIKE', '%'.$this->keyword.'%')
                                        ->orWhere('email','LIKE', '%'.$this->keyword.'%')
                                        ->orWhere('telepon','LIKE', '%'.$this->keyword.'%');
                                        
        if($this->user_access_id) $data = $data->where('user_access_id',$this->user_access_id);

        $module_item_id = '51';

        $access = UserAccessModule::where('user_access_id', Auth::user()->user_access_id)
                                    ->where('module_id', $module_item_id)
                                    ->get();

        // dd(json_decode($access));                                    
        if(count($access) > 0){
            return view('livewire.user.index')
                ->layout('layouts.app')
                ->with(['data'=>$data->paginate(100)]);
        }else{
            // return view('livewire.home');
            // return redirect()->route('home');
            
            $this->redirect()->route('home');
        }
    }

   

    public function setActiveId($id)
    {
        $this->active_id = $id;
    }

    public function autologin($id)
    {
        $data = User::where('id', $id)->first();

        if($data){
            \Session::put('is_id', \Auth::user()->id);
            \Auth::loginUsingId($data->id);
            \Session::put('is_login_administrator', true);

            return redirect('/')->with('message-success', 'Welcome, Login success.');
        }
    }

    public function delete($id)
    {
        User::find($id)->delete();
    }
}
