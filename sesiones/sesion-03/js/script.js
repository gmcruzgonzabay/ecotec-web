
//funcion de tipo javascript
  let contador='0';

function mostrarMensaje()
{

    let nombre="Juan Perez";
    let edad="20";

//consola

    

   // alert("Hola Mundo!");
   //declaracion de variables

   //const algo que no va a cambiar
   //const resultado=document.getElementById("resultado");
    //resultado.textContent="Hola, ha cambiado el texto";

    //valores que pueden cambiar con la palabra
    //reservada
  
     //contador=contador+1;
     contador++;
   const resultado=document.getElementById("resultado");
   //modificamos el contenido de un parrafo
   resultado.textContent="Hola has hecho un click:" +contador;
   console.log(nombre);
   resultado.style.color="blue";

   //modificar las propiedades de un boton  
    const boton=document.getElementById("boton1");
    boton.style.backgroundColor="green";
    boton.style.color="white";

//    if(contador ==1)
//    {
//         resultado.textContent="Mi Primer Click";
//    }
//    else
//     {
//         resultado.textContent="Has hecho click: "+contador;
//     }

if(contador==5)
{
    boton.disabled=true;
    resultado.textContent="Botón desactivado";
}

}
function mostrarMensaje2(){
    alert("Hola desde la funcion 2");
}

function restablecer(){
const boton=document.getElementById("boton1");
// boton.style.backgroundColor="";
// boton.style.color="";

    setTimeout(function(){
            boton.style.backgroundColor="";
            boton.style.color="";
    },1000);

}

function mouseEncima()
{
    const boton=document.getElementById("boton1");
    boton.style.backgroundColor="red";
    boton.style.color="white";
}

function mouseFuera(){
    const boton=document.getElementById("boton1");
    boton.style.backgroundColor="";

}
