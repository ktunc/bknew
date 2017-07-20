<div class="ilans index">
	<h2><?php echo __('Ilans'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('baslik'); ?></th>
			<th><?php echo $this->Paginator->sort('icerik'); ?></th>
			<th><?php echo $this->Paginator->sort('turu'); ?></th>
			<th><?php echo $this->Paginator->sort('fiyat'); ?></th>
			<th><?php echo $this->Paginator->sort('durum'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('eklenme_tarihi'); ?></th>
			<th><?php echo $this->Paginator->sort('duzenlenme_tarihi'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($ilans as $ilan): ?>
	<tr>
		<td><?php echo h($ilan['Ilan']['id']); ?>&nbsp;</td>
		<td><?php echo h($ilan['Ilan']['baslik']); ?>&nbsp;</td>
		<td><?php echo h($ilan['Ilan']['icerik']); ?>&nbsp;</td>
		<td><?php echo h($ilan['Ilan']['turu']); ?>&nbsp;</td>
		<td><?php echo h($ilan['Ilan']['fiyat']); ?>&nbsp;</td>
		<td><?php echo h($ilan['Ilan']['durum']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($ilan['User']['id'], array('controller' => 'users', 'action' => 'view', $ilan['User']['id'])); ?>
		</td>
		<td><?php echo h($ilan['Ilan']['eklenme_tarihi']); ?>&nbsp;</td>
		<td><?php echo h($ilan['Ilan']['duzenlenme_tarihi']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $ilan['Ilan']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $ilan['Ilan']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $ilan['Ilan']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $ilan['Ilan']['id']))); ?>
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
		<li><?php echo $this->Html->link(__('New Ilan'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Danismen'), array('controller' => 'danisman', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Danisman'), array('controller' => 'danisman', 'action' => 'add')); ?> </li>
	</ul>
</div>
