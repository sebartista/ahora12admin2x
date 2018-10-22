<div class="comercios form">
<?php echo $this->Form->create('Comercio', ['class' => 'form']); ?>
	<fieldset>
		<legend><?php echo __('Edit Comercio'); ?></legend>
	<?php
	$options = [
		'class' => 'form-control',
		'div'=>'form-group'
	];
		echo $this->Form->input('id');
		echo $this->Form->input('razonsocial', $options);
		echo $this->Form->input('cuit', $options );
		echo $this->Form->input('direccion', $options);
		echo $this->Form->input('codigopostal', $options);
		echo $this->Form->input('ciudad_id', $options);
		echo $this->Form->input('sitioweb', $options);
		echo $this->Form->input('email', $options);
		echo $this->Form->input('telefono', $options);
		echo $this->Form->input('nombrefantasia', $options);
		echo $this->Form->input('activo', $options);
		echo $this->Form->input('Rubro', $options);
	?>
	</fieldset>
<?php echo $this->Form->end(__('Aceptar'), ['class'=> 'btn btn-success']); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Comercio.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Comercio.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Comercios'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Ciudades'), array('controller' => 'ciudades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ciudade'), array('controller' => 'ciudades', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rubros'), array('controller' => 'rubros', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rubro'), array('controller' => 'rubros', 'action' => 'add')); ?> </li>
	</ul>
</div>
