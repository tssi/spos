<div class="salePayments index">
	<h2><?php __('Sale Payments');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('sale_id');?></th>
			<th><?php echo $this->Paginator->sort('payment_type_id');?></th>
			<th><?php echo $this->Paginator->sort('amount');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($salePayments as $salePayment):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $salePayment['SalePayment']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($salePayment['Sale']['id'], array('controller' => 'sales', 'action' => 'view', $salePayment['Sale']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($salePayment['PaymentType']['name'], array('controller' => 'payment_types', 'action' => 'view', $salePayment['PaymentType']['id'])); ?>
		</td>
		<td><?php echo $salePayment['SalePayment']['amount']; ?>&nbsp;</td>
		<td><?php echo $salePayment['SalePayment']['created']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $salePayment['SalePayment']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $salePayment['SalePayment']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $salePayment['SalePayment']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $salePayment['SalePayment']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page %page% of %pages%, showing %current% records out of %count% total, starting on record %start%, ending on %end%', true)
	));
	?>	</p>

	<div class="paging">
		<?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null, array('class'=>'disabled'));?>
	 | 	<?php echo $this->Paginator->numbers();?>
 |
		<?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' => 'disabled'));?>
	</div>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Sale Payment', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Sales', true), array('controller' => 'sales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale', true), array('controller' => 'sales', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Payment Types', true), array('controller' => 'payment_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Payment Type', true), array('controller' => 'payment_types', 'action' => 'add')); ?> </li>
	</ul>
</div>