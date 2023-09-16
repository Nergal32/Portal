<?php
namespace App\Http\Controllers;
use App\Models\Application; // Używaj poprawnej ścieżki do modelu Application
use Illuminate\Http\Request;
use PDF;

class ApplicationController extends Controller
{
    public function createRequestForm() {
        return view('create-request');
    }

    public function generateRequest(Request $request) {
        $data = $request->all();
        
        // Tutaj możesz przetworzyć dane i wygenerować wniosek
        $application = "Wniosek dla: " . $data['name'] . "\nAdres: " . $data['address'];
        
        return view('request-result', ['application' => $application]);
    }
    public function generatePDF($id)
    {
        $application = Application::find($id);
        $pdf = PDF::loadView('pdf.template', ['application' => $application]);

        return $pdf->stream('wniosek.pdf');
    }
    public function verifyPasswordAndApprove(Request $request, $id)
    {
        // Pobieramy wniosek na podstawie $id
        $application = Application::find($id);

        if (!$application) {
            return response()->json(['message' => 'Wniosek nie istnieje'], 404);
        }

        // Sprawdzamy, czy hasło przekazane w żądaniu jest prawidłowe
        if ($request->password !== 'twoje_haslo') { // Zmień 'twoje_haslo' na rzeczywiste hasło
            return response()->json(['message' => 'Nieprawidłowe hasło'], 401);
        }

        // Jeśli hasło jest poprawne, zmieniamy status wniosku na 'zatwierdzone'
        $application->status = 'zatwierdzone';
        $application->save();

        return response()->json(['message' => 'Wniosek został zatwierdzony']);
    }
}
