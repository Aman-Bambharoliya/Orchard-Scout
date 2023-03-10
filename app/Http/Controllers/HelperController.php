<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CropCommodityVariety;
use App\Models\CropLocation;
use App\Models\CropLocationBlock;
use App\Models\Customer;
use App\Models\CustomerAddress;
use Illuminate\Http\Request;
use DataTables;
use Hash;
use Arr, Str;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Validator;

class HelperController extends Controller
{
    public function getCustomerAddressesById($id)
    {
        $customer_addresses = CustomerAddress::with('hasAddress')->where('customer_id', $id)->get();
        if (count($customer_addresses) > 0 && !empty($customer_addresses)) {
            $address_box = '<option value="">Select address</option>';
            foreach ($customer_addresses as $address) {
                $address_box .= '<option value="' . $address->address_id . '">' . $address->address_type_name . ' ' . $address->hasAddress->address_1 . '</option>';
            }
            echo json_encode(array('status' => 1, 'data' => $address_box));
        } else {
            echo json_encode(array('status' => 0, 'data' => null));
        }
    }
    public function getCustomerCropLocationById($id)
    {
        $CropLocation = CropLocation::where('customer_id', $id)->get();
        if (count($CropLocation) > 0 && !empty($CropLocation)) {
            $crop_location_box = '<option value="">Select Crop Location</option>';
            foreach ($CropLocation as $crop) {
                $crop_location_box .= '<option value="' . $crop->id . '">' . $crop->name . '</option>';
            }
            echo json_encode(array('status' => 1, 'data' => $crop_location_box));
        } else {
            echo json_encode(array('status' => 0, 'data' => null));
        }
    }
    public function getCropLocationBlockById($id)
    {
        $CropLocationBlock = CropLocationBlock::where('crop_location_id', $id)->get();
        if (count($CropLocationBlock) > 0 && !empty($CropLocationBlock)) {
            $crop_location_block_box = '<option value="">Select Crop Location Block</option>';
            foreach ($CropLocationBlock as $block) {
                $crop_location_block_box .= '<option value="' . $block->id . '">' . $block->name . '</option>';
            }
            echo json_encode(array('status' => 1, 'data' => $crop_location_block_box));
        } else {
            echo json_encode(array('status' => 0, 'data' => null));
        }
    }
    public function getCropCommodities($id)
    {
        $cropCommoditiyVarities = CropCommodityVariety::where('crop_commodity_id', $id)->get();
        if (count($cropCommoditiyVarities) > 0 && !empty($cropCommoditiyVarities)) {
            $crop_commodity_verity = '<option value="">Select Crop Commodity Verities</option>';
            foreach ($cropCommoditiyVarities as $verity) {
                $crop_commodity_verity .= '<option value="' . $verity->id . '">' . $verity->name . '</option>';
            }
            echo json_encode(array('status' => 1, 'data' => $crop_commodity_verity));
        } else {
            echo json_encode(array('status' => 0, 'data' => null));
        }
    }
}
