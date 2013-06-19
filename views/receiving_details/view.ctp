<div class="receivingDetails view">
<h2><?php  __('Receiving Detail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetail['ReceivingDetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Receiving'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($receivingDetail['Receiving']['id'], array('controller' => 'receivings', 'action' => 'view', $receivingDetail['Receiving']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Item Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetail['ReceivingDetail']['item_code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetail['ReceivingDetail']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Qty'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetail['ReceivingDetail']['qty']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Unit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($receivingDetail['Unit']['name'], array('controller' => 'units', 'action' => 'view', $receivingDetail['Unit']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetail['ReceivingDetail']['price']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetail['ReceivingDetail']['amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Purchase Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetail['ReceivingDetail']['purchase_price']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Avg Purchase Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetail['ReceivingDetail']['avg_purchase_price']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Current Selling Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetail['ReceivingDetail']['current_selling_price']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Revise Srp'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetail['ReceivingDetail']['revise_srp']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Receiving Detail', true), array('action' => 'edit', $receivingDetail['ReceivingDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Receiving Detail', true), array('action' => 'delete', $receivingDetail['ReceivingDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $receivingDetail['ReceivingDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Receiving Details', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Receiving Detail', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Receivings', true), array('controller' => 'receivings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Receiving', true), array('controller' => 'receivings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units', true), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit', true), array('controller' => 'units', 'action' => 'add')); ?> </li>
	</ul>
</div>
