<?php

class Users extends Ruckusing_BaseMigration {

	public function up() {

		$table = $this->create_table('users');

		$table->column('email', 'string', array('unique'=>true, 'limit'=>255));
		$table->column('password', 'string', array('limit'=>100));
		$table->column('name', 'string', array('limit'=>100));

		$table->column('created', 'datetime', array('null'=>true));
		$table->column('modified', 'datetime', array('null'=>true));

		$table->finish();

	}//up()

	public function down() {
		$this->drop_table('users');
	}//down()
}
?>