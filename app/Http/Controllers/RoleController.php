<?php

namespace App\Http\Controllers;

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
            return datatables::of($roles) ->addColumn('action', function ($roles) {
                return '<a href='. route('roles.show', $roles->id) .' class="btn btn-xs btn-outline-info"><i class="fas fa-eye"></i> </a>
                          .<a href='. route('roles.edit', $roles->id) .' class="btn btn-xs btn-outline-primary"><i class="fas fa-edit"></i></a>.
                          <button class="btn btn-xs btn-outline-danger danger btn-delete" data-remote='. route('roles.destroy', $roles->id) .'><i class="fas fa-trash"></i></button>';
            })
                ->toJson();
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
        return view('roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {

        Role::create([
           'name'=>$request->name,
            'slug'=>$request->name,
        ]);
        return redirect()->route('roles.index')->with('success','Record Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return view('roles.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        return view('roles.edit',compact('role'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, Role $role)
    {
        $request['slug'] = $request->name;
        $role->update($request->all());
        return redirect()->route('roles.index')->with('success','Record Updated Successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return response()->json('data dleted successfully');
//        return redirect()->route('roles.index')->with('success','Record Deleted Successfully');
    }
}
