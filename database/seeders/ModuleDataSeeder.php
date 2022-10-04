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
                 'name'=>'peoples',
                 'actions'=>[
                     [
                         'action_name'=> 'peoples.index',
                         'rights'=>'index'
                     ],
                     [
                         'action_name'=> 'peoples.create',
                         'rights'=>'create'
                     ],
                     [
                        'action_name'=> 'peoples.store',
                        'rights'=>'create'
                    ],
                     [
                         'action_name'=> 'peoples.edit',
                         'rights'=>'update'
                     ],
                     [
                         'action_name'=> 'peoples.update',
                         'rights'=>'update'
                     ],
                     [
                         'action_name'=> 'peoples.destroy',
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
            array(
                'name'=>'people-addresses',
                'actions'=>[
                    [
                        'action_name'=> 'people-addresses.index',
                        'rights'=>'index'
                    ],
                    [
                        'action_name'=> 'people-addresses.create',
                        'rights'=>'create'
                    ],
                    [
                        'action_name'=> 'people-addresses.store',
                        'rights'=>'create'
                    ],
                    [
                        'action_name'=> 'people-addresses.edit',
                        'rights'=>'update'
                    ],
                    [
                        'action_name'=> 'people-addresses.update',
                        'rights'=>'update'
                    ],
                    [
                        'action_name'=> 'people-addresses.destroy',
                        'rights'=>'delete'
                    ],
                ],
            ),
            array(
                'name'=>'people-phones',
                'actions'=>[
                    [
                        'action_name'=> 'people-phones.index',
                        'rights'=>'index'
                    ],
                    [
                        'action_name'=> 'people-phones.create',
                        'rights'=>'create'
                    ],
                    [
                        'action_name'=> 'people-phones.store',
                        'rights'=>'create'
                    ],
                    [
                        'action_name'=> 'people-phones.edit',
                        'rights'=>'update'
                    ],
                    [
                        'action_name'=> 'people-phones.update',
                        'rights'=>'update'
                    ],
                    [
                        'action_name'=> 'people-phones.destroy',
                        'rights'=>'delete'
                    ],
                ],
            ),
            array(
                'name'=>'customers',
                'actions'=>[
                    [
                        'action_name'=> 'customers.index',
                        'rights'=>'index'
                    ],
                    [
                        'action_name'=> 'customers.create',
                        'rights'=>'create'
                    ],
                    [
                       'action_name'=> 'customers.store',
                       'rights'=>'create'
                   ],
                    [
                        'action_name'=> 'customers.edit',
                        'rights'=>'update'
                    ],
                    [
                        'action_name'=> 'customers.update',
                        'rights'=>'update'
                    ],
                    [
                        'action_name'=> 'customers.destroy',
                        'rights'=>'delete'
                    ],
                ],
            ),
            array(
                'name'=>'customer-addresses',
                'actions'=>[
                    [
                        'action_name'=> 'customer-addresses.index',
                        'rights'=>'index'
                    ],
                    [
                        'action_name'=> 'customer-addresses.create',
                        'rights'=>'create'
                    ],
                    [
                        'action_name'=> 'customer-addresses.store',
                        'rights'=>'create'
                    ],
                    [
                        'action_name'=> 'customer-addresses.edit',
                        'rights'=>'update'
                    ],
                    [
                        'action_name'=> 'customer-addresses.update',
                        'rights'=>'update'
                    ],
                    [
                        'action_name'=> 'customer-addresses.destroy',
                        'rights'=>'delete'
                    ],
                ],
            ),
            array(
                'name'=>'customer-phones',
                'actions'=>[
                    [
                        'action_name'=> 'customer-phones.index',
                        'rights'=>'index'
                    ],
                    [
                        'action_name'=> 'customer-phones.create',
                        'rights'=>'create'
                    ],
                    [
                        'action_name'=> 'customer-phones.store',
                        'rights'=>'create'
                    ],
                    [
                        'action_name'=> 'customer-phones.edit',
                        'rights'=>'update'
                    ],
                    [
                        'action_name'=> 'customer-phones.update',
                        'rights'=>'update'
                    ],
                    [
                        'action_name'=> 'customer-phones.destroy',
                        'rights'=>'delete'
                    ],
                ],
            ),
            array(
                'name'=>'crop-commodity-types',
                'actions'=>[
                    [
                        'action_name'=> 'crop-commodity-types.index',
                        'rights'=>'index'
                    ],
                    [
                        'action_name'=> 'crop-commodity-types.create',
                        'rights'=>'create'
                    ],
                    [
                        'action_name'=> 'crop-commodity-types.store',
                        'rights'=>'create'
                    ],
                    [
                        'action_name'=> 'crop-commodity-types.edit',
                        'rights'=>'update'
                    ],
                    [
                        'action_name'=> 'crop-commodity-types.update',
                        'rights'=>'update'
                    ],
                    [
                        'action_name'=> 'crop-commodity-types.destroy',
                        'rights'=>'delete'
                    ],
                ],
            ),
            array(
                'name'=>'crop-commodities',
                'actions'=>[
                    [
                        'action_name'=> 'crop-commodities.index',
                        'rights'=>'index'
                    ],
                    [
                        'action_name'=> 'crop-commodities.create',
                        'rights'=>'create'
                    ],
                    [
                        'action_name'=> 'crop-commodities.store',
                        'rights'=>'create'
                    ],
                    [
                        'action_name'=> 'crop-commodities.edit',
                        'rights'=>'update'
                    ],
                    [
                        'action_name'=> 'crop-commodities.update',
                        'rights'=>'update'
                    ],
                    [
                        'action_name'=> 'crop-commodities.destroy',
                        'rights'=>'delete'
                    ],
                ],
            ),
            array(
                'name'=>'crop-commodity-varieties',
                'actions'=>[
                    [
                        'action_name'=> 'crop-commodity-varieties.index',
                        'rights'=>'index'
                    ],
                    [
                        'action_name'=> 'crop-commodity-varieties.create',
                        'rights'=>'create'
                    ],
                    [
                        'action_name'=> 'crop-commodity-varieties.store',
                        'rights'=>'create'
                    ],
                    [
                        'action_name'=> 'crop-commodity-varieties.edit',
                        'rights'=>'update'
                    ],
                    [
                        'action_name'=> 'crop-commodity-varieties.update',
                        'rights'=>'update'
                    ],
                    [
                        'action_name'=> 'crop-commodity-varieties.destroy',
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
