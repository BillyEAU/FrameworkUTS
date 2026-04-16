<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class BerandaController extends Controller
{
    public function index(){
        $news = Post::where('id', '!=', 1)->get();
        $itim= Post::where('id', 1)->first();
        $nows = Post::where('id', '>', 5)->get();
        return view('layouts.Beranda.categories.index', compact('nows', 'itim','news'));
    }
}