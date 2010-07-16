<?php
class EncuestasController extends FrageAppController {
	var $name = 'Encuestas';
	var $helpers = array('Frage.functions');

	function index() {
		$this->Encuesta->recursive = 1;
		$this->set('encuestas', $this->paginate());
	}

	function resultados($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid fr encuesta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Encuesta->recursive = 2;
		$this->set('encuesta', $this->Encuesta->read(null, $id));
		$this->set('opciones', $this->Encuesta->Pregunta->Opcion->find('list'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid fr encuesta', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('encuesta', $this->Encuesta->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Encuesta->create();
			if ($this->Encuesta->save($this->data)) {
				$this->Session->setFlash(__('The fr encuesta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fr encuesta could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fr encuesta', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Encuesta->save($this->data)) {
				$this->Session->setFlash(__('The fr encuesta has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The fr encuesta could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Encuesta->read(null, $id);
		}
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for fr encuesta', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Encuesta->delete($id)) {
			$this->Session->setFlash(__('Fr encuesta deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Fr encuesta was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
