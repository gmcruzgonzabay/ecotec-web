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
        
        <!-- Metodo get para la búsqueda-->
        <form method="get" class="mt-3">
            <div class="input-group">
                <input type="text" name="buscar" class="form-control" 
                       placeholder="Buscar por nombre" value="<?= htmlspecialchars($termino ?? '')?>">
            </div>
            
            <button class="btn btn-primary" type="submit">Buscar</button>
        
        </form> <!-- fin form get-->
        
        <!-- Mostrar el resultado-->
        <?php if(!empty($resultado)):  ?>
        <div class="card mt-3">
        <div class="card-header  bg-secondary text-white">
        Resultado de la búsqueda
            
        </div>
            <div class="card-body">
                <?php foreach($resultado as $row): ?>
                <div>
                <div class="mt-3">
                    
                <p><strong>Nombre:</strong><?= htmlspecialchars($row['nombre']) ?></p> 
                <p><strong> Correo:</strong><?= htmlspecialchars($row['correo'])?></p>    
                <p><strong> Edad:</strong><?= htmlspecialchars($row['edad'])?></p>    
                </div>
                </div>
                <?php endforeach;?>
                
            
            </div>
            
        </div>
        <?php elseif(isset($_GET['buscar'])): ?>
        <div class="alert alert-warning">
            No se encontraron resultados.
        
        </div>
        
        
        <?php endif;?>
        
            
        
        
        <form method="post">
            <div class="mb-3">
                <label class="form-label">Nombre</label>
                <input type="text" name="nombre"
                       class="form-control <?= $nombreError ? 'is-valid':''?>" value="<?= htmlspecialchars($nombre)?>" >
                <?php if($nombreError): ?>
                <div class="invalid-feedback">
                El nombre debe tener al menos 3 caracteres
                </div>
                <?php endif;?>
            </div>
            
             <div class="mb-3">
                <label class="form-label">Correo</label>
                <input type="text" name="correo" class="form-control" 
                    value="<?=htmlspecialchars($correo)?>"  >
            </div>
               <div class="mb-3">
                <label class="form-label">Edad</label>
                <input type="number" name="edad" class="form-control" 
                       value="<?=htmlspecialchars($edad)?>">
            </div>
            
            <button class="btn btn-success w-100" type="submit"> Enviar Información</button>
            
        </form>
        
        <?php if(!empty($mensaje)): ?>
        <div class="card border-success">
            <div class="card-header bg-success  text-white">
            Registro exitoso
            </div>
            <div class="card-body">
                <p class="card-text">
                <?= htmlspecialchars($mensaje)?>
                </p>
                <?php var_dump($mostrarDatos); ?>
                <?php if($mostrarDatos):?>
                <hr>
                <p><strong>Nombre:</strong><?=htmlspecialchars($nombre)?></p>
                <p><strong>Correo:</strong><?=htmlspecialchars($correo)?></p>
                <p><strong>Edad:</strong><?=htmlspecialchars($edad)?></p>
              <?php endif; ?>
                
            </div>
        </div>
          <?php endif; ?>
    </div>
</div>

</body>
    
</html>
