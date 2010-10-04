<?php
class AppController extends Controller {

	var $helpers = array('Html', 'Form', 'Session', 'Time');
	var $components = array('Session', 'MyAuth');
	var $uses = array('User');

	function beforeFilter() {
		parent::beforeFilter();

		$this->Auth = $this->MyAuth;
		$this->Auth->init();

		if (isset($this->params['prefix']) && $this->params['prefix']=='admin') {
			$this->layout = 'admin';
		}
	}

}
?>