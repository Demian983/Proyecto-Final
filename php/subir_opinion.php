<?php
$nombre = trim($_POST['nombre'] ?? '');
$opinion = trim($_POST['opinion'] ?? '');

if ($nombre === '' || $opinion === '') {
    die("Error: El nombre y la opinión son obligatorios.");
}

// Ruta de la carpeta
$carpeta = "../datos/opiniones/";
if (!is_dir($carpeta)) {
    mkdir($carpeta, 0777, true);
}

// Obtener un ID único
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

// Guardar opinión en archivo
$archivoOpinion = $carpeta . "opinion_" . $id . ".txt";
$contenido = "nombre=$nombre\nopinion=$opinion\nimagen=$rutaImagen\nlikes=0";

$resultado = file_put_contents($archivoOpinion, $contenido);

if ($resultado === false) {
    die("Error: No se pudo guardar la opinión.");
}

// Redirigir a la página de opiniones
header("Location: ../paginas/opiniones.php");
exit;
?>
