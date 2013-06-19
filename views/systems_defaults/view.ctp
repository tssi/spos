<div class="systemsDefaults view">
<h2><?php  __('Systems Default');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $systemsDefault['SystemsDefault']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Field'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $systemsDefault['SystemsDefault']['field']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Value'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $systemsDefault['SystemsDefault']['value']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Systems Default', true), array('action' => 'edit', $systemsDefault['SystemsDefault']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Systems Default', true), array('action' => 'delete', $systemsDefault['SystemsDefault']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $systemsDefault['SystemsDefault']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Systems Defaults', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Systems Default', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
