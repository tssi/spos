<div class="receivingDetailsEditeds view">
<h2><?php  __('Receiving Details Edited');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Receiving'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($receivingDetailsEdited['Receiving']['id'], array('controller' => 'receivings', 'action' => 'view', $receivingDetailsEdited['Receiving']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Receiving Detail Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['receiving_detail_id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Item Code'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['item_code']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Qty'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['qty']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Unit'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($receivingDetailsEdited['Unit']['name'], array('controller' => 'units', 'action' => 'view', $receivingDetailsEdited['Unit']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Purchase Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['purchase_price']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Avg Purchase Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['avg_purchase_price']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Current Selling Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['current_selling_price']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Revise Srp'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['revise_srp']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Est Purchasing Price'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['est_purchasing_price']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $receivingDetailsEdited['ReceivingDetailsEdited']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Receiving Details Edited', true), array('action' => 'edit', $receivingDetailsEdited['ReceivingDetailsEdited']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Receiving Details Edited', true), array('action' => 'delete', $receivingDetailsEdited['ReceivingDetailsEdited']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $receivingDetailsEdited['ReceivingDetailsEdited']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Receiving Details Editeds', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Receiving Details Edited', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Receivings', true), array('controller' => 'receivings', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Receiving', true), array('controller' => 'receivings', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Receiving Details', true), array('controller' => 'receiving_details', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Receiving Details', true), array('controller' => 'receiving_details', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units', true), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit', true), array('controller' => 'units', 'action' => 'add')); ?> </li>
	</ul>
</div>
