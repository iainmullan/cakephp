<?php
class AppController extends Controller {
	
	function beforeFilter() {
		parent::beforeFilter();
		
		if (isset($this->params['admin'])) {
			$this->layout = 'admin';
		}
	}
	
}
?>