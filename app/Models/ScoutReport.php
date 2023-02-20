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

class ScoutReport extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $table = 'scout_reports';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'customer_id',
        'date',
        'crop_location_id',
        'crop_commodity_ids',
        'general_comments',
        'crop_location_blocks',
        'notes',
        'added_by',
    ];

    protected $dates = ['deleted_at'];

    public function hasCustomer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function hasCropLocation()
    {
        return $this->belongsTo(CropLocation::class,'crop_location_id','id');
    }
    public function hasCropCommodity()
    {
        return $this->belongsTo(CropCommodity::class,'crop_commodity_id','id');
    }
}
