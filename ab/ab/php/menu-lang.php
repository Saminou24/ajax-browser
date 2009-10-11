<h3 class='h'><?php echo _('Languages list'); ?></h3>
	<ol id='lang'>
		<li lang='en' title='Switch to English' <?php echo is_locale(lang(), 'en')?>><a href='http://<?php echo $_SERVER["HTTP_HOST"];?>/en/?<?php echo translate_QS('en'); ?>'><img src='/images/en.png' alt='English' /></a></li>
		<li lang='fr' title='Basculer en FranÃ§ais' <?php echo is_locale(lang(), 'fr')?>><a href='http://<?php echo $_SERVER["HTTP_HOST"];?>/fr/?<?php echo translate_QS('fr'); ?>'><img src='/images/fr.png' alt='FranÃ§ais' /></a></li>
	<!-- TRANSLATION TODO! -->
		<li lang='es' title='Cambiar por EspaÃ±ol' <?php echo is_locale(lang(), 'es')?>><a title='http://<?php echo $_SERVER["HTTP_HOST"];?>/es/?<?php echo translate_QS('es'); ?>'><img src='/images/es.png' alt='EspaÃ±ol' /></a></li>
		<li lang='zh' title='å°æ¹¾' <?echo is_locale(lang(), 'zh')?>><a href='http://<?php echo $_SERVER["HTTP_HOST"];?>/zh/?<?php echo translate_QS('zh'); ?>'><img src='/images/zh.png' alt='ä¸­è¯æ°å' /></a></li>
	</ol>