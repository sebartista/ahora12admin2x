<div class="actions col-lg-12">
	<h5><?php echo __('Actions'); ?></h5>
	<ul class="nav nav-pills">
		<li><?php echo $this->Html->link(__('New Comercio'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Ciudades'), array('controller' => 'ciudades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ciudade'), array('controller' => 'ciudades', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rubros'), array('controller' => 'rubros', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rubro'), array('controller' => 'rubros', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="comercios index col-lg-12">
	<h2><?php echo __('Comercios'); ?></h2>
	<table class="table table-condensed ahora12-table-default">
		<thead>
			<tr>
				<th><?php echo $this->Paginator->sort('razonsocial'); ?></th>
				<th><?php echo $this->Paginator->sort('cuit'); ?></th>
				<th><?php echo $this->Paginator->sort('direccion'); ?></th>
				<th><?php echo $this->Paginator->sort('codigopostal'); ?></th>
				<th><?php echo $this->Paginator->sort('ciudad_id'); ?></th>
				<th><?php echo $this->Paginator->sort('sitioweb'); ?></th>
				<th><?php echo $this->Paginator->sort('email'); ?></th>
				<th><?php echo $this->Paginator->sort('telefono'); ?></th>
				<th><?php echo $this->Paginator->sort('nombrefantasia'); ?></th>			
				<th><?php echo $this->Paginator->sort('Rubro.nombre'); ?></th>
				<th class="actions"><?php echo __('Actions'); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($comercios as $comercio): ?>
			
			<tr>
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
				<td><?php echo h($comercio['Comercio']['nombrefantasia']); ?>&nbsp;</td>

				<td><?php 
					foreach ($comercio['Rubro'] as $rubro) {
						echo $this->Html->link($rubro['nombre'], array('controller' => 'rubros', 'action' => 'view', $rubro['id']));
						
					}
				?>&nbsp;</td>

				<td class="actions">
					<?php echo $this->Html->link(__('V'), array('action' => 'view', $comercio['Comercio']['id']), ['class' => 'btn btn-info btn-xs']); ?>
					<?php echo $this->Html->link(__('E'), array('action' => 'edit', $comercio['Comercio']['id']), ['class' => 'btn btn-info btn-xs']); ?>
					<?php echo $this->Form->postLink(__('D'), array('action' => 'delete', $comercio['Comercio']['id']), array('class' => 'btn btn-danger btn-xs', 'confirm' => __('Are you sure you want to delete # %s?', $comercio['Comercio']['id']))); ?>
				</td>
			</tr>
			<?php endforeach; ?>
		</tbody>
	</table>
		<div class="text-center">
		<?php
		//echo $this->Paginator->counter(array('format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')));

		echo $this->Paginator->pagination(array(
				'ul' => 'pagination'
			)
		);
	?>	
	</div>

</div>