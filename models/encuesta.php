<?php
class Encuesta extends AppModel {
	var $name = 'Encuesta';
	var $useTable = 'fr_encuestas';
	var $displayField = 'nombre';
	var $hasMany = array(
		'Pregunta' => array(
			'className' => 'Frage.Pregunta'
		)
	);
}
?>
