<?php
class UsersController extends AppController {

	var $name = 'Users';
	var $helpers = array('Html', 'Form');

	function login() {

		if ($this->Auth->user()) {

			$this->Auth->afterLogin();

			$user = $this->User->read(null, $this->Auth->user('id'));
			$user = $user['User'];

			$this->redirect($this->Auth->loginRedirect);
		}

	}

	function logout() {
		$this->redirect($this->Auth->logout());
	}

	function register() {

		if (!empty($this->data)) {

			if ($this->User->save($this->data)) {

				// well done, log em in
				$this->data['User']['password'] = $this->Auth->password($this->data['User']['passwd']);
				$this->Auth->login($this->data);
				$this->login();

			} else {
				// denied!

			}

		}

	}



	function forgot() {

		if (!empty($this->data)) {
			$user = $this->User->findByEmail($this->data['User']['email']);
			if (!$user) {
				$this->User->validationErrors = array('email' => 'Email address not found');
			} else {
				$this->MyAuth->resetPassword($user['User']['id']);
				$this->_flash('We\'ve emailed you a new password');
				$this->redirect(array('action'=>'login'));
			}
		}

	}



}
?>