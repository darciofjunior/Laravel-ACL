<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Permission;
use Gate;

class PermissionController extends Controller
{
    private $permission;

    public function __construct(Permission $permission) {
        $this->permission = $permission;

        if(Gate::denies('adm')) 
            return abort(403, 'Não autorizado !');
    }

    /*private function checkPermission() {
        if(Gate::denies('adm')) 
            return abort(403, 'Não autorizado !');
    }*/

    public function index() {
        $permissions = $this->permission->all();

        //$this->checkPermission();

        return view('painel.permissions.index', compact('permissions'));
    }

    public function roles($id) {
        //Recupera a Permissão ...
        $permission = $this->permission->find($id);

        //$this->checkPermission();

        //Recupera Permissões ...
        $roles = $permission->roles()->get();

        return view('painel.permissions.roles', compact('permission', 'roles'));
    }
}
