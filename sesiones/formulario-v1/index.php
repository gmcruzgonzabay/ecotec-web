<!doctype html>
<html lang="es">
<head>
<title>Integración de PHP  + HTML</title>   
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" >   
</head>
<body class="bg-light">
<div class=container mt-5>
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
        <h4 class="mb-0"> Formulario de Registro</h4>
        </div>
    </div>
    
    
    <div class="card-body">
        
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre" class="form-control" >
            </div>
            
             <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="text" name="correo" class="form-control" >
            </div>
               <div class="mb-3">
                <label class="form-label">Edad</label>
                <input type="number" name="edad" class="form-control" >
            </div>
            
            <button class="btn btn-success w-100" type="submit"> Enviar Información</button>
            
        </form>
        
        <?php
            if($_SERVER["REQUEST_METHOD"]=="POST")
            {
           
                $nombre=trim($_POST["nombre"] ?? '');
                $correo=trim($_POST["correo"] ?? '') ;
                $edad=trim($_POST["edad"] ?? '');
                $errores=[];
                
                if( $nombre==='' || strlen($nombre) <3 )
                {
                    $errores[]="El nombre es obligatorio y debe tener 3 dígitos" ;   
                }
                
                if(!filter_var($correo,FILTER_VALIDATE_EMAIL))
                {
                    $errores[]="El correo no tiene un formato válido";
                }
                
                if(!ctype_digit($edad))
                {
                    $errores[]="La edad debe ser un número entero";
                    
                }
                else{
                    
                    $edadint=(int)$edad;
                    if($edadint < 1 || $edadint >80)
                    {
                        $errores[]="La edad debe estar entre 1 y 80";
                    }
                    
                }
                
                if(empty($errores))
                {
                    
                    echo " 
                    <div class='alert alert-success mt-3'>
                    <h5> Datos del Formulario</h5>
                    <p> <strong> Nombre:</strong>".htmlspecialchars($nombre)."</p>
                     <p> <strong> Correo:</strong>".htmlspecialchars($correo)."</p>
                     <p> <strong> Edad:</strong>".htmlspecialchars($edad)."</p>
                    
                    
                    </div>
                    ";
                    
                } // fin if errores
                else{
                    
                    echo "<div class='alert alert-danger mt-3'> <ul class='mb-0'>";
                    foreach($errores as $e)
                    {
                        echo "<li> ".htmlspecialchars($e)."</li>";
                    }
                    echo" </ul></div>";
                    
                }
                
                
                
                /*if(isset($_POST["nombre"]) && !empty($_POST['nombre']) 
                 && isset($_POST["correo"]) && isset($_POST["edad"]))
                 */
           
            

                 
            }// fin del $_SERVER   
                 
                
             
        
        
        ?>
        
    
    </div>
    
</div>
    
    

	


    
    
</body>
    

    
</html>
