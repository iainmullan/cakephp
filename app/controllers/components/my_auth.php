<?php
App::import('Component', 'Auth');
class MyAuthComponent extends AuthComponent {

	var $name = 'MyAuth';
	var $components = array('RequestHandler', 'Session', 'Email');

	var $controller = null;

	function initialize(&$controller) {
		parent::initialize($controller);
		$this->controller = $controller;
	}

	function startup(&$controller) {
		parent::startup($controller);
	}

	function init() {
		$this->allow('*');
		$this->fields = array('username'=>'email', 'password'=>'password');
		$this->autoRedirect = false;
		$this->loginRedirect = '/';
		$this->logoutRedirect = $this->loginAction;
		$this->loginError = 'Incorrect username or password';
	}

	function isLoggedIn() {
		if ($this->user()) {
			return true;
		} else {
			return false;
		}
	}

	function isAdmin() {
		if ($this->user('admin')==1) {
			return true;
		}
		return false;
	}

	function afterLogin() {
		$this->controller->User->save(array(
			'id' => $this->user('id'),
			'last_login' => date('Y-m-d H:i:s', time())
		));		
	}

	function beforeRender() {
		if (isset($this->controller)) {
			if ($this->isLoggedIn()) {
				$this->controller->set('User', $this->user());
			}
			$this->controller->set('Auth', $this);
		}
	}

	/**
	 * Generate a new password for the given user id, trigger an email to the user.
	 * @param id The user's id
	 * @param boolean email If set to true (default), send the password by email, otherwise return the password from the method call
	 * @return Email address used, if $email set to true, otherwise return the newly generated password
	 **/
	function resetPassword($id, $email = true) {

		$new_password = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$') , 0 , 10 );

		$user = $this->controller->User->read(null, $id);
		$this->controller->User->saveField('password', $this->password($new_password));
		$this->controller->User->saveField('auto_password', 1);

		if ($email) {
			$this->Email->reset();

			$this->Email->template = 'new_password';
			$this->Email->to = $user['User']['email'];
			$this->Email->subject = 'Your new '.Configure::read('site_name');
			$this->Email->from = Configure::read('Email.from');
			$this->Email->replyTo = Configure::read('Email.replyTo');

			$this->controller->set('password', $new_password);

			$this->Email->send();

			return $user['User']['email'];
		} else {
			return $new_password;
		}

	}

}
?>