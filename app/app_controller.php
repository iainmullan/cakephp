<?php
class AppController extends Controller {

	var $helpers = array('Html', 'Form', 'Session', 'Time');
	var $components = array('Session', 'MyAuth');
	var $uses = array('User');

	function beforeFilter() {
		parent::beforeFilter();

		$this->Auth = $this->MyAuth;
		$this->Auth->init();

		$this->_checkAdmin();
	}

	private function _checkAdmin() {
		if (isset($this->params['prefix']) && $this->params['prefix']=='admin') {
			CakeLog::write('debug', 'accessing admin area');
			if ($this->Auth->isAdmin()) {
				$this->layout = 'admin';
			} else {
				CakeLog::write('debug', 'not an admin, go away');
				$this->redirect('/', true);
			}
		}
	}

}
?>