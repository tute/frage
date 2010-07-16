<div id="frage">
<h2><?= $encuesta['Encuesta']['nombre'] ?></h2>
<?
foreach ($encuesta['Pregunta'] as $frage) {
	echo "<h3>{$frage['pregunta']}</h3>";
	$results = array();
	foreach ($frage['PreguntasVoto'] as $voto) {
		$results[$voto['valor']][] = $voto;
	}
	foreach ($results as $voto => $detalle) {
		/* FIXME: Mapear voto a opciones[tipo][id] (valor real y no id) */
		echo "<p>$voto: " . count($detalle) . "</h3>";
	}
}
?>
</div>
