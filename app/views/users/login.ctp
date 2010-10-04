<h2>Login</h2>
<div id="login-page">
	<div class="login-form"><?php
		echo $this->Session->flash('auth');

		echo $form->create('User', array('url' => $Auth->loginAction));

		echo $form->input('email', array('label'=>'Email Address'));
		echo $form->input('password');

		echo $form->submit('Login');

		?><p class="quiet">or <?php echo $html->link('Register', array('controller'=>'users', 'action'=>'register')); ?></p><?php

		echo $form->end();

	?>
	<p class="small"><?php echo $html->link('Forgot your password', array('controller'=>'users', 'action'=>'forgot')); ?></p>
	</div>
</div>
