<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\Role;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;


class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
//        $roles = Role::all();
//        return view('roles.index',compact('roles'));
        if ($request->ajax()) {
            $roles = Role::all();

            return datatables::of($roles)->addColumn('action', function ($roles) {
                return '<a href=' . route('roles.show', $roles->id) . ' class="btn btn-xs btn-outline-info"><i class="fas fa-eye"></i> </a>
                          <a href=' . route('roles.edit', $roles->id) . ' class="btn btn-xs btn-outline-primary"><i class="fas fa-edit"></i></a>.
                          <button class="btn btn-xs btn-outline-danger danger btn-delete" data-remote=' . route('roles.destroy', $roles->id) . '><i class="fas fa-trash"></i></button>';
            })->addColumn('permission', function ($roles) {
                $permissions = $roles->permissions->pluck('name')->toArray();
                if (count($permissions)) {
                    return implode(',', $permissions);
                }
                return "";
            })->toJson();
        }

        return view('roles.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('roles.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
//
//        $role = Role::find(1);
//        $role->permissions()->attach([1,2]);


        $role = Role::create([
            'name' => $request->name,
            'slug' => $request->name,
        ]);
        $role = Role::find($role->id);

//        dd($request->permissions);
        $role->permissions()->attach($request->permissions);
        return redirect()->route('roles.index')->with('success', 'Record Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all();
        return view('roles.edit', compact('role', 'permissions'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Role $role)
    {
        $request['slug'] = $request->name;
        $role->update($request->all());

        $role->permissions()->sync($request->permissions);

        return redirect()->route('roles.index')->with('success', 'Record Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Role $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json('data delete successfully');
//        return redirect()->route('roles.index')->with('success','Record Deleted Successfully');
    }
}
