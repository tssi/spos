<div class="sopCgeTrans view">
<h2><?php  __('Sop Cge Tran');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sopCgeTran['SopCgeTran']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Date'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sopCgeTran['SopCgeTran']['date']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Doc Number'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sopCgeTran['SopCgeTran']['doc_number']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Amount'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sopCgeTran['SopCgeTran']['amount']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Flag'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $sopCgeTran['SopCgeTran']['flag']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Sop Cge Tran', true), array('action' => 'edit', $sopCgeTran['SopCgeTran']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Sop Cge Tran', true), array('action' => 'delete', $sopCgeTran['SopCgeTran']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $sopCgeTran['SopCgeTran']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Sop Cge Trans', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Sop Cge Tran', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
