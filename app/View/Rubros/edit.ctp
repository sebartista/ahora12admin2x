<div class="rubros form">
<?php echo $this->Form->create('Rubro', array('class' => 'form','inputDefaults' => array(
		'div' => 'form-group',
		'wrapInput' => false,
		'class' => 'form-control'
	))); ?>

	<fieldset>
		<legend><?php echo __('Edit Rubro'); ?></legend>
		
	<?php
		echo $this->Form->input('id', array('class'=>'form-control'));
		echo $this->Form->input('nombre', array('class'=>'form-control'));
		echo $this->Form->input('programa', array('class'=>'form-control'));
	?>

	</fieldset>
		<?php echo $this->Form->submit(__('Submit'), array(
			'div' => 'form-group',
			'class' => 'btn btn-info'
		)); ?>

		<?php echo $this->Form->end();?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Rubro.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Rubro.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Rubros'), array('action' => 'index')); ?></li>
	</ul>
</div>
