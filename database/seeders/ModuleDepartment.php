<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
class ModuleDepartment extends Seeder
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
            $menu = \App\Models\ModulesItem::where('name','Department')->first();
            if(!$menu) {
                $menu = new \App\Models\ModulesItem();
                $menu->module_id = $module->id;
                $menu->name = 'Department';
                $menu->link = 'department.index';
                $menu->status = 1;
                $menu->type = 1;
                $menu->prefix_link = 'department';
                $menu->save();
            }
            \DB::table('modules_items')->insert(
                [
                    [
                        'module_id'      => $module->id,
                        'name' => 'Insert',
                        'link' => 'department.insert',
                        'status' => 1,
                        'type' => 2,
                        'parent_id'=>$menu->id,
                        'prefix_link' => 'department',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ],
                    [
                        'module_id'      => $module->id,
                        'name' => 'Edit',
                        'link' => 'department.edit',
                        'status' => 1,
                        'type' => 2,
                        'parent_id'=>$menu->id,
                        'prefix_link' => 'department',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ],
                    [
                        'module_id'      => $module->id,
                        'name' => 'Delete',
                        'link' => 'department.delete',
                        'status' => 1,
                        'type' => 2,
                        'parent_id'=>$menu->id,
                        'prefix_link' => 'department',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ],
                    [
                        'module_id'      => $module->id,
                        'name' => 'Insert Sub Department',
                        'link' => 'department.insert-sub-department',
                        'status' => 1,
                        'type' => 2,
                        'parent_id'=>$menu->id,
                        'prefix_link' => 'department',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ],
                    [
                        'module_id'      => $module->id,
                        'name' => 'Delete Sub Department',
                        'link' => 'department.delete-sub-department',
                        'status' => 1,
                        'type' => 2,
                        'parent_id'=>$menu->id,
                        'prefix_link' => 'department',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ],
                    [
                        'module_id'      => $module->id,
                        'name' => 'Update Sub Department',
                        'link' => 'department.update-sub-department',
                        'status' => 1,
                        'type' => 2,
                        'parent_id'=>$menu->id,
                        'prefix_link' => 'department',
                        'created_at' => Carbon::now(),
                        'updated_at' => Carbon::now(),
                    ]
                ]
            );
        }
    }
}
