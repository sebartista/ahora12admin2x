<div class="rubros view">
<h2><?php echo __('Rubro'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($rubro['Rubro']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($rubro['Rubro']['nombre']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Programa'); ?></dt>
		<dd>
			<?php echo h($rubro['Rubro']['programa']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Rubro'), array('action' => 'edit', $rubro['Rubro']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Rubro'), array('action' => 'delete', $rubro['Rubro']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $rubro['Rubro']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Rubros'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rubro'), array('action' => 'add')); ?> </li>
	</ul>
</div>
