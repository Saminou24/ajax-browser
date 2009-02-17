<?
// ENGLISH i18n
// @ symbol indicate that the following part is an HTML attribute
$GLOBALS['i18n:file'] = array(
// PAGE FILE
  'file:home' => '首页',
  'file:features' => 'features',
  'file:screenshots' => '屏幕捕捉 (screenshots)',
  'file:demo' => '示范 (demo)',
  'file:download' => '下载',
  'file:faq' => '常见问题',
  'file:documentation' => '指南',
  'file:forum' => '会馆',
  'file:contact' => '联系',
  'file:team' => '队',
  '' => ''
);
$GLOBALS['i18n'] = array(
// HTML header
  'htmllang'=>'zh-cn',
  'htmlkeywords' =>', folder, file, file manager, domain, gallery, tree view mode, thumbnails mode, webmaster tool',
  'htmldesc' => 'AJAX-Browser is a HTTP file manager fully written in PHP/AJAX, it will extend your file management experience to your web server without any FTP client. It&#039;s a project under LGPL licence.',
  'title' => 'AJAX-browser',

// MENU
    'menulang' => '语言单子',
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
  'menu.a:download@title' => 'Free, buying and older versions.',
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
  'logo.a@alt' => 'go to homepage',
  'logo.a' => 'home',
  'switchlang' => 'switch language',
  'skip2content' => 'skip to main content',

// FOOTER
  'footer.h2-last' => 'Footer',
  'footer.ARR' => ' – All rights reserved.',
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
The AJAX-Browser project begin in 2006 as a personnal script to manage my own files on a remote server. At this time I was juggling between Windows® and Linux so I was looking for a cross-platform solution. As I was highly disappointed with <abbr title='File Transfer Protol'>FTP</abbr>, I decided to create this project upon the popularity and portability of web browser.
ABOUT
,
  'home.h3-2' => 'Description',
  'home.desc' => <<<DESC
<p>The whole project is written in <acronym title='Asyncronous Javascript And XML'>AJAX</acronym> and <acronym title='PHP: Hypertext Preprocessor'>PHP</acronym>, which are two higly spread technologies among modern web browsers and web servers. Thus, <acronym title='PHP: Hypertext Preprocessor'>PHP</acronym> make it an <em>easy to install</em> application and <acronym title='Asyncronous Javascript And XML'>AJAX</acronym> allow instantaneous reactivity and <strong>intuitive use</strong>.</p>
You will find the following features like on your <abbr title='Operating System'>OS</abbr> browser&thinsp;:
<ul>
    <li>Files management (drag'n'drop, advanced selection, cut/copy/paste, etc.)&thinsp;;</li>
    <li>Images watermarking&thinsp;;</li>
    <li>Online files edition with syntax highlightment (<abbr title='confer' lang='la'>cf</abbr>. <a href='http://codepress.org/'>Codepress</a>)&thinsp;;</li>
    <li>Online compression and extraction (<abbr title='confer' lang='la'>cf</abbr>. <a href='{$GLOBALS['lang']}/?p=documentation.easyarchive'>EasyArchive</a>)&thinsp;;</li>
    <li>Upload and batch download (archive)&thinsp;;</li>
    <li>Advanced rights management (UNIX-like)&thinsp;;</li>
    <li>Log journal&thinsp;;</li>
    <li>Themes support and customisation&thinsp;;</li>
    <li><abbr title='Localization'>i10n</abbr> and <abbr title='Internationalization'>i18n</abbr> support.</li>
</ul>
see the <a href='{$GLOBALS['lang']}/?p={$GLOBALS['i18n:file']['file:features']}'>full features list</a>.
DESC
  ,
  'home.h3-3' => 'Quick Download',
  'home.download' => 'download latest version',
  'home.h3-4' => 'News',
  'home.h3-5' => 'Donate',
  'home.donation' => 'Help this project&thinsp;!',
  '' => '',
  '' => '',
  '' => '',

    // NEWS
        'news.todo' => 'No news systems installed',
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
  'demo.info' => 'Be aware that the live demo is <em>based upon the Pro version</em>.',
  'demo.h2-1' => '<em>Tree view</em> mode',
  'demo.h2-2' => '<em>Preview</em> mode',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// DOWNLOAD
    'get.h1' => '下载',
  'get.pro' => '<em>Pro</em>版本',
        'get.pro.latest' => '',
        'get.pro.older' => '',
  'get.free' => '<em>免费</em>版本',
        'get.free.latest' => '',
        'get.free.older' => '',
  'get.lang' => '其他语言',
  'get.icons' => 'Icons pack',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// FAQ
  'faq.h1' => '常见问题 (FAQ)',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// DOC
  'doc.h1' => '指南',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// FORUM
  'forum.h1' => '会馆',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// CONTACT
  'contact.h1' => '联系',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',
  '' => '',

// TEAM
  'team.h1' => '队',
  'team_member_role' => '任务',
  'team_member_aka' => "<abbr title='用戶名稱'>aka</abbr>",
  'team_member_country' => '国家',
  'team_member_mail' => 'E-mail',
  'team_member_website' => '网站',
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
