<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuleAction extends Model
{
    use HasFactory;
    protected $appends=['module_name'];
    public function hasModule()
    {
        return $this->belongsTo(Module::class,'module_id', 'id');
    }
    
    public function getModuleNameAttribute()
    {
        $module_id=$this->module_id;
        $module=Module::where('id',$module_id)->first();
        if($module!=null)
        {
            return $module->name;
        }
        return '';
    }
}
