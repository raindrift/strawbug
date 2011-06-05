<?php
class BugsController extends AppController {

	var $name = 'Bugs';

	function index() {
		$this->Bug->recursive = 0;
		$this->set('bugs', $this->paginate());

		if($this->Acl->check(array('model' => 'User', 'foreign_key' => $this->Auth->user('id')), 'User', 'create')) {
			$this->set('isadmin', true);
		} else {
			$this->set('isadmin', false);
		}
	}

	function view($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid bug', true));
			$this->redirect(array('action' => 'index'));
		}
		
		# using find here and turning up the recursive parameter gives access
		# to the the data linked from the Notes.
		$this->set('bug', $this->Bug->find('first',
			array(
				'conditions' => array('Bug.id' => $id),
				'recursive' => 2,
			)
		));
	}

	function add() {
		if (!empty($this->data)) {
			$this->Bug->create();

			$this->data{'Bug'}{'user_id'} = $this->Auth->user('id');

			# if the bug is assigned, set the status immediately.
			if($this->data{'Bug'}{'owner_id'}) {
				$this->data{'Bug'}{'status'} = 'assigned';
			}
			
			if ($this->Bug->save($this->data)) {
				$this->Session->setFlash(__('The bug has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bug could not be saved. Please, try again.', true));
			}
		}

		$owners = $this->Bug->Owner->find('list');
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
			
			# fetch whatever's in the DB.
			$stored = $this->Bug->read(null, $id);
			
			# if the bug has been assigned, set the status.
			# be sure to check the incoming (and not stored) data, since it's
			# possible the owner and status were changed at the same time.
			if($this->data{'Bug'}{'owner_id'} && $this->data{'Bug'}{'status'} == 'new') {
				$this->data{'Bug'}{'status'} = 'assigned';
			}
			
			# if the status changed, save a note.
			# this could perhaps be wrapped in a transaction, in case the bug update fails.
			if ($this->data{'Bug'}{'status'} != $stored{'Bug'}{'status'}) {
				$this->Bug->Note->create();

				$note_data = array(
					'bug_id' => $id,
					'user_id' => $this->Auth->user('id'),
					'type' => 'status_change',
					'content' => 'Status changed from ' . $stored{'Bug'}{'status'} . ' to ' . $this->data{'Bug'}{'status'},
				);
				
				if (! $this->Bug->Note->save($note_data)) {
					$this->Session->setFlash(__('The note could not be saved. Please, try again.', true));
				}
			}
		
			if ($this->Bug->save($this->data)) {
				$this->Session->setFlash(__('The bug has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The bug could not be saved. Please, try again.', true));
			}
		} else {  #this->data was empty.
			$this->data = $this->Bug->read(null, $id);
		}

		$owners = $this->Bug->Owner->find('list');
		$this->set(compact('owners'));
		
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
