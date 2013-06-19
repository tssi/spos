<div class="endingReconciliations view">
<h2><?php  __('Ending Reconciliation');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $endingReconciliation['EndingReconciliation']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Beginning Computer'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $endingReconciliation['EndingReconciliation']['beginning_computer']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Beginning Actual'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $endingReconciliation['EndingReconciliation']['beginning_actual']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Purchases'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $endingReconciliation['EndingReconciliation']['purchases']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Product'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($endingReconciliation['Product']['name'], array('controller' => 'products', 'action' => 'view', $endingReconciliation['Product']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ending Computer'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $endingReconciliation['EndingReconciliation']['ending_computer']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ending Actual'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $endingReconciliation['EndingReconciliation']['ending_actual']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Variance Computer'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $endingReconciliation['EndingReconciliation']['variance_computer']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Variance Actual'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $endingReconciliation['EndingReconciliation']['variance_actual']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Remarks'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $endingReconciliation['EndingReconciliation']['remarks']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ending Reconciliation', true), array('action' => 'edit', $endingReconciliation['EndingReconciliation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Ending Reconciliation', true), array('action' => 'delete', $endingReconciliation['EndingReconciliation']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $endingReconciliation['EndingReconciliation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ending Reconciliations', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ending Reconciliation', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
