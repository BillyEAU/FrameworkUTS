@extends('layouts.Admin.masterPage.master')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.css">
@section('content')
    <div id="layoutSidenav_content">
        <div class="container">
            <form action="{{ route('news.store') }} " method="POST" enctype="multipart/form-data" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="form-label">Judul</label>
                    <input type="text" name="title"
                        class="form-control @error('Title') 
                id-invalid    
                @enderror"
                        value="{{ old('Title') }} " required>
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
                    <label class="form-label">Konten</label>
                    <textarea class="form-control" name="content" id="summernote" cols="30" rows="10">{{ old('content') }}</textarea>
                </div>

                <input type="hidden" name="image" id="image" value="{{ old('image') }}">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </form>


        </div>
    </div>
@endsection
@section('page-script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/summernote@0.8.20/dist/summernote-bs5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#summernote').summernote({
                height: 300,
                callbacks: {
                    onImageUpload: function(files) {
                        uploadImage(files[0]);
                    }
                }
            });

            function uploadImage(file) {
                let formData = new FormData();
                formData.append("image", file);

                $.ajax({
                    url: "{{ route('news.uploadImage') }}",
                    method: "POST",
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: formData,
                    contentType: false,
                    processData: false,
                    success: function(response) {
                        if (response.url) {
                            $('#summernote').summernote('insertImage', response.url);
                            $('#image').val(response.filename);
                        }
                    }
                });
            }
        });
    </script>
@endsection
