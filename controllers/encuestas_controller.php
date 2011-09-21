<?php
class EncuestasController extends FrageAppController {
	var $name = 'Encuestas';
	var $helpers = array('Html', 'Form', 'Frage.functions');

	function beforeFilter() {
		parent::beforeFilter();
		$this->Auth->allow('index', 'resultados', 'view');
	}

	function index() {
		$this->Encuesta->recursive = 1;
		$this->set('encuestas', $this->paginate());
	}

	function resultados($id = null) {
		$id = $id ? $id : $this->params['id'];
		if (!$id) {
			$this->Session->setFlash(__('Invalid id', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Encuesta->recursive = 2;
		$this->set('encuesta', $this->Encuesta->read(null, $id));
		$this->set('opciones', $this->Encuesta->Pregunta->Opcion->find('list'));
	}

	function view($id = null) {
		$u = $this->Auth->user();
		if (!is_array($u)) {
			$this->Session->setFlash('Debe estar logueado para completar encuestas.');
			$this->redirect('/usuarios/login');
		}
		$id = $id ? $id : $this->params['id'];
		if (!$id) {
			$this->Session->setFlash(__('Invalid id', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('encuesta', $this->Encuesta->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Encuesta->create();
			if ($this->Encuesta->saveAll($this->data)) {
				$this->Session->setFlash(__('The survey has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The survey could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid id', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			/* Cleanup old questions */
			$this->Encuesta->Pregunta->deleteAll(array('fr_encuesta_id' => $id));
			if ($this->Encuesta->saveAll($this->data)) {
				$this->Session->setFlash(__('The survey has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The survey could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Encuesta->read(null, $id);
		}
	}

	function publicar($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid id', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->Encuesta->saveField('publicar', $this->params['named']['do_it']);
		$this->redirect(array('action' => 'index'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Encuesta->delete($id)) {
			$this->Session->setFlash(__('Survey deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Survey was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}

	function next_question() {
		/* Called by JS to build new forms */
		Configure::write('debug', 0);
		$this->layout = false;
	}
}
?>
