<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Models\AddressType;
use Illuminate\Http\Request;
use App\Models\People;
use App\Models\PeopleAddress;
use DataTables;
use Hash;
use Arr, Str;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Validator;

class PeopleAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request,$people_id)
    {
        People::findOrFail($people_id);
        if ($request->ajax()) {
            $query =PeopleAddress::with('hasAddress')->where('people_id',$people_id);
            $data = $query->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (PeopleAddress $data) {
                    $user_data = Auth::user();
                    $actionBtn = '';
                    $edit_button = '';
                    $delete_button = '';
                    if ($user_data->hasPermission('people-addresses', 'update')) {
                        $edit_button .= '<div class="menu-item px-1">
                                <a href="' . route('people-addresses.edit', $data->id) . '" class="menu-link px-3">Edit</a>
                            </div>';
                    }
                    if ($user_data->hasPermission('people-addresses', 'delete')) {
                        $delete_button .= '<div class="menu-item px-1">
                        <a href="#" data-id="' . route('people-addresses.destroy', $data->id) . '" class="menu-link px-3 delete_record">Delete</a>
                          </div>';
                    }
                    return '<div class="btn-group">
                                <button data-bs-toggle="dropdown" class="btn btn-sm btn-light btn-active-light-primary" aria-expanded="false">Action
                                    <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                    </svg>
                                    </span>
                                </button>
                                <div class="dropdown-menu menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary menu menu-sub menu-sub-dropdown fw-bold fs-7 pt-1 pb-1" x-placement="top-start" style="position: absolute; top: -2px; left: 0px; will-change: top, left;">
                                   '.$edit_button . " " . $delete_button.'
                                </div>
                            </div>';
                })->editColumn('address_type',function(PeopleAddress $data){
                    return $data->address_type_id;
                })->editColumn('address_1',function(PeopleAddress $data){
                    return $data->hasAddress->address_1;
                })->editColumn('address_2',function(PeopleAddress $data){
                    return $data->hasAddress->address_2;
                })->editColumn('city',function(PeopleAddress $data){
                    return $data->hasAddress->city;
                })->editColumn('state',function(PeopleAddress $data){
                    return $data->hasAddress->state;
                })->editColumn('zip',function(PeopleAddress $data){
                    return $data->hasAddress->zip;
                })->editColumn('zip_plus4',function(PeopleAddress $data){
                    return $data->hasAddress->zip_plus4;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('people-addresses.index',compact('people_id'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request,$people_id)
    {
        $people=People::findOrFail($people_id);
        $AddressTypes=AddressType::all();
        return view('people-addresses.create',compact('AddressTypes','people_id'));
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
                'people_id' => 'required|exists:App\Models\People,id',
                'address_type_id' => 'required|exists:App\Models\AddressType,id',
                'address_1' => 'required|string|max:32',
                'address_2' => 'nullable|string|max:32',
                'city' => 'required|string|max:32',
                'state' => 'required|string|max:32',
                'zip' => 'required|integer|max:2147483647',
                'zip_plus4' => 'required|integer|max:2147483647',
            ],
            [
                'people_id.required' => trans('translation.required', ['name' => 'people id']),
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
            $address_id=$result->id;
            $input['address_id']=$address_id;
            $PeopleAddress=PeopleAddress::create($input);
            if($PeopleAddress)
            {
                return redirect()->route('people-addresses.index',$request->people_id)
                ->with('success', trans('translation.created', ['name' => 'people address']));
            }
            else
            {
                Address::find($result->id)->delete();
                return redirect()->route('people-addresses.index',$request->people_id)
                ->with('error', trans('translation.error'));
            }
            
        } else {
            return redirect()->route('peoples.index')
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
        $AddressTypes=AddressType::all();
        $data = PeopleAddress::with('hasAddress')->findOrFail($id);
        return view('people-addresses.edit', compact('data','AddressTypes'));
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
                'people_id' => 'required|exists:App\Models\People,id',
                'address_type_id' => 'required|exists:App\Models\AddressType,id',
                'address_1' => 'required|string|max:32',
                'address_2' => 'nullable|string|max:32',
                'city' => 'required|string|max:32',
                'state' => 'required|string|max:32',
                'zip' => 'required|integer|max:2147483647',
                'zip_plus4' => 'required|integer|max:2147483647',
            ],
            [
                'people_id.required' => trans('translation.required', ['name' => 'people id']),
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
        $data = PeopleAddress::find($id);
        $result =  $data->update($input);
        if ($result) {
            $data->hasAddress->address_1=$request->address_1;
            $data->hasAddress->address_2=$request->address_2;
            $data->hasAddress->city=$request->city;
            $data->hasAddress->state=$request->state;
            $data->hasAddress->zip=$request->zip;
            $data->hasAddress->zip_plus4=$request->zip_plus4;
            $data->hasAddress->save();
            return redirect()->route('people-addresses.index',$request->people_id)
                ->with('success', trans('translation.updated', ['name' => 'people']));
        } else {
            return redirect()->route('people-addresses.index',$request->people_id)
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
        $PeopleAddress =  PeopleAddress::findOrFail($id);
        $address_id=$PeopleAddress->address_id;
        $delete=$PeopleAddress->delete();
        $delete_address=Address::find($address_id)->delete();
        if ($delete && $delete_address) {
            if ($request->submit_type == 'ajax') {
                return response()->json([
                    'result' => 'success',
                    'status' => 1,
                    'message' => trans('translation.deleted', ['name' => 'people'])
                ]);
            } else {
                return redirect()->route('peoples.index')
                    ->with('success', trans('translation.deleted', ['name' => 'people']));
            }
        } else {
            if ($request->submit_type == 'ajax') {
                return response()->json([
                    'result' => 'fail',
                    'status' => -1,
                    'message' => trans('translation.error')
                ]);
            } else {
                return redirect()->route('peoples.index')
                    ->with('error', trans('translation.error'));
            }
        }
    }
}
