<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;
use DB;
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
        if($this->user_rut_exists($request->get('rut'))){
            return back()->with('status', 'Ya existe otro usuario con el mismo rut.');
        }
        if($this->user_email_exists($request->get('email'))){
            return back()->with('status', 'Ya existe otro usuario con el mismo email.');
        }
        if($request->get('role') === 'Encargado Docente' && 
        $this->there_is_encargado_enabled()){
        $user->enabled = 0;
        }

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
        if($user->rut != $request->get('rut') &&
            $this->user_rut_exists($request->get('rut'))){
            return back()->with('status', 'Ya existe otro usuario con el mismo rut.');
        }
        if($user->email != $request->get('email')
            && $this->user_email_exists($request->get('email'))){
            return back()->with('status', 'Ya existe otro usuario con el mismo email.');
        }
        $user->rut = $request->get('rut');
        $user->name = $request->get('full_name');
        $user->email = $request->get('email');
        $user->role = $request->get('role');
        if($request->get('enabled') === 'on'){
            $user->enabled = 1;
        }else{
            $user->enabled = 0;
        }
        if($request->get('role') === 'Encargado Docente' && 
            $this->there_is_encargado_enabled()){
            
            $user->enabled = 0;
            }
    

        $user->save();
        return redirect('/dashboard/users');
    }

    /**
     * Check if theres an encargado enabled already
     *
     * @return boolean
     */
    public function there_is_encargado_enabled(){

        $encagado_list = User::where('role','Encargado Docente');
        foreach($encargado_list as $encargado){
            if ($encargado->enabled === 1){
                return true;
            }
        }
        return false;
    }
    
    /**
     * Check if theres an user with rut
     *
     * @return boolean
     */
    public function user_rut_exists($rut){

        $users_quantity = DB::select('select count(*) as cantidad from users where rut = ?', [$rut])[0]->cantidad;
        //dd($users_quantity);
        if($users_quantity > 0){
            return true;
        }
        return false;
    }

    /**
     * Check if theres an user with email
     *
     * @return boolean
     */
    public function user_email_exists($email){

        $users_quantity = DB::select('select count(*) as cantidad from users where email = ?', [$email])[0]->cantidad;
        if($users_quantity > 0){
            return true;
        }
        return false;
    }

    /**
     * Reset password to default (rut without verification digit)
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reset_password(Request $request){

        $user = User::find($request->get('user_id'));
        $user->password = Hash::make(substr($user->rut, 0, -2));
        $user->save();
        return back()->with('status', 'Se restableció la contraseña del usuario '.$user->name);
    }

    /**
     * Change current user if password is valid
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function change_password(Request $request){

        if ($request->get('password') !== $request->get('confirm_password')){
            return back()->with('status', 'Las contraseñas no coinciden.');
        }
        $view_message = $this->password_is_valid($request->get('password'));
        if ($view_message != 'valid'){
            return back()->with('status', $view_message);
        }
        else{
            $user = User::find(Auth::user()->id);
            $user->password = Hash::make($request->get('password'));
            $save_message = $user->save();
            return redirect('/dashboard');
        }

    }

    /**
     * Check if password is valid, return descriptive message
     *
     * @param  string  $request
     * @return string
     */
    public function password_is_valid($password){
        if (strlen($password) < 8 ){
            return 'Contraseña demasiado corta.';
        }
        // regular expression
        // https://www.geeksforgeeks.org/how-to-remove-non-alphanumeric-characters-in-php/
        $alphanumeric_password = preg_replace( '/[\W]/', '', $password);

        if ($alphanumeric_password != $password){
            return 'Contraseña incluye caracters inválidos.';
        }

        return 'valid';
    }
    
    /**
     * Send email atributte of the current Administrator
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function password_request(Request $request){

        $admin_email = User::where('role','Administrador')->get()[0]->email;
        return view('User_stories.adm003.password_request',['admin_email'=>$admin_email]);

    }

}
