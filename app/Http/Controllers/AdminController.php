<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Module;
use DataTables;
use Hash;
use Arr, Str;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use App\Rules\MatchOldPassword;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Admin::query();
            $data = $query->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function (Admin $user) {
                    $user_data = Auth::user();
                    $actionBtn = '';
                    $edit_button = '<a href="' . route('admin-users.edit', $user->id) . '" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                    <span class="svg-icon svg-icon-3">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor"></path>
                            <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor"></path>
                        </svg>
                    </span>
                </a>';
                    $delete_button = '<a href="#" data-id="' . route('admin-users.destroy', $user->id) . '" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1 delete_user">
                    <span class="svg-icon svg-icon-3">
						<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
							<path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor"></path>
							<path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor"></path>
							<path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor"></path>
						</svg>
					</span>
                </a>';
                    if ($user_data->id !== $user->id) {
                        return $edit_button . " " . $delete_button;
                    } else {
                        return "";
                    }
                })
                ->editColumn('role', function (Admin $admin) {
                    if ($admin->role == '1') {
                        $active = 'Super Admin';
                    } else {
                        $active = 'Admin';
                    }
                    return $active;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('admin-users.index');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $modules = Module::with('module_actions')->get();
        return view('admin-users.create', compact('modules'));
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
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
                'password' => ['required', 'string', 'min:8', 'same:confirm-password'],
                'role' => ['required', 'in:1,2'],
                'permissions' => 'required_if:role,2',
            ],
            [
                'permissions.required_if' => 'The permissions field is required when role is admin'
            ]
        );
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        if (isset($request->permissions) && !empty($request->permissions)) {
            $input['permissions'] = json_encode($request->permissions);
        }
        $admin = Admin::create($input);
        if ($admin) {
            if ($request->submit_type == 'ajax') {
                return  json_encode(['result' => 'success', 'message' => trans('translation.created', ['name' => 'admin'])]);
            } else {
                return redirect()->route('admin-users.index')
                    ->with('success', trans('translation.created', ['name' => 'admin']));
            }
        } else {
            if ($request->submit_type == 'ajax') {
                return json_encode(['result' => 'fail', 'message' => trans('translation.error')]);
            } else {
                return redirect()->route('admin-users.index')
                    ->with('error', trans('translation.error'));
            }
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
        $admin_user = Admin::find($id);
        $modules = Module::with('module_actions')->get();
        return view('admin-users.edit', compact('admin_user', 'modules'));
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
        $this->validate($request, 
        [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email,' . $id],
            'password' => ['same:confirm-password'],
            'role' => ['required', 'in:1,2'],
            'permissions' => 'required_if:role,2',
        ],
        [
            'permissions.required_if' => 'The permissions field is required when role is admin'
        ]
    );
        $input = $request->all();

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        if (isset($request->permissions) && !empty($request->permissions)) {
            $input['permissions'] = json_encode($request->permissions);
        }

        $admin_user = Admin::find($id);
        $update =  $admin_user->update($input);
        if ($update) {
            if ($request->submit_type == 'ajax') {
                return  json_encode(['result' => 'success', 'message' => trans('translation.updated', ['name' => 'user'])]);
            } else {
                return redirect()->route('admin-users.index')
                    ->with('success', trans('translation.updated', ['name' => 'user']));
            }
        } else {
            if ($request->submit_type == 'ajax') {
                return json_encode(['result' => 'fail', 'message' => trans('translation.error')]);
            } else {
                return redirect()->route('admin-users.index')
                    ->with('error', trans('translation.error'));
            }
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
        if ($id == 1 || $id == '1') {
            abort(401, 'Administrator user cannot be deleted');
        }
        $delete =  Admin::find($id)->delete();
        if ($delete) {
            if ($request->submit_type == 'ajax') {
                return response()->json([
                    'result' => 'success',
                    'status' => 1,
                    'message' => trans('translation.deleted', ['name' => 'user'])
                ]);
            } else {
                return redirect()->route('admin-users.index')
                    ->with('success', trans('translation.deleted', ['name' => 'user']));
            }
        } else {
            if ($request->submit_type == 'ajax') {
                return response()->json([
                    'result' => 'fail',
                    'status' => -1,
                    'message' => trans('translation.error')
                ]);
            } else {
                return redirect()->route('admin-users.index')
                    ->with('error', trans('translation.error'));
            }
        }
    }
    public function changePassword()
    {
        return view('admin-users.change-password');
    }
    public function changePasswordUpdate(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'password' => ['required','string', 'min:8','different:current_password'],
            'confirm_password' => ['required','same:password'],
        ]);
   
        $result=Admin::find(Auth::user()->id)->update(['password'=> Hash::make($request->password)]);
        if ($result) {
            if ($request->submit_type == 'ajax') {
                return json_encode(['result' => 'success',
                'message' =>trans('translation.updated', ['name' => 'password'])]);
            } else {
                return redirect()->route('change-password')
                    ->with('success', trans('translation.updated', ['name' => 'password']));
            }
        } else {
            if ($request->submit_type == 'ajax') {
                return json_encode(['result' => 'fail', 'message' => trans('translation.error')]);
            } else {
                return redirect()->route('change-password')
                    ->with('error', trans('translation.error'));
            }
        }
    }
}
