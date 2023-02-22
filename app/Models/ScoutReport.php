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
    protected $appends = ['has_crop_location_blocks', 'has_crop_commodities','date_formatted'];

    public function hasCustomer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }
    public function hasCropLocation()
    {
        return $this->belongsTo(CropLocation::class, 'crop_location_id', 'id');
    }
    public function hasCropCommodity()
    {
        return $this->belongsTo(CropCommodity::class, 'crop_commodity_id', 'id');
    }
    public function getHasCropLocationBlocksAttribute()
    {
        $crop_bname = [];
        if ($this->crop_location_blocks != null && $this->crop_location_blocks != '') {
            $crop_location_blocks = $this->crop_location_blocks;
            $crop_location_blocks = json_decode($crop_location_blocks);

            if (!empty($crop_location_blocks)) {
                foreach ($crop_location_blocks as $vt) {
                    $CropLocationBlock = CropLocationBlock::where('id', $vt)->first();
                    if ($CropLocationBlock != '' && $CropLocationBlock != null) {
                        $crop_bname[] = $CropLocationBlock;
                    }
                }
            }
            return $crop_bname;
        } else {
            return $crop_bname;
        }
    }
    public function getHasCropCommoditiesAttribute()
    {
        $commodity_bname = [];
        if ($this->crop_commodity_ids != null && $this->crop_commodity_ids != '') {
            $crop_commodity_ids = $this->crop_commodity_ids;
            $crop_commodity_ids = json_decode($crop_commodity_ids);

            if (!empty($crop_commodity_ids)) {
                foreach ($crop_commodity_ids as $vt) {
                    $CropCommodity = CropCommodity::where('id', $vt)->first();
                    if ($CropCommodity != '' && $CropCommodity != null) {
                        $commodity_bname[] = $CropCommodity;
                    }
                }
            }
            return $commodity_bname;
        } else {
            return $commodity_bname;
        }
    }
    public function getDateFormattedAttribute()
    {
        if ($this->date != '' && $this->date != null) {
            return date('m/d/Y', strtotime($this->date));
        }
        return $this->date;
    }
}
