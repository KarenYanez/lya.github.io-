<?php
// Función para calcular el factorial de un número
function factorial($numero)
{
    $total = 1;
    for ($i = $numero; $i >= 1; $i--) {
        $total = $total * $i;
    }
    return $total;
}

// Función para verificar si un número es primo
function esPrimo($numero)
{
    if ($numero <= 1) return false;
    for ($i = 2; $i <= sqrt($numero); $i++) {
        if ($numero % $i == 0) return false;
    }
    return true;
}

// Función para calcular la serie matemática
function calcularSerie($numero)
{
    $resultado = 0;
    for ($i = 1; $i <= $numero; $i++) {
        $termino = pow($i, 2) / factorial($i);
        $resultado += ($i % 2 != 0) ? $termino : -$termino;
    }
    return $resultado;
}

// Variables para manejar el formulario y resultados
$opcion = isset($_GET['opcion']) ? $_GET['opcion'] : '';
$numero = isset($_POST['numero']) ? (int)$_POST['numero'] : 0;
$terminos = isset($_POST['terminos']) ? (int)$_POST['terminos'] : 0;
$resultado = '';
$error = '';

// Validar el número ingresado (debe estar entre 0 y 10)
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($numero < 0 || $numero > 10) {
        $error = 'El número debe estar entre 0 y 10.';
    } else {
        switch ($opcion) {
            case 'factorial': // Calcular factorial
                $resultado = 'El factorial de ' .$numero . ' es: ' . factorial($numero);
                break;
            case 'primo': // Verificar si es primo
                $resultado = esPrimo($numero) ? $numero . ' es un número primo.' : $numero . ' no es un número primo.';
                break;
            case 'serie': // Calcular la serie matemática
                if ($terminos < 1) {
                    $error = 'Debe ingresar al menos un término para la serie.';
                } else {
                    $resultado = 'El resultado de la serie es: ' . calcularSerie($terminos);
                }
                break;
            default:
                $error = 'Opción no válida.';
                break;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú 01</title>
    <!-- Enlace a la hoja de estilos de Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: rgb(195, 155, 248); /* Fondo azul */
        }

        .navbar-custom .nav-link:hover {
            color: rgb(242, 244, 247); /* Color del texto al pasar el ratón */
        }

        .form-container {
            max-width: 400px;  /* Ajusta el tamaño máximo del contenedor */
            height: 400px; 
            margin: 0 auto;    /* Centra el formulario en la página */
            padding: 20px;     /* Espaciado interno */
            border: 2px solid #ddd;  /* Borde suave alrededor del formulario */
            border-radius: 10px;  /* Bordes redondeados */
            background-color: #f9f9f9; /* Fondo claro para diferenciar */
            margin-top: 30px;  
            border-color:black;
        }

        .form-container form {
            display: block; /* Asegura que el formulario tenga el comportamiento estándar */
            text-align: center; /* Centra todo el contenido dentro del formulario */
            margin-top: 50px; 
        }

        .btn-primary {
            background-color:rgb(190, 54, 223); /* Azul personalizado */
            color: white; /* Texto blanco */
            border-radius: 5px; /* Bordes redondeados */
        }

        .btn-primary:hover {
            background-color:  rgb(195, 155, 248); /* Azul más oscuro al pasar el ratón */
        }

        .content-section {
            margin-top: 50px;
        }

        .result-container {
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <!-- Menú de navegación con fondo azul y texto blanco -->
    <nav class="navbar navbar-expand-sm navbar-custom">
        <div class="container-fluid">
            <a class="navbar-brand" href="http://localhost/WebSiteS/IIPARCIAL/Tarea%20Individual/">Menú de Opciones</a>
            
            <!-- Botón de hamburguesa (se muestra solo en pantallas pequeñas) -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav d-flex justify-content-around w-100">
                    <li class="nav-item">
                        <a class="nav-link" href="?opcion=factorial">1. Factorial</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?opcion=primo">2. Primo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?opcion=serie">3. Serie Matemática</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?opcion=salir">S. Salir</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Secciones de contenido -->
    <div class="content-section">
        <!-- Verificar si el usuario seleccionó salir -->
        <?php if ($opcion == 'salir'): ?>
            <div class="text-center mt-5">
                <h2>¡Gracias por usar el menú!</h2>
            </div>
        <?php else: ?>
            <!-- Mostrar el formulario correspondiente según la opción seleccionada -->
            <?php if ($opcion == 'factorial'): ?>
                <div class="form-container">
                    <form action="?opcion=factorial" method="POST">
                        <div class="mb-3">
                            <label for="numero" class="form-label">Ingrese un número (0-10):</label>
                            <input type="number" class="form-control" id="numero" name="numero" min="0" max="10" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Calcular</button>
                        
                        <!-- Mostrar resultados o errores dentro del formulario -->
                        <div class="result-container">
                            <?php if ($error != ''): ?>
                                <div class="alert alert-danger"><?= $error ?></div>
                            <?php elseif ($resultado != ''): ?>
                                <div class="alert alert-info"><?= $resultado ?></div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>

            <?php elseif ($opcion == 'primo'): ?>
                <div class="form-container">
                    <form action="?opcion=primo" method="POST">
                        <div class="mb-3">
                            <label for="numero" class="form-label">Ingrese un número (0-10):</label>
                            <input type="number" class="form-control" id="numero" name="numero" min="0" max="10" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Calcular</button>
                        
                        <!-- Mostrar resultados o errores dentro del formulario -->
                        <div class="result-container">
                            <?php if ($error != ''): ?>
                                <div class="alert alert-danger"><?= $error ?></div>
                            <?php elseif ($resultado != ''): ?>
                                <div class="alert alert-info"><?= $resultado ?></div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>

            <?php elseif ($opcion == 'serie'): ?>
                <div class="form-container">
                    <form action="?opcion=serie" method="POST">
                        <div class="mb-3">
                            <label for="terminos" class="form-label">Número de términos para la serie:</label>
                            <input type="number" class="form-control" id="terminos" name="terminos" min="1" required>
                        </div>
                        <div class="mb-3">
                            <label for="numero" class="form-label">Ingrese un número para la serie (0-10):</label>
                            <input type="number" class="form-control" id="numero" name="numero" min="0" max="10" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Calcular</button>
                        
                        <!-- Mostrar resultados o errores dentro del formulario -->
                        <div class="result-container">
                            <?php if ($error != ''): ?>
                                <div class="alert alert-danger"><?= $error ?></div>
                            <?php elseif ($resultado != ''): ?>
                                <div class="alert alert-info"><?= $resultado ?></div>
                            <?php endif; ?>
                        </div>
                    </form>
                </div>

            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- Script de Bootstrap (es necesario para que el menú hamburguesa funcione correctamente) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
