@extends('layouts.Admin.master')
@section('content')
    <div id="layoutSidenav_content">
        <div class="container">
            <h1 class="mb-4">Daftar Berita</h1>
            <a href="{{ route('news.create') }}" class="btn btn-primary mb-3">Tambah Berita</a>

            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Gambar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($news as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->Title }}</td>
                            <td>{{ $item->category->name }}</td>
                            <td>
                                @if ($item->Img)
                                    <img src="{{ asset('storage/' . $item->Img) }}">
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('news.edit', [$item->id, $item->slug]) }}"
                                    class="btn btn-info btn-sm">Edit</a>
                                <button class="btn btn-danger btn-sm delete-btn"
                                    data-id="{{ $item->id, $item->slug }}">Delete</button>
                                <form id="delete-form-{{ $item->id }}"
                                    action="{{ route('news.destroy', [$item->id, $item->slug]) }}" method="POST"
                                    style="display:none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            {{-- {{$news->links()}} --}}
        </div>
    </div>
@endsection
<style>
    .content img{
        max-width: 100%;
        height: auto;
        display: block;
        margin: 10px auto;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll(".delete-btn");

        deleteButtons.forEach(button => {
            button.addEventListener("click", function() {
                const newsId = this.getAttribute("data-id");

                Swal.fire({
                    title: "Apakah Anda Yakin?",
                    text: "Anda tidak akan dapat mengembalikan data ini!",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#d33",
                    cancelButtonColor: "#3085d6",
                    confirmButtonText: "Ya, hapus!",
                    cancelButtonText: "Batal"
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById(`delete-form-${newsId}`).submit();
                    }
                });
            });
        });
    });
</script>
