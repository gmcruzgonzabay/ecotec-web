<?php
class UsuarioController {

    public function index() {
     
require_once __DIR__ . "/../models/usuario.php";
require_once __DIR__ . "/../config/database.php";
        $mensaje = '';
        $errores = [];
        $nombre = '';
        $correo = '';
        $edad = '';
        $nombreError = false;
        $correoError = false;
        $mostrarDatos = false;
        // POST
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            $usuario = new Usuario(
                $_POST['nombre'] ?? '',
                $_POST['correo'] ?? '',
                $_POST['edad'] ?? ''
            );

            $nombre = $usuario->nombre;
            $correo = $usuario->correo;
            $edad   = $usuario->edad;

            if ($usuario->validar()) {

                if ($usuario->guardar($conn)) {
                    $mensaje = "Datos guardados correctamente";
                } else {
                    $mensaje = "Error al guardar";
                }

            } else {

                $errores = $usuario->errores;

                foreach ($errores as $error) {
                    if (str_contains(strtolower($error), 'nombre')) {
                        $nombreError = true;
                    }
                    if (str_contains(strtolower($error), 'correo')) {
                        $correoError = true;
                    }
                }
            }
        }
        
               // ELIMINAR
if (isset($_GET['accion']) &&
    $_GET['accion'] === 'eliminar' && isset($_GET['id'])) {
    
    $id = (int) $_GET['id'];

    if (Usuario::eliminar($conn, $id)) {
        $mensaje = "Registro eliminado correctamente";
    } else {
        $mensaje = "Error al eliminar";
    }
}
        
        // BUSQUEDA AJAX
if (isset($_GET['accion']) && $_GET['accion'] === 'buscar') {
    $termino = trim($_GET['termino'] ?? '');
    if ($termino === '') {
        echo "";
        exit();
    }
    $usuarios = Usuario::buscar($conn, $termino);
    if (empty($usuarios)) {
        echo "<div class='alert alert-warning mt-3'>
                No se encontraron resultados.
              </div>";
        exit();
    }

    foreach ($usuarios as $row) {
        echo "<div class='mb-3'>";
        echo "<strong>Nombre:</strong> " . $row['nombre'] . "<br>";
        echo "<strong>Correo:</strong> " . $row['correo'] . "<br>";
        echo "<strong>Edad:</strong> " . $row['edad'] . "<br>";
        echo "<button class='btn btn-danger btn-sm btn-eliminar'
                data-id='" . $row['id'] . "'>
                Eliminar
              </button>";
        echo "</div><hr>";
    }

    exit(); // MUY IMPORTANTE
}
        
        
        
        // GET (Buscar)
        $resultados = [];
        $termino = '';

        if (isset($_GET['buscar']) && trim($_GET['buscar']) !== '') {
            $termino = trim($_GET['buscar']);
            $resultados = Usuario::buscar($conn, $termino);
        }
        
        
 
        

        require_once "views/formulario.php";
    }
}