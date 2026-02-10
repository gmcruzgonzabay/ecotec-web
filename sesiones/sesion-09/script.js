document.addEventListener("DOMContentLoaded", function () {
    console.log("Archivo cargado");
    //declaraciones globales
    const btnCargar = document.getElementById("btnCargar");
    const resultado = document.getElementById("resultado");
    const ordenarAZ = document.getElementById("ordenarAZ");
    const ordenarZA = document.getElementById("ordenarZA");
    let paginaActual=1;
    const porPagina=5;
    let personaVista=[];
    const btnPrev= document.getElementById("prev");
    const btnNext=document.getElementById("next");
    const pageInfo=document.getElementById("pageInfo");
    
    
    //Funcion para cambiar de página
    function cambiarPagina(delta){
        const totalPaginas=Math.ceil(personaVista.length/porPagina) || 1;
        paginaActual=paginaActual+delta;
        if(paginaActual<1)
        {
            paginaActual=1;
        }
        if(paginaActual>totalPaginas)
            {
            paginaActual=totalPaginas;
            }
        
        
    }
    
    //Renderizar o dibujar nueva tabla
    
    function renderPagina(){
        const inicio=(paginaActual-1)*porPagina;
        const fin=inicio+porPagina;
        const lista=personaVista.slice(inicio,fin);
        
        mostrarPersonas(lista);
        const totalPagina=math.ceil(personaVista.length/porPagina) || 1;
        pageInfo.innerText=`Página ${paginaActual} de ${totalPagina}`;
        btnPrev.disabled=(paginaActual==1);
        btnNext.disabled=(paginaActual==totalPagina);
        
        
    }
    
    
    
    //Para la búsqueda
    let personasGlobal = [];
    const buscar = document.getElementById("buscar");

    //Eventos
    btnCargar.addEventListener("click", cargarPersonas);
    buscar.addEventListener("keyup", filtrarPersonas);
    ordenarAZ.addEventListener("click", ordenarNombreAZ);
    ordenarZA.addEventListener("click", ordenarNombreZA);

    //Buscar por nombre
    function filtrarPersonas() {
        console.log("Ingresa a Filtrar Persona");
        const texto = buscar.value.toLowerCase();
        const personasFiltradas = personasGlobal.filter(
            (persona) => persona.nombre.toLowerCase().includes(texto) || persona.ciudad.toLowerCase().includes(texto)
        );
       
        personaVista=personasFiltradas;
        paginaActual=1;
        renderPagina();
        //mostrarPersonas(personasFiltradas);
    }
    //Ordena de A-Z
    function ordenarNombreAZ() {
        personasGlobal.sort((a, b) => a.nombre.localeCompare(b.nombre));
        mostrarPersonas(personasGlobal);
    }

    //Ordena de Z-A
    function ordenarNombreZA() {
        personasGlobal.sort((a, b) => b.nombre.localeCompare(a.nombre));
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
            await esperar(1000);
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
            personasGlobal = personas;
            personaVista=personasGlobal;
            paginaActual=1;
            renderPagina();
            return;
            
            //Cambio en las fechas del examen parcial
            //del 6 de febrero a las 19:00 al 8 de Febrero 23:00

           // mostrarPersonas(personas);
        } catch (error) {
            resultado.innerText = "Error al consultar los datos";
            console.error(error);
        } finally {
            // console.log("Ingresa al bloque del finally");
            document.getElementById("spinner").classList.add("d-none");
            btnCargar.disabled = false;
        } //final finally
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
                <td>
                <button class="btn btn-sm btn-danger button">Eliminar</button>
                <button  class="btn btn-sm btn-info me-1">Ver</button>
               </td>
                `;
            tbody.appendChild(tr);
            
            const btnEliminar=tr.querySelector("button");
            btnEliminar.addEventListener("click",()=>{
                eliminarPersona(persona.email);
            });
            
            //llamar a la función para ver el detalle del usuario
            
            const btnVer= tr.querySelector(".btn-info");
            btnVer.addEventListener("click",()=>{
                verDetalle(persona);
                                    });
            
        });

        resultado.innerText = "";
    }
    
    //Funcion para ver detalle del usuario
    function verDetalle(persona){
        alert(
        `
        DETALLE DEL USUARIO \n\n` +
        `Nombre: ${persona.nombre}\n`+
        `Email: ${persona.email}\n`+
        `Ciudad:${persona.ciudad}\n`+
        `Empresa:${persona.empresa}`    
        
        
        
        );
    }

    //Funcion para eliminar un registro
    function eliminarPersona(email) {
        const confirmar = confirm("¿Está seguro de eliminar este usuario?");
        if (!confirmar) return;
        personasGlobal = personasGlobal.filter((persona) => persona.email !== email);
        mostrarPersonas(personasGlobal);
        document.getElementById("total").innerText = `Total de usuarios: ${personasGlobal.length}`;
    }//Fin funcion de eliminar

    //Simulo una espera
    function esperar(ms) {
        return new Promise((resolve) => setTimeout(resolve, ms));
    }
});
