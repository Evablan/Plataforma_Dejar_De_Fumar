ddocument.addEventListener('DOMContentLoaded', function () {
    cargarMensajes();
});

// Detectar envío de formulario
document.getElementById('formulario-mensaje').addEventListener('submit', function (e) {
    e.preventDefault();
    enviarMensaje();
});

// Actualizar mensajes cada 5 segundos
setInterval(cargarMensajes, 5000);

function cargarMensajes() {
    fetch('../controladores/foroControlador.php') // Obtener HTML directamente
        .then(response => response.text()) // Convertimos la respuesta a texto (HTML)
        .then(html => {
            document.getElementById('mensajes').innerHTML = html; // Insertar HTML directamente
        })
        .catch(error => console.error('Error al cargar mensajes:', error));
}

function enviarMensaje() {
    const formData = new FormData(document.getElementById("formulario-mensaje"));

    fetch('../controladores/procesar_mensaje.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text()) // Recibimos el HTML directamente
    .then(html => {
        document.getElementById('mensajes').innerHTML = html; // Insertamos el nuevo HTML
        document.getElementById('mensaje').value = ''; // Limpiar el campo de texto
    })
    .catch(error => console.error("Error en la petición:", error));
}
