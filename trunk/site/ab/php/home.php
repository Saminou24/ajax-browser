<h1><? echo i18n('home.h1'); ?></h1>
<div>
	<h2><? echo i18n('home.h2-1'); ?></h2>
	<div>
		<h3><? echo i18n('home.h3-1'); ?></h3>
		<p><? echo i18n('home.about'); ?></p>

		<h3><? echo i18n('home.h3-2'); ?></h3>
		<div>
			<? echo i18n('home.desc'); ?>
		</div>

		<h3><? echo i18n('home.h3-3'); ?></h3>
		<div id='download'>
			<a href='/misc/download/lastest'><? echo i18n('home.download'); ?></a>
			(<? echo last_version(); ?>)
		</div>

		<h3><? echo i18n('home.h3-4'); ?></h3>
		<div id='news'>
			<?
				require_once 'news.php';
				$news->show();
			?>
		</div>

		<? include 'donate.php'; ?>

	</div>
</div>