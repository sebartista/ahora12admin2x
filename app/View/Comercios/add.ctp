<div class="comercios form">
<?php echo $this->Form->create('Comercio'); ?>
	<fieldset>
		<legend><?php echo __('Add Comercio'); ?></legend>
	<?php
		echo $this->Form->input('razonsocial');
		echo $this->Form->input('cuit');
		echo $this->Form->input('direccion');
		echo $this->Form->input('codigopostal');
		echo $this->Form->input('ciudad_id');
		echo $this->Form->input('sitioweb');
		echo $this->Form->input('email');
		echo $this->Form->input('telefono');
		echo $this->Form->input('nombrefantasia');
		echo $this->Form->input('activo');
		echo $this->Form->input('Rubro');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Comercios'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Ciudades'), array('controller' => 'ciudades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ciudade'), array('controller' => 'ciudades', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Rubros'), array('controller' => 'rubros', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Rubro'), array('controller' => 'rubros', 'action' => 'add')); ?> </li>
	</ul>
</div>
