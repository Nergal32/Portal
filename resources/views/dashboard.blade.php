@extends('layouts.app')

@section('content')
<div class="container mt-5 mb-5">
    <div class="text-center my-5">
        <h1 style="font-size: 32px; font-weight: bold;">Witaj, {{ auth()->user()->name }}!</h1>
    </div>
    <div class="row justify-content-between align-items-center mt-4">
        <div class="col-md-5 ml-4 pl-5">
            <h4>Twój wydział:</h4>
            <p>{{ auth()->user()->department }}</p>
        </div>
        <div class="col-md-5 ml-4 pl-5">
            <h4>Jednostka:</h4>
            <p>{{ auth()->user()->unit }}</p>
        </div>
    </div>
    <div class="text-center mt-4">
        <h4>Twoje wnioski</h4>
        <input type="text" id="searchInput" placeholder="Wyszukaj wnioski...">
        @if($applications->isEmpty())
            <p>Nie masz jeszcze żadnych wniosków.</p>
        @else
            <table class="paleBlueRows">
                <thead class="thead-dark">
                    <tr>
                        <th>Lp.<th>
                        <th>Nr zlecenia<th>
                        <th>Nr sprawy OP / PI / RTO <th>
                        <th> Jednostka Organizacyjna zlecająca (z komórką)<th>
                        <th>Podstawa prawna<th>
                        <th>data uzyskanych danych<th>
                        <th>Dane (MSISDN, IMEI, LAC/CID, PESEL, NIP, REGON, INNE)<th>
                        <th>Okres Sprawdzenia<th>
                        <th>l.dz.<th>
                        <th>Nazwa</th>
                        <th>Telefon</th>
                        <th>Email</th>
                        <th>Adres</th>
                        <th>ID użytkownika prowadzącego sprawę</th>
                        <th>Data utworzenia</th>
                        <th>Status wniosku</th>
                        <th>ZATWIERDŹ</th>
                    </tr>
                </thead>
                <tbody>
                @foreach($applications as $application)
                    <tr>
                        <td>{{ $application->name }}</td>
                        <td>{{ $application->phone }}</td>
                        <td>{{ $application->email }}</td>
                        <td>{{ $application->address }}</td>
                        <td>{{ $application->case_manager_id }}</td>
                        <td>{{ $application->created_at->format('d-m-Y') }}</td>
                        <td>
                            @if($application->status == 'zatwierdzony')
                                <a href="{{ route('generate.pdf', $application->id) }}" target="_blank">Zatwierdzony</a>
                            @else
                                <a href="{{ route('generate.pdf', $application->id) }}" target="_blank">Niezatwierdzony</a>
                            @endif
                        </td>
                        <td>
                            <input type="checkbox" class="approval-checkbox" data-id="{{ $application->id }}">
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
</div>

<style>
    table.paleBlueRows {
      font-family: "Times New Roman", Times, serif;
      border: 1px solid #FFFFFF;
      width: 100%;
      text-align: center;
      border-collapse: collapse;
    }
    table.paleBlueRows td, table.paleBlueRows th {
      border: 1px solid #FFFFFF;
      padding: 3px 2px;
    }
    table.paleBlueRows tbody td {
      font-size: 13px;
    }
    table.paleBlueRows tr:nth-child(even) {
      background: #D0E4F5;
    }
    table.paleBlueRows thead {
      background: #0B6FA4;
      border-bottom: 5px solid #FFFFFF;
    }
    table.paleBlueRows thead th {
      font-size: 17px;
      font-weight: bold;
      color: #FFFFFF;
      text-align: center;
      border-left: 2px solid #FFFFFF;
    }
    table.paleBlueRows thead th:first-child {
      border-left: none;
    }
    table.paleBlueRows tfoot {
      font-size: 14px;
      font-weight: bold;
      color: #333333;
      background: #D0E4F5;
      border-top: 3px solid #444444;
    }
    table.paleBlueRows tfoot td {
      font-size: 14px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Pobieramy wszystkie checkboxy z klasą "approval-checkbox"
        const approvalCheckboxes = document.querySelectorAll(".approval-checkbox");

        // Nasłuchujemy zmiany stanu checkboxa
        approvalCheckboxes.forEach((checkbox) => {
            checkbox.addEventListener("change", function () {
                // Sprawdzamy, czy checkbox został zaznaczony
                if (this.checked) {
                    // Pytamy użytkownika o hasło
                    const password = prompt("Proszę podać hasło:");

                    // Weryfikacja hasła
                    if (password === "test") { // Zmień "twoje_haslo" na rzeczywiste hasło
                        // Hasło jest poprawne, możesz oznaczyć wniosek jako "zatwierdzony"
                        // Tutaj możesz użyć AJAX do zmiany statusu wniosku na serwerze
                        // Aktualizacja statusu na stronie po stronie klienta
                        const statusCell = this.parentElement.nextElementSibling;
                        statusCell.textContent = "zatwierdzone";
                    } else {
                        // Hasło jest niepoprawne, odznaczamy checkbox
                        this.checked = false;
                        alert("Nieprawidłowe hasło. Czynność anulowana.");
                    }
                }
            });
        });

        // Dodajemy funkcję do filtrowania tabeli
        document.getElementById('searchInput').addEventListener('keyup', function () {
            let input, filter, table, tr, td, i, j, txtValue;
            input = document.getElementById('searchInput');
            filter = input.value.toUpperCase();
            table = document.querySelector('.paleBlueRows');
            tr = table.getElementsByTagName('tr');

            for (i = 1; i < tr.length; i++) {
                tr[i].style.display = 'none';
                td = tr[i].getElementsByTagName('td');
                for (j = 0; j < td.length; j++) {
                    if (td[j]) {
                        txtValue = td[j].textContent || td[j].innerText;
                        if (txtValue.toUpperCase().indexOf(filter) > -1) {
                            tr[i].style.display = '';
                            break;
                        }
                    }
                }
            }
        });
    });
</script>

@endsection
