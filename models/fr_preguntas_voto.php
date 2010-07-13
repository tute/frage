<?php
class FrPreguntasVoto extends AppModel {
	var $name = 'FrPreguntasVoto';
	var $displayField = 'id';
	var $belongsTo = array('Usuario', 'Pregunta', 'Opcion');
}
?>
