@include('layouts.Admin.master')
<div id="layoutSidenav_content">
    <div class="container">
        <h2>Tambah Kategori</h2>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Nama Kategori</label>
                <input type="text" class="form-control" id="name" name="name" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
            <a href="{{route('categories.index')}}" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
</div>