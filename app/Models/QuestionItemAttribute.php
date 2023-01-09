<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuestionItemAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'label',
        'question_item_id',
    ];

}
