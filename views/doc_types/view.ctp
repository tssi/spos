<div class="docTypes view">
<h2><?php  __('Doc Type');?></h2>
	<dl><?php $i = 0; $class = ' class="altrow"';?>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Id'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $docType['DocType']['id']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Name'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $docType['DocType']['name']; ?>
			&nbsp;
		</dd>
		<dt<?php if ($i % 2 == 0) echo $class;?>><?php __('Comment'); ?></dt>
		<dd<?php if ($i++ % 2 == 0) echo $class;?>>
			<?php echo $docType['DocType']['comment']; ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Doc Type', true), array('action' => 'edit', $docType['DocType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('Delete Doc Type', true), array('action' => 'delete', $docType['DocType']['id']), null, sprintf(__('Are you sure you want to delete # %s?', true), $docType['DocType']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Doc Types', true), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Doc Type', true), array('action' => 'add')); ?> </li>
	</ul>
</div>
