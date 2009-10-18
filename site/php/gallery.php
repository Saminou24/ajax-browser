<h1><?php echo _('Screenshots'); ?></h1>
<div id='page'>
	<ul id='screenshots'>
		<?php 			require_once 'gallery.phpc';
      $gallery = new gallery();
      $gallery->set_wd('/misc/screenshots/');
      $gallery->list_screenshots();
      $filter = $gallery->filter('/^\./');
//       dump($filter['match']);
//       dump($filter['nomatch']);
			$gallery->htmlizer($filter['nomatch']);
		?>
	</ul>
<br class='clear'/>
</div>