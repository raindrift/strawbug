<div class="notes form">
<?php echo $this->Form->create('Note');?>
	<fieldset>
		<legend><?php __('Admin Add Note'); ?></legend>
	<?php
		echo $this->Form->input('bug_id');
		echo $this->Form->input('user_id');
		echo $this->Form->input('type');
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Notes', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bugs', true), array('controller' => 'bugs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bug', true), array('controller' => 'bugs', 'action' => 'add')); ?> </li>
	</ul>
</div>