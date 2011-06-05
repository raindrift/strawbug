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
}
