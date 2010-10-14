<div id="frage">
<h2>Administrar encuestas</h2>
<?
foreach ($encuestas as $e) {
	echo '  <h3 style="margin-top:1em"><a href="/frage/encuestas/view/'.$e['Encuesta']['id'].'">' . $e['Encuesta']['nombre'] . '</a>
    <a href="/frage/encuestas/resultados/'.$e['Encuesta']['id'].'">[Resultados]</a>'
	. $functions->abm($e['Encuesta']['id'], 'encuestas');
	echo "</h3>\n";
}
?>

<p><a href="/frage/encuestas/add">Nueva encuesta</a></p>
</div>
