<div class="employees view">
<h2><?php  __('Employee');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $employee['Employee']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Last Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $employee['Employee']['last_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('First Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $employee['Employee']['first_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Middle Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $employee['Employee']['middle_name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Credit Limit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $employee['Employee']['credit_limit']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date Opened'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $employee['Employee']['date_opened']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date Close'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $employee['Employee']['date_close']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $employee['Employee']['status']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Employee', true), array('action' => 'edit', $employee['Employee']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Employee', true), array('action' => 'delete', $employee['Employee']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $employee['Employee']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Employees', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Employee', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Charge Ledgers', true), array('controller' => 'charge_ledgers', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Charge Ledger', true), array('controller' => 'charge_ledgers', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Charges', true), array('controller' => 'charges', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Charge', true), array('controller' => 'charges', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Charge Ledgers');?></h3>
	<?php if (!empty($employee['ChargeLedger'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id Employee'); ?></th>
		<th><?php __('Date Time'); ?></th>
		<th><?php __('Doc Type'); ?></th>
		<th><?php __('Amount'); ?></th>
		<th><?php __('Flag'); ?></th>
		<th><?php __('Created'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($employee['ChargeLedger'] as $chargeLedger):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $chargeLedger['id_employee'];?></td>
			<td><?php echo $chargeLedger['date_time'];?></td>
			<td><?php echo $chargeLedger['doc_type'];?></td>
			<td><?php echo $chargeLedger['amount'];?></td>
			<td><?php echo $chargeLedger['flag'];?></td>
			<td><?php echo $chargeLedger['created'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'charge_ledgers', 'action' => 'view', $chargeLedger['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'charge_ledgers', 'action' => 'edit', $chargeLedger['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'charge_ledgers', 'action' => 'delete', $chargeLedger['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $chargeLedger['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Charge Ledger', true), array('controller' => 'charge_ledgers', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Charges');?></h3>
	<?php if (!empty($employee['Charge'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Employee Id'); ?></th>
		<th><?php __('Amount'); ?></th>
		<th><?php __('Date Time'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($employee['Charge'] as $charge):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $charge['id'];?></td>
			<td><?php echo $charge['employee_id'];?></td>
			<td><?php echo $charge['amount'];?></td>
			<td><?php echo $charge['date_time'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'charges', 'action' => 'view', $charge['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'charges', 'action' => 'edit', $charge['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'charges', 'action' => 'delete', $charge['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $charge['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Charge', true), array('controller' => 'charges', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
