<div class="actions col-lg-2">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Comercio'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Ciudades'), array('controller' => 'ciudades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ciudade'), array('controller' => 'ciudades', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rubros'), array('controller' => 'rubros', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rubro'), array('controller' => 'rubros', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="comercios index col-lg-10">
	<h2><?php echo __('Comercios'); ?></h2>
	<table cellpadding="0" cellspacing="0" class="table">
	<thead>
	<tr>
<!--			<th><?php echo $this->Paginator->sort('id'); ?></th>-->
			<th><?php echo $this->Paginator->sort('razonsocial'); ?></th>
			<th><?php echo $this->Paginator->sort('cuit'); ?></th>
			<th><?php echo $this->Paginator->sort('direccion'); ?></th>
			<th><?php echo $this->Paginator->sort('codigopostal'); ?></th>
			<th><?php echo $this->Paginator->sort('ciudad_id'); ?></th>
			<th><?php echo $this->Paginator->sort('sitioweb'); ?></th>
			<th><?php echo $this->Paginator->sort('email'); ?></th>
			<th><?php echo $this->Paginator->sort('telefono'); ?></th>
<!--			<th><?php echo $this->Paginator->sort('created'); ?></th>-->
<!--			<th><?php echo $this->Paginator->sort('updated'); ?></th>-->
			<th><?php echo $this->Paginator->sort('nombrefantasia'); ?></th>
			<th><?php echo $this->Paginator->sort('activo'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($comercios as $comercio): ?>
	<tr>
<!--		<td><?php echo h($comercio['Comercio']['id']); ?>&nbsp;</td>-->
		<td><?php echo h($comercio['Comercio']['razonsocial']); ?>&nbsp;</td>
		<td><?php echo h($comercio['Comercio']['cuit']); ?>&nbsp;</td>
		<td><?php echo h($comercio['Comercio']['direccion']); ?>&nbsp;</td>
		<td><?php echo h($comercio['Comercio']['codigopostal']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($comercio['Ciudade']['nombre'], array('controller' => 'ciudades', 'action' => 'view', $comercio['Ciudade']['id'])); ?>
		</td>
		<td><?php echo h($comercio['Comercio']['sitioweb']); ?>&nbsp;</td>
		<td><?php echo h($comercio['Comercio']['email']); ?>&nbsp;</td>
		<td><?php echo h($comercio['Comercio']['telefono']); ?>&nbsp;</td>
<!--		<td><?php echo h($comercio['Comercio']['created']); ?>&nbsp;</td>-->
<!--		<td><?php echo h($comercio['Comercio']['updated']); ?>&nbsp;</td>-->
		<td><?php echo h($comercio['Comercio']['nombrefantasia']); ?>&nbsp;</td>
		<td><?php echo h($comercio['Comercio']['activo']); ?>&nbsp;</td>
		<td class="actions">
                        <?php echo $this->Html->link(__('View'), array('action' => 'view', $comercio['Comercio']['id']), ['class' => 'btn btn-info btn-xs']); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $comercio['Comercio']['id']), ['class' => 'btn btn-info btn-xs']); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $comercio['Comercio']['id']), array('class' => 'btn btn-danger btn-xs', 'confirm' => __('Are you sure you want to delete # %s?', $comercio['Comercio']['id']))); ?>
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

