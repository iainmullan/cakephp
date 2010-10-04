<div id="current-user">
	<?php if (isset($User)): ?>
		<?php echo $User['User']['email']; ?> - 
		<?php echo $this->Html->link(__('Logout', true), array('controller'=>'users', 'action'=>'logout')); ?>		
	<?php else: ?>
		<?php echo $this->Html->link(__('Login', true), array('controller'=>'users', 'action'=>'login')); ?>
	<?php endif; ?>
</div>
	