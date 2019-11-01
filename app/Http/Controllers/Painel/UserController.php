<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Gate;

class UserController extends Controller
{
    private $user;

    public function __construct(User $user) {
        $this->user = $user;

        if(Gate::denies('user'))
            return redirect()->back();
    }

    public function index() {
        $users = $this->user->all();

        return view('painel.users.index', compact('users'));
    }

    public function roles($id) {
        //Recupera o Usuário ...
        $user = $this->user->find($id);

        //Recupera Roles ...
        $roles = $user->roles()->get();

        return view('painel.users.roles', compact('user', 'roles'));
    }

    //Adaptação para métodos específicos ...
    public function edit($id) {
        if(Gate::denies('user'))
            return redirect()->back();
    }

    public function update($id) {
        if(Gate::denies('user'))
            return redirect()->back();
    }
}
