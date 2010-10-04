<h2>Register</h2>
<div class="login-form"><?php

	echo $this->Session->flash('auth');

	echo $form->create('User', array('url'=> array('action'=>'register')));

	?><fieldset><?php
	echo $form->input('email', array('label'=>'Email Address'));
	echo $form->input('confirm_email', array('label'=>'Confirm Email Address'));
	?></fieldset><?php

	?><fieldset><?php
	echo $form->input('passwd', array('label' => 'Password', 'value'=>'', 'autocomplete'=>'off'));
	echo $form->input('confirm_passwd', array('label' => 'Confirm Password', 'type' => 'password', 'value' => ''));
	?></fieldset><?php

	echo $form->end('Register');

	?><p class="small quiet">or <?php echo $html->link('Login', array('controller'=>'users', 'action'=>'login')); ?></p><?php

?></div>
