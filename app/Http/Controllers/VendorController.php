<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vendor;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Vendor::query();

            if ($request->get('is_deleted_at') != '' && $request->get('is_deleted_at')!=null) {
              
                if($request->get('is_deleted_at')=='true'){                   
                    $query = $query->withTrashed();
                }
            } 

            $data = $query->get();
            return Datatables::of($data)
                ->addColumn('action', function (Vendor $data) {
                    $user_data = Auth::user();
                    $actionBtn = '';
                    $edit_button = '';
                    $delete_button = '';
                    $address_list_btn = '';
                    $phone_list_btn = '';
                    $people_list_btn = '';
                    if ($user_data->hasPermission('vendors', 'update')) {
                        $edit_button .= '<div class="menu-item  px-3">
                                <a href="' . route('vendors.edit', $data->id) . '" class="menu-link px-3">Edit</a>
                            </div>';
                    }
                    if ($user_data->hasPermission('vendors', 'delete')) {
                        if(is_null($data->deleted_at)){
                        $delete_button .= '<div class="menu-item  px-3">
                    <a href="#" data-id="' . route('vendors.destroy', $data->id) . '" class="menu-link px-3 delete_record">Delete</a>
                </div>';
            }else{
        
                $delete_button .= '<div class="menu-item  px-3">
                <a href="#" data-id="' . route('vendors.undelete', $data->id) . '" class="menu-link px-3 delete_request">UnDelete</a>
            </div>';
               }
                    }
                    if ($user_data->hasPermission('vendor-addresses', 'index')) {
                        $address_list_btn .= ' <div class="menu-item  px-3">
                    <a href="' . route('vendor-addresses.index', $data->id) . '" class="menu-link px-3">Address List</a>
                    </div>';
                    }
                    if ($user_data->hasPermission('vendor-phones', 'index')) {
                        $phone_list_btn .= ' <div class="menu-item  px-3">
                        <a href="' . route('vendor-phones.index', $data->id) . '" class="menu-link px-3">Phone List</a>
                        </div>';
                    }
                    if ($user_data->hasPermission('vendor-peoples', 'index')) {
                        $people_list_btn .= ' <div class="menu-item  px-3">
                        <a href="' . route('vendor-peoples.index', $data->id) . '" class="menu-link px-3">People List</a>
                        </div>';
                    }
                    return '<div class="btn-group"><a href="#" data-bs-toggle="dropdown" class="btn btn-sm btn-light btn-active-light-primary dropdown-toggle" aria-expanded="false">Actions
                            <span class="svg-icon svg-icon-5 m-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor"></path>
                                </svg>
                            </span>
                        </a>
                        <div class="dropdown-menu menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4"  x-placement="bottom-start" style="position: absolute; top: 29px; left: 0px; will-change: top, left;">
                            ' . $edit_button . " " . $delete_button . ''.$address_list_btn.''.$phone_list_btn.''.$people_list_btn.'
                        </div></div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('vendors.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vendors.create');
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
                'name' => 'required|string|max:32',
            ],
            [
                'name.required' => trans('translation.required', ['name' => 'name']),
            ]
        );
        $input = $request->all();
        $result = Vendor::create($input);
        if ($result) {
            return redirect()->route('vendors.index')
                ->with('success', trans('translation.created', ['name' => 'vendor']));
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
        $data = Vendor::find($id);
        return view('vendors.edit', compact('data'));
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
                'name' => 'required|string|max:32',
            ],
            [
                'name.required' => trans('translation.required', ['name' => 'name']),
            ]
        );
        $input = $request->all();
        $data = Vendor::find($id);
        $result =  $data->update($input);
        if ($result) {
            return redirect()->route('vendors.index')
                ->with('success', trans('translation.updated', ['name' => 'vendors']));
        } else {
            return redirect()->route('vendors.index')
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
        $delete =  Vendor::find($id)->delete();
        if ($delete) {
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
        $delete_request=Vendor::where('id', $id)->withTrashed()->restore();
        if ($delete_request) {
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
