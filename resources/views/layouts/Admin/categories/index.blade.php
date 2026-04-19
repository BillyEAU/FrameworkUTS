@extends('layouts.Admin.masterPage.master')
@section('content')
    
<div id="layoutSidenav_content">
    <div class="container">
        <h2>Daftar Kategori</h2>
        <a href="{{route ('categories.create')}}" class="btn btn-primary mb-3">Tambah Kategori</a>
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Kategori</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($categories as $index => $category)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $category->name }}</td>
                    <td>
                        <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-warning">Edit</a>
                        
                        <button class="btn btn-danger delete-btn" data-id="{{ $category->id }}">Hapus</button>
                        <form id="delete-form-{{$category->id}}" action="{{ route('categories.destroy', $category->id) }}" method="POST" style="display:inline-block;">     
                            @csrf
                            @method('DELETE')
                        </form>
                    </td>   
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

<script>
    document.addEventListener("DOMContentLoaded", function() {
       const deleteButtons = document.querySelectorAll(".delete-btn");
       
       deleteButtons.forEach(button =>{
        button.addEventListener("click", function(){
            const categoryId = this.getAttribute("data-id");

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
                if(result.isConfirmed){
                    document.getElementById(`delete-form-${categoryId}`).submit();
                }
        });
        });
       });
    });
</script>