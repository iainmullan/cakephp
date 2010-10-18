<?php
class LoremShell extends Shell {

	function main() {
		
		$className = $this->args[0];
		$quantity = $this->args[1];

		$model = ClassRegistry::init($className);

		$extras = array();
		if (isset($this->args[2])) {
			$extras[$this->args[2]] = 'Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum';
		}

		for ($i=1; $i<= $quantity; $i++) {
			
			$model->create();
			$data = array_merge(
				array($model->displayField => $className.' #'.$i),
				$extras
				);
			$model->save($data);
			
		}
		
		
	}
	
}
?>