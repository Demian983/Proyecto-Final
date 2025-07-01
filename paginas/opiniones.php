<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Opiniones</title>
    <link rel="stylesheet" href="../css/Menu.css">
    <link rel="stylesheet" href="../css/Opiniones.css">
</head>
<body>
    <?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $nombre = trim($_POST['nombre'] ?? '');
    $opinion = trim($_POST['opinion'] ?? '');

    if ($nombre === '' || $opinion === '') {
        die("❌ Error: El nombre y la opinión son obligatorios.");
    }

    $carpeta = "../datos/opiniones/";
    if (!is_dir($carpeta)) {
        mkdir($carpeta, 0777, true);
    }

    $contador_path = "../datos/contador.txt";
    if (!file_exists($contador_path)) file_put_contents($contador_path, "1");
    $id = (int)file_get_contents($contador_path);
    file_put_contents($contador_path, $id + 1);

    // Procesar imagen si se sube
    $rutaImagen = "";
    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === 0) {
        $nombreImagen = time() . "_" . basename($_FILES['imagen']['name']);
        $rutaImagen = $carpeta . $nombreImagen;
        move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaImagen);
    }

    // Guardar opinión
    $archivoOpinion = $carpeta . "opinion_" . $id . ".txt";
    $contenido = "nombre=$nombre\nopinion=$opinion\nimagen=$rutaImagen\nlikes=0";

    $resultado = file_put_contents($archivoOpinion, $contenido);

    if (!$resultado) {
        die("Error: No se pudo guardar la opinión.");
    }

    // Recargar para evitar reenvío doble
    header("Location: opiniones.php");
    exit;
}
?>

    <header>
        <h1>Sabor del Sol</h1>
        <h2>Opiniones</h2>
        <nav>
            <div class="nav-links" id="navLinks">
                <a href="../index.html">Inicio</a>
                <a href="recetas.html">Platillos</a>
                <a href="reservas.php">Reservas</a>
                <a href="ubicacion.html">Ubicación</a>
            </div>
        </nav>
    </header>

    <main class="contenedor-opiniones">
        <section class="formulario-opinion">
            <h3>Comparte tu experiencia</h3>
            <form action="" method="POST" enctype="multipart/form-data">
                <label for="nombre">Nombre:</label>
                <input type="text" name="nombre" id="nombre" required>

                <label for="opinion">Opinión:</label>
                <textarea name="opinion" id="opinion" required></textarea>

                <label for="imagen">Sube una imagen (opcional):</label>
                <input type="file" name="imagen" id="imagen" accept="image/*">

                <button type="submit">Enviar opinión</button>
            </form>
        </section>

        <section class="lista-opiniones">
            <h3>Opiniones de otros usuarios</h3>
            <?php include("../php/mostrar_opiniones.php"); ?>
        </section>
    </main>
</body>
</html>
