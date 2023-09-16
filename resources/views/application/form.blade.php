@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Formularz wniosku</h2>
    <form action="{{ route('generate.request') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Imię i nazwisko:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="address">Adres:</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="date">Wybierz datę:</label>
            <input type="date" id="date" name="date" value="{{ date('Y-m-d') }}">
        </div>
        <!-- Możesz dodać więcej pól formularza według potrzeb --
        >
        <button type="submit" class="btn btn-primary">Generuj wniosek</button>
    </form>
</div>
@endsection
