function calcularAhorro() {
    let cigarrillosPorDia = localStorage.getItem("cigarrillosPorDia") || 5;
    let costoPorCigarrillo = 0.50;

    let diasInput = document.getElementById("diasSinFumar");
    let diasSinFumar = diasInput ? parseInt(diasInput.value) || 0 : 0;

    let usuario_id = sessionStorage.getItem("usuario_id") || localStorage.getItem("usuario_id");

    // Clave única por usuario
    let ahorroKey = `ahorroTotal_${usuario_id}`;

    let ahorroAnterior = parseFloat(localStorage.getItem(ahorroKey)) || 0;

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

    // Guardar ahorro individual por usuario
    localStorage.setItem(ahorroKey, ahorroTotal);

    if (usuario_id) {
        guardarAhorro(usuario_id, ahorroTotal); 
    }
}
