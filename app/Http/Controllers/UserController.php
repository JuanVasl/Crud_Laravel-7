<?php

namespace App\Http\Controllers;

use App\Usuario;
use Illuminate\Http\Request;

class UserController extends Controller{

    //Listado de los Usuarios
    public function list(){
        $data['users'] = Usuario::paginate(5);

        return view('usuarios.list', $data);
    }

    //Formulario de Usuario
    public function userform(){
        return view('usuarios.userform');
    }

    //Guardar Usuarios
    public function save(Request $request){

        $validator = $this->validate($request, [
            'nombre'=> 'required|string|max:255',
            'email'=> 'required|string|max:255|email|unique:usuarios'
        ]);

        $userdata = request()->except('_token');
        Usuario::insert($userdata);

        return back()->with('usuarioGuardado','Usuario Guardado');
    }
}
