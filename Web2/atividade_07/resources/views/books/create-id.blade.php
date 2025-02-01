@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Adicionar Livro (Com ID)</h1>

    <form action="{{ route('books.store.id') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="cover_image" class="form-label">Capa do Livro</label>
            <input type="file" class="form-control @error('cover_image') is-invalid @enderror" id="cover_image" name="cover_image">
            @error('cover_image')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="title" class="form-label">Título</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" required>
            @error('title')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="publisher_id" class="form-label">ID da Editora</label>
            <input type="number" class="form-control @error('publisher_id') is-invalid @enderror" id="publisher_id" name="publisher_id" required>
            @error('publisher_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="author_id" class="form-label">ID do Autor</label>
            <input type="number" class="form-control @error('author_id') is-invalid @enderror" id="author_id" name="author_id" required>
            @error('author_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="category_id" class="form-label">ID da Categoria</label>
            <input type="number" class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
            @error('category_id')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Salvar</button>
    </form>
</div>
@endsection


