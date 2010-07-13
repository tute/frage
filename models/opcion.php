<?php
class Opcion extends AppModel {
	var $name = 'Opcion';
	var $useTable = 'fr_opciones';
	var $displayField = 'opcion';
	var $belongsTo = array(
		'Pregunta' => array(
			'className' => 'Frage.Pregunta',
			'foreignKey' => 'fr_pregunta_id'
		)
	);
}
?>
