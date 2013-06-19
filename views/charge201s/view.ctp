<div class="charge201s view">
<h2><?php  __('Charge201');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $charge201['Charge201']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Reference'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $charge201['Charge201']['reference']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Status'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $charge201['Charge201']['status']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Category'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $charge201['Charge201']['category']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Charge201', true), array('action' => 'edit', $charge201['Charge201']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Charge201', true), array('action' => 'delete', $charge201['Charge201']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $charge201['Charge201']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Charge201s', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Charge201', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
