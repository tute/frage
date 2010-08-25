<?php
foreach ($opciones as $k => $ops) {
	echo "<h3>Grupo $k:</h3>\n<p>";
	$items = array();
	foreach ($ops as $op) {
		$items[] = $op['Opcion']['opcion'];
	}
	echo implode(', ', $items) . ".</p>\n";
}
?>

<p><a href="/frage/opciones/add">Nuevas opciones</a></p>
