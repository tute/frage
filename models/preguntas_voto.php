<?php
class PreguntasVoto extends AppModel {
	var $name = 'PreguntasVoto';
	var $useTable = 'fr_preguntas_votos';
	var $belongsTo = array(
		'Usuario',
		'Pregunta' => array(
			'className' => 'Frage.Pregunta'
		),
		'Opcion' => array(
			'className' => 'Frage.Opcion'
		)
	);
}
?>
