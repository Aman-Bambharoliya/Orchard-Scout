<?php

namespace App\Models;

use Auth, DB; 
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

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
    
    protected $appends=['crop_location_name','crop_commodity_name','crop_commodity_variety_name'];
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
    public function getCropCommodityVarietyNameAttribute()
    {
        if($this->crop_commodity_id!=null)
        {   $CropCommodityVarietiesIds=CropLocationBlockCommodityVariety::where('crop_location_block_id',$this->id)->get('crop_commidties_verity_id')->toarray();
            // return $CropCommodityVarietiesIds;

                $CropCommodityVarieties=CropCommodityVariety::whereIn('id',$CropCommodityVarietiesIds)->get('name')->toArray();
                if($CropCommodityVarieties!=null)
                {
                        return array_column($CropCommodityVarieties,'name');
                    }else{
                        return null;
                    }
        }
        return null;
    }
}
