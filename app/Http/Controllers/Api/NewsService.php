<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\news;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class NewsService extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get()
    {
        $news = news::latest()->get();
        $data = [
            'status' => true,
            'message' => 'berhasil',
            'data' => $news
        ];
        if ($news)
            return response()->json($data);
        else return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function detail(int $id)
    {
        if (!$id) return response()->json(['error' => 'ID kategori dibutuhkan']);
        $news = news::find($id);
        $data = [
            'status' => true,
            'message' => 'berhasil',
            'data' => $news
        ];
        if ($news)
            return response()->json($data);
        else return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!$request) return response()->json(['error' => 'Data kategori baru dibutuhkan'], 422);
        $validator = Validator::make($request->all(), [
            'Title' => 'required|string|max:100|unique:news_blog,Title',
            'content' => 'required',
            'Img' => 'required|string',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => true,
                'message' => 'berhasil',
                'data' => $validator->errors()
            ], 422);
        }
        // $imgPath = $this->ekstrakGambar($request->content);
        $news = news::create([
            'Title' => $request->Title,
            'slug' => Str::slug($request->Title),
            'content' => $request->content,
            'Img' => $request->image,
            'user_id' => $request->user_id,
            'category_id' =>$request->category_id
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Berhasil menambahkan data',
            'data' => $news

        ]);
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        if (!$id) return response()->json(['error' => 'ID kategori dibutuhkan'], 422);
        if (!$request) return response()->json(['error' => 'Data kategori dibutuhkan'], 422);

        $validator = Validator::make($request->all(), [
            'Title' => 'required|string|max:100|unique:news_blog,Title,' . $id,
            'content' => 'required',
            'Img' => 'nullable|string',
            'user_id' => 'required|exists:users,id',
            'category_id' => 'required|exists:categories,id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'data' => $validator->errors()
            ], 422);
        }
        $imgPath = $this->ekstrakGambar($request->content);
        $data = [
            'Title'         => $request->Title,
            'slug'          => Str::slug($request->Title),
            'content'       => $request->content,
            'Img'           => $imgPath,
            'user_id'       => $request->user_id,
            'category_id'   => $request->category_id
        ];

        $news = news::find($id);

        if (!$news) return response()->json(['error' => 'Berita tidak ditemukan'], 404);

        if (
            $request->Title !== $news->Title ||
            $request->content !== $news->content ||
            $request->image !== $imgPath ||
            $request->user_id != $news->user_id ||
            $request->category_id != $request->category_id
        ) {
            $news->update($data);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Tidak ada data yang diupdate'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Kategori berhasil diupdate',
            'data' => $news->getChanges()
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        if (!$id) return response()->json(['error' => 'ID berita dibutuhkan'], 422);

        $news = news::find($id);

        if (!$news) return response()->json(['error' => 'Berita tidak ditemukan'], 404);

        $news->delete();

        return response()->json([
            'status' => true,
            'message' => 'Berita berhasil dihapus',
            'data' => $news
        ], 200);
    }

    private function ekstrakGambar($content)
    {
        preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"]/', $content, $image);
        if (!empty($image['src'])) {
            return str_replace(asset('storage') . '/', '', $image['src']);
        }
        return null;
    }
}
