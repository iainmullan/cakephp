<?php
class User extends AppModel {
	var $name = 'User';
	var $displayField = 'email';
	var $validate = array(
		'email' => array(
			'email' => array(
				'rule' => array('email'),
				'message' => 'Please enter a valid email address',
				//'allowEmpty' => false,
				//'required' => true,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
			'unique' => array(
				'rule' => array('isUnique'),
				'message' => 'That email address is already registered'
			)
		),
		'password' => array(
			'notempty' => array(
				'rule' => array('notempty'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			)
		),
		'confirm_email' => array(
			'match' => array(
				'rule' => array('confirmMatch', 'email'),
				'message' => 'Email addresses must match'
			)
		),
		'passwd' => array(
			'length' => array(
				'rule' => array('minLength', 6),
				'message' => 'Password must be at least 6 characters'
			)
		),
		'confirm_passwd' => array(
			'match' => array(
				'rule' => array('confirmMatch', 'passwd'),
				'message' => 'Passwords must match'
			)
		)
	);

    function confirmMatch($field=array(), $compare_field=null) {
        foreach( $field as $key => $value ){
            $v1 = $value;
            $v2 = $this->data[$this->name][ $compare_field ];
            if($v1 !== $v2) {
                return FALSE;
            } else {
                continue;
            }
        }
        return TRUE;
    }
	
	
	function beforeSave()  {
	     if (isset($this->data['User']['passwd']))
	     {
			App::import('Core', 'Security');
	        $this->data['User']['password'] =
	             Security::hash($this->data['User']['passwd'], null, true);
	         unset($this->data['User']['passwd']);
	     }

	     if (isset($this->data['User']['passwd_confirm']))
	     {
	         unset($this->data['User']['passwd_confirm']);
	     }

	     return true;
	 }

	
	
}
?>