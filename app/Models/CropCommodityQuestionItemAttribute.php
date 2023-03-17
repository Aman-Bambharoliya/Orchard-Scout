<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class CropCommodityQuestionItemAttribute extends Model
{
    use HasFactory , HasFactory, Notifiable;

    protected $table = 'crop_commodity_question_item_attributes';

    protected $fillable = [
        'crop_commodity_id',
        'question_item_attribute_id'
    ];
}
