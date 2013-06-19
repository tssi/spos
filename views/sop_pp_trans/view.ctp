<div class="sopPpTrans view">
<h2><?php  __('Sop Pp Tran');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sopPpTran['SopPpTran']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Prepaid201'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($sopPpTran['Prepaid201']['id'], array('controller' => 'prepaid201s', 'action' => 'view', $sopPpTran['Prepaid201']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Doc Number'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sopPpTran['SopPpTran']['doc_number']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sopPpTran['SopPpTran']['amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Flag'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sopPpTran['SopPpTran']['flag']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sopPpTran['SopPpTran']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sop Pp Tran', true), array('action' => 'edit', $sopPpTran['SopPpTran']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Sop Pp Tran', true), array('action' => 'delete', $sopPpTran['SopPpTran']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sopPpTran['SopPpTran']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sop Pp Trans', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sop Pp Tran', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Prepaid201s', true), array('controller' => 'prepaid201s', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Prepaid201', true), array('controller' => 'prepaid201s', 'action' => 'add')); ?> </li>
	</ul>
</div>
