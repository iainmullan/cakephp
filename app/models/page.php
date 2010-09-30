<?php
class Page extends AppModel {
	var $name = 'Page';
	var $displayField = 'title';

	var $belongsTo = array('Parent'=>array('className'=>'Page', 'foreignKey'=>'parent_id', 'counterCache'=>'child_count'));
	var $hasMany = array('Child'=>array('className'=>'Page', 'foreignKey'=>'parent_id'));

	var $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty')
			),
		)
	);
}
?>