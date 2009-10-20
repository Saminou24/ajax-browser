<!--MENU BLOCK-->
<?php
  require_once 'menu.phpc';
  require_once 'i18n.phpc';
  require_once 'toolbox.php';

	$menu_items = build_menu();
?>
<h2 class='h'><?php echo _('Navigation menu'); ?></h2>
<div id='topmenu'>
  <div class='bgl'>&nbsp;</div>
  <div class='bgc'>
	<ul id='menu' title='<?php echo _('Navigation menu'); ?>'>
		<li id='lang0'><?php require 'menu-lang.php'; ?></li>
		<?php echo $menu_items; ?>
	</ul>
  </div>
  <div class='bgr'>&nbsp;</div>
</div>