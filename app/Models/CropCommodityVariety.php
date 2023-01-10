<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Auth, DB; 
use Illuminate\Database\Eloquent\SoftDeletes;

class CropCommodityVariety extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $table = 'crop_commodity_varieties';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'crop_commodity_id',
        'name',
    ];

    protected $dates = ['deleted_at'];

    protected $appends=['crop_commodity_name'];

    public function getCropCommodityNameAttribute()
    {
        if($this->crop_commodity_id!=null)
        {
            $crop_commodity=CropCommodity::where('id',$this->crop_commodity_id)->first();
            if($crop_commodity!=null)
            {
                return $crop_commodity->name;
            }
        }
        return '';
    }

}
