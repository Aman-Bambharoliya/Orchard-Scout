<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'question_items';

    protected $fillable = [
        'scout_report_category_id',        
        'position',
        'status',
    ];

    protected $dates = ['deleted_at'];

    protected $appends=[
        'scout_report_category_name',
    ];

    public function getScoutReportCategoryNameAttribute()
    {
       if($this->scout_report_category_id!='' && $this->scout_report_category_id!=null)
       {
             $ScoutReportCategory=ScoutReportCategory::find($this->scout_report_category_id);   
             if($ScoutReportCategory)
             {
                 return $ScoutReportCategory->name;
             }
             return '';
       }
       return '';
    }

    // public function getCommodityIdAttribute()
    // {
    //    if($this->getItemOptionAttributes->id!='' && $this->getItemOptionAttributes!=null)
    //    {
    //          $commodity_find=CropCommodityQuestionItemAttribute::where('question_item_attribute_id',$this->getItemOptionAttributes->id);

    //          return $commodity_find;
    //    }
    //    return '';
    // }


    public function getItemOptionAttributes()
    {
        return $this->hasMany(QuestionItemAttribute::class,'question_item_id','id')->orderBy('id');
    }
    
}
