<?php
class User extends AppModel
{
	var $name = 'User';
	
	var $hasMany = array(
		'BugsCreated' => array(
			'className' => 'Bug',
			'foreignKey' => 'user_id',
		),
		'BugsOwned' => array(
			'className' => 'Bug',
			'foreignKey' => 'owner_id',
		),
		'Note',
	);

	var $validate = array(
		'username' => array(
			'rule' => 'alphaNumeric',
			'allowEmpty' => false,
			'message' => 'Your username must contain only alphanumeric characters, and cannot be blank.'
		),
		
		'email' => array(
			'rule' => 'email',
			'allowEmpty' => false,
			'message' => 'A valid email address is required.'
		),
		
		'name' => array(
			'rule' => 'notEmpty',
			'allowEmpty' => false,
			'message' => 'Please enter your name.'
		),

		'password' => array(
			'rule' => array('identicalValue', 'password_confirm'),
			'message' => 'Both passwords must match.'
		),

	);
	
	# custom validation function for password comparison
	function identicalValue( $field=array(), $compare_field=null ) {
		foreach( $field as $key => $value ) { 
			# check both hashed and not, just in case.
			if(
				$value !== $this->data{$this->name}{$compare_field} && 
				$value !== Security::hash($this->data{$this->name}{$compare_field}, null, true)
			) { 
				return false; 
			}
			return true;
		}
	}
	
}
?>
