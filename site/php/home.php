<h1><?php echo _('Home page'); ?></h1>
<div id='page'>
	<h2 class='h'><?php echo _('Overview'); ?></h2>
	<div>
		<h3><?php echo _('About'); ?></h3>
    <div>
      <div id='sample'>
        <a href='?p=screenshots' >
          <img id='sample' src='/misc/screenshots/thumbs/gallery-view.png' title='<?php echo urlizer(_('Screenshots gallery.'));?>' alt='<?php echo urlizer(_('see screenshots'));?>' />
        </a>
      </div>
      <p><?php echo _("The AjaxBrowser project begin in 2006 as a personnal script to manage my own files on a remote server. At this time I was juggling between Windows® and Linux so I was looking for a <strong>cross-platform solution</strong>. As I was highly disappointed with <abbr title='File Transfer Protocol'>FTP</abbr>, I decided to create this project upon the <strong>popularity</strong> and <strong>portability</strong> of web browser."); ?></p>
    </div>

    <h3 class='h'><?php echo _('Quick Download'); ?></h3>
    <div id='home-download'>
       <?php echo snippets_latest_pro(); ?>
       <?php echo snippets_latest_free(); ?>

    </div>

		<h3><?php echo _('Description'); ?></h3>
		<div>
			<p><?php echo _("The whole project is written in <abbr title='Asynchronous Javascript And XML'>AJAX</abbr> and <abbr title='PHP: Hypertext Preprocessor'>PHP</abbr>, which are two highly spread technologies among modern web browsers and web servers. Thus, <abbr title='PHP: Hypertext Preprocessor'>PHP</abbr> make it an <strong>easy to install</strong> application and <abbr title='Asynchronous Javascript And XML'>AJAX</abbr> allow instantaneous reactivity and <strong>intuitive use</strong>.");?></p>
      <?php echo _("You will find the following features, <em>similar to the one you will find in your <abbr title='Operating System'>OS</abbr> file manager</em>&thinsp;:");?>
       <?php echo snippets_donate(); ?>
      <ul>
        <li><?php echo _("Files management (drag'n'drop, advanced selection, cut/copy/paste, etc.)&thinsp;;");?></li>
        <li><?php echo _("Images watermarking&thinsp;;");?></li>
        <li><?php echo _("Online files edition with syntax highlightment (<abbr title='confer' lang='la'>cf</abbr>. <a href='http://codepress.org/'>Codepress</a>)&thinsp;;");?></li>
        <li><?php echo _("Online compression and extraction (<abbr title='confer' lang='la'>cf</abbr>. <a href='?p=documentation.easyarchive'>EasyArchive</a>)&thinsp;;");?></li>
        <li><?php echo _("Uploads and downloads of files as archive&thinsp;;");?></li>
        <li><?php echo _("Advanced rights management (UNIX-like)&thinsp;;");?></li>
        <li><?php echo _("Log journal&thinsp;;");?></li>
        <li><?php echo _("Themes support and customisation&thinsp;;");?></li>
        <li><?php echo _("<abbr title='Localization'>l10n</abbr> and <abbr title='Internationalization'>i18n</abbr> support.");?></li>
      </ul>
      <p><?php printf(_("See the <a href='?p=Features'>full features list</a> and the <a href='?p=Features#comparison'>features comparison</a> between <em>pro</em> and <em>free</em> versions."));?></p>
		</div>

		<h3><?php echo _('News'); ?></h3>
		<div id='news'>
			<?php
        require_once 'news.php';
				$news->show();
			?>
		</div>
	</div>
</div>
