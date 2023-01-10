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

class CropLocationBlock extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $table = 'crop_location_blocks';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'crop_location_id',
        'crop_commodity_id',
        'name',
        'acres',
        'year_planted',
        'plant_feet_spacing_in_rows',
        'plant_feet_between_rows',
        'description',
    ];

    protected $dates = ['deleted_at'];
    
    protected $appends=['crop_location_name','crop_commodity_name'];
    public function getCropLocationNameAttribute()
    {
        if($this->crop_location_id!=null)
        {
            $CropLocation=CropLocation::where('id',$this->crop_location_id)->first();
            if($CropLocation!=null)
            {
                return $CropLocation->name;
            }
        }
        return '';
    }
    public function getCropCommodityNameAttribute()
    {
        if($this->crop_commodity_id!=null)
        {
            $CropCommodity=CropCommodity::where('id',$this->crop_commodity_id)->first();
            if($CropCommodity!=null)
            {
                return $CropCommodity->name;
            }
        }
        return '';
    }
}
