<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_list = User::all();
        return view('User_stories.Admin.adm001.users', ['user_list' => $user_list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('User_stories.Admin.adm001.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->rut = $request->get('rut');
        $user->name = $request->get('full_name');
        $user->email = $request->get('email');
        $user->password = Hash::make(substr($request->get('rut'), 0, -2));
        $user->role = $request->get('role');
        $user->save();

        return redirect('/dashboard/users');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('User_stories.Admin.adm001.edit',['user' => $user]);
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
        $user = User::find($id);
        $user->rut = $request->get('rut');
        $user->name = $request->get('full_name');
        $user->email = $request->get('email');
        $user->role = $request->get('role');

        if($request->get('enabled') === 'on'){
            $user->enabled = 1;
        }else{
            $user->enabled = 0;
        }
        $user->save();
        return redirect('/dashboard/users');
    }

}
