<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ModuleEmployee extends Seeder
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
            $menu = new \App\Models\ModulesItem();
            $menu->module_id = $module->id;
            $menu->name = 'Employee';
            $menu->link = 'employee.index';
            $menu->status = 1;
            $menu->type = 1;
            $menu->prefix_link = 'employee';
            $menu->save();

            \DB::table('modules_items')->insert(
                [
                    [
                        'module_id'      => $module->id,
                        'name' => 'Insert',
                        'link' => 'employee.insert',
                        'status' => 1,
                        'type' => 2,
                        'parent_id'=>$menu->id,
                        'prefix_link' => 'employee',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ],
                    [
                        'module_id'      => $module->id,
                        'name' => 'Edit',
                        'link' => 'employee.edit',
                        'status' => 1,
                        'type' => 2,
                        'parent_id'=>$menu->id,
                        'prefix_link' => 'employee',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ],
                    [
                        'module_id'      => $module->id,
                        'name' => 'Delete',
                        'link' => 'employee.delete',
                        'status' => 1,
                        'type' => 2,
                        'parent_id'=>$menu->id,
                        'prefix_link' => 'employee',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ],
                ]
            );
        }
        
    }
}
