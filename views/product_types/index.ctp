<div class="productTypes index">
	<h2><?php __('Product Types');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('alias');?></th>
			<th><?php echo $this->Paginator->sort('is_consumable');?></th>
			<th><?php echo $this->Paginator->sort('is_perishable');?></th>
			<th><?php echo $this->Paginator->sort('is_shelf');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($productTypes as $productType):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $productType['ProductType']['id']; ?>&nbsp;</td>
		<td><?php echo $productType['ProductType']['name']; ?>&nbsp;</td>
		<td><?php echo $productType['ProductType']['alias']; ?>&nbsp;</td>
		<td><?php echo $productType['ProductType']['is_consumable']; ?>&nbsp;</td>
		<td><?php echo $productType['ProductType']['is_perishable']; ?>&nbsp;</td>
		<td><?php echo $productType['ProductType']['is_shelf']; ?>&nbsp;</td>
		<td><?php echo $productType['ProductType']['created']; ?>&nbsp;</td>
		<td><?php echo $productType['ProductType']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $productType['ProductType']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $productType['ProductType']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $productType['ProductType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $productType['ProductType']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Product Type', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Perishables', true), array('controller' => 'perishables', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Perishable', true), array('controller' => 'perishables', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>