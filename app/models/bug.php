<?php
class Bug extends AppModel
{
	var $name = 'Bug';
	var $belongsTo = array(
		'Creator' => array(
			'className' => 'User',
			'foreignKey' => 'user_id',
			'fields' => array('first_name', 'last_name', 'id'),
		),
		'Owner' => array(
			'className' => 'User',
			'foreignKey' => 'owner_id',
			'fields' => array('first_name', 'last_name', 'id'),
		)
	);
}
?>
