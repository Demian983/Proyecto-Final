<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $archivo = $_POST['archivo'];

    if (!file_exists($archivo)) {
        die("Error: Archivo no encontrado.");
    }

    $contenido = file_get_contents($archivo);
    parse_str(str_replace("\n", "&", $contenido), $data);

    $data['likes'] = isset($data['likes']) ? (int)$data['likes'] + 1 : 1;

    $nuevoContenido = "nombre={$data['nombre']}\nopinion={$data['opinion']}\nimagen={$data['imagen']}\nlikes={$data['likes']}";
    file_put_contents($archivo, $nuevoContenido);

    header("Location: ../paginas/opiniones.php");
    exit;
}
?>
