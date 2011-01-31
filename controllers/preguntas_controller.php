<?php
class PreguntasController extends FrageAppController {
	var $name = 'Preguntas';
	var $helpers = array('Html', 'Form');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('completar');
	}

	function completar($id) {
		$u = $this->Auth->user();
		if (!is_array($u)) {
			$this->Session->setFlash('Debe estar logueado para completar encuestas.');
			$this->redirect('/usuarios/login');
		}
		foreach ($this->data as $i => $v) {
			/* Agregar info de usuario_id */
			if (isset($this->data[$i]['PreguntasVoto']))
				$this->data[$i]['PreguntasVoto']['usuario_id'] = $u['Usuario']['id'];

			/* "Aplanar" opciones múltiples */
			if (is_array($this->data[$i]['PreguntasVoto']['valor'])) {
				foreach ($this->data[$i]['PreguntasVoto']['valor'] as $k => $v) {
					$arr = array();
					$arr['valor']          = $v;
					$arr['fr_opcion_id']   = $this->data[$i]['PreguntasVoto']['fr_opcion_id'];
					$arr['fr_pregunta_id'] = $this->data[$i]['PreguntasVoto']['fr_pregunta_id'];
					$arr['usuario_id']     = $this->data[$i]['PreguntasVoto']['usuario_id'];

					$this->data[]['PreguntasVoto'] = $arr;
				}
				unset($this->data[$i]);
			}
		}
		$this->Pregunta->PreguntasVoto->saveAll($this->data);
		$this->redirect('/frage/encuestas/resultados/' . $id);
	}
}
?>
