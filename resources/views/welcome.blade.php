<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda de Preguntas en Stack Overflow</title>

    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        form {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Buscar preguntas en Stack Overflow</h1>

        <!-- Formulario de búsqueda -->
        <form action="{{ route('muestra.index') }}" method="GET" class="mb-4">
            <div class="form-group">
                <label for="etiqueta">Etiqueta:</label>
                <input type="text" name="etiqueta" id="etiqueta" class="form-control" required>
            </div>
            <div class="form-row">
                <div class="col">
                    <label for="fecha_desde">Desde:</label>
                    <input type="date" name="fecha_desde" id="fecha_desde" class="form-control">
                </div>
                <div class="col">
                    <label for="fecha_hasta">Hasta:</label>
                    <input type="date" name="fecha_hasta" id="fecha_hasta" class="form-control">
                </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Buscar</button>
        </form>

        <!-- Resultado de la búsqueda -->
        @isset($primerResultado)
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title">Resultado de la búsqueda (API)</h2>
                    @if (!empty($primerResultado))
                        <p><strong>Título:</strong> {{ $primerResultado['title'] }}</p>
                        <p><strong>Enlace:</strong> <a href="{{ $primerResultado['link'] }}" target="_blank">Ver en Stack Overflow</a></p>
                    @else
                        <p>No se encontraron preguntas para la etiqueta proporcionada.</p>
                    @endif
                </div>
            </div>
        @endisset

        <!-- Historial de Búsquedas -->
        <h2 class="mt-5">Historial de Búsquedas (BD)</h2>
        <div class="row">
            @foreach ($historial->chunk(ceil($historial->count() / 3)) as $column)
                <div class="col">
                    <ul class="list-group">
                        @foreach ($column as $consulta)
                            <li class="list-group-item">{{ $consulta->etiqueta }} - {{ $consulta->created_at->format('d/m/Y H:i:s') }}</li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>


