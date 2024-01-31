@extends('layouts.layout')

@section('content')
    <h1>Detalles del Libro {{ $book->id }}</h1>

    <p><strong>ID:</strong> {{ $book->id }}</p>
    <p><strong>ID del Usuario:</strong> {{ $book->user_id }}</p>
    <p><strong>ID del Módulo:</strong> {{ $book->module_id }}</p>
    <p><strong>Editor:</strong> {{ $book->publisher }}</p>
    <p><strong>Precio:</strong> ${{ $book->price }}</p>
    <p><strong>Páginas:</strong> {{ $book->pages }}</p>
    <p><strong>Estado:</strong> {{ $book->status }}</p>
    <p><strong>Foto:</strong> <br> <img src="{{ asset($book->photo) }}" alt="Foto del Libro {{ $book->id }}"></p>
    <p><strong>Comentarios:</strong> {{ $book->comments }}</p>
    <p><strong>Fecha de Venta:</strong> {{ $book->soldDate }}</p>

    <a href="{{ route('book.index') }}">Volver al Listado</a>
@endsection
