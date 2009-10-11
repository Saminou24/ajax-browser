<!--MENU BLOCK-->
<?php 	require_once 'menu.phpc';
	$menu_items = build_menu();
?>
<h2 class='h'><?php echo _('Navigation menu'); ?></h2>
<div id='topmenu'>

	<ul id='menu' title='<?php echo _('Navigation menu'); ?>'>
		<li id='lang0'><?php require 'menu-lang.php'; ?></li>
		<?php echo $menu_items; ?>
	</ul>
</div>