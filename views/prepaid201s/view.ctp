<div class="prepaid201s view">
<h2><?php  __('Prepaid201');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $prepaid201['Prepaid201']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reference'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $prepaid201['Prepaid201']['reference']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $prepaid201['Prepaid201']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Category'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $prepaid201['Prepaid201']['category']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Prepaid201', true), array('action' => 'edit', $prepaid201['Prepaid201']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Prepaid201', true), array('action' => 'delete', $prepaid201['Prepaid201']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $prepaid201['Prepaid201']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Prepaid201s', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prepaid201', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sop Pp Trans', true), array('controller' => 'sop_pp_trans', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sop Pp Tran', true), array('controller' => 'sop_pp_trans', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sop Pp Vals', true), array('controller' => 'sop_pp_vals', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sop Pp Val', true), array('controller' => 'sop_pp_vals', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Sop Pp Trans');?></h3>
	<?php if (!empty($prepaid201['SopPpTran'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Prepaid201 Id'); ?></th>
		<th><?php __('Doc Number'); ?></th>
		<th><?php __('Amount'); ?></th>
		<th><?php __('Flag'); ?></th>
		<th><?php __('Created'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($prepaid201['SopPpTran'] as $sopPpTran):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $sopPpTran['id'];?></td>
			<td><?php echo $sopPpTran['prepaid201_id'];?></td>
			<td><?php echo $sopPpTran['doc_number'];?></td>
			<td><?php echo $sopPpTran['amount'];?></td>
			<td><?php echo $sopPpTran['flag'];?></td>
			<td><?php echo $sopPpTran['created'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'sop_pp_trans', 'action' => 'view', $sopPpTran['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'sop_pp_trans', 'action' => 'edit', $sopPpTran['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'sop_pp_trans', 'action' => 'delete', $sopPpTran['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sopPpTran['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Sop Pp Tran', true), array('controller' => 'sop_pp_trans', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Sop Pp Vals');?></h3>
	<?php if (!empty($prepaid201['SopPpVal'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Prepaid201 Id'); ?></th>
		<th><?php __('Amount Balance'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($prepaid201['SopPpVal'] as $sopPpVal):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $sopPpVal['id'];?></td>
			<td><?php echo $sopPpVal['prepaid201_id'];?></td>
			<td><?php echo $sopPpVal['amount_balance'];?></td>
			<td><?php echo $sopPpVal['created'];?></td>
			<td><?php echo $sopPpVal['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'sop_pp_vals', 'action' => 'view', $sopPpVal['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'sop_pp_vals', 'action' => 'edit', $sopPpVal['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'sop_pp_vals', 'action' => 'delete', $sopPpVal['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sopPpVal['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Sop Pp Val', true), array('controller' => 'sop_pp_vals', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
