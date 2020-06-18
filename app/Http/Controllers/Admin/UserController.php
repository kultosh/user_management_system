<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\User;
use App\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.users.index')->with('users', User::paginate(5));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      if(Auth::user()->id == $id)
      {
        return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to edit yourself!');
      }
      return view('admin.users.edit')->with(['edit' => User::find($id), 'roles' => Role::all()]);
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
      if(Auth::user()->id == $id)
      {
        return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to edit yourself!');
      }

      $user = User::find($id);
      $user->roles()->sync($request->roles);

      return redirect()->route('admin.users.index')->with('success', 'User Role has been updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Auth::user()->id == $id)
        {
          return redirect()->route('admin.users.index')->with('warning', 'You are not allowed to delete yourself!');
        }

        User::destroy($id);
        return redirect()->route('admin.users.index')->with('success', 'User has been deleted successfully!');
    }
}
