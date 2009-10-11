<?php // ENGLISH i18n
// @ symbol indicate that the following part is an HTML attribute
$GLOBALS['i18n:file'] = array(
// PAGE FILE
  'home' => 'home',
  'features' => 'features',
  'gallery' => 'screenshots',
  'demo' => 'demo',
  'download' => 'download',
  'help' => 'help',
  'faq' => 'faq',
  'documentation' => 'documentation',
  'forum' => 'forum',
  'contact' => 'contact',
  'team' => 'team',
  'admin' => 'administration',
  '' => ''
);
$GLOBALS['i18n'] = array(
// HTML header
  'htmllang'=>'en',
  'htmlkeywords' =>', folder, file, file manager, domain, gallery, tree view mode, thumbnails mode, webmaster tool',
  'htmldesc' => 'AJAX-Browser is a HTTP file manager fully written in PHP/AJAX, it will extend your file management experience to your web server without any FTP client. It&#039;s a project under LGPL licence.',
  'title' => 'AJAX-browser',

// MENU
	'menulang' => 'Languages list',
	'menuheader' => 'Navigation menu',
  'menu.a:home' => 'Home',
  'menu.a:home@title' => 'Quick overview',
  'menu.a:features' => 'Features',
  'menu.a:features@title' => 'Complete list of functions.',
  'menu.a:screenshots' => 'Screenshots',
  'menu.a:screenshots@title' => 'Screen captures.',
  'menu.a:demo' => 'Demo',
  'menu.a:demo@title' => 'Live demo (Pro version&#039;s ).',
  'menu.a:download' => 'Download',
  'menu.a:download@title' => 'Free, Pro or older versions.',
  'menu.a:help' => 'Help',
  'menu.a:help@title' => 'Support: FAQ, Docs, Forum.',
  'menu.a:FAQ' => 'FAQ',
  'menu.a:FAQ@title' => 'Frequent Asked Questions.',
  'menu.a:doc' => 'Documentation',
  'menu.a:doc@title' => 'Install and use case howto.',
  'menu.a:forum' => 'Forum',
  'menu.a:forum@title' => 'French or English forum.',
  'menu.a:contact' => 'Contact',
  'menu.a:contact@title' => 'If you need help or for any other raison.',
  'menu.a:team' => 'Team',
  'menu.a:team@title' => 'Project collaborators.',
  '' => '',

// INDEX
  'logo.div@title' => 'Homepage',
  'logo.a@alt' => 'go to home page',
  'logo.a' => 'home',
  'switchlang' => 'switch language',
  'skip2content' => 'skip to main content',
  'index#login' => 'login',
  'index#login@title' => 'enter administrator mode',
  'index#logout' => 'logout',
  'index#logout@title' => 'leave the administrator mode',


// FOOTER
  'footer.h2-last' => 'Footer',
  'footer.ARR' => ' â All rights reserved.',
  'CSS@alt' => 'Valid CSS 2.1',
  'CSS@title' => 'Valid CSS 2.1',
  'XHTML@alt' => 'Valid XHTML 1.0 Strict',
  'XHTML@title' => 'Valid XHTML 1.0 Strict',
  'WCAG@href' => 'http://www.w3.org/WAI/intro/accessibility.php',
  'WCAG@alt' => 'WCAG-AA',
  '' => '',
  '' => '',
  '' => '',

// HOMEPAGE
  'home.h1' => 'Home page',
  'home.h2-1' => 'Overview',
  'home.h3-1' => 'About',
  'home.about' => <<<ABOUT
The AJAX-Browser project begin in 2006 as a personnal script to manage my own files on a remote server. At this time I was juggling between WindowsÂ® and Linux so I was looking for a <strong>cross-platform solution</strong>. As I was highly disappointed with <abbr title='File Transfer Protol'>FTP</abbr>, I decided to create this project upon the <strong>popularity</strong> and <strong>portability</strong> of web browser.
ABOUT
,
  'home#sample' => "<div id='sample'><a href='?p={$GLOBALS['i18n:file']['screenshots']}'><img id='sample' src='./misc/screenshots/thumbs/00-samples.png' title='Screenshots gallery.' alt='see screenshots' /></a></div>",
  'home.h3-2' => 'Description',
  'home.desc' => <<<DESC
<p>The whole project is written in <abbr title='Asynchronous Javascript And XML'>AJAX</abbr> and <abbr title='PHP: Hypertext Preprocessor'>PHP</abbr>, which are two highly spread technologies among modern web browsers and web servers. Thus, <abbr title='PHP: Hypertext Preprocessor'>PHP</abbr> make it an <strong>easy to install</strong> application and <abbr title='Asynchronous Javascript And XML'>AJAX</abbr> allow instantaneous reactivity and <strong>intuitive use</strong>.</p>
You will find the following features, <em>similar to the one you will find in your <abbr title='Operating System'>OS</abbr> file manager</em>&thinsp;:
<ul>
	<li>Files management (drag'n'drop, advanced selection, cut/copy/paste, etc.)&thinsp;;</li>
	<li>Images watermarking&thinsp;;</li>
	<li>Online files edition with syntax highlightment (<abbr title='confer' lang='la'>cf</abbr>. <a href='http://codepress.org/'>Codepress</a>)&thinsp;;</li>
	<li>Online compression and extraction (<abbr title='confer' lang='la'>cf</abbr>. <a href='?p=documentation.easyarchive'>EasyArchive</a>)&thinsp;;</li>
	<li>Upload and batch download (archive)&thinsp;;</li>
	<li>Advanced rights management (UNIX-like)&thinsp;;</li>
	<li>Log journal&thinsp;;</li>
	<li>Themes support and customisation&thinsp;;</li>
	<li><abbr title='Localization'>l10n</abbr> and <abbr title='Internationalization'>i18n</abbr> support.</li>
</ul>
<p>See the <a href='?p={$GLOBALS['i18n:file']['features']}'>full features list</a>.</p>
DESC
  ,
  'home.h3-3' => 'Quick Download',
  'home.download' => '<a href=\'/misc/download/lastest\'>download <strong>latest version</strong></a>',
  'home.h3-4' => 'News',
  'home.h3-5' => 'Donate',
  'home.donation' => 'Donation&thinsp;!',
  '' => '',
  '' => '',
  '' => '',

	// NEWS
		'news.todo' => '<p>No news systems installed</p>',
		'' => '',
		'' => '',
		'' => '',
		'' => '',
		'' => '',
		'' => '',

// FEATURES
  'features.h1' => 'Features',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// SCREENSHOTS
  'screenshots.h1' => 'Screenshots',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// DEMO
  'demo.h1' => 'Pro Version\'s Live Demo',
  'demo.info' => 'Be aware that the <strong>live demo is based upon the Pro version</strong>.',
  'demo.h2-1' => '<em>Tree view</em> mode',
  'demo.h2-2' => '<em>Preview</em> mode',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// DOWNLOAD
	'get.h1' => 'Download',
  'get.pro' => '<em>Pro</em> version',
		'get.pro.latest' => '',
		'get.pro.older' => '',
  'get.free' => '<em>Free</em> version',
		'get.free.latest' => '',
		'get.free.older' => '',
  'get.lang' => 'Others languages',
  'get.icons' => 'Icons pack',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// HELP
  'help.h1' => 'Help & Support',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// FAQ
  'faq.h1' => "<abbr title='Frequent Asked Questions'>FAQ</abbr>",
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// DOC
  'doc.h1' => 'Documentation',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// FORUM
  'forum.h1' => 'Forum',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// CONTACT
  'contact.h1' => 'Contact',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// TEAM
  'team.h1' => 'Team',
  'team_member_role' => 'Role',
  'team_member_aka' => "<abbr title='Also Known As'>aka</abbr>",
  'team_member_country' => 'Country',
  'team_member_mail' => 'E-mail',
  'team_member_website' => 'Website',
  '' => '',
  '' => '',

//
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => ''

);
?>