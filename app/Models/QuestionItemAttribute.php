<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QuestionItemAttribute extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'label',
        'question_item_id',
    ];

    protected $dates = ['deleted_at'];

    // public $appends=[
    //     'commodity_id',
    // ];


    // public function getCommodityIdAttribute()
    // {
    //    if($this->id!='' && $this->id!=null)
    //    {
    //          $commodity_find=CropCommodityQuestionItemAttribute::where('question_item_attribute_id',$this->id)->first();
    //          return $commodity_find;
    //    }
    //    return '';
    // }

    public function getCommodityIds(){
        return $this->hasMany(CropCommodityQuestionItemAttribute::class,'question_item_attribute_id','id');
    }


}

