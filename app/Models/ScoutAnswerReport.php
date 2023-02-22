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

class ScoutAnswerReport extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    // use SoftDeletes;

    protected $table = 'scout_answer_reports';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'scout_report_id',
        'scout_question_item_id',
        'comment',
    ];

    // protected $dates = ['deleted_at'];

    public function hasScoutAnswerReportItem()
    {
        return $this->hasMany(ScoutAnswerReportItem::class, 'scout_answer_report_id', 'id');
    }
}
