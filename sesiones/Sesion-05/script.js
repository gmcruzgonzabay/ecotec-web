console.log("Archivo Cargado");
//Variables globales
const form = document.getElementById("formulario");
const mensaje =document.getElementById("mensaje");
const nombre=document.getElementById("nombre");

let texto= "Estoy programando en JavaScript 2";
const regex=/\d+/;
console.log(regex.test(texto));



form.addEventListener("submit", function (e) {
    //e.preventDefault() no recarga la pagina al presionar submit
    e.preventDefault();
    
    const nombre = document.getElementById("nombre").value;
    const correo = document.getElementById("correo").value;
    const password = document.getElementById("password").value;
    const edad = document.getElementById("edad").value;
    const mensaje = document.getElementById("mensaje");
    
    limpiarErrores();



    if(nombre=="" || correo=="" || password=="" || edad=="" )
        {
            mensaje.innerText="Todos los campos son obligatorios";
            mensaje.style.color="red";
          return;
        }

    
    
    if(password.length<6)
        {
            mensaje.innerText="La contraseña debe tener 6 dígitos";
            mensaje.style.color="red";
            return;
        }
    if(isNaN(edad) || edad<18)
        {
            mensaje.innerText="Debe ser mayor de edad";
            mensaje.style.color="red";
            
            document.getElementById("edad").style.border="2px solid red";
            document.getElementById("edad").focus();
            
            return;
        }
    
    if(!correoValido(correo))
       {
       mensaje.innerText="Correo invalido";
       mensaje.style.color="red";
       return;
       }
    
    
    
    
    
  
});
//Validar el correo, que contenga un @ y un .

function correoValido(correo){
   // return correo.includes("@") && correo.includes("."); forma sencilla de validar un correo
    const emailRegex=/^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(correo);
}

//Funcion para limpiar controles
function limpiarErrores()
{
    mensaje.innerText="";
    mensaje.style.color="";
    
    
}

//Capturar datos en tiempo real
nombre.addEventListener("input",()=>{
    console.log("Esta escribiendo....");
    if(nombre.value.length < 3)
        {
            nombre.style.border="2px solid red";
            
            
        }else{
             nombre.style.border="2px solid green";
        }
});


