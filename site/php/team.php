<h1><?php echo _('Team'); ?></h1>
<div id='site' class='page'>
	<dl id='team'>
		<?php
      require_once 'team.phpc';
			echo team();
		?>
	</dl>
</div>