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
 
$version="0.9.21-Language_Pack";

	$reload=false;

	$SESSION = new SESSION('AJAX-B');
	if (isset($stop))						// dans le cas d'une fermeture de session
		$SESSION->close();
	if (empty($_SESSION['AJAX-B']))
	{
		if (isset($makevarfile) && $code1==$code2 && !empty($login))
		{
			$SESSION->exemple['droits']['GLOBAL_SETTING']=true;
			$SESSION->exemple['droits']['GLOBAL_ACCOUNTS']=true;
			$SESSION->exemple["IP_count"][$_SERVER['REMOTE_ADDR']]++;
			$SESSION->DefConfFile=addUser($SESSION->exemple, $SESSION->DefConfFile, $login, $code1);
			if (!WriteInFile($InstallDir.'AJAX-Array.var', serialize($SESSION->DefConfFile), "sup"))
			{
				echo $ABS[100].'<br/>';
				exit ();
			}
		}
		elseif (!file_exists($InstallDir.'AJAX-Array.var'))
		{
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
	<body onLoad="document.getElementById('login').focus()">
		<form method="post" action="?">
		<table >
		<tr>
			<td>
				<div>
					<p><?php echo $ABS[101];?></p>
					<p><?php echo $ABS[102];?></p>
					<p><span><?php echo $ABS[5];?> : </span><input type="text" id="login" name="login"></p>
					<p><span><?php echo $ABS[6];?> : </span><input type="password" name="code1"></p>
					<p><span><?php echo $ABS[6];?> : </span><input type="password" name="code2"></p>
					<p><input type="submit" name="makevarfile" value="Make Account"></p>
					<a href="http://ajaxbrowser.free.fr/"><?php echo $ABS[301];?></a>
				</div>
			</td>
		<tr>
		</table>
	</form>
	</body>
</html>
<?php
			exit ();
		}
		$GLOBALS['AJAX-Var'] = unserialize(file_get_contents($InstallDir.'AJAX-Array.var'));
		if (isset($code) && isset($login) && $GLOBALS['AJAX-Var']['accounts'][$login]["code"]==crypt($code,$login))
			$SESSION->load();
		else
		{
			if (!empty($login) && $_SESSION['AJAX-B']['spy']['log'])
					WriteInFile ($_SESSION['AJAX-B']['spy_dir'].'/WRONG_Log.spy', $login.($_SESSION['AJAX-B']['spy']['ip']?' » '.$_SERVER['REMOTE_ADDR']:'').' ['.date ("d/m/y H:i:s",time()).'] » '.$_SERVER['HTTP_USER_AGENT']."\n", "add");
			$SESSION->request_log();
		}
	}

	if (!empty($racine) && is_dir($racine))
	{
		$racine64=encode64($racine);
		$reload=true;
	}
	elseif (empty($racine64) || !is_dir(decode64($racine64)) || encode64(decode64($racine64))!=$racine64)
	{
		$racine64 = is_dir(decode64($_SESSION['AJAX-B']['def_racine']))?$_SESSION['AJAX-B']['def_racine']:encode64('./');
		$reload=true;
	}
	if (empty($mode))
	{
		$mode=!empty($_SESSION['AJAX-B']['def_mode'])?$_SESSION['AJAX-B']['def_mode']:'arborescence';
		$reload=true;
	}
	if (($reload==true || isset($code)) && strpos($mode,'request')===false)
	{
		header("Location:".RebuildURL ());
		exit ();
	}

function RebuildURL ()
{
	global $login, $mode, $racine64, $ie, $db;
	return '?mode='.$mode.'&racine64='.$racine64.(isset($ie)?'&ie':'').(isset($db)?'&db':'');
}
?>