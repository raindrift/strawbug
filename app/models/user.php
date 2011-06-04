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
}
?>
