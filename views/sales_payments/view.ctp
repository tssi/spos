<div class="salesPayments view">
<h2><?php  __('Sales Payment');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $salesPayment['SalesPayment']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Sale'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($salesPayment['Sale']['id'], array('controller' => 'sales', 'action' => 'view', $salesPayment['Sale']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Payment Type'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $this->Html->link($salesPayment['PaymentType']['name'], array('controller' => 'payment_types', 'action' => 'view', $salesPayment['PaymentType']['id'])); ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $salesPayment['SalesPayment']['created']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sales Payment', true), array('action' => 'edit', $salesPayment['SalesPayment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Sales Payment', true), array('action' => 'delete', $salesPayment['SalesPayment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $salesPayment['SalesPayment']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales Payments', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sales Payment', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Sales', true), array('controller' => 'sales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale', true), array('controller' => 'sales', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payment Types', true), array('controller' => 'payment_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment Type', true), array('controller' => 'payment_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
