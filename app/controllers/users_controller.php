<?php
class UsersController extends AppController {

	var $name = 'Users';

	function login() {
	}

	function logout() {
		$this->redirect($this->Auth->logout());
	}
	
	function index() {
		$this->User->recursive = 0;
		$this->set('users', $this->paginate());
		
		if($this->Acl->check(
			array('model' => 'User', 'foreign_key' => $this->Auth->user('id')),
			'User',
			'create'
		)) {
			$userPermissions{'create'} = true;
		} else {
			$userPermissions{'create'} = false;
		};
		
		if($this->Acl->check(
			array('model' => 'User', 'foreign_key' => $this->Auth->user('id')),
			'User',
			'update'
		)) {
			$userPermissions{'update'} = true;
		} else {
			$userPermissions{'update'} = false;
		};
		
		if($this->Acl->check(
			array('model' => 'User', 'foreign_key' => $this->Auth->user('id')),
			'User',
			'delete'
		)) {
			$userPermissions{'delete'} = true;
		} else {
			$userPermissions{'delete'} = false;
		};
		$this->set('userPermissions', $userPermissions);
	}

	function view($id = null) {
		# view the currently logged in account by default.
		if(!$id) {
			$id = $this->Auth->user('id');
		}
		
		if (!$id) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}

		$this->set('user', $this->User->find('first',
			array(
				'conditions' => array('User.id' => $id),
				'recursive' => 2,
			)
		));
		
		#$this->set('user', $this->User->read(null, $id));
		
		#TODO: move ACL info into session variables at login, write a permissions helper
		
		# user editing is allowed if this is the user's own account, or if the ACL permits it.
		if(
			$this->Acl->check(array('model' => 'User', 'foreign_key' => $this->Auth->user('id')), 'User', 'update') ||
			$id == $this->Auth->user('id')
		) {
			$userPermissions{'update'} = true;
		} else {
			$userPermissions{'update'} = false;
		}
		
		if($this->Acl->check(
			array('model' => 'User', 'foreign_key' => $this->Auth->user('id')),
			'User',
			'delete'
		)) {
			$userPermissions{'delete'} = true;
		} else {
			$userPermissions{'delete'} = false;
		};

		$this->set('userPermissions', $userPermissions);
		
		if($this->Acl->check(
			array('model' => 'User', 'foreign_key' => $this->Auth->user('id')),
			'Bug',
			'delete'
		)) {
			$bugPermissions{'delete'} = true;
		} else {
			$bugPermissions{'delete'} = false;
		};
		
		if($this->Acl->check(
			array('model' => 'User', 'foreign_key' => $this->Auth->user('id')),
			'Bug',
			'update'
		)) {
			$bugPermissions{'update'} = true;
		} else {
			$bugPermissions{'update'} = false;
		};

		$this->set('bugPermissions', $bugPermissions);
	}

	function add() {
		if (!empty($this->data)) {
			$this->User->create();
			if ($this->User->save($this->data)) {
				# add an ACL entry.
				$aro = new Aro();
				$arodata = array(
					'alias' => $this->data{'User'}{'name'},
					'parent_id' => 2,  #TODO: look this number up by name.
					'model' => 'User',
					'foreign_key' => $this->User->getLastInsertId(),
				);
				
				$aro->save($arodata);
				
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		}
	}

	function edit($id = null) {		
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(__('Invalid user', true));
			$this->redirect(array('action' => 'index'));
		}
		
		if(
			!$this->Acl->check(array('model' => 'User', 'foreign_key' => $this->Auth->user('id')), 'User', 'update') &&
			!$id == $this->Auth->user('id')
		) {
			$this->Session->setFlash(__('Insufficient permissions to edit this account.', true));
			$this->redirect(array('action' => 'index'));
		};
		
		if (!empty($this->data)) {
			# if no new password was supplied, don't update that part.
			if(array_key_exists('password', $this->data{'User'}) && !$this->data{'User'}{'password_confirm'}) {
				unset($this->data{'User'}{'password'});
			}
			
			if ($this->User->save($this->data)) {
				$this->Session->setFlash(__('The user has been saved', true));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The user could not be saved. Please, try again.', true));
			}
		} else {
			$this->data = $this->User->read(null, $id);
		}
		
		if($this->Acl->check(
			array('model' => 'User', 'foreign_key' => $this->Auth->user('id')),
			'User',
			'delete'
		)) {
			$userPermissions{'delete'} = true;
		} else {
			$userPermissions{'delete'} = false;
		};

		$this->set('userPermissions', $userPermissions);
	}

	function delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(__('Invalid id for user', true));
			$this->redirect(array('action'=>'index'));
		}
		
		if(!$this->Acl->check(
			array('model' => 'User', 'foreign_key' => $this->Auth->user('id')),
			'User',
			'delete'
		)) {
			$this->Session->setFlash(__('Insufficient permissions to delete this account.', true));
			$this->redirect(array('action' => 'index'));
		};
		
		if ($this->User->delete($id)) {
			$this->Session->setFlash(__('User deleted', true));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(__('User was not deleted', true));
		$this->redirect(array('action' => 'index'));
	}
}
