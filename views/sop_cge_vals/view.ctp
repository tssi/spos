<div class="sopCgeVals view">
<h2><?php  __('Sop Cge Val');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sopCgeVal['SopCgeVal']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount Balance'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sopCgeVal['SopCgeVal']['amount_balance']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('As Of Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sopCgeVal['SopCgeVal']['as_of_date']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sop Cge Val', true), array('action' => 'edit', $sopCgeVal['SopCgeVal']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Sop Cge Val', true), array('action' => 'delete', $sopCgeVal['SopCgeVal']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sopCgeVal['SopCgeVal']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sop Cge Vals', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sop Cge Val', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
