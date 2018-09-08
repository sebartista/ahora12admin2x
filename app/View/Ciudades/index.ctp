<div class="ciudades index">
	<h2><?php echo __('Ciudades'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('provincia_id'); ?></th>
			<th><?php echo $this->Paginator->sort('nombre'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($ciudades as $ciudade): ?>
	<tr>
		<td><?php echo h($ciudade['Ciudade']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($ciudade['Provincia']['nombre'], array('controller' => 'provincias', 'action' => 'view', $ciudade['Provincia']['id'])); ?>
		</td>
		<td><?php echo h($ciudade['Ciudade']['nombre']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $ciudade['Ciudade']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $ciudade['Ciudade']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $ciudade['Ciudade']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $ciudade['Ciudade']['id']))); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
		'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Ciudade'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Provincias'), array('controller' => 'provincias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Provincia'), array('controller' => 'provincias', 'action' => 'add')); ?> </li>
	</ul>
</div>
