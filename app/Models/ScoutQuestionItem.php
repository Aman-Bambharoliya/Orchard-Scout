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

class ScoutQuestionItem extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    // use SoftDeletes;
// 
    protected $table = 'scout_question_items';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'scout_report_id',
        'scout_report_category_id',
        'commodity_id',
        'position',
        'status',
    ];

    public function getScoutItemOptionAttributes()
    {
        return $this->hasMany(ScoutQuestionItemAttribute::class,'scout_question_item_id','id')->orderBy('id');
    }
    public function hasScoutReportCategory()
    {
        return $this->hasOne(ScoutReportCategory::class,'id','scout_report_category_id');
    }
    // protected $dates = ['deleted_at'];
}
