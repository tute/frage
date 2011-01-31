<?php
class Encuesta extends AppModel {
	var $name  = 'Encuesta';
	var $order = 'Encuesta.id DESC';
	var $useTable = 'fr_encuestas';
	var $displayField = 'nombre';
	var $hasMany = array(
		'Pregunta' => array(
			'className' => 'Frage.Pregunta'
		)
	);
}
?>
