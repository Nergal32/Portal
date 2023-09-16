<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF; // Jeśli używasz biblioteki dompdf
use App\Models\Application; 
use App\Models\User;


class RequestController extends Controller
{
    public function generatePDF(Request $request)
    {
        // Pobierz wartość przycisku, który został naciśnięty
        $action = $request->input('action');

        // Dodajemy walidację dla nowego pola
        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required|string',
            'email' => 'required|email',
            'address' => 'required|string',
            'case_manager' => 'nullable|numeric|exists:users,user_id',
            // ... możesz dodać więcej reguł walidacji dla innych pól
        ]);

        // Jeśli przycisk "Wyślij" został naciśnięty
        if ($action == 'send') {
            // Tworzenie nowego wniosku
            $application = new Application();
            $application->name = $request->input('name');
            $application->phone = $request->input('phone');
            $application->email = $request->input('email');
            $application->address = $request->input('address');
            $application->user_id = auth()->user()->id;
            $application->case_manager_id = User::where('user_id', $request->input('case_manager'))->first()->id;
            $application->save();
            // Przekierowanie użytkownika z powrotem do formularza z komunikatem o sukcesie
            return redirect()->back()->with('success', 'Wniosek został pomyślnie wysłany i zapisany w bazie danych!');

        } else { // Jeśli przycisk "Generuj PDF" został naciśnięty
            // Istniejąca logika generowania PDF
            $data = $request->all();
            $pdf = PDF::loadView('pdf_view', $data);
            $pdf->getDomPDF()->set_option("defaultFont", "DejaVu Sans");
            
            // Zwróć plik PDF do pobrania
            return $pdf->download('wniosek.pdf');
        }
        
    }
}
