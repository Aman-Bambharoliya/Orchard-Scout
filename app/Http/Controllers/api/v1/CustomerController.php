<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\CropCommodity;
use App\Models\CropCommodityType;
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

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllCustomers(Request $request)
    {
        $customer_query = Customer::where('is_prospect', false)->orderBy('id', 'DESC');
        $customer = $customer_query->get()->makeHidden(['deleted_at', 'created_at', 'updated_at']);
        $customers = array();
        $prospect_query = Customer::where('is_prospect', true)->orderBy('id', 'DESC');
        $prospect_customer = $prospect_query->get()->makeHidden(['deleted_at', 'created_at', 'updated_at']);
        $prospect_customers = array();
        if ($customer->isNotEmpty() && !is_null($customer) && count($customer) > 0) {
            $customers = $customer;
        }
        if ($prospect_customer->isNotEmpty() && !is_null($prospect_customer) && count($prospect_customer) > 0) {
            $prospect_customers = $prospect_customer;
        }
        if (!empty($customers) || !empty($prospect_customers)) {
            $data=['customers' => $customers, 'prospect_customers' => $prospect_customers];
            return response()->json([
                'status' => 1,
                'data' => $data,
                'message' => "Success...!!",
            ]);
        }
        else
        {
            return response()->json([
                'status' => -1,
                'data' => [],
                'message' => trans('translation.not_found',['name' => 'Data']),
            ]);
        }
    }
    public function getAddressByCustomerId(Request $request,$customer_id)
    {
        $customer_addresses = CustomerAddress::with('hasAddress')->where('customer_id', $customer_id)->get();
        if ($customer_addresses->isNotEmpty() && count($customer_addresses) > 0 && !empty($customer_addresses)) {
            return response()->json([
                        'status' => 1,
                        'data' => $customer_addresses,
                        'message' => "Success...!!",
                    ]);
        } else {
                return response()->json([
                'status' => -1,
                'data' => [],
                'message' => trans('translation.not_found',['name' => 'Addresses']),
            ]);
        }
    }
    public function getCropLocationByCustomerId(Request $request,$customer_id)
    {
        $customer_crop_locations = CropLocation::where('customer_id', $customer_id)->get();
        if ($customer_crop_locations->isNotEmpty() && count($customer_crop_locations) > 0 && !empty($customer_crop_locations)) {
            return response()->json([
                        'status' => 1,
                        'data' => $customer_crop_locations,
                        'message' => "Success...!!",
                    ]);
        } else {
                return response()->json([
                'status' => -1,
                'data' => [],
                'message' => trans('translation.not_found',['name' => 'Crop Location']),
            ]);
        }
    }
    public function getCropLocationBlocksByCropLocationId(Request $request,$crop_location_id)
    {
        $CropLocationBlock = CropLocationBlock::where('crop_location_id', $crop_location_id)->get();
        if ($CropLocationBlock->isNotEmpty() && count($CropLocationBlock) > 0 && !empty($CropLocationBlock)) {
            return response()->json([
                        'status' => 1,
                        'data' => $CropLocationBlock,
                        'message' => "Success...!!",
                    ]);
        } else {
                return response()->json([
                'status' => -1,
                'data' => [],
                'message' => trans('translation.not_found',['name' => 'Crop Location Block']),
            ]);
        }
    }
}
