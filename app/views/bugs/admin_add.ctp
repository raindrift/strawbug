<div class="bugs form">
<?php echo $this->Form->create('Bug');?>
	<fieldset>
		<legend><?php __('Admin Add Bug'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('owner_id');
		echo $this->Form->input('title');
		echo $this->Form->input('status');
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Bugs', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Creator', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>