<?php
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

// phpinfo();
require_once 'toolbox.php';
require_once 'snippets.php';
require_once 'i18n.phpc';
lang();
// require_once 'i18n-'.lang().'.php';
require_once 'news.php';
require_once 'admin.phpc';
$backoffice = new admin();
// dump($_SERVER);
$_GLOBALS['BASE_URI'] = $_SERVER["REDIRECT_URL"].'';
// parse_query_string();

function last_version()
{
	return '2.03-FAKE';
}

function is_locale($env, $me)
{
	if ($env==$me)
	{
		return "class='active'";
	} else
	{
		return '';
	}
}

function status($item)
{// ajoute une class CSS spÃ©cial au bouton correspondant Ã  la page courante
	//dump($_REQUEST['p']); dump($item);
	if (isset($_REQUEST['p'])==FALSE)
	{// aucune page demander = page d'acceuil
		if ($item==$GLOBALS['i18n:file']['home'])
		{
			return 'current ';
		}
	} else
	{// l'utilisateur Ã  demander une page
		if ($item==strtolower($_REQUEST['p']))
		{
			return 'current ';
		}
	}
}


function include_page()
{// we include the requested file if it's a valid one, else homepage

	// default page
	$key = 'home';
	$file = str_replace('', '', $key);

	if (isset($_REQUEST['p'])==TRUE)
	{
		$req = mb_strtolower($_REQUEST['p']); # problÃ¨me d'accent sur les majuscules !
//     dump($req);
		if (in_array($req, $GLOBALS['i18n:file'])==TRUE)
		{// the requested page is a valid file
			$key = array_search($req, $GLOBALS['i18n:file']);
			$file = str_replace('', '', $key);
		}
	}
// 	dump($file);
	$page['file'] = $file.'.php';
	$page['title'] = ucfirst($GLOBALS['i18n:file'][$key]);

	return $page;
}

$page = include_page();
// var_dump($page);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="<?php echo $lang; ?>" dir="ltr" xml:lang="<?php echo $lang; ?>" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Reply-to" content="alban.lopez+ajaxbrowser@gmail.com" />
	<meta http-equiv="Expires" content="1 weeks" />
	<meta http-equiv="Rating" content="general" />
	<meta http-equiv="Keywords" content="<?php echo _('file manager, domain, gallery, tree view mode, thumbnails mode, webmaster tool'); ?>" />
	<meta http-equiv="Description" content="<?php echo _('AJAX-Browser is a HTTP file manager fully written in PHP/AJAX, it will extend your file management experience to your web server without any FTP client. It&#039;s a project under LGPL licence.'); ?>" />
	<meta http-equiv="ROBOTS" content="ALL, INDEX" />
	<meta http-equiv="Author" content="Alban Lopez, Ãdouard Lopez" />
	<meta http-equiv="Revised" content="2009-10-03" />
	<meta http-equiv="Language" content="<?php echo $lang; ?>" />
	<meta name="revisit-after" content="2 days" />
	<link rel='stylesheet' type='text/css' href='/css/ab-typo.css' />
	<link rel='stylesheet' type='text/css' href='/css/ab-layout.css' />
	<link rel='icon' type='image/png' href='/.favicon.png' />
	<link href="/download/rss.xml" rel="alternate" title="<?php echo _("AJAX-Browser News");?>" type="application/rss+xml" />
	<title><?php echo $page['title']; ?></title>
</head>
<body>
	<div id='layout'>
		<div id='logo' title="<?php echo _('Home page'); ?>">
			<a href='#lang' class='h'><?php echo _('switch language'); ?></a>
			<a href='#content' class='h'><?php echo _('skip to main content'); ?></a>
			<a href='?p=<?php echo _('home'); ?>'><img src='/images/logo.png' alt="<?php echo _('go to home page'); ?>"/></a>
		</div>
    <?php
      require_once 'menu.php';
      //dump($_SESSION);
      echo $backoffice->logged();
    ?>
    <br class='clear' />
		<div id='content'>
			<?php require_once $page['file']; ?>
		</div>

		<?php require_once 'footer.php'; ?>
	</div>
</body>
</html>