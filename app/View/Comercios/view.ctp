<div class="actions col-lg-12">
	<h5><?php echo __('Actions'); ?></h5>
	<ul class="nav nav-pills">
		<li><?php echo $this->Html->link(__('Edit Comercio'), array('action' => 'edit', $comercio['Comercio']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Comercio'), array('action' => 'delete', $comercio['Comercio']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $comercio['Comercio']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Comercios'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Comercio'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ciudades'), array('controller' => 'ciudades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ciudade'), array('controller' => 'ciudades', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rubros'), array('controller' => 'rubros', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rubro'), array('controller' => 'rubros', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="comercios view col-lg-12">
<h2><?php echo __('Comercio'); ?></h2>
</div>
<div class="col-lg-3">
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($comercio['Comercio']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Razonsocial'); ?></dt>
		<dd>
			<?php echo h($comercio['Comercio']['razonsocial']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Cuit'); ?></dt>
		<dd>
			<?php echo h($comercio['Comercio']['cuit']); ?>
			&nbsp;
		</dd>
	</dl>
	</div>
	<div class="col-lg-3">
	<dl>
		<dt><?php echo __('Direccion'); ?></dt>
		<dd>
			<?php echo h($comercio['Comercio']['direccion']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Codigopostal'); ?></dt>
		<dd>
			<?php echo h($comercio['Comercio']['codigopostal']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Ciudade'); ?></dt>
		<dd>
			<?php echo $this->Html->link($comercio['Ciudade']['nombre'], array('controller' => 'ciudades', 'action' => 'view', $comercio['Ciudade']['id'])); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
	<div class="col-lg-3">
	<dl>
		<dt><?php echo __('Sitioweb'); ?></dt>
		<dd>
			<?php echo h($comercio['Comercio']['sitioweb']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Email'); ?></dt>
		<dd>
			<?php echo h($comercio['Comercio']['email']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Telefono'); ?></dt>
		<dd>
			<?php echo h($comercio['Comercio']['telefono']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($comercio['Comercio']['created']); ?>
			&nbsp;
		</dd>
		</dl>
	</div>
	<div class="col-lg-3">
	<dl>
		<dt><?php echo __('Updated'); ?></dt>
		<dd>
			<?php echo h($comercio['Comercio']['updated']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombrefantasia'); ?></dt>
		<dd>
			<?php echo h($comercio['Comercio']['nombrefantasia']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Activo'); ?></dt>
		<dd>
			<?php echo h($comercio['Comercio']['activo']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="related col-lg-12">
	<h3><?php echo __('Related Rubros'); ?></h3>
	<?php if (!empty($comercio['Rubro'])): ?>
	<table class="table table-condensed">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($comercio['Rubro'] as $rubro): ?>
		<tr>
			<td><?php echo $rubro['id']; ?></td>
			<td><?php echo $rubro['nombre']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'rubros', 'action' => 'view', $rubro['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'rubros', 'action' => 'edit', $rubro['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'rubros', 'action' => 'delete', $rubro['id']), array('confirm' => __('Are you sure you want to delete # %s?', $rubro['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions col-lg-12">
		<ul class="nav nav-pills">
			<li><?php echo $this->Html->link(__('New Rubro'), array('controller' => 'rubros', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
