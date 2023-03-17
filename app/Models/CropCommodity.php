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

class CropCommodity extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use SoftDeletes;

    protected $table = 'crop_commodities';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'crop_commodity_type_id',
        'name',
    ];

    protected $dates = ['deleted_at'];
    
    protected $appends=['crop_commodity_type_name'];

    public function getCropCommodityTypeNameAttribute()
    {
        if($this->crop_commodity_type_id!=null)
        {
            $crop_commodity_type=CropCommodityType::where('id',$this->crop_commodity_type_id)->first();
            if($crop_commodity_type!=null)
            {
                return $crop_commodity_type->name;
            }
        }
        return '';
    }

    public function hasCropCommodityQuestionItemAttribute(){
        return $this->hasMany(CropCommodityQuestionItemAttribute::class);
    }
}
