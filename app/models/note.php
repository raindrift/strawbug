<?php
class Note extends AppModel
{
	var $name = 'Note';
	var $belongsTo = array(
		'User',
		'Bug',
	);
	
	# TODO: validation goes here.
}
?>
