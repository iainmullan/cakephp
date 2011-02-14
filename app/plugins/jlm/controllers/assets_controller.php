<?php
class AssetsController extends AppController {
	
	public $components = array('JlmPackager');
	public $autoRender = false;
    public $uses = array();
    
    function jlm() {
        Configure::write("debug", 0);
        header('Content-type: application/javascript');
        $this->JlmPackager->output();
    }

}
?>