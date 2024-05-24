<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Arr;
use App\Models\Consulta;
use App\Models\Pregunta;

class StackOverflowController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'etiqueta' => 'required|string',
            'fecha_hasta' => 'nullable|date',
            'fecha_desde' => 'nullable|date',
        ]);
    
        $etiqueta = $request->input('etiqueta');
        $fecha_hasta = $request->input('fecha_hasta');
        $fecha_desde = $request->input('fecha_desde');
    
        $consulta = Consulta::create([
            'etiqueta' => $etiqueta,
            'fecha_hasta' => $fecha_hasta,
            'fecha_desde' => $fecha_desde,
        ]);
    
        $url = 'https://api.stackexchange.com/2.3/questions';
        $response = Http::get($url, [
            'order' => 'desc',
            'sort' => 'activity',
            'tagged' => $etiqueta,
            'site' => 'stackoverflow',
            'todate' => $fecha_hasta ? strtotime($fecha_hasta) : null,
            'fromdate' => $fecha_desde ? strtotime($fecha_desde) : null,
        ]);
    
        $preguntas = $response->json()['items'];
    
        if ($response->successful()) {
            $data = $response->json();
        
            // Guardar las preguntas en la base de datos
            foreach ($data['items'] as $item) {
                // Verificar si la clave 'body' existe antes de intentar acceder a ella
                $cuerpo = Arr::get($item, 'body', '');
        
                Pregunta::create([
                    'consulta_id' => $consulta->id,
                    'id_pregunta' => $item['question_id'],
                    'titulo' => $item['title'],
                    'cuerpo' => $cuerpo,
                    'enlace' => $item['link']
                ]);
            }
        }
    
        return response()->json($preguntas);
    }

    public function muestra(Request $request)
    {
        $request->validate([
            'etiqueta' => 'required|string',
            'fecha_hasta' => 'nullable|date',
            'fecha_desde' => 'nullable|date',
        ]);
    
        $etiqueta = $request->input('etiqueta');
        $fecha_hasta = $request->input('fecha_hasta');
        $fecha_desde = $request->input('fecha_desde');
    
        $consulta = Consulta::create([
            'etiqueta' => $etiqueta,
            'fecha_hasta' => $fecha_hasta,
            'fecha_desde' => $fecha_desde,
        ]);
    
        $url = 'https://api.stackexchange.com/2.3/questions';
        $response = Http::get($url, [
            'order' => 'desc',
            'sort' => 'activity',
            'tagged' => $etiqueta,
            'site' => 'stackoverflow',
            'todate' => $fecha_hasta ? strtotime($fecha_hasta) : null,
            'fromdate' => $fecha_desde ? strtotime($fecha_desde) : null,
        ]);
    
        $preguntas = $response->json()['items'];
        $primerResultado = !empty($preguntas) ? $preguntas[0] : null;

        if ($response->successful()) {
            $data = $response->json();
        
            // Guardar las preguntas en la base de datos
            foreach ($data['items'] as $item) {
                // Verificar si la clave 'body' existe antes de intentar acceder a ella
                $cuerpo = Arr::get($item, 'body', '');
        
                Pregunta::create([
                    'consulta_id' => $consulta->id,
                    'id_pregunta' => $item['question_id'],
                    'titulo' => $item['title'],
                    'cuerpo' => $cuerpo,
                    'enlace' => $item['link']
                ]);
            }
        }
    
        // Obtener las últimas 10 consultas desde la base de datos
        $historial = Consulta::latest()->take(10)->get();

        return view('welcome', compact('primerResultado', 'historial'));
    }
}

