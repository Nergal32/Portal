<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    // Określ pola, które mogą być masowo przypisywane (dla bezpieczeństwa)
    protected $fillable = [
        'name', 'phone', 'email', 'address', 'user_id', 'case_manager_id'
    ];

    // Relacja do modelu User dla prowadzącego sprawę
    public function caseManager() {
        return $this->belongsTo(User::class, 'case_manager_id');
    }    

    // Jeśli wniosek jest również powiązany z użytkownikiem, który go stworzył, możesz dodać dodatkową relację:
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function generateRequest(Request $request) {
        $data = $request->all();
        
        // Tutaj możesz używać modelu Application do operacji na danych wniosku
        $application = new Application(); // Przykładowe użycie modelu
        // ...
    }
}
