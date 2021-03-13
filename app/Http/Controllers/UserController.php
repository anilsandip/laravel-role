<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\user;
use Illuminate\Http\Request;

class UserController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with('role')->latest()->paginate(5);
        return view('users.index',compact('users'))
            ->with("i",($users->currentPage()-1)*$users->perPage()+1);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        User::create([
           'name' => $request->name,
           'email' => $request->email,
           'password' => $request->password,
            'role_id'=>$request->roles,
        ]);

        return redirect('users')->with('success','User Added Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(user $user)
    {
        return view('users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(user $user)
    {
        $roles = Role::all();
        return view('users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, user $user)
    {
        $request['role_id'] = $request->roles;
        $user->update($request->all());
        return redirect()->route('users.index')->with('success','User Updated Successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\user $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function destroy(user $user)
    {
        $user -> delete();
        return redirect()->route('users.index')->with('success','User Deleted Successfully!');
    }

    public function changeStatus($id)
    {
        $user = User::find($id);
        $user->is_active = !$user->is_active;
        $user->save();
    }
}
