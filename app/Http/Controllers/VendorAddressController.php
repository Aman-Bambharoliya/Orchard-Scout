<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\AddressType;
use App\Models\Vendor;
use App\Models\VendorAddress;
use Illuminate\Http\Request;
use DataTables;
use Hash;
use Arr, Str;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Validator;

class VendorAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $vendor_id)
    {
        Vendor::findOrFail($vendor_id);
        if ($request->ajax()) {
            $query = VendorAddress::with('hasAddress')->where('vendor_id', $vendor_id);

            if ($request->get('is_deleted_at') != '' && $request->get('is_deleted_at')!=null) {
              
                if($request->get('is_deleted_at')=='true'){                   
                    $query = $query->withTrashed();
                    $query = $query->with('hasAddress', function ($query) {
                        $query->withTrashed();
                    });
                    $query = $query->whereHas('hasAddress', function($q) {
                        // Query the name field in status table
                        $q->withTrashed(); // '=' is optional
                    });
                }
            } 

            $data = $query->get();
            return Datatables::of($data)
                ->addColumn('action', function (VendorAddress $data) {
                    $user_data = Auth::user();
                    $actionBtn = '';
                    $edit_button = '';
                    $delete_button = '';
                    if ($user_data->hasPermission('vendor-addresses', 'update')) {
                        $edit_button .= '<a href="' . route('vendor-addresses.edit', $data->id) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                                    <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                                </svg>
                            </span>
                        </a>';
                    }
                    if ($user_data->hasPermission('vendor-addresses', 'delete')) {
                        if(is_null($data->deleted_at)){
                        $delete_button .= '<a href="#" data-id="' . route('vendor-addresses.destroy', $data->id) . '" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1 delete_record">
                            <span class="svg-icon svg-icon-3">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
                                    <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
                                    <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
                                </svg>
                            </span>
                        </a>';
                    }else{
                        $delete_button = '<a title="UnDelete" href="#" data-id="' . route('vendor-addresses.undelete', $data->id) . '" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1 delete_request">
                       <span class="svg-icon svg-icon-3"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                       <path d="M14.5 20.7259C14.6 21.2259 14.2 21.826 13.7 21.926C13.2 22.026 12.6 22.0259 12.1 22.0259C9.5 22.0259 6.9 21.0259 5 19.1259C1.4 15.5259 1.09998 9.72592 4.29998 5.82592L5.70001 7.22595C3.30001 10.3259 3.59999 14.8259 6.39999 17.7259C8.19999 19.5259 10.8 20.426 13.4 19.926C13.9 19.826 14.4 20.2259 14.5 20.7259ZM18.4 16.8259L19.8 18.2259C22.9 14.3259 22.7 8.52593 19 4.92593C16.7 2.62593 13.5 1.62594 10.3 2.12594C9.79998 2.22594 9.4 2.72595 9.5 3.22595C9.6 3.72595 10.1 4.12594 10.6 4.02594C13.1 3.62594 15.7 4.42595 17.6 6.22595C20.5 9.22595 20.7 13.7259 18.4 16.8259Z" fill="currentColor"/>
                       <path opacity="0.3" d="M2 3.62592H7C7.6 3.62592 8 4.02592 8 4.62592V9.62589L2 3.62592ZM16 14.4259V19.4259C16 20.0259 16.4 20.4259 17 20.4259H22L16 14.4259Z" fill="currentColor"/>
                       </svg></span>
                       </a>';
                      }
                    }
                    return $edit_button . " " . $delete_button;
                })->editColumn('address_type', function (VendorAddress $data) {
                    return $data->address_type_id;
                })->editColumn('address_1', function (VendorAddress $data) {
                    return $data->hasAddress->address_1;
                })->editColumn('address_2', function (VendorAddress $data) {
                    return $data->hasAddress->address_2;
                })->editColumn('city', function (VendorAddress $data) {
                    return $data->hasAddress->city;
                })->editColumn('state', function (VendorAddress $data) {
                    return $data->hasAddress->state;
                })->editColumn('zip', function (VendorAddress $data) {
                    return $data->hasAddress->zip;
                })->editColumn('zip_plus4', function (VendorAddress $data) {
                    return $data->hasAddress->zip_plus4;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('vendor-addresses.index', compact('vendor_id'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $vendor_id)
    {
        $vendor = Vendor::findOrFail($vendor_id);
        $AddressTypes = AddressType::all();
        return view('vendor-addresses.create', compact('AddressTypes', 'vendor_id'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate(
            $request,
            [
                'vendor_id' => 'required|exists:App\Models\Vendor,id',
                'address_type_id' => 'required|exists:App\Models\AddressType,id',
                'address_1' => 'required|string|max:32',
                'address_2' => 'nullable|string|max:32',
                'city' => 'required|string|max:32',
                'state' => 'required|string|max:32',
                'zip' => 'required|integer|max:2147483647',
                'zip_plus4' => 'required|integer|max:2147483647',
            ],
            [
                'vendor_id.required' => trans('translation.required', ['name' => 'vendor id']),
                'address_type_id.required' => trans('translation.required', ['name' => 'address type']),
                'address_1.required' => trans('translation.required', ['name' => 'address line 1']),
                'city.required' => trans('translation.required', ['name' => 'city']),
                'state.required' => trans('translation.required', ['name' => 'state']),
                'zip.required' => trans('translation.required', ['name' => 'zip']),
                'zip_plus4.required' => trans('translation.required', ['name' => 'zip+4']),
                'zip_plus4.max' => trans('translation.max_zip', ['name' => 'zip+4']),
                'zip.max' => trans('translation.max_zip', ['name' => 'zip']),
            ]
        );
        $input = $request->all();
        $result = Address::create($input);
        if ($result) {
            $address_id = $result->id;
            $input['address_id'] = $address_id;
            $VendorAddress = VendorAddress::create($input);
            if ($VendorAddress) {
                return redirect()->route('vendor-addresses.index', $request->vendor_id)
                    ->with('success', trans('translation.created', ['name' => 'vendor address']));
            } else {
                Address::find($result->id)->delete();
                return redirect()->route('vendor-addresses.index', $request->vendor_id)
                    ->with('error', trans('translation.error'));
            }
        } else {
            return redirect()->route('vendors.index')
                ->with('error', trans('translation.error'));
        }
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $AddressTypes = AddressType::all();
        $data = VendorAddress::with('hasAddress')->findOrFail($id);
        return view('vendor-addresses.edit', compact('data', 'AddressTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate(
            $request,
            [
                'vendor_id' => 'required|exists:App\Models\Vendor,id',
                'address_type_id' => 'required|exists:App\Models\AddressType,id',
                'address_1' => 'required|string|max:32',
                'address_2' => 'nullable|string|max:32',
                'city' => 'required|string|max:32',
                'state' => 'required|string|max:32',
                'zip' => 'required|integer|max:2147483647',
                'zip_plus4' => 'required|integer|max:2147483647',
            ],
            [
                'vendor_id.required' => trans('translation.required', ['name' => 'vendor id']),
                'address_type_id.required' => trans('translation.required', ['name' => 'address type']),
                'address_1.required' => trans('translation.required', ['name' => 'address line 1']),
                'city.required' => trans('translation.required', ['name' => 'city']),
                'state.required' => trans('translation.required', ['name' => 'state']),
                'zip.required' => trans('translation.required', ['name' => 'zip']),
                'zip_plus4.required' => trans('translation.required', ['name' => 'zip+4']),
                'zip_plus4.max' => trans('translation.max_zip', ['name' => 'zip+4']),
                'zip.max' => trans('translation.max_zip', ['name' => 'zip']),
            ]
        );
        $input = $request->all();
        $data = VendorAddress::find($id);
        $result =  $data->update($input);
        if ($result) {
            $data->hasAddress->address_1 = $request->address_1;
            $data->hasAddress->address_2 = $request->address_2;
            $data->hasAddress->city = $request->city;
            $data->hasAddress->state = $request->state;
            $data->hasAddress->zip = $request->zip;
            $data->hasAddress->zip_plus4 = $request->zip_plus4;
            $data->hasAddress->save();
            return redirect()->route('vendor-addresses.index', $request->vendor_id)
                ->with('success', trans('translation.updated', ['name' => 'vendor']));
        } else {
            return redirect()->route('vendor-addresses.index', $request->vendor_id)
                ->with('error', trans('translation.error'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $VendorAddress =  VendorAddress::findOrFail($id);
        $address_id = $VendorAddress->address_id;
        $delete = $VendorAddress->delete();
        $delete_address = Address::find($address_id)->delete();
        if ($delete && $delete_address) {
            if ($request->submit_type == 'ajax') {
                return response()->json([
                    'result' => 'success',
                    'status' => 1,
                    'message' => trans('translation.deleted', ['name' => 'vendor'])
                ]);
            } else {
                return redirect()->route('vendors.index')
                    ->with('success', trans('translation.deleted', ['name' => 'vendor']));
            }
        } else {
            if ($request->submit_type == 'ajax') {
                return response()->json([
                    'result' => 'fail',
                    'status' => -1,
                    'message' => trans('translation.error')
                ]);
            } else {
                return redirect()->route('vendors.index')
                    ->with('error', trans('translation.error'));
            }
        }
    }

    
    public function undelete($id)
    {
        $delete_request=VendorAddress::where('id', $id)->withTrashed()->restore();

        $VendorAddress =  VendorAddress::findOrFail($id);
        $address_id = $VendorAddress->address_id;
        $restore_address = Address::where('id', $address_id)->withTrashed()->restore();

        if ($restore_address) {
            return response()->json([
                'status' => 1,
                'result' => 'Success',
                'message' => "UnDeleted",
            ]);
        } else {
            return response()->json([
                'status' => -1,
                'result' => 'fail',
                'message' => "Not UnDeleted",
            ]);
        }
    }


}
