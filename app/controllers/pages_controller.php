<?php
class PagesController extends AppController {

	var $name = 'Pages';
	
	function admin_home() {
		
	}

	function admin_index() {
		$this->Page->recursive = 0;
		$this->set('pages', $this->paginate());
	}

	function admin_view($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'page'));
			$this->redirect(array('action' => 'index'));
		}
		$this->set('page', $this->Page->read(null, $id));
	}

	function admin_add() {
		if (!empty($this->data)) {
			$this->Page->create();
			if ($this->Page->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'page'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'page'));
			}
		}

		$this->set('parents', $this->Page->find('list', array('fields'=>array('id','title'))));
	}

	function admin_edit($id = null) {
		if (!$id && empty($this->data)) {
			$this->Session->setFlash(sprintf(__('Invalid %s', true), 'page'));
			$this->redirect(array('action' => 'index'));
		}
		if (!empty($this->data)) {
			if ($this->Page->save($this->data)) {
				$this->Session->setFlash(sprintf(__('The %s has been saved', true), 'page'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(sprintf(__('The %s could not be saved. Please, try again.', true), 'page'));
			}
		}
		if (empty($this->data)) {
			$this->data = $this->Page->read(null, $id);
		}
	}

	function admin_delete($id = null) {
		if (!$id) {
			$this->Session->setFlash(sprintf(__('Invalid id for %s', true), 'page'));
			$this->redirect(array('action'=>'index'));
		}
		if ($this->Page->delete($id)) {
			$this->Session->setFlash(sprintf(__('%s deleted', true), 'Page'));
			$this->redirect(array('action'=>'index'));
		}
		$this->Session->setFlash(sprintf(__('%s was not deleted', true), 'Page'));
		$this->redirect(array('action' => 'index'));
	}


	function view($id) {
		$cond = array();
		if (is_numeric($id)) {
			$cond['Page.id'] = $id;
		} else {
			$cond['Page.slug'] = $id;
		}

		$this->Page->contain('Child', 'Parent');
		$page = $this->Page->find('first', array('conditions'=>$cond));
		$this->set('page', $page);
	}
	
	

}
?>