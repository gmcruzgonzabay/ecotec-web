<?php
class Usuario{
    public $nombre;
    public $correo;
    public $edad;
    public $errores=[];
    public function __construct($nombre, $correo,$edad){
        $this->nombre=trim($nombre);
        $this->correo=trim($correo);
        $this->edad=trim($edad);
    }//fin contructor
    public function validar(){
        
        if($this->nombre==='' || strlen($this->nombre)<3){
            $this->errores[]="El nombre es obligatorio y debe tener al menos 3 caracteres";
        }
        
         if (!filter_var($this->correo, FILTER_VALIDATE_EMAIL)) {
            $this->errores[] = "El correo no tiene un formato válido.";
        }

        if (!ctype_digit($this->edad)) {
            $this->errores[] = "La edad debe ser un número entero.";
        } else {
            $edadInt = (int)$this->edad;
            if ($edadInt < 1 || $edadInt > 120) {
                $this->errores[] = "La edad debe estar entre 1 y 120.";
            }
        }
        return empty($this->errores); 
        
    }//fin validar
    
    
    public function guardar($conn)
    {
        //	values(?,?,?) son marcadores de posición (placeholders):
        //El primer ? será el nombre
        //Se usan para evitar inyección SQL y para que MySQL sepa que esos valores se enviarán aparte.
        $sql= " INSERT INTO usuarios(nombre,correo,edad) values(?,?,?)";
        //prepare() le dice a MySQL: “Reserva esta consulta con ? y déjala lista”.
        //	Devuelve un objeto llamado statement ($stmt) que representa esa consulta preparada.
        //Si algo está mal (tabla no existe, columna mal escrita), prepare() puede devolver false/null.
        $stmt=$conn->prepare($sql);
        
        /*	bind_param() “pega” (asocia) los valores reales a cada ?.
	•	"ssi" indica el tipo de dato de cada valor, en orden:
	1.	s = string → para $this->nombre
	2.	s = string → para $this->correo
	3.	i = integer → para $this->edad*/

        $stmt->bind_param("ssi",$this->nombre,$this->correo,$this->edad);
        return $stmt ->execute();
        
    }
    
    
    public static function buscar($conn, $termino)
    {
        $sql="select * from usuarios where nombre like ?";
        $stmt=$conn->prepare($sql);
        $busqueda="%".$termino."%";
        $stmt->bind_param("s",$busqueda);
        $stmt->execute();
        $resultado=$stmt->get_result();
        return $resultado->fetch_all(MYSQLI_ASSOC);
        
        
    }
    
    public static function eliminar($conn, $id)
{
    $sql = "DELETE FROM usuarios WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    return $stmt->execute();
}
    
}

?>