<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use Illuminate\Http\Request;
use App\Models\news;
// use Psy\Util\Str;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $news = news::with('category', 'user')->latest()->paginate(10);
        $user = Auth::user();
        if($user->role === 'admin'){
        return view('layouts.Admin.news.index', compact('news'));
        }else{
            return redirect()->intended(route('beranda.index'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categories::all();
        
            return view('layouts.Admin.news.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'Title' => 'required|string|max:255',
            'content' => 'required',
            'Img' => 'nullable|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        $imgPath = $this->ekstrakGambar($request->content);

        news::create([
            'Title'         => $request->Title,
            'slug'          => Str::slug($request->Title),
            'content'       => $request->content,
            'Img'           => $imgPath,
            'user_id'       => Auth::id(),
            'category_id'   => $request->category_id
        ]);
        return redirect()->route('news.index')->with('success', 'Berita berhasil ditambahkan.');
    }
    public function uploadImage(Request $request)
    {
        if($request->hasFile('image')){
            $file = $request->file('image');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('news_images', $filename, 'public');

            return response()->json([
                'url' => asset("storage/{$path}"),
                'filename' => $filename
            ]);
        }
        return response()->json(['error' => 'Gagal mengupload gambar'], 400);
    }

    private function ekstrakGambar($content){
        preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"]/', $content, $image);
        if(!empty($image['src'])){
            return str_replace(asset('storage') . '/', '', $image['src']);
        }
        return null;
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id, $slug)
    {
        $news = news::findOrFail($id);
        $categories = Categories::all();
        return view('layouts.Admin.news.edit', compact('news', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, $slug)
    {
        
        $news = news::findOrFail($id);

        $imgPath = $this->ekstrakGambar($request->content);

        // $news->update($request->all());

        $news->update([
            'Title' => $request->Title,
            // 'slug' => $request->slug,    
            'content' => $request->content,
            'Img' => $imgPath,
            'category_id' => $request->category_id
        ]);

        return redirect()->route('news.index')
                        ->with('success', 'Kategori berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id, $slug)
    {
        $news = news::findOrFail($id);
        $news->delete();
        return redirect()->route('news.index')
                        ->with('success', 'Berita Berhasil dihapus');
    }
}
