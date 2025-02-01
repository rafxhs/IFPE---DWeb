@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">Lista de Atores</h1>

    <a href="{{ route('authors.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus"></i> Adicionar Autor(a)
    </a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table table-striped">
        <thead>
            <tr>
                <th>#</th>
                <th>Nome</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($authors as $author)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $author->name }}</td>
                    <td>
                        <!-- Botão de Visualizar -->
                        <a href="{{ route('authors.show', $author) }}" class="btn btn-info btn-sm">
                            <i class="bi bi-eye"></i> Visualizar
                        </a>

                        <!-- Botão de Editar -->
                        <a href="{{ route('authors.edit', $author) }}" class="btn btn-primary btn-sm">
                            <i class="bi bi-pencil"></i> Editar
                        </a>

                        <!-- Botão de Excluir -->
                        <form action="{{ route('authors.destroy', $author) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Deseja excluir esta categoria?')">
                                <i class="bi bi-trash"></i> Excluir
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3">Nenhuma autor(a) encontrado(a).</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

