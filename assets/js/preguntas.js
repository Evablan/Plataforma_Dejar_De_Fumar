document.addEventListener("DOMContentLoaded", function () {
    // Cargar respuestas anteriores si el usuario tiene respuestas previas
    cargarRespuestas();

    // Función para guardar las respuestas
    function guardarReflexion() {
        let usuario_id = sessionStorage.getItem("usuario_id"); // Obtener el ID del usuario

        if (!usuario_id) {
            alert("No estás autenticado. Inicia sesión primero.");
            return;
        }

        // Obtener respuestas de las preguntas
        let preguntas = [
            { titulo: "¿Qué logro pequeño celebras hoy en tu camino para dejar de fumar?", contenido: document.getElementById("pregunta1").value },
            { titulo: "¿Cómo te sentiste hoy al respirar profundamente sin el humo del tabaco?", contenido: document.getElementById("pregunta2").value },
            { titulo: "¿Qué cosa nueva o positiva hiciste hoy para cuidar tu salud?", contenido: document.getElementById("pregunta3").value },
            { titulo: "¿Qué palabras de aliento te dirías a ti mismo para seguir adelante?", contenido: document.getElementById("pregunta4").value },
            { titulo: "¿Qué disfrutaste hoy que antes pasabas por alto cuando fumabas?", contenido: document.getElementById("pregunta5").value },
            { titulo: "¿Qué aspecto de tu vida ha mejorado desde que comenzaste este cambio?", contenido: document.getElementById("pregunta6").value }
        ];

        // Enviar las respuestas al backend para guardarlas
        fetch("modelos/guardar_post.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ usuario_id: usuario_id, preguntas: preguntas })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === "success") {
                alert("Respuestas guardadas correctamente");
            } else {
                alert("Hubo un error al guardar las respuestas");
            }
        })
        .catch(error => console.error("Error:", error));
    }

    // Función para cargar las respuestas previas del usuario
    function cargarRespuestas() {
        let usuario_id = sessionStorage.getItem("usuario_id"); // Obtener el ID del usuario

        if (usuario_id) {
            fetch(`../controladores/cargar_preguntas.php?usuario_id=${usuario_id}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === "success" && data.preguntas.length > 0) {
                        // Cargar las respuestas anteriores
                        data.preguntas.forEach((pregunta, index) => {
                            let preguntaTextarea = document.getElementById(`pregunta${index + 1}`);
                            if (preguntaTextarea) {
                                preguntaTextarea.value = pregunta.contenido; // Cargar la respuesta en el textarea
                            }
                        });
                    }
                })
                .catch(error => console.error("Error al cargar respuestas:", error));
        }
    }
});