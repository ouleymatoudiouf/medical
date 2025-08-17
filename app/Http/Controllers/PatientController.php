<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientController extends Controller
{
    public function index()
    {
        return view('patient.dashboard'); // Crée la vue resources/views/patient/dashboard.blade.php
    }
}
