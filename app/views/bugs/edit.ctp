<div class="bugs form">
<?php echo $this->Form->create('Bug');?>
	<fieldset>
		<legend><?php __('Edit Bug'); ?></legend>
	<?php
		echo $this->Form->input('id');
		echo $this->Form->input('owner_id', array('empty' => '-'));
		echo $this->Form->input('title');
		echo $form->input('status', array('options' => $statusOptions));
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $this->Form->value('Bug.id')), null, sprintf(__('Are you sure you want to delete # %s?', true), $this->Form->value('Bug.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Bugs', true), array('action' => 'index'));?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Creator', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Notes', true), array('controller' => 'notes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Note', true), array('controller' => 'notes', 'action' => 'add')); ?> </li>
	</ul>
</div>