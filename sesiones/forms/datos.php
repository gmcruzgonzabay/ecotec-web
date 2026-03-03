<?php
$nombre='';
$correo='';
$edad='';
$errores=[];
$mensaje='';  
$nombreError = false;
$correoError=false;
    

        //Agrego un arreglo
            if($_SERVER["REQUEST_METHOD"]=="POST")
            {      
                $nombre = trim($_POST['nombre'] ?? '');
                $correo = trim($_POST['correo'] ?? '');
                $edad   = trim($_POST['edad'] ?? '');       
        // Validaciones
        if($nombre === '' || strlen($nombre) < 3)
        {
          $errores[] = "El nombre es obligatorio y debe tener al menos 3 caracteres.";
            $nombreError=true;
            
        }
                
        if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
            $errores[]="El correo no tiene un formato valido";
            $correoError=true;
        }          
        if(!ctype_digit($edad)){
            $errores[]="La edad debe ser un numero entero";
        } 
                else{
                    
                    $edadint=(int)$edad;
                    if($edadint<1 || $edadint>120){
                        $errores[]="La edad debe estar entre 1 y 120";
                    }
                }
                
                
               // $nombre=$_POST["nombre"];
                //$correo=$_POST["correo"];
                //$edad=$_POST["edad"];
                
             if(empty($errores))
             {
          $mensaje="
          <div class='alert alert-success mt-3'>
            <h5>Datos Recibidos</h5>
            <p><strong>Nombre:</strong> ".htmlspecialchars($nombre)."</p>
            <p><strong>Correo:</strong> ".htmlspecialchars($correo)."</p>
            <p><strong>Edad:</strong> ".htmlspecialchars($edad)."</p>
          </div>";
            } 
            else
            {
                $mensaje= "<div class='alert alert-danger mt-3'><ul class='mb-0'>";
                foreach($errores as $e)
                    {
                        $mensaje.= "<li>".htmlspecialchars($e)."</li>";
                    }
                $mensaje .= "</ul></div>";
            } //fin else       

                    
            } //fin server
                    
             
        
                
             
        
        
        ?>
        