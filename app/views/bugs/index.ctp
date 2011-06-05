<div class="bugs index">
	<h2><?php __('Bugs');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('Creator', 'user_id');?></th>
			<th><?php echo $this->Paginator->sort('owner_id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('status');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($bugs as $bug):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $bug['Bug']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($bug['Creator']['name'], array('controller' => 'users', 'action' => 'view', $bug['Creator']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($bug['Owner']['name'], array('controller' => 'users', 'action' => 'view', $bug['Owner']['id'])); ?>
		</td>
		<td><?php echo $bug['Bug']['title']; ?>&nbsp;</td>
		<td><?php echo $bug['Bug']['status']; ?>&nbsp;</td>
		<td><?php echo $bug['Bug']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $bug['Bug']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $bug['Bug']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $bug['Bug']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $bug['Bug']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Bug', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users', true), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('My Account', true), array('controller' => 'users', 'action' => 'view')); ?> </li>
	</ul>
	
	<?php if($isadmin) { ?>
	<ul>
		<li>Admin</li>
		<li><?php echo $this->Html->link(__('New User', true), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
	<?php } ?>
</div>