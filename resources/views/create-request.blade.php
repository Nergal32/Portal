@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Formularz wniosku</h2>
    <form action="{{ route('generatePDF') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Imię i nazwisko:</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="phone">Numer telefonu:</label>
            <input type="text" class="form-control" id="phone" name="phone" required>
        </div>
        <div class="form-group">
            <label for="email">Adres e-mail:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="address">Adres zamieszkania:</label>
            <input type="text" class="form-control" id="address" name="address" required>
        </div>
        <div class="form-group">
            <label for="case_manager">Prowadzący sprawę (ID użytkownika):</label>
            <input type="text" class="form-control" id="case_manager" name="case_manager" maxlength="6" required>
        </div>
        <!-- Wyświetl komunikat o błędzie dla każdego pola -->
        @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('phone')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('email')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('address')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        @error('case_manager')
            <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <button type="submit" class="btn btn-primary">Generuj PDF</button>
        <button type="submit" name="action" value="send" class="btn btn-primary">Wyślij</button>
    </form>
</div>
@endsection
