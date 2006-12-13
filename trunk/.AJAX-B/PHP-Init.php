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

	$version = "0.9.00";
	include ("./.AJAX-B/PHP-Common.php");
	ini_set('php_admin_flag engine','on');
	$StartPhpScripte = microtime_float();
	foreach ($_GET as $key=>$para)
	{
		$_GET[$key] = rawurldecode(($para));
	}
	if (!is_dir(session_save_path()))
	{
		if (!is_dir(mkdirs(str_replace(realpath("./"), ".", session_save_path()))))
			echo "Impossible d'accéder au repertoire de SESSIONS (\"".session_save_path()."\"), celui-ci n'existe pas et ne peut etre créé automatiquement.<br>";
	}
	session_start(); // On démarre la session avant toute autre chose
	clearstatcache();
	include ("./.AJAX-B/AJAX-Actions.php");
	include ("./.AJAX-B/PHP-Session.php");
	$speed = isset($_GET['speed']) ? $_GET['speed'] : $_SESSION['speed'];

	if ((!empty($_GET) || !empty($_POST)) && $GLOBALS['AJAX-Var']["ip-spy"])
	{
		if (!is_dir("./.AJAX-Spy/")) mkdirs("./.AJAX-Spy/");
		if (!empty($_GET['login']) || !empty($_POST['login']))
		WriteInFile(
			"./.AJAX-Spy/LOGINGS.txt",
			"\n[".date ("d/m/y H:i:s",time())."]\n{\n\t".$_POST['login']." (level ".$_SESSION['level']." : ".$leveltxt[$_SESSION['level']].")\n\t".$_SERVER['REMOTE_ADDR']." => ".gethostbyaddr($_SERVER['REMOTE_ADDR'])."\n\t".$_SERVER['HTTP_USER_AGENT']."\n}",
			"ajoute"
		);
		else WriteInFile(
			"./.AJAX-Spy/".$_SESSION['name'].".txt",
			"\n[".date ("d/m/y H:i:s",time())."]\n".(!empty($_GET)?"\$_GET=".print_r($_GET, true):'').(!empty($_POST)?"\$_POST=".print_r($_POST, true):''),
			"ajoute"
		);
		if (file_exists("./.AJAX-Spy/".$_SESSION['name'].".txt") && filesize("./.AJAX-Spy/".$_SESSION['name'].".txt")>100000)
		{
			$data_file = file_get_contents("./.AJAX-Spy/".$_SESSION['name'].".txt");
			WriteInFile("./.AJAX-Spy/".$_SESSION['name'].".txt", substr($data_file, strpos($data_file, ")\n\n[")+3), "remplace");
		}
	}

	if (isset($_GET['subdir']))
	{
		$OverTime = 1;
		echo ListDir ($_GET['subdir']);
		exit();
	}
	elseif (isset($_GET['shortsubdir']))
	{
		echo ListDirShort ($_GET['shortsubdir']);
		exit();
	}
	elseif (isset($_GET['getmini']))
	{
		echo CreatMini($_GET['getmini'], "./.AJAX-Mini/", $_SESSION['mini-size']);
		exit();
	}
	elseif (isset($_GET['size']))
	{
		$speed = "no";
		echo SizeDir (DirUrl($_GET['size']));
		exit();
	}
	elseif (isset($_GET['infos']))
	{
		include ("./.AJAX-B/AJAX-Infos.php");
		exit();
	}
	elseif (isset($_GET['email']) )
	{
		if ((isset($_POST['adress']) || isset($_POST['message'])) && $GLOBALS['AJAX-Var']["MAIL"])
			SendMail();
		else EMail();
		exit();
	}
	elseif (isset($_GET['account']) || isset($_GET['usrconf']))
	{
		include ("./.AJAX-B/AJAX-Account.php");
		exit();
	}
	elseif (isset($_GET['setting']))
	{
		if ($_SESSION['level']==4)
			include ("./.AJAX-B/AJAX-Setting.php");
		exit();
	}
	elseif (isset($_GET['apropos']))
	{
		include ("./.AJAX-B/AJAX-APropos.php");
		exit();
	}
	elseif (isset($_GET['open']))
	{
		header("Content-type: image");
		readfile(realpath(urldecode($_GET['open'])));
		exit();
	}
	elseif (isset($_GET['edit']))
	{
		if ($_SESSION['level']>=3 && $GLOBALS['AJAX-Var']["EDIT"])
		{
			if (isset($_GET['bulk']))
			{
				include ("./.AJAX-B/CodePress/codepress.php");
			}
			elseif (isset($_POST['save']))
			{
				WriteInFile ($_GET['edit'].date( ' - H:i:s', time() ), urldecode($_POST['save']), "remplace");
				echo date( 'd/m/y - H:i:s', time() );
//				echo "SAVE is Under devellopement";
			}
			else Edit($_GET['edit']);
		}
		exit();
	}
	elseif (isset($_GET['new']))
	{
		if ($_SESSION['level']>=2 && $GLOBALS['AJAX-Var']["NEW"])
		{
			if (substr($_GET['new'], -1, 1)=='/')
			{
				if ($new=mkdirs($_GET['new']))
					echo "Creation de $new réuci.";
				else echo "Impossible de creer ce dossier verifier les droits d'ecriture.";
			}
			else MakeFile($_GET['new']);
		}
		exit();
	}
	elseif (isset($_GET['ren']))
	{
		if ($_SESSION['level']>=3 && $GLOBALS['AJAX-Var']["REN"])
		{
			$Selected = explode("\n", $_POST['ToRename']);
			foreach ($Selected as $file)
				if (is_dir($file)) MultiRen(DirSort ($file, 'all', $file), $_GET['ren']); // isset($_GET['match']) ? explode(',',$_GET['match']) : 'all'
				else MultiRen(array($file), $_GET['ren']);
		}
		exit();
	}
	elseif (isset($_GET['RenOld']))
	{
		if ($_SESSION['level']>=3 && $GLOBALS['AJAX-Var']["REN"])
			rename($_GET['RenOld'], NewFile(dirname($_GET['RenOld'])."/".$_GET['RenNew']));
		exit();
	}
	elseif (isset($_GET['move']))
	{
		if ($_SESSION['level']>=3 && $GLOBALS['AJAX-Var']["MOVE"])
		{
			$Selected = explode("\n", $_POST['ToMove']);
			foreach ($Selected as $file)
				rename($file, NewFile($_GET['move'].basename($file), ($_SESSION['level']>2?true:false)));
		}
		exit();
	}
	elseif (isset($_GET['copy']))
	{
		if ($_SESSION['level']>=2 && $GLOBALS['AJAX-Var']["COPY"])
		{
			$Selected = explode("\n", $_POST['ToCopy']);
			foreach ($Selected as $file)
				Copie($file, $_GET['copy']);
		}
		exit();
	}
	elseif (isset($_GET['erase']))
	{
		if ($_SESSION['level']>=3 && $GLOBALS['AJAX-Var']["DEL"])
		{
			$Selected = explode("\n", $_POST['ToErase']);
			foreach ($Selected as $Element)
				SupFile($Element);
		}
		exit();
	}
	elseif (isset($_GET['upload']))
	{
		if ($_SESSION['level']>1 && $GLOBALS['AJAX-Var']["UPLOAD"])
			ManageUpload($_GET['upload']);
		exit();
	}
	elseif (isset($_GET['update']))
	{
		if ($_SESSION['level']==4)
			echo MAJ();
		exit();
	}
	elseif (isset($_GET['download']))
	{
		if ((count(($Downlod_List=explode('%;',$_GET['download'])))>1 || is_dir($_GET['download'])) && $GLOBALS['AJAX-Var']["DOWNLOAD"])
		{
			ini_set("memory_limit", "256M");
			require ("./.AJAX-B/PHP-Archiver.php");
			switch($_GET['format'])
			{
				case 'zip':
					$Download = new zip_file("Downloaded@".$_SERVER['SERVER_NAME'].".zip");
					break;
				case 'tar':
					ini_set("memory_limit", "512M");
					$Download = new tar_file("Downloaded@".$_SERVER['SERVER_NAME'].".tar");
					break;
				case 'gzip':
					$Download = new gzip_file("Downloaded@".$_SERVER['SERVER_NAME'].".tar.gz");
					break;
				case 'bzip2':
					$Download = new bzip_file("Downloaded@".$_SERVER['SERVER_NAME'].".tar.bz");
					break;
			}
			$Download -> set_options(array('inmemory' => 1, 'prepend' => 'Downloaded@'.$_SERVER['SERVER_NAME']));
			$Download -> add_files($Downlod_List);
			$Download -> create_archive();
			if (count($test->errors) > 0)
			{
				echo "<html><body><pre>";
				print_r ($test->errors); // Process errors here
				echo "</pre></body></html>";
			}
			else $Download -> download_file();
		}
		elseif (is_file($_GET['download']) && $GLOBALS['AJAX-Var']["DOWNLOAD"])
		{
			header('Content-Type: application/force-download');
			header("Content-Disposition: attachment;filename=".basename($_GET['download'])."\n");// force le telechargement
			readfile($_GET['download']);
		}
		exit();
	}

	if (!isset($_GET['mode']) || ($_GET['mode']!="arborescence" && $_GET['mode']!="gallerie"))
	{
		$mode = ($_SESSION['mode']=="arborescence" || $_SESSION['mode']=="gallerie") ? $_SESSION['def-mode'] : 'arborescence';
		header("Location:?mode=".$mode.($_SERVER['QUERY_STRING'] ? "&".$_SERVER['QUERY_STRING'] : ""));
		exit ();
	}
	elseif (!isset($_GET['racine']) || !is_dir($_GET['racine']))
	{
		header("Location:?".$_SERVER['QUERY_STRING']."&racine=".(is_dir($_SESSION['def-racine']) ? $_SESSION['def-racine'] : "./"));
		exit ();
	}

	$racine = UrlSimplied($_GET['racine']);

	if ($_SESSION['level']<4 && is_dir($_SESSION['def-racine']) && strpos($racine, $_SESSION['def-racine'])===false)
	{
		$Other_GET = str_replace("racine=".$_GET['racine']."&", "", str_replace("&racine=".$_GET['racine'], "", $_SERVER['QUERY_STRING']));
		header("Location:?".$Other_GET."&racine=".$_SESSION['def-racine']);
		exit ();
	}
?>