<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CropLocationBlockCommodityVariety extends Model
{
    use HasFactory;

    protected $table='crop_location_block_commodity_varieties';

    protected $fillable= [
        'crop_location_block_id',
        'crop_commodities_verity_id'
    ];
}
