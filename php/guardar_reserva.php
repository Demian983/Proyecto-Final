<?php
$archivo = "../datos/reservas.txt";
$nombre = $_POST['nombre'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$personas = $_POST['personas'];

$reserva = "Nombre: $nombre | Fecha: $fecha | Hora: $hora | Personas: $personas\n";
file_put_contents($archivo, $reserva, FILE_APPEND);
echo "¡Reserva guardada con éxito!";
?>
