document.addEventListener("DOMContentLoaded", function () {
    calcularAhorro(); 

    let diasInput = document.getElementById("diasSinFumar");
    if (diasInput) {
        diasInput.addEventListener("input", calcularAhorro);
    }
});

function calcularAhorro() {
    let cigarrillosPorDia = localStorage.getItem("cigarrillosPorDia") || 5;
    let costoPorCigarrillo = 0.50;

    let diasInput = document.getElementById("diasSinFumar");
    let diasSinFumar = diasInput ? parseInt(diasInput.value) || 0 : 0;

    let ahorroAnterior = parseFloat(localStorage.getItem("ahorroTotal")) || 0;

    let ahorroNuevo = diasSinFumar * cigarrillosPorDia * costoPorCigarrillo;

    let ahorroTotal = ahorroAnterior + ahorroNuevo;

    let ahorroFormateado = new Intl.NumberFormat("es-ES", {
        style: "currency",
        currency: "EUR"
    }).format(ahorroTotal);

    let ahorroElemento = document.getElementById("totalAhorro");
    if (ahorroElemento) {
        ahorroElemento.textContent = ahorroFormateado;
    } else {
        console.error("Elemento #totalAhorro no encontrado");
    }

    let progresoAhorro = document.getElementById("progresoAhorro");
    if (progresoAhorro) {
        let maxAhorro = 100; 
        let progreso = Math.min(ahorroTotal, maxAhorro); 
        progresoAhorro.value = progreso;
    }

    localStorage.setItem("ahorroTotal", ahorroTotal);

    let usuario_id = sessionStorage.getItem("usuario_id") || localStorage.getItem("usuario_id");
    if (usuario_id) {
        guardarAhorro(usuario_id, ahorroTotal); 
    }
}

function guardarAhorro(usuario_id, ahorro_diario) {
    fetch("../controladores/guardarAhorro.php", {
        method: "POST",
        headers: {
            "Content-Type": "application/json",
        },
        body: JSON.stringify({ usuario_id, ahorro_diario }), 
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