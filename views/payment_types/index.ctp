<div class="paymentTypes index">
	<h2><?php __('Payment Types');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('alias');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($paymentTypes as $paymentType):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $paymentType['PaymentType']['id']; ?>&nbsp;</td>
		<td><?php echo $paymentType['PaymentType']['name']; ?>&nbsp;</td>
		<td><?php echo $paymentType['PaymentType']['alias']; ?>&nbsp;</td>
		<td><?php echo $paymentType['PaymentType']['created']; ?>&nbsp;</td>
		<td><?php echo $paymentType['PaymentType']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $paymentType['PaymentType']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $paymentType['PaymentType']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $paymentType['PaymentType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $paymentType['PaymentType']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Payment Type', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Sales', true), array('controller' => 'sales', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sale', true), array('controller' => 'sales', 'action' => 'add')); ?> </li>
	</ul>
</div>