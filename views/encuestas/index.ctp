<h2>Encuestas</h2>
<ul>
<?
foreach ($encuestas as $e) {
	echo '  <li><a href="/frage/encuestas/edit/'.$e['Encuesta']['id'].'">' . $e['Encuesta']['nombre'] . '</a> '
	. $functions->abm($e['Encuesta']['id'], 'encuestas');
	$functions->listar_preguntas($e['Pregunta']);
	echo "</li>\n";

	// $functions->show_options(1);
}
?>
</ul>

<p><a href="/frage/encuestas/add">Nueva encuesta</a></p>
