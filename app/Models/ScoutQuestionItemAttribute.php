<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Auth, DB; 
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class ScoutQuestionItemAttribute extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    // use SoftDeletes;

    protected $table = 'scout_question_item_attributes';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'scout_question_item_id',
        'label',
    ];

    // protected $dates = ['deleted_at'];
}
