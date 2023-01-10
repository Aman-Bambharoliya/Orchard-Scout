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

}
