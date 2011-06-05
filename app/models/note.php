<?php
class Note extends AppModel
{
	var $name = 'Note';
	var $belongsTo = array(
		'User',
		'Bug',
	);
	
	var $validate = array(
		'content' => array(
			'rule' => 'notEmpty',
			'allowEmpty' => false,
			'message' => 'Message content cannot be blank.'
		),
	);
}
?>
