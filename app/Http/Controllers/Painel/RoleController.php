<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Role;
use Gate;

class RoleController extends Controller
{
    private $role;

    public function __construct(Role $role) {
        $this->role = $role;

        //Deixando essa verificação aqui no construtor, já serve para todos os outros métodos ...
        if(Gate::denies('adm'))
            return redirect()->back();
    }

    public function index() {
        $roles = $this->role->all();

        return view('painel.roles.index', compact('roles'));
    }

    public function permissions($id) {
        //Recupera o Role ...
        $role = $this->role->find($id);

        //Recupera Permissões ...
        $permissions = $role->permissions()->get();

        return view('painel.roles.permissions', compact('role', 'permissions'));
    }
}
