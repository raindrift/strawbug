<?php
class NotesController extends AppController {

	var $name = 'Notes';

	# this add method has no view file, since its only view is an element.
	# it always redirects.
	function add() {
		if (!empty($this->data)) {
			$this->Note->create();
			
			$user = $this->Auth->user();
			$this->data{'Note'}{'user_id'} = $user{'User'}{'id'};
			$this->data{'Note'}{'type'} = 'comment';
			
			if ($this->Note->save($this->data)) {
				$this->Session->setFlash(__('The note has been saved', true));
			} else {
				$this->Session->setFlash(__('The note could not be saved. Please, try again.', true));
			}
			$this->redirect(array('controller' => 'bugs', 'action' => 'view', $this->data{'Note'}{'bug_id'}));
		}
	}
	
	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for note', true));
			$this->redirect(array('action'=>'index'));
		}
		
		if(!$this->Acl->check(
			array('model' => 'User', 'foreign_key' => $this->Auth->user('id')),
			'Bug',
			'delete'
		)) {
			$this->Session->setFlash(__('Insufficient permissions to delete this note.', true));
			$this->redirect(array('controller' => 'bugs', 'action' => 'view', $this->data{'Note'}{'bug_id'}));
		};
		
		# fetch so that it's possible to redirect.
		$this->data = $this->Note->read(null, $id);
				
		if ($this->Note->delete($id)) {
			$this->Session->setFlash(__('Note deleted', true));
			$this->redirect(array('controller' => 'bugs', 'action' => 'view', $this->data{'Note'}{'bug_id'}));
		}
		$this->Session->setFlash(__('Note was not deleted', true));
		$this->redirect(array('controller' => 'bugs', 'action' => 'view', $this->data{'Note'}{'bug_id'}));
	}
}
