<?php

namespace App\Http\Controllers;

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
        return view('Admin.adm001.users', ['user_list' => $user_list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.adm001.create');
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
        $user->password = substr($request->get('rut'), 0, -2); // rut[0:-2]
        // TODO: cifrar contraseña antes de guardarla
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
        $usuario = Usuario::find($id);
        return view('usuario.edit',['usuario' => $usuario]);
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
        echo $request;
        $usuario = Usuario::find($id);
        $usuario->rut = $request->get('rut');
        $usuario->nombre_completo = $request->get('nombre_completo');
        $usuario->email = $request->get('email');
        $usuario->clave = $request->get('clave');
        $usuario->rol = $request->get('rol');

        if($request->get('estado') === 'on'){
            $usuario->estado = 1;
        }else{
            $usuario->estado = 0;
        }
        
        $usuario->save();

        return redirect('/usuarios');
    }

}
