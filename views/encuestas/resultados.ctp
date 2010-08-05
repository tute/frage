<script type="text/javascript" src="/frage/js/jquery-1.4.2.min.js"></script>
<script type="text/javascript" src="/frage/js/jquery.flot.js"></script>
<script type="text/javascript">
$(document).ready(function() {
<?php
	foreach ($encuesta['Pregunta'] as $frage) {
	if ($frage['tipo'] != 3) {
	$results = $res = array();
	foreach ($frage['PreguntasVoto'] as $voto) {
		$results[$voto['valor']][] = $voto;
	}
	ksort($results);
	foreach ($results as $v => $vs) {
		if (isset($opciones[$v]))
			$v = $opciones[$v];
		$res[] = array('valor' => $v, 'votos' => count($vs));
	}
	echo "var json = " . json_encode($res) . ";\n";
	?>
	var plot_data = new Array();
	var plot_ticks = new Array(); 
	var max = 0;
	for (var i in json) {
		i = parseInt(i);
		if (max < json[i].votos) max = json[i].votos;
		plot_data.push([i, json[i].votos]);
		plot_ticks.push([i, json[i].valor]);
	}
	$.plot($("#frage_<?= $frage['id'] ?>"), [{
			bars: {"show": "true"},
			color: '#55AD6C',
			data: plot_data
		}],
		{
			yaxis: { min: 0, max: max+1 },
			xaxis: { min: -1, ticks: plot_ticks }
		}
	);
	<?
	echo "\n";
	} // Not text type
	} // foreach frage
	?>
});
</script>

<div id="frage">
<h2><?= $encuesta['Encuesta']['nombre'] ?></h2>
<?
foreach ($encuesta['Pregunta'] as $frage) {
	echo "<h3>{$frage['pregunta']}</h3>";
	if ($frage['tipo'] == 3) {
		echo "<ul>\n";
		foreach ($frage['PreguntasVoto'] as $voto) {
			echo "  <li>{$voto['valor']}</li>\n";
		}
		echo "</ul>\n";
	} else {
		echo '<div id="frage_'.$frage['id'].'" style="width:300px;height:200px;"></div>';
	}
}
?>
</div>
