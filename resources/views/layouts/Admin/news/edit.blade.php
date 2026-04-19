@extends('layouts.Admin.masterPage.master')
@section('content')
<div id="layoutSidenav_content">
    <div class="container">
        <h2>Edit Kategori</h2>
        <form action="{{ route('news.update', [$news->id, $news->slug]) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="Title" class="form-label">Judul</label>
                <input type="text" class="form-control @error('Title') is-invalid @enderror" id="Title"
                    name="Title" value="{{ old('Title', $news->Title) }}" required>
                @error('Title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">Kategori</label>
                <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <div class="mb-3">
                    <label class="form-label">Konten</label>
                    <textarea class="form-control" name="content" id="summernote" cols="30" rows="10">{{ old('content', $news->content) }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('news.index') }}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Sukses',
            text: '{{ session('success') }}',
            timer: 2000,
            showConfirmButton: false
        });
    @endif
</script>
