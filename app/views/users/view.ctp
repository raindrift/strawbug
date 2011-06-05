<div class="users view">
<h2><?php  __('User');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Username'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['username']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Email'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['email']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $user['User']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		
		<?php if($userPermissions{'edit'}) { ?>
			<li><?php echo $this->Html->link(__('Edit User', true), array('action' => 'edit', $user['User']['id'])); ?> </li>
		<?php } ?>
		
		<?php if($userPermissions{'delete'}) { ?>
		<li><?php echo $this->Html->link(__('Delete User', true), array('action' => 'delete', $user['User']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $user['User']['id'])); ?> </li>
		<?php } ?>
		
		<li><?php echo $this->Html->link(__('List Users', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Bugs', true), array('controller' => 'bugs', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Bugs Created', true), array('controller' => 'bugs', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Notes', true), array('controller' => 'notes', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Note', true), array('controller' => 'notes', 'action' => 'add')); ?> </li>
	</ul>
</div>

<div class="related">
	<h3><?php __('Bugs Owned');?></h3>
	<?php if (!empty($user['BugsOwned'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Owner Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Status'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['BugsOwned'] as $bugsOwned):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $bugsOwned['id'];?></td>
			<td><?php echo $bugsOwned['user_id'];?></td>
			<td><?php echo $bugsOwned['owner_id'];?></td>
			<td><?php echo $bugsOwned['title'];?></td>
			<td><?php echo $bugsOwned['status'];?></td>
			<td><?php echo $bugsOwned['created'];?></td>
			<td><?php echo $bugsOwned['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'bugs', 'action' => 'view', $bugsOwned['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'bugs', 'action' => 'edit', $bugsOwned['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'bugs', 'action' => 'delete', $bugsOwned['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $bugsOwned['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>

<div class="related">
	<h3><?php __('Bugs Created');?></h3>
	<?php if (!empty($user['BugsCreated'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('User Id'); ?></th>
		<th><?php __('Owner Id'); ?></th>
		<th><?php __('Title'); ?></th>
		<th><?php __('Status'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($user['BugsCreated'] as $bugsCreated):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $bugsCreated['id'];?></td>
			<td><?php echo $bugsCreated['user_id'];?></td>
			<td><?php echo $bugsCreated['owner_id'];?></td>
			<td><?php echo $bugsCreated['title'];?></td>
			<td><?php echo $bugsCreated['status'];?></td>
			<td><?php echo $bugsCreated['created'];?></td>
			<td><?php echo $bugsCreated['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'bugs', 'action' => 'view', $bugsCreated['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'bugs', 'action' => 'edit', $bugsCreated['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'bugs', 'action' => 'delete', $bugsCreated['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $bugsCreated['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>
</div>
