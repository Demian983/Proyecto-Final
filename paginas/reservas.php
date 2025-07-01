<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Reservaciones - Sabor del Sol</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/Menu.css">
</head>
<body>
    <header>
        <h1>Sabor del Sol</h1>
        <h2>Reservaciones</h2>
        <nav>
            <div class="nav-container">
                <div class="nav-links" id="navLinks">
                    <a href="../index.html">Inicio</a>
                    <a href="../paginas/recetas.html">Platillos</a>
                    <a href="../paginas/opiniones.php">Opiniones</a>
                    <a href="../paginas/ubicacion.html">Ubicación</a>
                </div>
            </div>
        </nav>
    </header>

    <main class="reservas">
        <section class="formulario-reserva">
            <h2>Haz tu reservación</h2>
            <form action="../php/guardar_reserva.php" method="POST">
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="fecha">Fecha:</label>
                <input type="date" id="fecha" name="fecha" required>

                <label for="hora">Hora:</label>
                <input type="time" id="hora" name="hora" required>

                <label for="personas">Número de personas:</label>
                <input type="number" id="personas" name="personas" min="1" required>

                <button type="submit">Reservar</button>
            </form>
        </section>

        <section class="panel-reservas">
            <h2>Reservaciones registradas</h2>
            <div class="lista-reservas">
                <?php
                $archivo = "../datos/reservas.txt";
                if (file_exists($archivo)) {
                    $reservas = file($archivo, FILE_IGNORE_NEW_LINES);
                    if (count($reservas) > 0) {
                        echo "<ul>";
                        foreach ($reservas as $reserva) {
                            echo "<li>" . htmlspecialchars($reserva) . "</li>";
                        }
                        echo "</ul>";
                    } else {
                        echo "<p>No hay reservaciones registradas aún.</p>";
                    }
                } else {
                    echo "<p>No se encontró el archivo de reservaciones.</p>";
                }
                ?>
            </div>
        </section>
    </main>
</body>
</html>
