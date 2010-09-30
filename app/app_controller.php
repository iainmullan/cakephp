<?php
class AppController extends Controller {

	var $helpers = array('Html', 'Form', 'Time');
	
	function beforeFilter() {
		parent::beforeFilter();

		if (isset($this->params['prefix']) && $this->params['prefix']=='admin') {
			$this->layout = 'admin';
		}
	}
	
}
?>