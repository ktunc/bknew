<div class="ilans form">
<?php echo $this->Form->create('Ilan'); ?>
	<fieldset>
		<legend><?php echo __('Add Ilan'); ?></legend>
	<?php
		echo $this->Form->input('baslik');
		echo $this->Form->input('icerik');
		echo $this->Form->input('turu');
		echo $this->Form->input('fiyat');
		echo $this->Form->input('durum');
		echo $this->Form->input('user_id');
		echo $this->Form->input('eklenme_tarihi');
		echo $this->Form->input('duzenlenme_tarihi');
		echo $this->Form->input('Danisman');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Ilans'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Danismen'), array('controller' => 'danisman', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Danisman'), array('controller' => 'danisman', 'action' => 'add')); ?> </li>
	</ul>
</div>
