<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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
}
