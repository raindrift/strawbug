<?php
class Bug extends AppModel
{
	var $name = 'Bug';
	
	# define the links between models
	var $belongsTo = array(
		'Creator' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
		),
		'Owner' => array(
			'className' => 'User',
			'foreignKey' => 'owner_id',
		)
	);
	var $hasMany = 'Note';
	
	# This behavior allows me to create a <select> list from the options in a mysql enum() type.
	var $actsAs = array('Enumerable');
	
	var $validate = array(
		'title' => array(
			'rule' => 'notEmpty',
			'allowEmpty' => false,
			'message' => 'Bug title cannot be blank.'
		),
		'content' => array(
			'rule' => 'notEmpty',
			'allowEmpty' => false,
			'message' => 'Bug content cannot be blank.'
		),
	);
}
?>
