<?php

namespace App\Http\Controllers;

use App\Models\permission;
use Illuminate\Http\Request;

class PermissionCOntroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::paginate(5);
        return view('permissions.index',compact('permissions'))
            ->with('i',(1-$permissions->currentPage())*$permissions->perPage()+1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view("permissions.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        permission::create([
            "name"=> $request->name,
        ]);
        return redirect()->route("permissions.index")->with("success","Permission Added successfully");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\Response
     */
    public function show(permission $permission)
    {
        return view("permissions.show",compact("permission"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(permission $permission)
    {
        return view("permissions.edit",compact("permission"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, permission $permission)
    {
        $permission->update($request->all());
        return redirect()->route("permissions.index")->with("success","Permission Updated successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\permission  $permission
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(permission $permission)
    {
        $permission->delete();
        return redirect()->route("permissions.index")->with("success","Permission Deleted successfully");
    }
}
