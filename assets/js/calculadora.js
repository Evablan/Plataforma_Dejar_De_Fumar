document.addEventListener("DOMContentLoaded", function () {
    calcularAhorro(); // Llamamos la función al cargar la página

    let diasInput = document.getElementById("diasSinFumar");
    if (diasInput) {
        diasInput.addEventListener("input", calcularAhorro);
    }
});

function calcularAhorro() {
    let cigarrillosPorDia = localStorage.getItem("cigarrillosPorDia") || 10;
    let costoPorCigarrillo = 0.50;

    // Obtener los días sin fumar desde el input
    let diasInput = document.getElementById("diasSinFumar");
    let diasSinFumar = diasInput ? parseInt(diasInput.value) || 0 : 0;

    // Obtener el ahorro acumulado anterior desde localStorage
    let ahorroAnterior = parseFloat(localStorage.getItem("ahorroTotal")) || 0;

    // Calcular el ahorro de los días nuevos
    let ahorroNuevo = diasSinFumar * cigarrillosPorDia * costoPorCigarrillo;

    // Sumar el ahorro nuevo al ahorro acumulado
    let ahorroTotal = ahorroAnterior + ahorroNuevo;

    // Formatear el valor en moneda (€)
    let ahorroFormateado = new Intl.NumberFormat("es-ES", {
        style: "currency",
        currency: "EUR"
    }).format(ahorroTotal);

    // Mostrar el ahorro acumulado en el HTML
    let ahorroElemento = document.getElementById("totalAhorro");
    if (ahorroElemento) {
        ahorroElemento.textContent = ahorroFormateado;
    } else {
        console.error("Elemento #totalAhorro no encontrado");
    }

    // Actualizar la barra de progreso
    let progresoAhorro = document.getElementById("progresoAhorro");
    if (progresoAhorro) {
        // Calculamos el valor para la barra de progreso (ajústalo según tus necesidades)
        let maxAhorro = 100; // El valor máximo de ahorro para la barra de progreso
        let progreso = Math.min(ahorroTotal, maxAhorro); // Evitar que el progreso supere el máximo
        progresoAhorro.value = progreso;
    }

    // Guardar el nuevo valor acumulado en localStorage
    localStorage.setItem("ahorroTotal", ahorroTotal);

    // Enviar a la base de datos si hay usuario logueado
    let usuario_id = sessionStorage.getItem("usuario_id") || localStorage.getItem("usuario_id");
    if (usuario_id) {
        guardarAhorro(usuario_id, ahorroTotal); // Se envía el ahorro total correctamente
    }
}

function guardarAhorro(usuario_id, ahorro_diario) {
    fetch("../controladores/guardarAhorro.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ usuario_id, ahorro_diario }), // Corregido
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
