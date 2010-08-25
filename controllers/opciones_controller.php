<?php
class OpcionesController extends FrageAppController {
	var $name = 'Opciones';

	function index() {
		$this->Opcion->recursive = 0;
		$ops = $this->Opcion->find('all');
		$opciones = array();
		foreach ($ops as $k => $v) {
			$opciones[$v['Opcion']['tipo']][] = $v;
		}
		$this->set(compact('opciones'));
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid fr opcion', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('opcion', $this->Opcion->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Opcion->create();
			if ($this->Opcion->save($this->data)) {
				$this->Session->setFlash(__('The fr opcion has been saved', true));
				$this->redirect(array('controller' => 'encuestas'));
			} else {
				$this->Session->setFlash(__('The fr opcion could not be saved. Please, try again.', true));
			}
		}
		$this->set('frEncuestas', $this->Opcion->Encuesta->find('list'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid fr opcion', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Opcion->save($this->data)) {
				$this->Session->setFlash(__('The fr opcion has been saved', true));
				$this->redirect(array('controller' => 'encuestas'));
			} else {
				$this->Session->setFlash(__('The fr opcion could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Opcion->read(null, $id);
		}
		$this->set('frEncuestas', $this->Opcion->Encuesta->find('list'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for fr opcion', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Opcion->delete($id)) {
			$this->Session->setFlash(__('Fr opcion deleted', true));
			$this->redirect(array('controller' => 'encuestas'));
		}
		$this->Session->setFlash(__('Fr opcion was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
?>
