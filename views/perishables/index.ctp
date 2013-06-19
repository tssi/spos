<div class="perishables index">
	<h2><?php __('Perishables');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('product_type_id');?></th>
			<th><?php echo $this->Paginator->sort('item_code');?></th>
			<th><?php echo $this->Paginator->sort('name');?></th>
			<th><?php echo $this->Paginator->sort('unit_id');?></th>
			<th><?php echo $this->Paginator->sort('qty');?></th>
			<th><?php echo $this->Paginator->sort('selling_price');?></th>
			<th><?php echo $this->Paginator->sort('avg_price');?></th>
			<th><?php echo $this->Paginator->sort('is_consumable');?></th>
			<th><?php echo $this->Paginator->sort('created');?></th>
			<th><?php echo $this->Paginator->sort('modified');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($perishables as $perishable):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $perishable['Perishable']['id']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($perishable['ProductType']['name'], array('controller' => 'product_types', 'action' => 'view', $perishable['ProductType']['id'])); ?>
		</td>
		<td><?php echo $perishable['Perishable']['item_code']; ?>&nbsp;</td>
		<td><?php echo $perishable['Perishable']['name']; ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($perishable['Unit']['name'], array('controller' => 'units', 'action' => 'view', $perishable['Unit']['id'])); ?>
		</td>
		<td><?php echo $perishable['Perishable']['qty']; ?>&nbsp;</td>
		<td><?php echo $perishable['Perishable']['selling_price']; ?>&nbsp;</td>
		<td><?php echo $perishable['Perishable']['avg_price']; ?>&nbsp;</td>
		<td><?php echo $perishable['Perishable']['is_consumable']; ?>&nbsp;</td>
		<td><?php echo $perishable['Perishable']['created']; ?>&nbsp;</td>
		<td><?php echo $perishable['Perishable']['modified']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View', true), array('action' => 'view', $perishable['Perishable']['id'])); ?>
			<?php echo $this->Html->link(__('Edit', true), array('action' => 'edit', $perishable['Perishable']['id'])); ?>
			<?php echo $this->Html->link(__('Delete', true), array('action' => 'delete', $perishable['Perishable']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $perishable['Perishable']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Perishable', true), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Product Types', true), array('controller' => 'product_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Type', true), array('controller' => 'product_types', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Units', true), array('controller' => 'units', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Unit', true), array('controller' => 'units', 'action' => 'add')); ?> </li>
	</ul>
</div>