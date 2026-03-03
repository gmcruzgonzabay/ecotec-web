<!doctype html>
<html lang="es">
<head>
<title>Php MVC</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
      rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/funciones.js"></script>
    </head>
<body class="bg-light">
<div class="container mt-5">
    <div class="card shadow-lg">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Formulario de Registro</h4>
        </div>
        <div class="card-body">
            <!-- FORMULARIO DE BÚSQUEDA -->
<form method="GET" class="mb-3">
  <div class="input-group">
      <input type="text" id="buscar" class="form-control mb-3" placeholder="Buscar usuario...">
      
    <input type="text"
           name="buscar"
           class="form-control"
           placeholder="Buscar por nombre o correo"
           value="<?= htmlspecialchars($termino ?? '') ?>">
    <button class="btn btn-primary" type="submit">
      Buscar
    </button>
  </div>
</form>
            
<div id="contenedorUsuarios">            
            <?php if (!empty($resultados)): ?>
  <div class="card mt-3">
    <div class="card-header bg-secondary text-white">
      Resultados de búsqueda
    </div>
    <div class="card-body">
      <?php foreach ($resultados as $row): ?>
        <div class="mb-3">
          <strong>Nombre:</strong> <?= htmlspecialchars($row['nombre']) ?><br>
          <strong>Correo:</strong> <?= htmlspecialchars($row['correo']) ?><br>
          <strong>Edad:</strong> <?= htmlspecialchars($row['edad']) ?>
        <a href="index.php?accion=eliminar&id=<?= $row['id'] ?>"
               class="btn btn-danger btn-sm"
               onclick="return confirm('¿Seguro que desea eliminar este registro?')">
               Eliminar
            </a>
            
            <button 
    class="btn btn-danger btn-sm btn-eliminar"
    data-id="<?= $row['id'] ?>">
    Eliminar Con JQ
</button>
        
        </div>
        <hr>
      <?php endforeach; ?>
    </div>
  </div>
<?php elseif(isset($_GET['buscar'])): ?>
  <div class="alert alert-warning mt-3">
    No se encontraron resultados.
  </div>
<?php endif; ?>
            
            </div>          
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Nombre</label>
                    <input type="text"
                           name="nombre"
                           class="form-control <?= $nombreError ? 'is-invalid' : '' ?>"
                           value="<?= htmlspecialchars($nombre) ?>">
                    <?php if ($nombreError): ?>
                        <div class="invalid-feedback">
                            El nombre debe tener al menos 3 caracteres.
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label class="form-label <?=$correoError ? 'is-invalid':''?>" >Correoy</label>
                    <input type="text"
                           name="correo"
                           class="form-control"
                           value="<?= htmlspecialchars($correo) ?>">
                                   <?php if ($correoError): ?>
                        <div class="invalid-feedback">
                            El nombre debe tener al menos 3 caracteres.
                        </div>
                    <?php endif; ?>
                
                </div>

                <div class="mb-3">
                    <label class="form-label">Edad</label>
                    <input type="text"
                           name="edad"
                           class="form-control"
                           value="<?= htmlspecialchars($edad) ?>">
                </div>
                <button class="btn btn-success w-100" type="submit">
                    Enviar Información
                </button>
            </form>
            <!-- CARD DE ÉXITO -->
            <?php if (!empty($mensaje)): ?>
                <div class="card border-success mt-3">
                    <div class="card-header bg-success text-white">
                        Registro Exitoso
                    </div>
                    <div class="card-body">
                        <p class="card-text">
                            <?= htmlspecialchars($mensaje) ?> ✅
                        </p>

                        <?php if ($mostrarDatos): ?>
                            <hr>
                            <p><strong>Nombre:</strong> <?= htmlspecialchars($nombre) ?></p>
                            <p><strong>Correo:</strong> <?= htmlspecialchars($correo) ?></p>
                            <p><strong>Edad:</strong> <?= htmlspecialchars($edad) ?></p>
                        <?php endif; ?>

                    </div><!--card-body-->
                </div><!--card border-success-->
            <?php endif; ?>
        </div><!--card body -->
    </div><!--card shadow-lg -->
</div>
</body>
</html>