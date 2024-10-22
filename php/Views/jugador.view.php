<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Colores</title>
</head>
<body>
    <h2>Selecciona tu nombre y colores favoritos</h2>
    <form action="#" method="post">
        <!-- Campo para el nombre -->
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required>
        <br><br>

        <!-- Desplegable de colores -->
        <label for="color">Selecciona un color:</label>
        <select id="color" name="color" required>
            <option value="">Selecciona un color</option>
            <option value="rojo">Rojo</option>
            <option value="azul">Azul</option>
            <option value="verde">Verde</option>
            <option value="amarillo">Amarillo</option>
        </select>
        <br><br>

        <button type="submit">Enviar</button>
    </form>
</body>
</html>
