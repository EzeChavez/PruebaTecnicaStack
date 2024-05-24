<?php

namespace App\Http\Controllers;
use App\Models\Consulta;


class ConsultaController extends Controller
{
    public function index()
    {
        // Obtener las últimas 10 consultas desde la base de datos
        $historial = Consulta::latest()->take(10)->get();

        return view('welcome', compact('historial'));
    }
}


