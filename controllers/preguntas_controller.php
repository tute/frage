<?php
class PreguntasController extends FrageAppController {
	var $name = 'Preguntas';

	function index() {
		$this->Pregunta->recursive = 0;
		$this->set('preguntas', $this->paginate());
	}

	function completar($id) {
		$u = $this->Auth->user();
		foreach ($this->data as $k => $v) {
			if (isset($this->data[$k]['PreguntasVoto'])) {
				$this->data[$k]['PreguntasVoto']['usuario_id'] = $u['Usuario']['id'];
			}
		}
		$this->Pregunta->PreguntasVoto->saveAll($this->data);
		$this->redirect('/frage/encuestas/resultados/' . $id);
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid fr pregunta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('pregunta', $this->Pregunta->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Pregunta->create();
			if ($this->Pregunta->save($this->data)) {
				$this->Session->setFlash(__('The fr pregunta has been saved', true));
				$this->redirect(array('controller' => 'encuestas'));
			} else {
				$this->Session->setFlash(__('The fr pregunta could not be saved. Please, try again.', true));
			}
		}
		$this->set('frEncuestas', $this->Pregunta->Encuesta->find('list'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fr pregunta', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Pregunta->save($this->data)) {
				$this->Session->setFlash(__('The fr pregunta has been saved', true));
				$this->redirect(array('controller' => 'encuestas'));
			} else {
				$this->Session->setFlash(__('The fr pregunta could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Pregunta->read(null, $id);
		}
		$this->set('frEncuestas', $this->Pregunta->Encuesta->find('list'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for fr pregunta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Pregunta->delete($id)) {
			$this->Session->setFlash(__('Fr pregunta deleted', true));
			$this->redirect(array('controller' => 'encuestas'));
		}
		$this->Session->setFlash(__('Fr pregunta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
