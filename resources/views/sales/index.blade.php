@extends('layouts.layout')

@section('content')
    <h1>Historial de Ventas</h1>
    <h3><a href="{{ route('book.index') }}">Ver Listado De Libros</a></h3>

    <ul>
        @foreach ($sales as $sale)
            <li>
                <strong>ID del libro:</strong> {{ $sale->book->id }} (<a href="{{ route('book.show', ['id' => $sale->book->id]) }}">Ver Detalles</a>) <br>
                <p>Publisher: {{ $sale->book->publisher }}</p>
                <p>Fecha de Venta: {{ $sale->date }}</p>
            </li>
        @endforeach
    </ul>
@endsection

