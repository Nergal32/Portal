<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;

class DashboardController extends Controller
{
    public function index()
    {
        $applications = Application::where('user_id', auth()->user()->id)
            ->orWhere('case_manager_id', auth()->user()->id)
            ->get();
        return view('dashboard', ['applications' => $applications]);
    }
    
    
}
