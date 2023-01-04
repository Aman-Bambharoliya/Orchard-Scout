<?php

use App\Models\CropCommodity;
use App\Models\Customer;
use App\Models\ItemOptionAttribute;
use App\Models\ScoutReportCategory;
use App\Models\VehicleType;

    if(!function_exists('getCropCommodities'))
    {
        function getCropCommodities()
        {
            $CropCommodity=CropCommodity::get();
            if(is_null($CropCommodity))
            {
                return null;
            }
            else
            {
                return  $CropCommodity;
            }
        }
    }
    if(!function_exists('getScoutReportCategories'))
    {
        function getScoutReportCategories()
        {
            $ScoutReportCategory=ScoutReportCategory::get();
            if(is_null($ScoutReportCategory))
            {
                return null;
            }
            else
            {
                return $ScoutReportCategory;
            }
        }
    }
?>