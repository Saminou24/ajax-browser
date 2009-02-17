<h2 class='h'><? echo i18n('footer.h2-last'); ?></h2>
<div id='footer'>
	<? include 'donate.php'; ?>

	<h3 class='h'><? echo i18n('menulang'); ?></h3>
	<div>
		<ol id='lang'>
			<li <?echo is_locale(lang(), 'en')?>><a href='/en/?<? echo translate_QS('en', 'i18n:file'); ?>'><img src='/images/en.png' alt='English' title='Switch to English' /></a></li>
			<li <?echo is_locale(lang(), 'fr')?>><a href='/fr/?<? echo translate_QS('fr', 'i18n:file'); ?>'><img src='/images/fr.png' alt='Français' title='Basculer en Français' /></a></li>
		<!-- TRANSLATION TODO! -->
			<li <?echo is_locale(lang(), 'es')?>><a title='/es/?<? echo translate_QS('es', 'i18n:file'); ?>'><img src='/images/es.png' alt='Español' title='Cambiar por Español' /></a></li>
			<li <?echo is_locale(lang(), 'tw')?>><a href='/tw/?<? echo translate_QS('tw', 'i18n:file'); ?>'><img src='/images/tw.png' alt='中華民國' title='台湾' /></a></li>
		</ol>
		<br class='clear' />
	</div>

	<span id='cr'>© copyright 2006-<? echo date('Y'); ?> Alban Lopez<? echo i18n('footer.ARR'); ?></span>
	<br />
	<a href="http://jigsaw.w3.org/css-validator/check?uri=referer">
		<img src="/images/valid_css_80x15.png"
			alt="<? echo i18n('CSS@alt'); ?>" title="<? echo i18n('CSS@title'); ?>" />
		</a>
	<a href="http://validator.w3.org/check?uri=referer">
		<img src="/images/valid_xhtml_80x15.png"
			alt="<? echo i18n('XHTML@alt'); ?>" title="<? echo i18n('XHTML@title'); ?>" />
	</a>
	<a href="<? echo i18n('WCAG@href'); ?>">
		<img src="/images/valid_wai-aa_80x15.png"
			alt="<? echo i18n('WCAG@alt'); ?>" />
	</a>
</div>
