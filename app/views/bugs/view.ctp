<div class="bugs view">
<h2><?php  __('Bug');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bug['Bug']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Title'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bug['Bug']['title']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Creator'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($bug['Creator']['name'], array('controller' => 'users', 'action' => 'view', $bug['Creator']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Owner'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($bug['Owner']['name'], array('controller' => 'users', 'action' => 'view', $bug['Owner']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bug['Bug']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bug['Bug']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $bug['Bug']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<?php if($bugPermissions{'update'}) { ?>
			<li><?php echo $this->Html->link(__('Edit Bug', true), array('action' => 'edit', $bug['Bug']['id'])); ?> </li>
		<?php } ?>
		
		<?php if($bugPermissions{'delete'}) { ?>
			<li><?php echo $this->Html->link(__('Delete Bug', true), array('action' => 'delete', $bug['Bug']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $bug['Bug']['id'])); ?> </li>
		<?php } ?>
		<li><?php echo $this->Html->link(__('New Bug', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('All Bugs', true), array('action' => 'index')); ?> </li>
	</ul>
</div>

<div class="actions">
	&nbsp;
</div>

<div class="bug content">

			<?php echo $this->Text->autoLink($this->Breaks->addBreaks($bug['Bug']['content'])); ?>
			&nbsp;

</div>

<div class="related">
	<h3><?php __('Notes');?></h3>
	<?php if (!empty($bug['Note'])):?>

	<?php
		$i = 0;
		foreach ($bug['Note'] as $note):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<div class="note">
			<div class="note_data">
			<dl class="note">
				<?php $i = 0; $class = ' class="altrow"';?>
				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $this->Html->link($note['User']['name'], array('controller' => 'users', 'action' => 'view', $note['User']['id'])); ?>
					&nbsp;
				</dd>

				<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
				<dd<?php if ($i++ % 2 == 0) echo $class;?>>
					<?php echo $note['created'];?>
					&nbsp;
				</dd>
			
				<?php if($bugPermissions{'delete'}) { ?>
					<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Actions'); ?></dt>
					<dd<?php if ($i++ % 2 == 0) echo $class;?>>
						<?php echo $this->Html->link(__('Delete', true), array('controller' => 'notes', 'action' => 'delete', $note['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $note['id'])); ?>
						&nbsp;
					</dd>
				<?php } ?>
			</div>
			<?php if($note['type'] == 'status_change') { ?>
				<div class="note_content_minor">
			<?php } else { ?>
				<div class="note_content">
			<?php } ?>
				<?php echo $this->Text->autoLink($this->Breaks->addBreaks($note['content']));?>
			</div>
		</div>
			
	<?php endforeach; ?>
	
<?php endif; ?>

	<div class="related">

		<?php echo $this->element('newnote')?>
	</div>	

</div>
