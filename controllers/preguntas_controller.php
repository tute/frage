<?php
class PreguntasController extends FrageAppController {
	var $name = 'Preguntas';
	var $helpers = array('Html', 'Form');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('completar');
	}

	function index() {
		$this->Pregunta->recursive = 0;
		$this->set('preguntas', $this->paginate());
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

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid pregunta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('pregunta', $this->Pregunta->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Pregunta->create();
			if ($this->Pregunta->save($this->data)) {
				$this->Session->setFlash(__('The pregunta has been saved', true));
				$this->redirect(array('controller' => 'encuestas'));
			} else {
				$this->Session->setFlash(__('The pregunta could not be saved. Please, try again.', true));
			}
		}
		$this->set('frEncuestas', $this->Pregunta->Encuesta->find('list'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid pregunta', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Pregunta->save($this->data)) {
				$this->Session->setFlash(__('The pregunta has been saved', true));
				$this->redirect(array('controller' => 'encuestas'));
			} else {
				$this->Session->setFlash(__('The pregunta could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Pregunta->read(null, $id);
		}
		$this->set('frEncuestas', $this->Pregunta->Encuesta->find('list'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for pregunta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Pregunta->delete($id)) {
			$this->Session->setFlash(__('Pregunta deleted', true));
			$this->redirect(array('controller' => 'encuestas'));
		}
		$this->Session->setFlash(__('Pregunta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
