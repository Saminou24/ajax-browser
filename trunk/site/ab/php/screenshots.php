<h1><? echo i18n('screenshots.h1'); ?></h1>
<ul id='screenshots'>
	<?
		require_once 'screenshots.phpc';
		htmlizer('misc/screenshots/');
	?>
</ul>
<br class='clear'/>