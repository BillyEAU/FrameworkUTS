<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;


class BerandaController extends Controller
{
    public function index(Request $request)
    {
        preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"]/', $request->content, $image);
        $imgPath = $image['src'] ?? null;
        if ($imgPath) {
            $imgPath = str_replace(asset('storage') . '/', '', $imgPath);
        }
        $news = Post::where('id', '!=', 1)->get();
        $itim = Post::where('id', 1)->first();
        $nows = Post::where('id', '>', 6)->get();
        return view('layouts.Beranda.index', compact('nows', 'itim', 'news'));
    }
}
