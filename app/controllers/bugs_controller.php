<?php
class BugsController extends AppController {

	var $name = 'Bugs';

	function index() {
		$this->Bug->recursive = 0;
		$this->set('bugs', $this->paginate());
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid bug', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('bug', $this->Bug->read(null, $id));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Bug->create();

			$user = $this->Auth->user();

			$this->data{'Bug'}{'user_id'} = $user{'User'}{'id'};

			# if the bug is assigned, set the status immediately.
			if($this->data{'Bug'}{'owner_id'}) {
				$this->data{'Bug'}{'status'} = 'assigned';
			}
			
			if ($this->Bug->save($this->data)) {
				$this->Session->setFlash(__('The bug has been saved', true));
				#$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bug could not be saved. Please, try again.', true));
			}
		}

		$owners = $this->Bug->Owner->find('list');
		$owners{0} = '-';
		$this->set(compact('owners'));
		
		$statusOptions = $this->Bug->enumOptions('status');
		$statusOptions = array_combine(array_values($statusOptions), array_values($statusOptions));  #FormHelper wants keys & values.
		$this->set(compact('statusOptions'));
	}

	function edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid bug', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			
			# if the bug has been assigned, set the status.
			if($this->data{'Bug'}{'owner_id'} && $this->data{'Bug'}{'status'} == 'new') {
				$this->data{'Bug'}{'status'} = 'assigned';
			}
			
			# TODO: save a note here with info about any status change.
			
			if ($this->Bug->save($this->data)) {
				$this->Session->setFlash(__('The bug has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bug could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Bug->read(null, $id);
		}

		$owners{''} = '-----';
		
		$owners = array_merge($owners, $this->Bug->Owner->find('list'));
		$this->set(compact('creators', 'owners'));
		
		$statusOptions = $this->Bug->enumOptions('status');
		$statusOptions = array_combine(array_values($statusOptions), array_values($statusOptions));  #FormHelper wants keys & values.
		
		$this->set(compact('statusOptions'));
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for bug', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Bug->delete($id)) {
			$this->Session->setFlash(__('Bug deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bug was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
	function admin_index() {
		$this->Bug->recursive = 0;
		$this->set('bugs', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid bug', true));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('bug', $this->Bug->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Bug->create();
			if ($this->Bug->save($this->data)) {
				$this->Session->setFlash(__('The bug has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bug could not be saved. Please, try again.', true));
			}
		}
		$creators = $this->Bug->Creator->find('list');
		$owners = $this->Bug->Owner->find('list');
		$this->set(compact('creators', 'owners'));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid bug', true));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Bug->save($this->data)) {
				$this->Session->setFlash(__('The bug has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bug could not be saved. Please, try again.', true));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Bug->read(null, $id);
		}
		$creators = $this->Bug->Creator->find('list');
		$owners = $this->Bug->Owner->find('list');
		$this->set(compact('creators', 'owners'));
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for bug', true));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Bug->delete($id)) {
			$this->Session->setFlash(__('Bug deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('Bug was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
