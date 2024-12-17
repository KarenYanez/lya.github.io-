<?php
// Función para generar los primeros N números de Fibonacci
function fibonacci($n) {
    $fibonacci = [1, 1]; // Los dos primeros números son 1
    for ($i = 2; $i < $n; $i++) {
        $fibonacci[] = $fibonacci[$i - 1] + $fibonacci[$i - 2];
    }
    return $fibonacci;
}

// Función para verificar si un número es un número de Armstrong (cubo de sus dígitos)
function esCubo($numero) {
    $suma = 0;
    $numeroStr = strval($numero);
    foreach (str_split($numeroStr) as $digito) {
        $suma += pow((int)$digito, 3);
    }
    return $suma == $numero;
}

// Función para calcular la expresión A + B * C - D con fraccionarios
function calcularFraccionarios($A, $B, $C, $D) {
    return $A + ($B * $C) - $D;
}

// Variables para manejar el formulario y los resultados
$opcion = isset($_GET['opcion']) ? $_GET['opcion'] : '';
$numero = isset($_POST['numero']) ? (int)$_POST['numero'] : 0;
$fraccionarios = isset($_POST['fraccionarios']) ? $_POST['fraccionarios'] : [];

$resultado = '';
$error = '';

// Validación de las opciones
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    switch ($opcion) {
        case 'fibonacci':
            if ($numero < 1 || $numero > 50) {
                $error = 'El número debe estar entre 1 y 50.';
            } else {
                $resultado = 'Los primeros ' . $numero . ' números de Fibonacci son: ' . implode(', ', fibonacci($numero));
            }
            break;
        case 'cubo':
            $MAX = 1000000;
            $numerosCubo = [];
            for ($i = 1; $i <= $MAX; $i++) {
                if (esCubo($i)) {
                    $numerosCubo[] = $i;
                }
            }
            $resultado = 'Los números que cumplen con la condición de cubo son: ' . implode(', ', $numerosCubo);
            break;
        case 'fraccionarios':
            if (count($fraccionarios) == 4) {
                list($A, $B, $C, $D) = $fraccionarios;
                $resultado = 'El resultado de la expresión A + B * C - D es: ' . calcularFraccionarios($A, $B, $C, $D);
            } else {
                $error = 'Debe ingresar exactamente 4 fraccionarios.';
            }
            break;
        default:
            $error = 'Opción no válida.';
            break;
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú 02</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .navbar-custom {
            background-color: rgb(195, 155, 248);
        }

        .navbar-custom .nav-link:hover {
            color: rgb(242, 244, 247);
        }

        .form-container {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 2px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            margin-top: 30px;
        }
        .form-container form {
            display: block; /* Asegura que el formulario tenga el comportamiento estándar */
            text-align: center; /* Centra todo el contenido dentro del formulario */
        }

        .btn-primary {
            background-color: rgb(190, 54, 223);
            color: white;
            border-radius: 5px;
        }

        .btn-primary:hover {
            background-color: rgb(195, 155, 248);
        }

        .content-section {
            margin-top: 50px;
        }
    </style>
</head>
<body>

    <!-- Menú de navegación -->
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
                        <a class="nav-link" href="?opcion=fibonacci">1. Fibonacci</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?opcion=cubo">2. Cubo</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?opcion=fraccionarios">3. Fraccionarios</a>
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
        <?php if ($opcion == 'salir'): ?>
            <div class="text-center mt-5">
                <h2>¡Gracias por usar el menú!</h2>
            </div>
        <?php elseif ($opcion != ''): ?>
            <div class="form-container">
                <form action="" method="POST">
                    <?php if ($opcion == 'fibonacci'): ?>
                        <div class="mb-3">
                            <label for="numero" class="form-label">Ingrese un número (1-50):</label>
                            <input type="number" class="form-control" id="numero" name="numero" min="1" max="50" required>
                        </div>
                    <?php elseif ($opcion == 'cubo'): ?>
                        <div class="mb-3">
                            <label class="form-label">Calculando los números de cubo hasta 1,000,000...</label>
                        </div>
                    <?php elseif ($opcion == 'fraccionarios'): ?>
                        <div class="mb-3">
                            <label for="A" class="form-label">Ingrese A:</label>
                            <input type="number" class="form-control" id="A" name="fraccionarios[]" required>
                        </div>
                        <div class="mb-3">
                            <label for="B" class="form-label">Ingrese B:</label>
                            <input type="number" class="form-control" id="B" name="fraccionarios[]" required>
                        </div>
                        <div class="mb-3">
                            <label for="C" class="form-label">Ingrese C:</label>
                            <input type="number" class="form-control" id="C" name="fraccionarios[]" required>
                        </div>
                        <div class="mb-3">
                            <label for="D" class="form-label">Ingrese D:</label>
                            <input type="number" class="form-control" id="D" name="fraccionarios[]" required>
                        </div>
                    <?php endif; ?>

                    <button type="submit" class="btn btn-primary">Calcular</button>

                    <!-- Mostrar resultados o errores dentro del formulario -->
                    <div class="result-container mt-3">
                        <?php if ($error != ''): ?>
                            <div class="alert alert-danger"><?= $error ?></div>
                        <?php elseif ($resultado != ''): ?>
                            <div class="alert alert-info"><?= $resultado ?></div>
                        <?php endif; ?>
                    </div>
                </form>
            </div>
        <?php endif; ?>
    </div>

    <!-- Script de Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
