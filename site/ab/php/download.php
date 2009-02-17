<? require_once 'download.phpc'; ?>
<h1><? echo i18n('get.h1'); ?></h1>
<div>
	<h2><? echo i18n('get.pro'); ?></h2>
	<div>
		<h3><? echo i18n('get.pro.latest'); ?></h3>
		<div>

		</div>
		<h3><? echo i18n('get.pro.older'); ?></h3>
		<div>
			<? echo downloadable_list(); ?>
		</div>
	</div>

	<h2><? echo i18n('get.free'); ?></h2>
	<div>
		<h3><? echo i18n('get.free.latest'); ?></h3>
		<div>

		</div>
		<h3><? echo i18n('get.free.older'); ?></h3>
		<div>

		</div>
	</div>

	<h2><? echo i18n('get.lang'); ?></h2>
	<div>
	</div>

	<h2><? echo i18n('get.icons'); ?></h2>
	<div>
	</div>

</div>