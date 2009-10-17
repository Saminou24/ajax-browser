<h2 class='h'><?php echo _('Footer'); ?></h2>
<div id='footer'>
	<?php echo snippets_donate(); ?>
	<?php /*require 'menu-lang.php';*/ ?>
	<a href="http://jigsaw.w3.org/css-validator/check?uri=referer">
		<img src="/images/valid_css_80x15-w.png"
			alt="<?php echo _('Valid CSS 2.1'); ?>" title="<?php echo _('Valid CSS 2.1'); ?>" />
		</a>
	<a href="http://validator.w3.org/check?uri=referer">
		<img src="/images/valid_xhtml_80x15-w.png"
			alt="<?php echo _('Valid XHTML 1.0 Strict'); ?>" title="<?php echo _('Valid XHTML 1.0 Strict'); ?>" />
	</a>
	<a href="http://www.w3.org/WAI/intro/accessibility.php">
		<img src="/images/valid_wai-aa_80x15-w.png"
			alt="<?php echo _('WCAG-AA'); ?>" />
	</a>
	<br />
	<span id='cr'>© copyright 2006-<?php echo date('Y'); ?> Alban Lopez<?php echo _(' – All rights reserved.'); ?></span>
</div>
