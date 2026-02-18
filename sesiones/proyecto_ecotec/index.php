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
                <input type="text" name="nombre" class="form-control" required>
            </div>
            
             <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="text" name="correo" class="form-control" required>
            </div>
               <div class="mb-3">
                <label class="form-label">Edad</label>
                <input type="text" name="edad" class="form-control" required>
            </div>
            
            <button class="btn btn-success w-100" type="submit"> Enviar Información</button>
            
        </form>
        
        <?php
            if($_SERVER["REQUEST_METHOD"]=="POST")
            {
              if(isset($_POST["nombre"]) && !empty($_POST['nombre']) 
                 && isset($_POST["correo"]) && isset($_POST["edad"]))
                 
                 {
                
                $nombre=$_POST["nombre"];
                $correo=$_POST["correo"];
                $edad=$_POST["edad"];
                
                echo "
                <div class='alert alert-success mt-3'> 
                <h5> Datos Recibidos </h5>
                <p><strong> Nombre:</strong> $nombre</p> 
                <p><strong> Nombre:</strong> $correo</p> 
                <p><strong> Nombre:</strong> $edad</p> 
                
                </div>
                
                ";
                }// fin del isset
                 else
                 {
                     
                   echo "
                   <div class='alert alert-danger mt-3'>
                   <h5> Hubo un error</h5>
                   
                   
                   </div>
                   
                   
                   ";
                     
                 }
                 
            }// fin del $_SERVER   
                 
                
             
        
        
        ?>
        
    
    </div>
    
</div>
    
    

	


    
    
</body>
    

    
</html>
