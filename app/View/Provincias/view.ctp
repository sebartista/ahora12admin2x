<div class="provincias view">
<h2><?php echo __('Provincia'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($provincia['Provincia']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Nombre'); ?></dt>
		<dd>
			<?php echo h($provincia['Provincia']['nombre']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Provincia'), array('action' => 'edit', $provincia['Provincia']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Provincia'), array('action' => 'delete', $provincia['Provincia']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $provincia['Provincia']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Provincias'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Provincia'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Ciudades'), array('controller' => 'ciudades', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ciudade'), array('controller' => 'ciudades', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Ciudades'); ?></h3>
	<?php if (!empty($provincia['Ciudade'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Provincia Id'); ?></th>
		<th><?php echo __('Nombre'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($provincia['Ciudade'] as $ciudade): ?>
		<tr>
			<td><?php echo $ciudade['id']; ?></td>
			<td><?php echo $ciudade['provincia_id']; ?></td>
			<td><?php echo $ciudade['nombre']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'ciudades', 'action' => 'view', $ciudade['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'ciudades', 'action' => 'edit', $ciudade['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'ciudades', 'action' => 'delete', $ciudade['id']), array('confirm' => __('Are you sure you want to delete # %s?', $ciudade['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Ciudade'), array('controller' => 'ciudades', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
