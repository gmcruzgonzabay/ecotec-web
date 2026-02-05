document.addEventListener("DOMContentLoaded", function () {
    console.log("Archivo cargado");
    //declaraciones globales
    const btnCargar = document.getElementById("btnCargar");
    const resultado = document.getElementById("resultado");
    const ordenarAZ=document.getElementById("ordenarAZ");
    const ordenarZA=document.getElementById("ordenarZA");
    //Para la búsqueda
    let personasGlobal=[];
    const buscar=document.getElementById("buscar");
     

    //Eventos 
    btnCargar.addEventListener("click", cargarPersonas);
    buscar.addEventListener("keyup",filtrarPersonas);
    ordenarAZ.addEventListener("click",ordenarNombreAZ);
    ordenarZA.addEventListener("click",ordenarNombreZA);
    
    
    //Buscar por nombre
    function filtrarPersonas(){
        console.log("Ingresa a Filtrar Persona");
        const texto=buscar.value.toLowerCase();
        const personasFiltradas=personasGlobal.filter((persona)=>
        persona.nombre.toLowerCase().includes(texto) || persona.ciudad.toLowerCase().includes(texto) );
    mostrarPersonas(personasFiltradas);
    }
    //Ordena de A-Z
    function ordenarNombreAZ(){
        personasGlobal.sort((a,b)=>a.nombre.localeCompare(b.nombre));
        mostrarPersonas(personasGlobal);
    }
    
    //Ordena de Z-A
        function ordenarNombreZA(){
        personasGlobal.sort((a,b)=>b.nombre.localeCompare(a.nombre));
        mostrarPersonas(personasGlobal);
    }

    class Persona {
        //Inicializo los atributos de la clase
        constructor(nombre, email, ciudad, empresa) {
            this.nombre = nombre;
            this.email = email;
            this.ciudad = ciudad;
            this.empresa = empresa;
        }

        info() {
            return ` Nombre: ${this.nombre}, email: ${this.email}, ciudad: ${this.ciudad},
            ${this.empresa}`;
        }
    } //fin clase Persona

    async function cargarPersonas() {
        document.getElementById("spinner").classList.remove("d-none");
        //Desactivo el boton
        btnCargar.disabled = true;

        try {
            //Simular el tiempo de espera
            //esperar(100);
            resultado.innerText = "Cargando datos......";
            const response = await fetch("https://jsonplaceholder.typicode.com/users");
            if (!response.ok) {
                throw new Error("Error Http" + response.status);
            }
            const data = await response.json();
            const personas = data.map(
                (user) => new Persona(user.name, user.email, user.address.city, user.company.name)
            );
            //Total de usuarios
            const total = data.length;
            const totalpersonas = personas.length;
            console.log(total);
            console.log(totalpersonas);
            document.getElementById("total").innerText = `Total de usuarios:${data.length}`;
            personasGlobal=personas;

            //Cambio en las fechas del examen parcial
            //del 6 de febrero a las 19:00 al 8 de Febrero 23:00

            mostrarPersonas(personas);
        } catch (error) {
            resultado.innerText = "Error al consultar los datos";
            console.error(error);
        } finally {
            console.log("Ingresa al bloque del finally");
            document.getElementById("spinner").classList.add("d-none");
            btnCargar.disabled = false;
        }//final finally
    } // fin de la funcion async cargarPersonas

    function mostrarPersonas(personas) {
        const tbody = document.querySelector("#tablaPersonas tbody ");
        tbody.innerHTML = "";

        personas.forEach((persona) => {
            const tr = document.createElement("tr");
            tr.innerHTML = `
                <td>${persona.nombre}</td>
                <td>${persona.email}</td>
                <td>${persona.ciudad}</td> 
                <td>${persona.empresa}</td>
                `;
            tbody.appendChild(tr);
        });

        resultado.innerText = "";
    }

    function esperar(ms) {
        return new Promise((resolve) => setTimeout((resolve, ms)));
    }
});
