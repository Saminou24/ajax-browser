<h3 class='h'><?php echo _('Languages list'); ?></h3>
	<ol id='lang'>
		<li lang='en' title='Switch to English' <?php echo is_locale(lang(), 'en')?>><a href='http://<?php echo $_SERVER["HTTP_HOST"];?>/en/?<?php echo translate_QS('en'); ?>'><img src='/images/en.png' alt='English' /></a></li>
		<li lang='fr' title='Basculer en Français' <?php echo is_locale(lang(), 'fr')?>><a href='http://<?php echo $_SERVER["HTTP_HOST"];?>/fr/?<?php echo translate_QS('fr'); ?>'><img src='/images/fr.png' alt='Français' /></a></li>
	<!-- TRANSLATION TODO! -->
		<!--<li lang='es' title='Cambiar por Español' <?php echo is_locale(lang(), 'es')?>><a href='http://<?php echo $_SERVER["HTTP_HOST"];?>/es/?<?php echo translate_QS('es'); ?>'><img src='/images/es.png' alt='Español' /></a></li>-->
		<!--<li lang='zh' title='改变中国' <?echo is_locale(lang(), 'zh')?>><a href='http://<?php echo $_SERVER["HTTP_HOST"];?>/zh/?<?php echo translate_QS('zh'); ?>'><img src='/images/zh.png' alt='中文' /></a></li>-->
		<li lang='tw' title='改變中國' <?echo is_locale(lang(), 'tw')?>><a href='http://<?php echo $_SERVER["HTTP_HOST"];?>/tw/?<?php echo translate_QS('tw'); ?>'><img src='/images/tw.png' alt='中國' /></a></li>
	</ol>