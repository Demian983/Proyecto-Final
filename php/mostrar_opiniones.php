<?php
$dir = "../datos/opiniones/";
$opiniones = [];

// Leer opiniones válidas
foreach (glob($dir . "opinion_*.txt") as $archivo) {
    $contenido = file_get_contents($archivo);
    parse_str(str_replace("\n", "&", $contenido), $data);

    if (!isset($data['nombre']) || !isset($data['opinion'])) {
        unlink($archivo);
        continue;
    }

    $data['archivo'] = $archivo;
    $opiniones[] = $data;
}

// Ordenar por likes
usort($opiniones, fn($a, $b) => ($b['likes'] ?? 0) - ($a['likes'] ?? 0));

// Mostrar opiniones
echo '<div class="lista-opiniones">';
foreach ($opiniones as $op) {
    echo "<div class='opinion'>";
    echo "<strong>" . htmlspecialchars($op['nombre']) . "</strong>";
    echo "<p>" . nl2br(htmlspecialchars($op['opinion'])) . "</p>";
    if (!empty($op['imagen']) && file_exists($op['imagen'])) {
        $rutaRelativa = str_replace("../", "", $op['imagen']);
        echo "<img src='../$rutaRelativa' width='150'><br>";
    }
    echo "<form method='POST' action='../php/votar.php'>";
    echo "<input type='hidden' name='archivo' value='" . htmlspecialchars($op['archivo']) . "'>";
    echo "<button type='submit'>👍 " . intval($op['likes']) . " Likes</button>";
    echo "</form>";
    echo "</div>";
}
echo '</div>';
?>
