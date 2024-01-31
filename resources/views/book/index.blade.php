@extends('layouts.layout')

@section('content')
    <h1>Listado de Libros</h1>
    @if (Auth::check())
        <h3><a href="{{ route('book.new') }}">Añadir Libro</a></h3>
        <h3><a href="{{ route('book.allBooks') }}">Listado de todos Libros</a></h3>
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
                    (<a href="{{ route('book.edit', ['id' => $book->id]) }}">Editar</a>)
                    (<a href="{{ route('book.buy', ['id' => $book->id]) }}">Comprar</a>)
                    (<a href="{{ route('book.delete', ['id' => $book->id]) }}" onclick="return confirm('¿Seguro que deseas eliminar este libro?')">Eliminar</a>)
                @endif
            </li>
        @endforeach
    </ul>

    {{ $books->links('pagination.simple-default') }}
@endsection
