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
		<?php echo $title_for_layout; ?> - <?php __('New Site'); ?>
	</title>
	<?php
		echo $this->Html->meta('icon');

		echo $this->Html->css('blueprint/src/reset');
		echo $this->Html->css('blueprint/src/typography');
		echo $this->Html->css('blueprint/src/grid');
		<!--[if IE]>
		<?php echo $this->Html->css('blueprint/src/ie'); ?>
		<![endif]-->

		echo $this->Html->css('app');

		echo $scripts_for_layout;

		echo $this->element('google/analytics');
	?>
</head>
<body>
	<div id="container" class="container">
		<div id="header" class="container">
			<h1 class="span-16"><?php echo $this->Html->link(__('New Site', true), Router::url('/')); ?></h1>
			<div class="span-8 last"><?php echo $this->element('current_user'); ?></div>
		</div>
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $content_for_layout; ?>

		</div>
		<div id="footer">
			<span id="credit">an <?php
				echo $this->Html->link(
					'ebotunes',
					'http://www.ebotunes.com/',
					array('target' => '_blank', 'escape' => false)
				);
			?> production</span>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>