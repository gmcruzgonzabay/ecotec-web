console.log("JS cargado correctamente");

const form = document.getElementById("formulario");
const passwordInput = document.getElementById("password");
const maxPassword = 12;

form.addEventListener("submit", function (e) {
    e.preventDefault();
    document.getElementById("edad").style.border = "";
    const nombre = document.getElementById("nombre").value;
    const correo = document.getElementById("correo").value;
    const password = document.getElementById("password").value;
    const edad = document.getElementById("edad").value;
    const mensaje = document.getElementById("mensaje");

    if (nombre == "" || correo == "" || password == "" || edad == "") {
        mensaje.innerText = "❌ Todos los campos son obligatorios";
        mensaje.style.color = "red";
        return;
    }

    const nombreRegex = /^[A-Za-zÁÉÍÓÚáéíóúÑñ\s]+$/;

    if (!nombreRegex.test(nombre)) {
        mensaje.innerText = "❌ El nombre solo debe contener letras";
        mensaje.style.color = "red";
        return;
    }

    if (!correoValido(correo)) {
        mensaje.innerText = "❌ Correo no válido";
        mensaje.style.color = "red";
        return;
    }
    // Contraseña
    if (password.length < 6) {
        mensaje.innerText = "❌ La contraseña debe tener al menos 6 caracteres";
        mensaje.style.color = "red";
        return;
    }
    mensaje.innerText = "✅ Campos completos";
    mensaje.style.color = "green";

    //Validacion de la edad
    if (isNaN(edad) || edad < 18) {
        mensaje.innerText = "Debe ser mayor de edad";
        mensaje.style.color = "red";

        document.getElementById("edad").style.border = "2px solid red";
        document.getElementById("edad").focus();

        return;
    }
});

function correoValido(correo) {
    // return correo.includes("@") && correo.includes(".");
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(correo);
}

nombre.addEventListener("input", () => {
  console.log(nombre.value);
});

nombre.addEventListener("change",()=>{
    console.log("El valor final del nombre es:"+nombre.value);
});

const contadorPassword = document.getElementById("contadorPassword");

passwordInput.addEventListener("input", () => {
    const cantidad = passwordInput.value.length;
    contadorPassword.innerText = `${cantidad} / ${maxPassword}`;

    if (cantidad > maxPassword) {
        contadorPassword.style.color = "red";
    } else {
        contadorPassword.style.color = "green";
    }
});
passwordInput.addEventListener("input", () => {
    if (passwordInput.value.length > maxPassword) {
        passwordInput.value = passwordInput.value.slice(0, maxPassword);
    }
});