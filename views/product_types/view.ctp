<div class="productTypes view">
<h2><?php  __('Product Type');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productType['ProductType']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productType['ProductType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Alias'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productType['ProductType']['alias']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Consumable'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productType['ProductType']['is_consumable']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Perishable'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productType['ProductType']['is_perishable']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Is Shelf'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productType['ProductType']['is_shelf']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Created'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productType['ProductType']['created']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Modified'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $productType['ProductType']['modified']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Product Type', true), array('action' => 'edit', $productType['ProductType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Product Type', true), array('action' => 'delete', $productType['ProductType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $productType['ProductType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Product Types', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product Type', true), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Perishables', true), array('controller' => 'perishables', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Perishable', true), array('controller' => 'perishables', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Products', true), array('controller' => 'products', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php __('Related Perishables');?></h3>
	<?php if (!empty($productType['Perishable'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Product Type Id'); ?></th>
		<th><?php __('Item Code'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Unit Id'); ?></th>
		<th><?php __('Qty'); ?></th>
		<th><?php __('Selling Price'); ?></th>
		<th><?php __('Avg Price'); ?></th>
		<th><?php __('Is Consumable'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($productType['Perishable'] as $perishable):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $perishable['id'];?></td>
			<td><?php echo $perishable['product_type_id'];?></td>
			<td><?php echo $perishable['item_code'];?></td>
			<td><?php echo $perishable['name'];?></td>
			<td><?php echo $perishable['unit_id'];?></td>
			<td><?php echo $perishable['qty'];?></td>
			<td><?php echo $perishable['selling_price'];?></td>
			<td><?php echo $perishable['avg_price'];?></td>
			<td><?php echo $perishable['is_consumable'];?></td>
			<td><?php echo $perishable['created'];?></td>
			<td><?php echo $perishable['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'perishables', 'action' => 'view', $perishable['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'perishables', 'action' => 'edit', $perishable['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'perishables', 'action' => 'delete', $perishable['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $perishable['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Perishable', true), array('controller' => 'perishables', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
<div class="related">
	<h3><?php __('Related Products');?></h3>
	<?php if (!empty($productType['Product'])):?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php __('Id'); ?></th>
		<th><?php __('Product Type Id'); ?></th>
		<th><?php __('Item Code'); ?></th>
		<th><?php __('Name'); ?></th>
		<th><?php __('Unit Id'); ?></th>
		<th><?php __('Qty'); ?></th>
		<th><?php __('Selling Price'); ?></th>
		<th><?php __('Avg Price'); ?></th>
		<th><?php __('Is Consumable'); ?></th>
		<th><?php __('Created'); ?></th>
		<th><?php __('Modified'); ?></th>
		<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
		$i = 0;
		foreach ($productType['Product'] as $product):
			$class = null;
			if ($i++ % 2 == 0) {
				$class = ' class="altrow"';
			}
		?>
		<tr<?php echo $class;?>>
			<td><?php echo $product['id'];?></td>
			<td><?php echo $product['product_type_id'];?></td>
			<td><?php echo $product['item_code'];?></td>
			<td><?php echo $product['name'];?></td>
			<td><?php echo $product['unit_id'];?></td>
			<td><?php echo $product['qty'];?></td>
			<td><?php echo $product['selling_price'];?></td>
			<td><?php echo $product['avg_price'];?></td>
			<td><?php echo $product['is_consumable'];?></td>
			<td><?php echo $product['created'];?></td>
			<td><?php echo $product['modified'];?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View', true), array('controller' => 'products', 'action' => 'view', $product['id'])); ?>
				<?php echo $this->Html->link(__('Edit', true), array('controller' => 'products', 'action' => 'edit', $product['id'])); ?>
				<?php echo $this->Html->link(__('Delete', true), array('controller' => 'products', 'action' => 'delete', $product['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $product['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Product', true), array('controller' => 'products', 'action' => 'add'));?> </li>
		</ul>
	</div>
</div>
