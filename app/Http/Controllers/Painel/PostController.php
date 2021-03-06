<?php

namespace App\Http\Controllers\Painel;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Post;
use Gate;

class PostController extends Controller
{
    private $post;

    public function __construct(Post $post) {
        $this->post = $post;

        if(Gate::denies('view_post'))
            return redirect()->back();
            //abort(403, 'Not Permission Lists Post !');
    }

    public function index() {
        $posts = $this->post->all();

        return view('painel.posts.index', compact('posts'));
    }
}
