<div class="endingDetails view">
<h2><?php  __('Ending Detail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $endingDetail['EndingDetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Ending'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($endingDetail['Ending']['id'], array('controller' => 'endings', 'action' => 'view', $endingDetail['Ending']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Item Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $endingDetail['EndingDetail']['item_code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $endingDetail['EndingDetail']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Qty'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $endingDetail['EndingDetail']['qty']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ending Detail', true), array('action' => 'edit', $endingDetail['EndingDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Ending Detail', true), array('action' => 'delete', $endingDetail['EndingDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $endingDetail['EndingDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Ending Details', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ending Detail', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Endings', true), array('controller' => 'endings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ending', true), array('controller' => 'endings', 'action' => 'add')); ?> </li>
	</ul>
</div>
