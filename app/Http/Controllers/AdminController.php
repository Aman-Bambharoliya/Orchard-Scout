<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use DataTables;
use Hash;
use Arr, Str;
use Auth;
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
            if ($request->get('name') != '') {
                $query = $query->where('name', 'ilike', '%' . $request->get('name') . '%');
            }
            if ($request->get('email') != '') {
                $query = $query->where('email', 'ilike', '%' . $request->get('email') . '%');
            }
            $data = $query->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="btn-wrapper" style="display: flex;">';
                    $href = "'" . route('admin-users.edit', $row->id) . "'";
                    $btn .= '<button data-href="' . route('admin-users.edit', $row->id) . '" class="btn btn-outline btn-success dim" onClick="location.href=' . $href . '"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
              </svg></button>';
                    $btn .= ' <button data-href="' . route('admin-users.destroy', $row->id) . '" 
                        class="delete-data btn btn-outline btn-danger dim" 
                        data-toggle="modal" data-target="#delete_model_warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                        <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                        <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                      </svg></button>';
                    $btn .= '</div>';
                    return $btn;
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
        return view('admin-users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'password' => ['required', 'string', 'min:8', 'same:confirm-password'],
        ]);
        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

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
        return view('admin-users.edit', compact('admin_user'));
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
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins,email,' . $id,
            // 'password' => 'sometimes|min:8|same:confirm-password',
        ]);
        $input = $request->all();

        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
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
                    'message' => trans('translation.error')
                ]);
            } else {
                return redirect()->route('admin-users.index')
                    ->with('error', trans('translation.error'));
            }
        }
    }
}
