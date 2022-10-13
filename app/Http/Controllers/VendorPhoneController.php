<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Phone;
use App\Models\PhoneType;
use App\Models\Vendor;
use App\Models\VendorPhone;
use DataTables;
use Auth;

class VendorPhoneController extends Controller
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
            $query = VendorPhone::with('hasPhone')->where('vendor_id', $vendor_id);
            $data = $query->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (VendorPhone $data) {
                    $user_data = Auth::user();
                    $actionBtn = '';
                    $edit_button = '';
                    $delete_button = '';
                    if ($user_data->hasPermission('vendor-phones', 'update')) {
                        $edit_button .= '<a href="' . route('vendor-phones.edit', $data->id) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                        </svg>
                    </span>
                </a>';
                    }
                    if ($user_data->hasPermission('vendor-phones', 'delete')) {
                        $delete_button .= '<a href="#" data-id="' . route('vendor-phones.destroy', $data->id) . '" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1 delete_record">
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
                        </svg>
                    </span>
                </a>';
                    }
                    return $edit_button . " " . $delete_button;
                })->editColumn('country_code', function (VendorPhone $data) {
                    return $data->hasPhone->country_code;
                })->editColumn('area_code', function (VendorPhone $data) {
                    return $data->hasPhone->area_code;
                })->editColumn('prefix', function (VendorPhone $data) {
                    return $data->hasPhone->prefix;
                })->editColumn('number', function (VendorPhone $data) {
                    return $data->hasPhone->number;
                })->editColumn('extension', function (VendorPhone $data) {
                    return $data->hasPhone->extension;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('vendor-phones.index', compact('vendor_id'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request, $vendor_id)
    {
        $vendor = Vendor::findOrFail($vendor_id);
        $PhoneTypes = PhoneType::all();
        return view('vendor-phones.create', compact('PhoneTypes', 'vendor_id'));
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
                'phone_type_id' => 'required|exists:App\Models\PhoneType,id',
                'country_code' => 'required|numeric|max:2147483647',
                'area_code' => 'required|numeric|max:2147483647',
                'prefix' => 'nullable|numeric|max:2147483647',
                'number' => 'required|numeric|max:2147483647',
                'extension' => 'nullable|numeric|max:2147483647',
            ],
            [
                'vendor_id.required' => trans('translation.required', ['name' => 'vendor id']),
                'phone_type_id.required' => trans('translation.required', ['name' => 'phone type']),
                'country_code.required' => trans('translation.required', ['name' => 'country code']),
                'area_code.required' => trans('translation.required', ['name' => 'area code']),
                'prefix.required' => trans('translation.required', ['name' => 'prefix']),
                'number.required' => trans('translation.required', ['name' => 'number']),
                'extension.required' => trans('translation.required', ['name' => 'extension']),
                'country_code.max' => trans('translation.max_number', ['name' => 'country code']),
                'area_code.max' => trans('translation.max_number', ['name' => 'area code']),
                'prefix.max' => trans('translation.max_number', ['name' => 'prefix']),
                'number.max' => trans('translation.max_number', ['name' => 'number']),
                'extension.max' => trans('translation.max_number', ['name' => 'extension']),
            ]
        );
        $input = $request->all();
        $result = Phone::create($input);
        if ($result) {
            $phone_id = $result->id;
            $input['phone_id'] = $phone_id;
            $VendorPhone = VendorPhone::create($input);
            if ($VendorPhone) {
                return redirect()->route('vendor-phones.index', $request->vendor_id)
                    ->with('success', trans('translation.created', ['name' => 'vendor phone']));
            } else {
                Phone::find($result->id)->delete();
                return redirect()->route('vendor-phones.index', $request->vendor_id)
                    ->with('error', trans('translation.error'));
            }
        } else {
            return redirect()->route('vendor-phones.index', $request->vendor_id)
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
        $PhoneTypes = PhoneType::all();
        $data = VendorPhone::with('hasPhone')->findOrFail($id);
        return view('vendor-phones.edit', compact('data', 'PhoneTypes'));
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
                'phone_type_id' => 'required|exists:App\Models\PhoneType,id',
                'country_code' => 'required|numeric|max:2147483647',
                'area_code' => 'required|numeric|max:2147483647',
                'prefix' => 'nullable|numeric|max:2147483647',
                'number' => 'required|numeric|max:2147483647',
                'extension' => 'nullable|numeric|max:2147483647',
            ],
            [
                'vendor_id.required' => trans('translation.required', ['name' => 'vendor id']),
                'phone_type_id.required' => trans('translation.required', ['name' => 'phone type']),
                'country_code.required' => trans('translation.required', ['name' => 'country code']),
                'area_code.required' => trans('translation.required', ['name' => 'area code']),
                'prefix.required' => trans('translation.required', ['name' => 'prefix']),
                'number.required' => trans('translation.required', ['name' => 'number']),
                'extension.required' => trans('translation.required', ['name' => 'extension']),
                'country_code.max' => trans('translation.max_number', ['name' => 'country code']),
                'area_code.max' => trans('translation.max_number', ['name' => 'area code']),
                'prefix.max' => trans('translation.max_number', ['name' => 'prefix']),
                'number.max' => trans('translation.max_number', ['name' => 'number']),
                'extension.max' => trans('translation.max_number', ['name' => 'extension']),
            ]
        );
        $input = $request->all();
        $data = VendorPhone::find($id);
        $result =  $data->update($input);
        if ($result) {
            $data->hasPhone->country_code = $request->country_code;
            $data->hasPhone->area_code = $request->area_code;
            $data->hasPhone->prefix = $request->prefix;
            $data->hasPhone->number = $request->number;
            $data->hasPhone->extension = $request->extension;
            $data->hasPhone->save();
            return redirect()->route('vendor-phones.index', $request->vendor_id)
                ->with('success', trans('translation.updated', ['name' => 'phone']));
        } else {
            return redirect()->route('vendor-phones.index', $request->vendor_id)
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
        $VendorPhone =  VendorPhone::findOrFail($id);
        $phone_id = $VendorPhone->phone_id;
        $delete = $VendorPhone->delete();
        $delete_phone = Phone::find($phone_id)->delete();
        if ($delete && $delete_phone) {
            if ($request->submit_type == 'ajax') {
                return response()->json([
                    'result' => 'success',
                    'status' => 1,
                    'message' => trans('translation.deleted', ['name' => 'phone'])
                ]);
            } else {
                return redirect()->route('vendors.index')
                    ->with('success', trans('translation.deleted', ['name' => 'phone']));
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
}
