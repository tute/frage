<h2>Encuestas</h2>
<ul>
<?
foreach ($preguntas as $p) {
	echo '  <li><a href="/frage/preguntas/edit/'.$p['Pregunta']['id'].'">' . $p['Pregunta']['pregunta'] . '</a></li>';
}
?>
</ul>

<p><a href="/frage/preguntas/add">Nueva pregunta</a></p>
