ddocument.addEventListener('DOMContentLoaded', function () {
    cargarMensajes();
});

document.getElementById('formulario-mensaje').addEventListener('submit', function (e) {
    e.preventDefault();
    enviarMensaje();
});

setInterval(cargarMensajes, 5000);

function cargarMensajes() {
    fetch('../controladores/foroControlador.php') 
        .then(response => response.text()) 
        .then(html => {
            document.getElementById('mensajes').innerHTML = html; 
        })
        .catch(error => console.error('Error al cargar mensajes:', error));
}

function enviarMensaje() {
    const formData = new FormData(document.getElementById("formulario-mensaje"));

    fetch('../controladores/procesar_mensaje.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text()) 
    .then(html => {
        document.getElementById('mensajes').innerHTML = html; 
        document.getElementById('mensaje').value = ''; 
    })
    .catch(error => console.error("Error en la petición:", error));
}
