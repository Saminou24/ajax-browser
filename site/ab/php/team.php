<h1><? echo i18n('team.h1'); ?></h1>
<div>
	<dl>
		<?
			require_once 'team.phpc';
			echo team();
		?>
	</dl>
</div>