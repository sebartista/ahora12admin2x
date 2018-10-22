<div class="ciudades view">
<h2><?php echo __('Ciudade'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($ciudade['Ciudade']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Provincia'); ?></dt>
		<dd>
			<?php echo $this->Html->link($ciudade['Provincia']['nombre'], array('controller' => 'provincias', 'action' => 'view', $ciudade['Provincia']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($ciudade['Ciudade']['nombre']); ?>
			&nbsp;
		</dd>
	</dl>
</div>

<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ciudade'), array('action' => 'edit', $ciudade['Ciudade']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Ciudade'), array('action' => 'delete', $ciudade['Ciudade']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $ciudade['Ciudade']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Ciudades'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ciudade'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Provincias'), array('controller' => 'provincias', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Provincia'), array('controller' => 'provincias', 'action' => 'add')); ?> </li>
	</ul>
</div>


<div class="related">
	<h3><?php echo __('Related Comercios'); ?></h3>
	<?php if (!empty($ciudade['Comercio'])): ?>
	<table cellpadding = "0" cellspacing = "0" class="table">
	<tr>
		<th><?php echo __('Id'); ?></th>		
		<th><?php echo __('Nombre'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($ciudade['Comercio'] as $comercio): ?>
		<tr>
			<td><?php echo $comercio['id']; ?></td>
			<td><?php echo $comercio['nombrefantasia']; ?></td>			
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'comercios', 'action' => 'view', $comercio['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'comercios', 'action' => 'edit', $comercio['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'comercios', 'action' => 'delete', $comercio['id']), array('confirm' => __('Are you sure you want to delete # %s?', $comercio['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Comercio'), array('controller' => 'comercios', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
