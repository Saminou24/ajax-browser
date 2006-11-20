<?php
/**-------------------------------------------------
 | AJAX-Browser  -  by Alban LOPEZ
 | Copyright (c) 2006 Alban LOPEZ
 | Email bugs/suggestions to alban.lopez@gmail.com
 +--------------------------------------------------
 | This script has been created and released under
 | the GNU GPL and is free to use and redistribute
 | only if this copyright statement is not removed
 +--------------------------------------------------*/

	$leveltxt = array(1 => "Reader",2 => "Uploader",3 => "Writer",4 => "Admin");
	$login = isset($_POST['login']) ? $_POST['login'] : $_GET['login'];
	$code = isset($_POST['code'])? $_POST['code'] : $_GET['code'];

	if (file_exists($File = "./.AJAX-B/AJAX-Array.var")) // AJAX-B/
		$GLOBALS['AJAX-Var'] = unserialize(file_get_contents($File));
	else
	{
		$DefConfFile = array (
			'ip-spy' => false,
			'E-Mail' => 'alban.lopez@gmail.com',
			'restrict-file' => array ('php','php5','asp'),
			'always-type' => array ('png','jpg','txt'),
			'users-infos' => array (
				'Admin_Installer' => array (
						'level' => 4,
						'code' => 'AdMpI6e2oxoLE', // corespond a crypt('','Admin_Installer')
						'def-mode' => 'arborescence',
						'def-racine' => './',
						'hidden-file' => false,
						'mini-size' => 100,
						'last' => '',
						'speed' => 'auto',
						'IP-count' => array ( )
					)
				)
			);
		echo "Le fichier de config \"$File\" n'est pas accésible.\n<br>";
		if (WriteInFile($File, serialize($DefConfFile), "remplace")) echo "Un fichier de remplacement vien d'etre créer";
		exit ();
	}
	if (!empty($_SESSION) && isset($_GET['stop']))
	{
		$_SESSION = array();
		if (isset($_COOKIE[session_name()]))
			setcookie(session_name(), '', time()-42000, '/');
		session_destroy();
	}
	if (empty($_SESSION) || (empty($_SESSION['def-mode']) && empty($_SESSION['def-racine']) && empty($_SESSION['']) && empty($_SESSION['level']) && empty($_SESSION['mini-size'])))
	{
		if (!empty($login) && array_key_exists($login, $GLOBALS['AJAX-Var']["users-infos"]) && $GLOBALS['AJAX-Var']["users-infos"][$login]["code"]==crypt($code,$login))
		{// Verrifie si ce login exsite dans notre tableau
			$GLOBALS['AJAX-Var']["users-infos"][$login]["IP-count"][$_SERVER['REMOTE_ADDR']]++;
			$_SESSION = $GLOBALS['AJAX-Var']["users-infos"][$login];
			$_SESSION['name'] = $login;//									OK
			$GLOBALS['AJAX-Var']["users-infos"][$login]["last"] = date ("d/m/y H:i:s",time());//		OK
			WriteInFile ($File, serialize($GLOBALS['AJAX-Var']), "remplace");
			unset ($_SESSION['code']);
		}
		else
		{
?>
<html>
	<head>
	<head>
		<meta content="text/html; charset=UTF-8" http-equiv="content-type">
		<title>Ouverture d'une session AJAX-Browser</title>
	</head>
		<title></title>
	</head>
	<style type="text/css">
		.mail {position:relative;width:99%;text-align:left;font-size:10px;font-style:italic;border:1px solid black;margin:5px 0px;padding:2px;}
		.mail:hover {background:rgb(230,250,210);}
		.alert {font-style:italic;font-weight:bold;text-align:center;color: #DD0000;}
	</style>
	<body style="font-size:10px;" onLoad="document.getElementById('login').focus()">
<br><div style="text-align:center;font-weight:bold;font-style:italic;">
Ce programme est concu et realisé sous licence GPL, est libre d'utilisation et de distribution seulement si le copyright n'est pas enlevé.
<br><br><br><br></div>
		<form method="post" action="?">
			<table border="0" width="400" align="center">
				<colgroup><col width='200'><col width='200'></colgroup>
				<tr><td><b>Login</b></td><td><input type="text" id="login" name="login" value="<? echo $login?$login:"anonymous"; ?>"></td></tr>
				<tr><td><b>Mot de passe<b></td><td><input type="password" name="code"></td></tr>
				<tr><td></td><td><input type="submit" name="OK"></td></tr>
			</table>
		</form>
<br><br><div style="text-align:center;font-style:italic;">
This script has been created and released under the GNU GPL and is free to use and redistribute only if this copyright statement is not removed.
<br></div><br><br>
<?
	if (isset($GLOBALS['AJAX-Var']['users-infos']['Admin_Installer']))
	{
?>
<br><br><div style="font-size:12px;color:red;text-align:center;font-weight:bold;font-style:italic;">
Attention le compte "Admin_Installer" n'as pas étés suprimé, c'est un compte ADMIN sans code.<br><br>
Il est TRES FORTEMENT RECOMMANDE de SUPPRIMER ce compte mais n'oubliez pas au préalable d'en créer un pour vous.<br><br>
Pour créer/modifier/supprimer des compte utiliser l'outil de configuration <img src="./.AJAX-Ico/Account.png"> en haut a droite.<br></div><br><br><hr><br><br>
<?
	}
	if ((isset($_POST['message']) || isset($_POST['title'])))
	{
		if (mail($GLOBALS['AJAX-Var']["E-Mail"], trim(stripslashes($_POST["title"])), trim(stripslashes($_POST["message"])), "From: ".$_POST["adress"]." <".$_POST["adress"].">\nMIME-Version: 1.0"))
			echo "<div class='alert'>Votre message a ete envoyee :</div><br><br>Titre :\n".$_POST["title"]."<br><br>Message :\n".$_POST["message"]."<br><br>\n";
		else
			echo "<div class='alert'>Un probleme s'est produit lors de l'envoi du message.<br>Ressayez...<br></div>\n";
	}
	elseif ($GLOBALS['AJAX-Var']["MAIL"])
	{
?>
	<form name="mail" METHOD='post' action='' enctype='multipart/form-data'>
		<label for="adress">Votre adresse e-mail (obligatoire):</label><br>
		<input class="mail" name="adress" id="adress" value="" /><br>
		<label for="title">Titre de message (facultatif):</label><br>
		<input class="mail" size="30" name="title" id="title" value="" /><br>
		<label for="message">Message (obligatoire):</label><br>
		<textarea class="mail" name="message" id="message" rows="10"></textarea><br>
		<input class="mail" right="0" style="text-align:center;" type="submit" value="Envoyer"/>
	</form>
	</body>
</html>
<?
	}
			exit ();
		}
	}
/*
var_export($GLOBALS['AJAX-Var']);
WriteInFile ($File, serialize(
array (
  'REN' => true,
  'MAIL' => true,
  'LINK' => true,
  'SOURCE' => true,
  'EDIT' => true,
  'DEL' => true,
  'DOWNLOAD' => true,
  'UPLOAD' => true,
  'COPY' => true,
  'MOVE' => true,
  'RENAME' => true,
  'NEW' => true,
  'CONTACT' => true,
  'ip-spy' => true,
  'E-Mail' => 'alban.lopez@gmail.com',
  'restrict-type' =>
  array (
    0 => 'php',
    1 => 'php5',
    2 => 'asp',
    3 => 'exe',
    4 => 'bin'
  ),
  'always-type' =>
  array (
    0 => 'png',
    1 => 'jpg',
    2 => 'gif',
    3 => 'txt',
    4 => 'zip',
    5 => 'gz',
    6 => 'bz',
    7 => 'bz2'
  ),
  'users-infos' =>
  array (
    'sctfic' =>
    array (
      'level' => 4,
      'code' => 'scZNgObYKntvs',
      'last' => '13/10/06 19:43:07',
      'hidden-file' => true,
      'def-mode' => 'arborescence',
      'def-racine' => './',
      'speed' => 'auto',
      'mini-size' => 100,
      'IP-count' => array ()
    ),
    'anonymous' =>
    array (
      'level' => 1,
      'code' => 'anFyJ.108W/Yk',
      'def-mode' => 'gallerie',
      'def-racine' => './IMG/',
      'hidden-file' => false,
      'mini-size' => 100,
      'last' => '11/10/06 20:32:40',
      'speed' => 'auto',
      'IP-count' => array ()
    ),
    'Admin_Installer' =>
    array (
      'level' => 4,
      'code' => 'AdMpI6e2oxoLE',
      'def-mode' => 'arborescence',
      'hidden-file' => false,
      'mini-size' => 100,
      'last' => '',
      'speed' => 'auto',
      'def-racine' => './',
      'IP-count' => array ()
    )
  )
 )
 )
, "remplace");*/
?>