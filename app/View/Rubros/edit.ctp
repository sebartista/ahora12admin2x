<div class="rubros form">
<?php echo $this->Form->create('Rubro', array('class' => 'form')); ?>
	<fieldset>
		<legend><?php echo __('Edit Rubro'); ?></legend>
		<div class='form-group'>
	<?php
		echo $this->Form->input('id', array('class'=>'form-control'));
		echo $this->Form->input('nombre', array('class'=>'form-control'));
		echo $this->Form->input('programa', array('class'=>'form-control'));
	?>
</div>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Rubro.id')), array('confirm' => __('Are you sure you want to delete # %s?', $this->Form->value('Rubro.id')))); ?></li>
		<li><?php echo $this->Html->link(__('List Rubros'), array('action' => 'index')); ?></li>
	</ul>
</div>
