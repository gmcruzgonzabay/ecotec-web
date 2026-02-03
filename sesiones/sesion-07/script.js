document.addEventListener("DOMContentLoaded",function(){
    console.log("Archivo cargado"); 
    //1- Inicio del programa
    //2-llamada al API
    //3- Fin del programa 
    /*
     async function ejecutar(){
        console.log("Esperando");
        ///espera hasta que llegue "esperar"
        const mensaje= await esperar();
        console.log(mensaje);
        console.log("Fin del proceso");
    }
    
    function esperar()
    {
        return new Promise(resolve=>{
            setTimeout(()=>{
            return resolve("Datos recibidos");
        },2000);
        });
    } 
    
    ejecutar();*/
    
class Persona
    {
        //Inicializo los atributos de la clase
        constructor(nombre,email, ciudad, empresa ){
            this.nombre=nombre;
            this.email=email;
            this.ciudad=ciudad;
            this.empresa=empresa;
        }
        
        info(){
            return ` Nombre: ${this.nombre}, email: ${this.email}, ciudad: ${this.ciudad},
            ${this.empresa}`; 
        }
        
    } //fin clase Persona
    
    const btnCargar= document.getElementById("btnCargar");
    const resultado=document.getElementById("resultado");
    
    btnCargar.addEventListener("click",cargarPersonas);
    
    async function cargarPersonas(){
        
        try 
        {
            resultado.innerText="Cargando datos......";
            const response= await fetch("https://jsonplaceholder.typicode.com/users");
            const data =await response.json();
            const personas= data.map(user=>
                                    new Persona(
                user.name,
                user.email,
                user.address.city,
                user.company.name
            ));
            mostrarPersonas(personas); 
            
        }// fin try
        catch(error)
        {
          resultado.innerText="Error al consultar los datos";
            console.error(error);
            
        }// fin catch
    } // fin de la funcion async cargarPersonas
   
    //Muestra información del api en etiqueta <pre>
   /* function mostrarPersonas(personas){
        resultado.innerHTML="";
        personas.forEach(persona=>{
            const pre= document.createElement("pre");
            pre.textContent=persona.info();
            resultado.appendChild(pre);
        });
    }*/
    
    
        function mostrarPersonas(personas){
        
            const tbody=document.querySelector("#tablaPersonas tbody ");
            tbody.innerHTML="";
            
            personas.forEach(persona=>{
               
                const tr = document.createElement("tr");
                tr.innerHTML=`
                <td>${persona.nombre}</td>
                <td>${persona.email}</td>
                <td>${persona.ciudad}</td> 
                <td>${persona.empresa}</td>
                `;
                tbody.appendChild(tr);
            });
           
            resultado.innerText="";
        
    }


});