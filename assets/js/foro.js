document.addEventListener('DOMContentLoaded', function () { //Espera a que la pág termine de cargar completamente antes de ejecutar el código
    cargarMensajes() //Llamamos a la función que trae los mensajes desde el servidor y los muestra en la página
})

document.getElementById('formulario-mensaje').addEventListener('submit', function (e) {
    e.preventDefault(); //Evita que la página se recargue al enviar el form
    enviarMensaje();
})

//Cada 5 segundos, revisamos si hay nuevos mensajes
setInterval(cargarMensajes, 5000);
//Creamos la función cargarMensajes() --obtiene los mensajes del servidor y los muestra en el chat

function cargarMensajes() {
    fetch('obtenerMensajes.php') //Pedimos los mensajes al servidor
        .then(reponse => reponse.json())// Convertimos respuesta a formato JSON
        .then(mensajes => {


            let contenedor = document.getElementById('mensajes'); //Buscamos el área donde están los mensajes
            contenedor.innerHTML = ''; //Limpiamos el chat antes de volver a agregar mensajes

            //Recorremos cada mensaje y lo agregamos a la pantalla

            mensajes.forEach(msg => {
                const div = document.createElement('div'); //Creamos un nuevo div para cada mensaje
                div.classList.add('mensaje'); //Le damos la clase CSS 'mensajes'
                div.innerHTML = `<strong> ${msg.fecha}</strong>: ${msg.contenido}`; //Mostramos la fecha y el texto
                contenedor.appendChild(div); //Agregamos el mensaje al área de mensajes

            });

        })
        .catch(error => console.error('Error al cargar mensajes:', error)); // Si hay un error lo mostramos en la consla
}

function enviarMensaje() {
    const formData = new formData(document.getElementById("formulario-mensaje"));
    //Obtiene el texto que envió el usuario

    fetch('guardarMensaje.php', {
        method: 'POST',
        body: formData('formulario-mensaje')
    })
        .then(reponse => reponse.text())
        .then(data => {
            document.getElementById('mensaje').value = '';
            cargarMensajes() //Actualizar mensajes tras enviar uno nuevo    
        })
        .catch(error => console.error('Error al enviar mensaje ', error));

}