<!doctype html>
<?php include "datos.php"; ?>
<html lang="es">
<head>
<title>Integración de PHP  + HTML</title>   
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" >   
</head>
<body class="bg-light">
    
<div class=container mt-5>
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
        <h4 class="mb-0"> Formulario de Registros</h4>
        </div>
    </div>
    
    
    <div class="card-body">
        
        <form method="post" >
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre"
                       class="form-control <?php echo $nombreError? 'is-invalid':''; ?>" 
                       value="<?php echo htmlspecialchars($nombre);?>" >
            </div>
            
             <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="text" name="correo" class="form-control" >
            </div>
               <div class="mb-3">
                <label class="form-label">Edad</label>
                <input type="text" name="edad" class="form-control" >
            </div>
            
            <button class="btn btn-success w-100" type="submit"> Enviar Información</button>
            
        </form>
        <?php echo $mensaje; ?>
      
    
    </div>
    
</div>
    
    

	


    
    
</body>
    

    
</html>
