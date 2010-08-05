<?php
class FrageAppController extends AppController {
	function beforeFilter() {
		parent::beforeFilter();
		$this->set('PREGUNTAS_TIPOS', array(
			1 => 'Sí o No',
			2 => 'Valores (1 to 5)',
			3 => 'Texto libre'
		));
	}
}
?>
