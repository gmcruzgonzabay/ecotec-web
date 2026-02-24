<?php
class Usuario
{
    public $nombre;
    public $correo;
    public $edad;
    public $errores=[];
    
    public function __construct($nombre,$correo,$edad)
    {
        $this->nombre=trim($nombre);
        $this->correo=trim($correo);
        $this->edad=trim($edad);
        
    }//fin de constructor
    
    public function validar()
    {
        if($this->nombre==='' || strlen($this->nombre)< 3)
        {
            $this->errores[]="El nombre es obligatorio y 
            debe tener al menos 3 dígitos";
            
        }// fin if nombre
        
        if(!filter_var($this->correo, FILTER_VALIDATE_EMAIL)){
            $this->errores[]="El formato del correo no es válido";
            
        }
        if(!ctype_digit($this->edad)){
            $this->errores[]="La edad debe ser un número entero";
            
        }else
        {
            $edadint=(int) $this->edad;
            if($edadint <1 || $edad >80){
                $this->errores[]="La edad debe ser mayor a 2 y menor a 80";
                
            }
            
        }
        return empty($this->error);
        
        
        
        
        
    }//fin de funcion validar
    
    //Funcion para guardar en base de datos
    public function guardar($conn)
    {
        //usuario root
        // contraseña "";   
        $sql= "INSERT INTO usuarios(nombre,correo,edad) values(?,?,?)";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("ssi",$this->nombre,$this->correo,$this->edad);
        return $stmt ->execute();
        
    }
    
    
    //Funcion para consultar en la base de datos;
    publicidad static function buscar($conn,$termino)
    {
        $sql="SELECT * from usuarios where nombre like ?";
        $stmt=$conn->prepare($sql);
        $busqueda="%".$termino."%";
        $stmt->bind_param("s",$busqueda);
        $stmt->execute();
        $resultado=$stmt->get_result();
        return $resultado->fetch_all(MYSQLI_ASSOC);
        
        
    }
    

    
}//fin clase Usuario

?>