<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Categories;
// use Dotenv\Validator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryService extends Controller
{
    public function get()
    {
        $categories = Categories::latest()->get();
        $data = [
            'status' => true,
            'message' => 'berhasil',
            'data' => $categories
        ];
        if ($categories)
            return response()->json($data);
        else return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
    }
    public function detail(int $id)
    {
        if (!$id) return response()->json(['error' => 'ID kategori dibutuhkan']);
        $categories = Categories::find($id);
        $data = [
            'status' => true,
            'message' => 'berhasil',
            'data' => $categories
        ];
        if ($categories)
            return response()->json($data);
        else return response()->json(['status' => false, 'message' => 'Data tidak ditemukan'], 404);
    }
    public function store(Request $request)
    {
        if (!$request) return response()->json(['error' => 'Data kategori baru dibutuhkan'], 422);
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:categories,name'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => true,
                'message' => 'berhasil',
                'data' => $validator->errors()
            ], 422);
        }
        $categories = Categories::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ]);
        return response()->json([
            'status' => true,
            'message' => 'Berhasil menambahkan data',
            'data' => $categories

        ]);
    }
    public function update(Request $request, int $id)
    {
        if (!$id) return response()->json(['error' => 'ID kategori dibutuhkan'], 422);
        if (!$request) return response()->json(['error' => 'Data kategori dibutuhkan'], 422);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:100|unique:categories,name,' . $id
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi gagal',
                'data' => $validator->errors()
            ], 422);
        }

        $data = [
            'name' => $request->name,
            'slug' => Str::slug($request->name)
        ];

        $category = Categories::find($id);

        if (!$category) return response()->json(['error' => 'Kategori tidak ditemukan'], 404);

        if ($request->name !== $category->name) {
            $category->update($data);
        } else {
            return response()->json([
                'status' => true,
                'message' => 'Tidak ada data yang diupdate'
            ]);
        }

        return response()->json([
            'status' => true,
            'message' => 'Kategori berhasil diupdate',
            'data' => $category->getChanges()
        ], 200);
    }
    public function destroy(int $id)
    {
        if (!$id) return response()->json(['error' => 'ID kategori dibutuhkan'], 422);

        $category = Categories::find($id);

        if (!$category) return response()->json(['error' => 'Kategori tidak ditemukan'], 404);

        $category->delete();

        return response()->json([
            'status' => true,
            'message' => 'Kategori berhasil dihapus',
            'data' => $category
        ], 200);
    }
}
