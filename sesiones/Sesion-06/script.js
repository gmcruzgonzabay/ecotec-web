//Inicio de la clase persona
class Persona{
    
 constructor(nombre,edad)
    {
        this.nombre=nombre;
        this.edad=edad;
    }
    info()
    {
        return `Nombre:${this.nombre}, Edad: ${this.edad}`;
    }
}// Fin de la clase persona
//llamo al evento click del boton
    document.getElementById("btn").addEventListener("click",()=>{
        const p= new Persona("Ana",25);
        document.getElementById("resultado").innerText=p.info();   
    });

/*
 * EXAMEN PARCIAL
DESDE 06/02/2026
HORA 19:00
HASTA: 09/02/2026
HORA 23:00
*/