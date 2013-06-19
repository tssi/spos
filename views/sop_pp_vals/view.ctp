<div class="sopPpVals view">
<h2><?php  __('Sop Pp Val');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sopPpVal['SopPpVal']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Prepaid201'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($sopPpVal['Prepaid201']['id'], array('controller' => 'prepaid201s', 'action' => 'view', $sopPpVal['Prepaid201']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount Balance'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sopPpVal['SopPpVal']['amount_balance']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sopPpVal['SopPpVal']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sopPpVal['SopPpVal']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sop Pp Val', true), array('action' => 'edit', $sopPpVal['SopPpVal']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Sop Pp Val', true), array('action' => 'delete', $sopPpVal['SopPpVal']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sopPpVal['SopPpVal']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sop Pp Vals', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sop Pp Val', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Prepaid201s', true), array('controller' => 'prepaid201s', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prepaid201', true), array('controller' => 'prepaid201s', 'action' => 'add')); ?> </li>
	</ul>
</div>
