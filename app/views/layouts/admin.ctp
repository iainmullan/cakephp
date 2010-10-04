<?php
/**
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2010, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       cake
 * @subpackage    cake.cake.libs.view.templates.layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?> - 
		<?php echo Configure::read('Site.name'); ?> Admin
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('blueprint/src/reset');
		echo $this->Html->css('blueprint/src/grid');
		echo $this->Html->css('blueprint/src/forms');
		echo $this->Html->css('blueprint/src/typography');
		echo $this->Html->css('blueprint/src/ie');

		echo $this->Html->css('admin');

		echo $scripts_for_layout;
	?>
</head>
<body>
    <div id="header">
		<h1><?php echo Configure::read('Site.name'); ?> Admin 
			<span class="back">[<?php echo $this->Html->link('Back to main site', Router::url('/')); ?>]</span></h1>
	</div>
	<div id="content" class="container span-24">
		<div id="sidebar" class="span-4">
			<?php echo $this->element('menus/admin'); ?>
		</div>
		<div id="main" class="span-20 last">
			<?php echo $this->Session->flash(); ?>
			<?php echo $content_for_layout; ?>
		</div>
	</div>
	<div class="clear"></div>
	<div id="footer"></div>
    <?php
    echo $this->element('sql_dump');
    ?>
</body>
</html>
