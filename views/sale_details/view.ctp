<div class="saleDetails view">
<h2><?php  __('Sale Detail');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $saleDetail['SaleDetail']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sale'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($saleDetail['Sale']['id'], array('controller' => 'sales', 'action' => 'view', $saleDetail['Sale']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Product Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($saleDetail['ProductType']['name'], array('controller' => 'product_types', 'action' => 'view', $saleDetail['ProductType']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Qty'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $saleDetail['SaleDetail']['qty']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $saleDetail['SaleDetail']['amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $saleDetail['SaleDetail']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sale Detail', true), array('action' => 'edit', $saleDetail['SaleDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Sale Detail', true), array('action' => 'delete', $saleDetail['SaleDetail']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $saleDetail['SaleDetail']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sale Details', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale Detail', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales', true), array('controller' => 'sales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale', true), array('controller' => 'sales', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Types', true), array('controller' => 'product_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Type', true), array('controller' => 'product_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
