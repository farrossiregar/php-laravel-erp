<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ModuleRegion extends Seeder
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
            $menu = \App\Models\ModulesItem::where('name','Region')->first();
            if(!$menu) {
                $menu = new \App\Models\ModulesItem();
                $menu->module_id = $module->id;
                $menu->name = 'Region';
                $menu->link = 'region.index';
                $menu->status = 1;
                $menu->type = 1;
                $menu->prefix_link = 'region';
                $menu->save();
            }
            $item = new \App\Models\ModulesItem();
            $item->module_id = $module->id;
            $item->name = 'Insert';
            $item->link = 'region.insert';
            $item->status = 1;
            $item->type = 2;
            $item->parent_id = $menu->id;
            $item->prefix_link = 'region';
            $item->save();

            $user = \App\Models\UserAccess::where('name','LIKE',"%Administrator%")->first();
            if($user){
                $menu_access = new \App\Models\UserAccessModule();
                $menu_access->user_access_id = $user->id;
                $menu_access->module_id = $item->id;
                $menu_access->save();
            }

            $item = new \App\Models\ModulesItem();
            $item->module_id = $module->id;
            $item->name = 'Edit';
            $item->link = 'region.edit';
            $item->status = 1;
            $item->type = 2;
            $item->parent_id = $menu->id;
            $item->prefix_link = 'region';
            $item->save();
            if($user){
                $menu_access = new \App\Models\UserAccessModule();
                $menu_access->user_access_id = $user->id;
                $menu_access->module_id = $item->id;
                $menu_access->save();
            }

            $item = new \App\Models\ModulesItem();
            $item->module_id = $module->id;
            $item->name = 'Delete';
            $item->link = 'region.delete';
            $item->status = 1;
            $item->type = 2;
            $item->parent_id = $menu->id;
            $item->prefix_link = 'region';
            $item->save();     
            if($user){
                $menu_access = new \App\Models\UserAccessModule();
                $menu_access->user_access_id = $user->id;
                $menu_access->module_id = $item->id;
                $menu_access->save();
            }       
        }
    }
}
