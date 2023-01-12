<?php

namespace App\Http\Controllers\api\v1;

use App\Http\Controllers\Controller;
use App\Models\CropCommodity;
use App\Models\CropCommodityType;
use Illuminate\Http\Request;
use DataTables;
use Hash;
use Arr, Str;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Validator;

class CropCommodityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
       
            $query = CropCommodity::orderBy('id', 'DESC');
            $data = $query->get();
          
            if (!is_null($data) && count($data) > 0) {
              
                return response()->json([
                    'status' => 1,
                    'data' => $data,
                    'message' => "Success...!!",
                ]);
            } else {
                return response()->json([
                    'status' => -1,
                    'data' => [],
                    'message' => "Not Created",
                ]);
            }


       }
}
