<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Registro</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
    <div class="form-container">
        <h1>Nuevo registro</h1>

        <?php if (isset($_GET['error'])): ?>
            <p style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
        <?php endif; ?>

        <form action="../controladores/usuarioControlador.php" method="POST">
            <fieldset>
                <legend>Información personal</legend>
                <div class="form-grid">
                    <div class="column">
                        <label for="nombre">Nombre:</label>
                        <input type="text" id="nombre" name="nombre" required><br><br>

                        <label for="edad">Edad:</label>
                        <input type="number" id="edad" name="edad" min="10" max="99" required><br><br>

                        <label for="email">Email:</label>
                        <input type="email" id="email" name="email" required><br><br>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <legend>Seguridad</legend>
                <div class="column">
                    <label for="contrasena">Contraseña:</label>
                    <input type="password" id="contrasena" name="contrasena" required autocomplete="new-password"><br><br>

                    <label for="confirmContrasena">Confirmar contraseña:</label>
                    <input type="password" id="confirmContrasena" name="confirmContrasena" required><br><br>
                </div>
            </fieldset>

            <fieldset>
                <legend>Información sobre el tabaquismo</legend>
                <div class="column">
                    <label for="tabaco">¿Cuántos cigarros fumas al día?:</label>
                    <input type="number" id="tabaco" name="tabaco" required><br><br>

                    <label for="cantidad">¿Desde hace cuánto tiempo que fumas?</label>
                    <input type="number" id="cantidad" name="cantidad" min="1" max="99" required><br><br>

                    <label for="dejar">¿Has intentado dejar de fumar antes?</label>
                    <select id="dejar" name="dejar">
                        <option value="si">Si</option>
                        <option value="no">No</option>
                    </select><br><br>
                </div>
            </fieldset>

            <fieldset>
                <legend>Información de apoyo</legend>
                <div class="column">
                    <label for="apoyo">¿Tienes apoyo familiar para dejar de fumar?</label>
                    <select id="apoyo" name="apoyo">
                        <option value="si">Si</option>
                        <option value="no">No</option>
                    </select><br><br>

                    <label for="razon">¿Porque quieres dejar de fumar?</label>
                    <textarea id="razon" name="razon"></textarea><br><br>
                </div>
            </fieldset>

            <fieldset>
                <legend>Actividades físicas</legend>
                <div class="column">
                    <label for="actividades">¿Te gustaría participar en actividades físicas, como caminatas, para ayudarte a dejar de fumar (Si/No)?</label>
                    <input type="text" id="actividades" name="actividades" required><br><br>

                    <label for="salud">¿Tienes alguna condición de salud que debamos considerar para recomendar actividades?</label>
                    <input type="text" id="salud" name="salud" required><br><br>
                </div>
            </fieldset>

            <div class="button-container">
                <button type="submit">Confirmar</button>
                <a href="../index.php" class="return-button">Volver al Inicio</a>
            </div>
        </form>
    </div>
</body>
</html>