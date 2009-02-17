<?php
require_once 'toolbox.php';
require_once 'i18n.phpc';
require_once 'i18n-'.lang().'.php';
require_once 'news.php';
parse_query_string();

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
{// ajoute une class CSS spécial au bouton correspondant à la page courante
	//dump($_REQUEST['p']); dump($item);
	if (isset($_REQUEST['p'])==FALSE)
	{// aucune page demander = page d'acceuil
		if ($item==$GLOBALS['i18n:file']['file:home'])
		{
			return 'current ';
		}
	} else
	{// l'utilisateur à demander une page
		if ($item==strtolower($_REQUEST['p']))
		{
			return 'current ';
		}
	}
}


function include_page()
{// we include the requested file if it's a valid one, else homepage

	// default page
	$key = 'file:home';
	$file = str_replace('file:', '', $key);

	if (isset($_REQUEST['p'])==TRUE)
	{
		$req = mb_strtolower($_REQUEST['p']); # problème d'accent sur les majuscules !
		//dump($req);
		if (in_array($req, $GLOBALS['i18n:file'])==TRUE)
		{// the requested page is a valid file
			$key = array_search($req, $GLOBALS['i18n:file']);
			$file = str_replace('file:', '', $key);
		}
	}
	//dump($file);
	$page['file'] = $file.'.php';
	$page['title'] = ucfirst($GLOBALS['i18n:file'][$key]);

	return $page;
}

$page = include_page();
// var_dump($page);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="<? echo i18n('htmllang'); ?>" dir="ltr" xml:lang="<? echo i18n('htmllang'); ?>" xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<meta http-equiv="Reply-to" content="alban.lopez+ajaxbrowser@gmail.com" />
	<meta http-equiv="Expires" content="never" />
	<meta http-equiv="Rating" content="general" />
	<meta http-equiv="Keywords" content="<? echo i18n('htmlkeywords'); ?>" />
	<meta http-equiv="Description" content="<? echo i18n('htmldesc'); ?>" />
	<meta http-equiv="ROBOTS" content="ALL, INDEX" />
	<meta http-equiv="Author" content="Alban Lopez, Édouard Lopez" />
	<meta http-equiv="Revised" content="2009-02-06" />
	<meta http-equiv="Language" content="<? echo i18n('htmllang'); ?>" />
	<meta name="revisit-after" content="2 days" />
	<link rel='stylesheet' type='text/css' href='/css/ab-typo.css' />
	<link rel='stylesheet' type='text/css' href='/css/ab-layout.css' />
	<link rel='icon' type='image/png' href='/.favicon.png' />
	<link href="/download/rss.xml" rel="alternate" title="AJAX-Browser News" type="application/rss+xml" />
	<title><? echo $page['title']; ?> @ <? echo i18n('title'); ?></title>
</head>
<body>
	<div>
		<div id='logo' title="<? echo i18n('logo.div@title'); ?>">
			<a href='?p=<? echo i18n('logo.a'); ?>'><img src='/images/MMMMMMMMMMMMMMM.png' alt="<? echo i18n('logo.a@alt'); ?>"/></a>
			<a href='#lang' class='h'><? echo i18n('switchlang'); ?></a>
			<a href='#content' class='h'><? echo i18n('skip2content'); ?></a>
		</div>
		<? require_once 'menu.php'; ?>

		<div id='content'>
			<?php require_once $page['file']; ?>
		</div>

		<?php require_once 'footer.php'; include 'note.txt'; ?>
	</div>
</body>
</html>