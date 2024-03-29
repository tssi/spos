<div class="Navigations index">
	<h2><?php __('Navigations');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('title');?></th>
			<th><?php echo $this->Paginator->sort('link');?></th>
			<th class="actions"><?php __('Actions');?></th>
	</tr>
	<?php
	$i = 0;
	foreach ($Navigations as $Navigation):
		$class = null;
		if ($i++ % 2 == 0) {
			$class = ' class="altrow"';
		}
	?>
	<tr<?php echo $class;?>>
		<td><?php echo $Navigation['Navigation']['id']; ?>&nbsp;</td>
		<td><?php echo $Navigation['Navigation']['title']; ?>&nbsp;</td>
		<td><?php echo $Navigation['Navigation']['link']; ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link($this->Html->image("icons/pencil.png"), array('action' => 'edit', $Navigation['Navigation']['id']),array('escape' => false)); ?>
			<?php echo $this->Html->link($this->Html->image("icons/bin.png"), array('action' => 'delete', $Navigation['Navigation']['id'] ), array('escape' => false), sprintf(__('Are you sure you want to delete # %s?', true), $Navigation['Navigation']['title'])); ?>
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
		<li><?php echo $this->Html->link(__('New Navigation', true), array('action' => 'add')); ?></li>
	</ul>
</div>