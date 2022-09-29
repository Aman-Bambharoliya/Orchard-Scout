<?php

namespace Database\Seeders;

use App\Models\Module;
use App\Models\ModuleAction;
use Illuminate\Database\Seeder;
use DB;

class ModuleDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $modules = array(
            array(
                 'name'=>'people',
                 'actions'=>[
                     [
                         'action_name'=> 'people.index',
                         'rights'=>'index'
                     ],
                     [
                         'action_name'=> 'people.create',
                         'rights'=>'create'
                     ],
                     [
                         'action_name'=> 'people.edit',
                         'rights'=>'update'
                     ],
                     [
                         'action_name'=> 'people.update',
                         'rights'=>'update'
                     ],
                     [
                         'action_name'=> 'people.destroy',
                         'rights'=>'delete'
                     ],
                 ],
             ),
             array(
                'name'=>'address-types',
                'actions'=>[
                    [
                        'action_name'=> 'address-types.index',
                        'rights'=>'index'
                    ],
                    [
                        'action_name'=> 'address-types.create',
                        'rights'=>'create'
                    ],
                    [
                        'action_name'=> 'address-types.store',
                        'rights'=>'create'
                    ],
                    [
                        'action_name'=> 'address-types.edit',
                        'rights'=>'update'
                    ],
                    [
                        'action_name'=> 'address-types.update',
                        'rights'=>'update'
                    ],
                    [
                        'action_name'=> 'address-types.destroy',
                        'rights'=>'delete'
                    ],
                ],
            ),
         );

        if (!empty($modules)) {
            foreach ($modules as $module) {
                if (isset($module['name'])) {
                    $md=array('name'=>$module['name']);
                    $module_add = Module::firstOrCreate($md);
                    if ($module_add) {
                        $module_id = $module_add->id;
                        $module_name = $module_add->name;
                        if ($module_id != null && isset($module['actions']) && !empty($module['actions'])) {
                            foreach($module['actions'] as $action)
                            {
                                $mda=array('module_id'=>$module_id,'action_name'=>$action['action_name'],'rights'=>$action['rights']);
                                $module_action_add = ModuleAction::firstOrCreate($mda);
                            }
                        }
                    }
                }
            }
        }
    }
}
