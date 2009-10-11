<h1><?php echo _('Screenshots'); ?></h1>
<div id='page'>
	<ul id='screenshots'>
		<?php 			require_once 'gallery.phpc';
      $gallery = new gallery();
      $gallery->set_wd('/misc/screenshots/');
			$gallery->htmlizer();
		?>
	</ul>
<br class='clear'/>
</div>