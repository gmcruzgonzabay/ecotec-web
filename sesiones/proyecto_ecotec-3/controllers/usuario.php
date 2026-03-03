<?php
class UsuarioController{

    public function index()
    {
            require_once __DIR__ ."/../models/usuario.php";
            require_once __DIR__ ."/../config/database.php";
            
            $mensaje='';
            $errores=[];
            $nombre='';
            $correo='';
            $edad='';
            $nombreError=false;
            $correoError=false;
            $mostrarDatos=false;
            
            //Metodo Post para guardar datos
            if($_SERVER['REQUEST_METHOD']=='POST')
            {
                    $usuario= new Usuario(
                    $_POST['nombre'] ?? '',
                    $_POST['correo'] ?? '',
                    $_POST['edad'] ?? ''
                    );
                    
                    $nombre=$usuario->nombre;
                    $correo=$usuario->correo;
                    $edad=$usuario->edad;
                    
                    if($usuario->validar()){
                            if($usuario->guardar($conn)){
                                    $mensaje='Datos Guardados correctamente';
                            }//fin if usuario->Guardar()
                            else{
                                    
                                    $mensaje='Error al guardar datos';
                            }// fin else
                            
                    }// fin if validar
                    else{
                            
                            foreach($errores as $error)
                            {
         if(str_contains(strtolower($error),'nombre'))
         {
                                $nombreError=true;
         }
                if(str_contains(strtolower($error),'correo'))
                {
                        $correoError=true;
                }                    
                            }
                    }
                    
            }// fin if
            
            
            if(isset($GET['accion']) &&
        $_GET['action']=='eliminar' && isset($_GET['id'])        
              
              
              ) 
            {       
                    $id= (int) $_GET['id'];
                    if(Usuario::eliminar($conn, $id)){
                            $mensaje=' Registro eliminado correctamente';
                            
                    }
                    else
                    {
                            $mensaje='Error al eliminar';
                            
                    }
            }
            

            
            
            
            
            require_once "views/formulario.php";
    }

}

?>