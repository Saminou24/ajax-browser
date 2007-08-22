<?php
/**-------------------------------------------------
 | AJAX-Browser  -  by Alban LOPEZ
 | Copyright (c) 2007 Alban LOPEZ
 | Email bugs/suggestions to alban.lopez@gmail.com
 +--------------------------------------------------
 | This script has been created and released under
 | the GNU GPL and is free to use and redistribute
 | only if this copyright statement is not removed
 +--------------------------------------------------*/
class SESSION
{
	var $name;
	var $exemple = array (
	'code' => '',
	'usr_email' => '',
	'language_file' => 'Language ??.php',
	'def_mode' => 'arborescence',		// ['arborescence', 'gallerie']
	'def_racine' => 'Li8.',
	'mini_size' => 100,					// [75, 100, 200, 300, 400]
	'last' => '',
	'IP_count' => array ( ),
	'droits' => array (
		'.VIEW' => FALSE, 				// view hidden files
		'..VIEW' => FALSE, 				// browse parent directory
		'REN' => FALSE, 				// rename item(s)
		'NEW' => FALSE, 				// make new folder or file
		'COPY' => FALSE, 				// copy item(s)
		'MOVE' => FALSE, 				// move item(s)
		'DEL' => FALSE, 				// remove definitively item(s)
		'CP_VIEW' => FALSE, 			// view item with CodePress
		'CP_EDIT' => FALSE, 			// edit item with CodePress
		'DOWNLOAD' => FALSE, 			// download item(s)
		'UPLOAD' => 'NO', 				// upload item(s) ['NO', 'OnlyAlways', 'ExceptRestrict', 'ALL']
		'GLOBAL_SETTING' => FALSE,	// setup global value
		'GLOBAL_ACCOUNTS' => FALSE	// setup one's account
		)
	);
	
	var $DefConfFile = array (
	'admin_email' => 'alban.lopez@gmail.com',
	'ajaxb_miror' => 'ajaxbrowser.free.fr',
	'restrict_mask' => array ('*.php','*.php5','*.asp','*.bin','*.exe'),
	'always_mask' => array ('*.html','*.avi','*.png','*.jpg','*.txt'),
	'codepress_mask' => array ('*.html','*.txt','*.php','*.php5','*.asp','*.*~'),
	'mini_dir' => './Mini/',
	'mini_intervale' => 250,
	'spy_dir' => './Spy/',
	'spy' => array (
		'ip' => false,
		'log' => false,
		'action' => false,
		'browse' => false
		),
	'accounts' => array ()
	);

	function SESSION ($name)
	{
		global $InstallDir;
		$this->name=$name;
		if (!is_dir(session_save_path()))
			if (!is_dir(mkdirs(str_replace(realpath('./'), '.', session_save_path()))))
				echo $ABS[100].' ("'.session_save_path().'").<br>';
		session_start();						// On démarre la session avant toute autre chose
	}
	function request_log()
	{
		global $ABS, $code, $login, $InstallDir;
?>
<html>
	<head>
		<meta content="text/html; charset=UTF-8" http-equiv="content-type">
		<title><?php echo $ABS[1];?></title>
	</head>
	<style type="text/css">
		html, body, table { position: absolute;width:100%;height:100%;padding:0px;margin:0px;}
		body {font-size:10px;}
		input, span {width:120px;}
		input:hover {background:rgb(230,250,210);}
		 td, tr {vertical-align:middle;text-align:center;}
		div {margin-left: auto;margin-right:auto;background-color:rgb(220,230,255);padding:2px 10px;width:250px;-moz-border-radius:8px;font-weight:bold;border:1px solid gray;}
	</style>
	<script type="text/javascript" src="<?php echo $InstallDir; ?>scripts/Dom-drag.js"></script>
	<script type="text/javascript" src="<?php echo $InstallDir; ?>scripts/Dom-event.js"></script>
	<script type="text/javascript" src="<?php echo $InstallDir; ?>scripts/Common.js"></script>
	<body onLoad="document.getElementById('login').focus()">
	<form method="post" action="?">
		<table >
		<tr>
			<td>
				<div>
					<p><span><?php echo $ABS[5];?> : </span><input type="text" id="login" name="login" value="<?php echo $login?$login:"anonymous"; ?>"></p>
					<p><span><?php echo $ABS[6];?> : </span><input type="password" name="code"></p>
					<p><button type="submit" name="mode" value="arborescence"><?php echo $ABS[12];?></button><button type="submit" name="mode" value="gallerie"><?php echo $ABS[13];?></button></p>
					<a href="http://ajaxbrowser.free.fr/"><?php echo $ABS[301];?></a>
				</div>
			</td>
		<tr>
		</table>
	</form>
	</body>
</html>
<?php
	exit();
	}
	function close()
	{
		$_SESSION[$this->name] = array(0);	// on vide bien la variable de session
		unset($_SESSION[$this->name]);		// et on detruit le contenue de session ki nous conserne
		if (empty($_SESSION))			// si aprés ca la session est vide on peut en deduire que personne d'autre ne l'utilise
		{
			setcookie(session_name(), '', time()-42000, '/');	// on force le cookie de session a etre périmé
			session_destroy();								 // on detruit la session sur le serveur
		}
	}
	function load()
	{
		global $login, $InstallDir;
		$GLOBALS['AJAX-Var']["accounts"][$login]["IP_count"][$_SERVER['REMOTE_ADDR']]++;
		$GLOBALS['AJAX-Var']["accounts"][$login]["last"] = date ("d/m/y H:i:s",time());
		$_SESSION['AJAX-B'] = $GLOBALS['AJAX-Var'];
			unset ($_SESSION['AJAX-B']["accounts"]);
				$_SESSION['AJAX-B'] = array_merge(array('login' => $login), $GLOBALS['AJAX-Var']["accounts"][$login], $_SESSION['AJAX-B']);
			unset ($_SESSION['AJAX-B']['code']);
		WriteInFile ($InstallDir.'AJAX-Array.var', serialize($GLOBALS['AJAX-Var']), "sup");
		if ($_SESSION['AJAX-B']['spy']['log'])
			WriteInFile ($_SESSION['AJAX-B']['spy_dir'].'/Log.spy', $login.($_SESSION['AJAX-B']['spy']['ip']?' » '.$_SERVER['REMOTE_ADDR']:'').' ['.date ("d/m/y H:i:s",time()).'] » '.$_SERVER['HTTP_USER_AGENT']."\n", "add");
	}
}
?>