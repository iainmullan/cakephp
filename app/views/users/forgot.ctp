<h2>Forgotten password</h2>
<div class="login-form">
<p class="notice">Enter your email address and we'll send you a new password</p>
<?php

	echo $form->create('User', array('url' => array('action'=>'forgot')));

	echo $form->input('email', array('label'=>'Email Address'));

	echo $form->submit('Send');

	?><p class="quiet">or <?php echo $html->link('Login', array('controller'=>'users', 'action'=>'login')); ?></p><?php

	echo $form->end();

?></div>
