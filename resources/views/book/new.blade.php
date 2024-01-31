@extends('layouts.layout')

@section('content')
    <h1>Añadir Nuevo Libro</h1>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    @endif
    <form action="{{ route('book.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <label for="publisher">Editor:</label>
        <input type="text" name="publisher" required><br>

        <label for="price">Precio:</label>
        <input type="text" name="price" required><br>

        <label for="pages">Páginas:</label>
        <input type="text" name="pages" required><br>

        <label for="status">Estado:</label>
        <select name="status" required>
            <option value="new">Nuevo</option>
            <option value="good">Bueno</option>
            <option value="used">Usado</option>
            <option value="bad">Defectuoso</option>
        </select><br>

        <label for="module_id">Módulo:</label>
        <select name="module_id" required>
            <option> <--- Selecciona una opción ---> </option>
            @foreach ($modules as $module)
                <option value="{{ $module->code }}">{{ $module->cliteral }}</option>
            @endforeach
        </select><br>

        <label for="photo">Foto:</label>
        <input type="file" name="photo"><br>


        <label for="comments">Comentarios:</label><br>
        <textarea name="comments"></textarea><br>

        <button type="submit">Añadir Libro</button>
    </form>

    <a href="{{ route('book.index') }}">Volver al Listado</a>
@endsection
