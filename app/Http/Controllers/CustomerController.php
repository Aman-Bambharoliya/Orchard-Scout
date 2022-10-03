<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use Illuminate\Http\Request;
use DataTables;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Customer::query();
            $data = $query->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (Customer $data) {
                    $user_data = Auth::user();
                    $actionBtn = '';
                    $edit_button = '';
                    $delete_button = '';
                    $address_list_btn = '';
                    if ($user_data->hasPermission('customers', 'update')) {
                        $edit_button .= '<div class="menu-item  px-3">
                                <a href="' . route('customers.edit', $data->id) . '" class="menu-link px-3">Edit</a>
                            </div>';
                    }
                    if ($user_data->hasPermission('customers', 'delete')) {
                        $delete_button .= '<div class="menu-item  px-3">
                    <a href="#" data-id="' . route('customers.destroy', $data->id) . '" class="menu-link px-3 delete_record">Delete</a>
                </div>';
                    }
                    if ($user_data->hasPermission('customer-addresses', 'index')) {
                        $address_list_btn .= ' <div class="menu-item  px-3">
                    <a href="' . route('customer-addresses.index', $data->id) . '" class="menu-link px-3">Address List</a>
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
                            ' . $edit_button . " " . $delete_button . ''.$address_list_btn.'
                        </div></div>';
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('customers.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customers.create');
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
        $result = Customer::create($input);
        if ($result) {
            return redirect()->route('customers.index')
                ->with('success', trans('translation.created', ['name' => 'customer']));
        } else {
            return redirect()->route('customers.index')
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
        $data = Customer::find($id);
        return view('customers.edit', compact('data'));
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
        $data = Customer::find($id);
        $result =  $data->update($input);
        if ($result) {
            return redirect()->route('customers.index')
                ->with('success', trans('translation.updated', ['name' => 'customers']));
        } else {
            return redirect()->route('customers.index')
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
        $delete =  Customer::find($id)->delete();
        if ($delete) {
            if ($request->submit_type == 'ajax') {
                return response()->json([
                    'result' => 'success',
                    'status' => 1,
                    'message' => trans('translation.deleted', ['name' => 'customer'])
                ]);
            } else {
                return redirect()->route('customers.index')
                    ->with('success', trans('translation.deleted', ['name' => 'customer']));
            }
        } else {
            if ($request->submit_type == 'ajax') {
                return response()->json([
                    'result' => 'fail',
                    'status' => -1,
                    'message' => trans('translation.error')
                ]);
            } else {
                return redirect()->route('customers.index')
                    ->with('error', trans('translation.error'));
            }
        }
    }
}
