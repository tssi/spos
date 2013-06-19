<div class="endings view">
<h2><?php  __('Ending');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ending['Ending']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ref No'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ending['Ending']['ref_no']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Login'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ending['Ending']['login']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('User'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ending['Ending']['user']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $ending['Ending']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ending', true), array('action' => 'edit', $ending['Ending']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Ending', true), array('action' => 'delete', $ending['Ending']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $ending['Ending']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Endings', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ending', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ending Details', true), array('controller' => 'ending_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ending Detail', true), array('controller' => 'ending_details', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Ending Details');?></h3>
	<?php if (!empty($ending['EndingDetail'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Ending Id'); ?></th>
		<th><?php __('Item Code'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Qty'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($ending['EndingDetail'] as $endingDetail):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $endingDetail['id'];?></td>
			<td><?php echo $endingDetail['ending_id'];?></td>
			<td><?php echo $endingDetail['item_code'];?></td>
			<td><?php echo $endingDetail['name'];?></td>
			<td><?php echo $endingDetail['qty'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'ending_details', 'action' => 'view', $endingDetail['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'ending_details', 'action' => 'edit', $endingDetail['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'ending_details', 'action' => 'delete', $endingDetail['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $endingDetail['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Ending Detail', true), array('controller' => 'ending_details', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
