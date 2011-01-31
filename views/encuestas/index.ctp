<div id="frage">
<h2>Administrar encuestas</h2>
<?
foreach ($encuestas as $e) {
	echo '  <h3 style="margin-top:1em"><a href="/frage/encuestas/view/'.$e['Encuesta']['id'].'">' . $e['Encuesta']['nombre'] . '</a>
    <a href="/frage/encuestas/resultados/'.$e['Encuesta']['id'].'">[Resultados]</a>
    <a href="/frage/encuestas/publicar/'.$e['Encuesta']['id'].'/do_it:';
	// Publicar / Despublicar
	echo ($e['Encuesta']['publicar'] ? '0">[Desp' : '1">[P') . 'ublicar]</a>';
	echo $functions->abm($e['Encuesta']['id'], 'encuestas');
	echo "</h3>\n";
}
?>

<p><a href="/frage/encuestas/add">Nueva encuesta</a></p>
</div>
