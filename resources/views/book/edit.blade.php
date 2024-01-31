@extends('layouts.layout')

@section('content')
    <h1>Editar Libro</h1>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
    <form action="{{ route('book.update', ['id' => $book->id]) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <label for="publisher">Editor:</label>
        <input type="text" name="publisher" value="{{ $book->publisher }}" required><br>

        <label for="price">Precio:</label>
        <input type="text" name="price" value="{{ $book->price }}" required><br>

        <label for="pages">Páginas:</label>
        <input type="text" name="pages" value="{{ $book->pages }}" required><br>

        <label for="status">Estado:</label>
        <select name="status" required>
            <option value="new" {{ $book->status == 'new' ? 'selected' : '' }}>Nuevo</option>
            <option value="good" {{ $book->status == 'good' ? 'selected' : '' }}>Bueno</option>
            <option value="used" {{ $book->status == 'used' ? 'selected' : '' }}>Usado</option>
            <option value="bad" {{ $book->status == 'bad' ? 'selected' : '' }}>Defectuoso</option>
        </select><br>

        <label for="module_id">Módulo:</label>
        <select name="module_id" required>
            @foreach ($modules as $module)
                <option value="{{ $module->code }}" {{ $module->code == $book->module_id ? 'selected' : '' }}>
                    {{ $module->cliteral }}
                </option>
            @endforeach
        </select><br>

        <label for="photo">Foto:</label>
        <input type="file" name="photo"><br>

        <label for="comments">Comentarios:</label><br>
        <textarea name="comments">{{ $book->comments }}</textarea><br>

        <button type="submit">Actualizar Libro</button>
    </form>

    <a href="{{ route('book.index') }}">Volver al Listado</a>
@endsection
