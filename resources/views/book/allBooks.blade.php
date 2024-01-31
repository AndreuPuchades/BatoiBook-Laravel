@extends('layouts.layout')

@section('content')
    <h1>Listado de todos los Libros</h1>
    @if (Auth::check())
        <h3><a href="{{ route('book.new') }}">Añadir Libro</a></h3>
        <h3><a href="{{ route('book.index') }}">Listado de Libros</a></h3>
        <h3><a href="{{ route('sales.index') }}">Ver Historial de Ventas</a></h3>
        @if(auth()->user()->isAdmin)
            <h3><a href="{{ route('users.index') }}">Listado de Usuarios</a></h3>
        @endif
    @endif

    <ul>
        @foreach ($books as $book)
            <li>
                <a>Publisher: </a>{{ $book->publisher }}
                (<a href="{{ route('book.show', ['id' => $book->id]) }}">Ver Detalles</a>)
                @if (Auth::check())
                    (<a href="{{ route('book.buy', ['id' => $book->id]) }}">Comprar</a>)
                @endif
            </li>
        @endforeach
    </ul>

    {{ $books->links('pagination.simple-default') }}
@endsection
