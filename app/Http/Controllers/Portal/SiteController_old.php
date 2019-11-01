<?php

namespace App\Http\Controllers\Portal;

use App\Post;
use Gate;
use App\Http\Controllers\Controller;

class SiteController_old extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Post $post)
    {
        return view('portal.home.index');
        /*$posts = $post->all();
        $posts = $post->where('user_id', auth()->user()->id)->get();

        return view('home', compact('posts'));*/
    }

    public function update($idPost) {
        $post = Post::find($idPost);

        //$this->authorize();

        if(Gate::denies('update-post', $post)) abort(403, 'Unautorized');

        return view('update-post', compact('post'));
    }

    public function rolesPermissions() {
        $nameUser = auth()->user()->name;

        var_dump("<h1>{$nameUser}</h1>");

        foreach(auth()->user()->roles as $role) {
            echo "<b>$role->name </b>-> ";

            $permissions = $role->permissions;
            foreach($permissions as $permission) {
                echo "$permission->name , ";
            }
            echo "<hr/>";
        }
    }
}