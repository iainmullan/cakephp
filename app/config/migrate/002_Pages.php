<?php

class Pages extends Ruckusing_BaseMigration {

	public function up() {
		$table = $this->create_table('pages');

		$table->column('title', 'string', array('unique'=>true, 'limit'=>255));
		$table->column('slug', 'string', array('unique'=>true, 'limit'=>255));
		$table->column('body', 'text');
		$table->column('parent_id', 'integer');
		$table->column('published', 'boolean', array('default'=>0));

		$table->column('created', 'datetime', array('null'=>true));
		$table->column('modified', 'datetime', array('null'=>true));

		$table->finish();

	}//up()

	public function down() {
		$this->drop_table('pages');
	}//down()
}
?>