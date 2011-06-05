<div class="related">
<?php echo $this->Form->create('Note', array('action' => 'add'));?>
	<fieldset>
		<legend><?php __('Add Note'); ?></legend>
	<?php
		echo $this->Form->input('bug_id', array('type' => 'hidden', 'value' => $bug['Bug']['id']));
		echo $this->Form->input('content');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit', true));?>
</div>
