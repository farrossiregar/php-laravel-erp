<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModuleEmployeeAdd1 extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $module = \App\Models\Module::where('name','Data Master')->first();
        if($module){
            $menu = \App\Models\ModulesItem::where('name','Employee')->first();
            if(!$menu) {
                $menu = new \App\Models\ModulesItem();
                $menu->module_id = $module->id;
                $menu->name = 'Employee';
                $menu->link = 'employee.index';
                $menu->status = 1;
                $menu->type = 1;
                $menu->prefix_link = 'employee';
                $menu->save();
            }
            $item = new \App\Models\ModulesItem();
            $item->module_id = $module->id;
            $item->name = 'Autologin';
            $item->link = 'employee.autologin';
            $item->status = 1;
            $item->type = 2;
            $item->parent_id = $menu->id;
            $item->prefix_link = 'employee';
            $item->save();

            $user = \App\Models\UserAccess::where('name','LIKE',"%Administrator%")->first();
            if($user){
                $menu_access = new \App\Models\UserAccessModule();
                $menu_access->user_access_id = $user->id;
                $menu_access->module_id = $item->id;
                $menu_access->save();
            }    
        }
    }
}
