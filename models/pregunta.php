<?php
class Pregunta extends AppModel {
	var $name = 'Pregunta';
	var $useTable = 'fr_preguntas';
	var $displayField = 'pregunta';
	var $hasMany = array(
		'Opcion' => array(
			'className' => 'Frage.Opcion'
		)
	);
	var $belongsTo = array(
		'Encuesta' => array(
			'className' => 'Frage.Encuesta',
			'foreignKey' => 'fr_encuesta_id'
		)
	);
}
?>
