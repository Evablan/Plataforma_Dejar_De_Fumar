console.log("calculadora.js cargado");

document.addEventListener("DOMContentLoaded", function () {
    // Llamamos la función al cargar la página
    calcularAhorro(); 

    let diasInput = document.getElementById("diasSinFumar");
    if (diasInput) {
        // Recalcular el ahorro cada vez que el usuario cambia el número de días
        diasInput.addEventListener("input", calcularAhorro);
    }
});

function calcularAhorro() {
    let cigarrillosPorDia = localStorage.getItem("cigarrillosPorDia") || 10; // Valor por defecto
    let costoPorCigarrillo = 0.50; // Costo por cigarrillo

    // Obtener los días sin fumar desde el input
    let diasInput = document.getElementById("diasSinFumar");
    let diasSinFumar = diasInput ? parseInt(diasInput.value) || 0 : 0;

    // Calcular el ahorro
    let ahorroTotal = diasSinFumar * cigarrillosPorDia * costoPorCigarrillo;

    // Formatear el valor en moneda (€)
    let ahorroFormateado = new Intl.NumberFormat("es-ES", {
        style: "currency",
        currency: "EUR"
    }).format(ahorroTotal);

    // Mostrar el ahorro en el HTML
    let ahorroElemento = document.getElementById("totalAhorro");
    if (ahorroElemento) {
        ahorroElemento.textContent = ahorroFormateado;
    } else {
        console.error("Elemento #totalAhorro no encontrado");
    }

    // Guardar el dato en localStorage
    localStorage.setItem("ahorroTotal", ahorroTotal);

    // Enviar a la base de datos si hay usuario logueado
    let usuario_id = sessionStorage.getItem("usuario_id") || localStorage.getItem("usuario_id");
    
    console.log("usuario_id:", usuario_id);

    if (usuario_id) {
        guardarAhorro(usuario_id, ahorroTotal); // Enviar el ahorro a la base de datos
    }
}

function guardarAhorro(usuario_id, ahorro_diario) {
    fetch("../controladores/guardarAhorro.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ usuario_id, ahorro_diario }), // Enviamos el ahorro total
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === "success") {
            console.log("Ahorro guardado correctamente en la BD.");
        } else {
            console.error("Error al guardar el ahorro:", data.message);
        }
    })
    .catch(error => console.error("Error:", error));
}
