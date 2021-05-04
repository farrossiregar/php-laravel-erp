<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ModulesItem;
use App\Models\PpeCheck;
 
class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function menu()
    {

        $menu[] = [
                'name'=>'Account Setting',
                'link' => 'account-setting'
            ];
        $parent = ModulesItem::where('link','mobile-apps.index')->first();       
        
        foreach(ModulesItem::where('parent_id',$parent->id)->get() as $menu){
            $menu[] = [
                'name'=> $menu->name,
                'link' => $menu->link
            ];
        }
        
        $is_commitment_daily = CommitmentDaily::whereDate('created_at',date('Y-m-d'))->where('employee_id',\Auth::user()->employee->id)->count();
        $is_ppe_check = PpeCheck::whereDate('created_at',date('Y-m-d'))->where('employee_id',\Auth::user()->employee->id)->count();
        $is_vehicle_check = VehicleCheck::whereDate('created_at',date('Y-m-d'))->where('employee_id',\Auth::user()->employee->id)->count();

        return response()->json(['menu'=>$menu], 200);
    }
}