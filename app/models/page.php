<?php
class Page extends AppModel {
	var $name = 'Page';
	var $displayField = 'title';

	var $recursive = -1;
	var $actsAs = array('Containable');

	var $belongsTo = array('Parent'=>array('className'=>'Page', 'foreignKey'=>'parent_id'));
	var $hasMany = array('Child'=>array('className'=>'Page', 'foreignKey'=>'parent_id'));

	var $validate = array(
		'title' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
		'published' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);
}
?>