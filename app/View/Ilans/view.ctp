<div class="ilans view">
<h2><?php echo __('Ilan'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($ilan['Ilan']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Baslik'); ?></dt>
		<dd>
			<?php echo h($ilan['Ilan']['baslik']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Icerik'); ?></dt>
		<dd>
			<?php echo h($ilan['Ilan']['icerik']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Turu'); ?></dt>
		<dd>
			<?php echo h($ilan['Ilan']['turu']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Fiyat'); ?></dt>
		<dd>
			<?php echo h($ilan['Ilan']['fiyat']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Durum'); ?></dt>
		<dd>
			<?php echo h($ilan['Ilan']['durum']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($ilan['User']['id'], array('controller' => 'users', 'action' => 'view', $ilan['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Eklenme Tarihi'); ?></dt>
		<dd>
			<?php echo h($ilan['Ilan']['eklenme_tarihi']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Duzenlenme Tarihi'); ?></dt>
		<dd>
			<?php echo h($ilan['Ilan']['duzenlenme_tarihi']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Ilan'), array('action' => 'edit', $ilan['Ilan']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Ilan'), array('action' => 'delete', $ilan['Ilan']['id']), array('confirm' => __('Are you sure you want to delete # %s?', $ilan['Ilan']['id']))); ?> </li>
		<li><?php echo $this->Html->link(__('List Ilans'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Ilan'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Danismen'), array('controller' => 'danisman', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Danisman'), array('controller' => 'danisman', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Danismen'); ?></h3>
	<?php if (!empty($ilan['Danisman'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Ad'); ?></th>
		<th><?php echo __('Soyad'); ?></th>
		<th><?php echo __('Resim'); ?></th>
		<th><?php echo __('Hakkinda'); ?></th>
		<th><?php echo __('Islem Tarihi'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($ilan['Danisman'] as $danisman): ?>
		<tr>
			<td><?php echo $danisman['id']; ?></td>
			<td><?php echo $danisman['ad']; ?></td>
			<td><?php echo $danisman['soyad']; ?></td>
			<td><?php echo $danisman['resim']; ?></td>
			<td><?php echo $danisman['hakkinda']; ?></td>
			<td><?php echo $danisman['islem_tarihi']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'danisman', 'action' => 'view', $danisman['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'danisman', 'action' => 'edit', $danisman['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'danisman', 'action' => 'delete', $danisman['id']), array('confirm' => __('Are you sure you want to delete # %s?', $danisman['id']))); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Danisman'), array('controller' => 'danisman', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
