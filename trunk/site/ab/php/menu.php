<!--MENU BLOCK-->
<?
	require_once 'menu.phpc';
	$menu_items = build_menu();
?>

<h2 class='h'><? echo i18n('menuheader'); ?></h2>
<ul id='menu' title='menu de navigation'>
	<? echo $menu_items; ?>
</ul>
<br class='clear' />