<div class="counters view">
<h2><?php  __('Counter');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $counter['Counter']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Value'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $counter['Counter']['value']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Counter', true), array('action' => 'edit', $counter['Counter']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Counter', true), array('action' => 'delete', $counter['Counter']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $counter['Counter']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Counters', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Counter', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
