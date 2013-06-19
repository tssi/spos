<div class="vendors view">
<h2><?php  __('Vendor');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $vendor['Vendor']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $vendor['Vendor']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $vendor['Vendor']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Vendor', true), array('action' => 'edit', $vendor['Vendor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Vendor', true), array('action' => 'delete', $vendor['Vendor']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $vendor['Vendor']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Vendors', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Vendor', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Receivings', true), array('controller' => 'receivings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Receiving', true), array('controller' => 'receivings', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Receivings');?></h3>
	<?php if (!empty($vendor['Receiving'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Date Time'); ?></th>
		<th><?php __('Doc No'); ?></th>
		<th><?php __('Vendor Id'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($vendor['Receiving'] as $receiving):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $receiving['id'];?></td>
			<td><?php echo $receiving['date_time'];?></td>
			<td><?php echo $receiving['doc_no'];?></td>
			<td><?php echo $receiving['vendor_id'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'receivings', 'action' => 'view', $receiving['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'receivings', 'action' => 'edit', $receiving['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'receivings', 'action' => 'delete', $receiving['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $receiving['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Receiving', true), array('controller' => 'receivings', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
