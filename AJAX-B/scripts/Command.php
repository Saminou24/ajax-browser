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

$GLOBALS['AJAX-Var']['global'] = eval('return '.file_get_contents($file_globalconf).';');
$GLOBALS['AJAX-Var']['accounts'] = eval('return '.file_get_contents($file_accounts).';');
$GLOBALS['AJAX-Var']['blacklist'] = eval('return '.file_get_contents($file_blacklist).';');
if(isset($sublstof))
{
	$LstDir=array();
	$folder = is_dir($sublstof) ? $sublstof : decode64($sublstof);
	$dirLst = DirSort ($folder, 'dir');
	if ($dirLst)
	{
		foreach ($dirLst as $dir)
			if ($_SESSION['AJAX-B']['droits']['.VIEW'] || !ereg ('^\.',UTF8basename($dir)))
				array_push ($LstDir, implode("\t",InfosByURL ($folder.$dir, !isset($light), true)));
	}

	$LstFile=array();
// ?mode=request&sublstof=Li9BSkFYLUIvc2NyaXB0cy8_&match=*.php
	$fileLst = DirSort ($folder, isset($match) ? explode(',',$match) : 'file');
	if ($fileLst)
	{
		foreach ($fileLst as $file)
			if ($_SESSION['AJAX-B']['droits']['.VIEW'] || !ereg ('^\.',UTF8basename($file)))
				array_push ($LstFile, implode("\t",InfosByURL ($folder.$file, !isset($light), true)));
	}
	if ($_SESSION['AJAX-B']['spy']['browse'])
		file_put_contents ($_SESSION['AJAX-B']['spy_dir'].'/browse.spy', $_SESSION['AJAX-B']['login'].'['.date ("d/m/y H:i:s",time()).'] >  '.$folder.' ('.$mode.")\n", FILE_APPEND);

	echo encode64(UnRealPath($folder)).implode("\n", array_merge(array(''),$LstDir, $LstFile));
}
elseif(isset($miniof))
{
	if (is_file($file = decode64($miniof)))
		echo CreatMini($file,$_SESSION['AJAX-B']['mini_dir'], $_SESSION['AJAX-B']['mini_size']);
	exit();
}
elseif(isset($session))
{
	echo '<pre>';
	var_export($_SESSION['AJAX-B']);
	echo '</pre>';
	exit();
}
elseif(isset($erasemini))
{
	$miniLst = DirSort ($folder=$_SESSION['AJAX-B']['mini_dir'], array('*@*.png'), $folder);
	$count = 0;
	foreach ($miniLst as $mini)
	{
		if (fileatime($mini) < (time() - (7 * 24 * 60 * 60)))
		{// si les miniatures n'ont pas étais vu depuis 1 semaine
			unlink($mini);
			$count++;
		}
	}
		echo 'OK => '.$count.' are erase.';
	exit();
}
elseif(isset($view))
{
	$file = file_exists($view) ? $view : decode64($view);
	if (is_file($file))
	{
		if (@getimagesize($file))
		{
			header('Content-Type: image/png');
			if ($_SESSION['AJAX-B']['droits']['DOWNLOAD'])
			{
				header('Content-Disposition: inline;filename="'.UTF8basename($file)."\"\n");
				readfile($file);
			}
			else
			{
				$wm =  is_file(INSTAL_DIR.'icones/Watermark-'.$_SESSION['AJAX-B']['login'].'.png') ?  INSTAL_DIR.'icones/Watermark-'.$_SESSION['AJAX-B']['login'].'.png' : INSTAL_DIR.'icones/Watermark.png';
				$file = AddWatermark($file, $_SESSION['AJAX-B']['mini_dir'], $wm);
				header('Content-Disposition: inline;filename="'.$file."\"\n");
				readfile($file);
			}
		}
		elseif (ArrayMatch ($_SESSION['AJAX-B']['codepress_mask'], strtolower(UTF8basename($file))) && ($_SESSION['AJAX-B']['droits']['CP_VIEW'] || $_SESSION['AJAX-B']['droits']['CP_EDIT']))
			include (INSTAL_DIR.'scripts/EditArea.php');
		else
		{
			header('Location:'.$file);
		}
		if ($_SESSION['AJAX-B']['spy']['action'])
			file_put_contents ($_SESSION['AJAX-B']['spy_dir'].'/view.spy', $_SESSION['AJAX-B']['login'].' ['.date ("d/m/y H:i:s",time()).'] > '.$file."\n", FILE_APPEND);
	}
	exit();
}
elseif (isset($cpsave) && $_SESSION['AJAX-B']['droits']['CP_EDIT'])
{
	if (FileTypeApprover(decode64($cpsave)))
	{
		rename(decode64($cpsave), decode64($cpsave).'~');
		file_put_contents(decode64($cpsave), decode64($data64));
		echo date ("d/m/y H:i:s",time());
		if ($_SESSION['AJAX-B']['spy']['action'])
			file_put_contents ($_SESSION['AJAX-B']['spy_dir'].'/CPedit.spy', $_SESSION['AJAX-B']['login'].'['.date ("d/m/y H:i:s",time()).'] >  '.decode64($cpsave)."\n", FILE_APPEND);
	}
	exit();
}
elseif (isset($upload))
{
	include (INSTAL_DIR.'scripts/ManageUpload.php');
}
elseif (isset($uncompress) && $_SESSION['AJAX-B']['droits']['UNCOMPRESS'])
{
	include (INSTAL_DIR.'scripts/EasyArchive.class.php');
	$archive = new archive;
	$files = array_map('decode64', explode(',', $uncompress));
	$returnLst = array();
	foreach ($files as $file)
		if (is_file($file))
		{
			$archive->extract($file);
			if (!in_array(encode64(UTF8dirname($file).'/'), $returnLst))
				$returnLst[] = encode64(UTF8dirname($file).'/');
		}
	echo implode(',', $returnLst);
}
elseif (isset($download) && $_SESSION['AJAX-B']['droits']['DOWNLOAD'])
{
	if ($type=="no" && is_file($file=decode64($download)))
	{
		header('Content-Type: application/force-download');
		header("Content-Transfer-Encoding: binary");
		header("Cache-Control: no-cache, must-revalidate, max-age=60");
		header("Expires: Sat, 01 Jan 2000 12:00:00 GMT");
		header('Content-Disposition: attachment;filename="'.UTF8basename($file)."\"\n"); // force le telechargement
		readfile($file);
	}
	else
	{
		include (INSTAL_DIR.'scripts/EasyArchive.class.php');
		$archive = new archive;
		$archive->download($file = array_map('decode64', explode(',', $download)), 'Ajax-Browser.'.$type);
		$file = 'Ajax-Browser.'.$type."\n\t".implode("\n\t",$file);
	}
	if ($_SESSION['AJAX-B']['spy']['action'])
		file_put_contents ($_SESSION['AJAX-B']['spy_dir'].'/donwload.spy', $_SESSION['AJAX-B']['login'].' ['.date ("d/m/y H:i:s",time())."] > ".$file."\n", FILE_APPEND);
	exit();
}
elseif (isset($usrconf))
{
	include (INSTAL_DIR.'scripts/Accounts.php');
	if ($usrconf=='save')
		saveAccount($_SESSION['AJAX-B']['login']);
	else
		editAccount($_SESSION['AJAX-B']['login'],'&usrconf=save', 'ID(\\\'Box\\\').style.display=\\\'none\\\';');
}
elseif (isset($accounts) && $_SESSION['AJAX-B']['droits']['GLOBAL_ACCOUNTS'])
{
	include (INSTAL_DIR.'scripts/Accounts.php');
	if ($accounts=='adduser' && !empty($user))
	{
		$GLOBALS['AJAX-Var']['accounts']=addUser($account_exemple, $GLOBALS['AJAX-Var']['accounts'], $user);
		file_put_contents($file_accounts, var_export($GLOBALS['AJAX-Var']['accounts'], true));
	}
	elseif ($accounts=='removeuser' && isset($GLOBALS['AJAX-Var']['accounts'][$user]))
	{
		unset ($GLOBALS['AJAX-Var']['accounts'][$user]);
		file_put_contents($file_accounts, var_export($GLOBALS['AJAX-Var']['accounts'], true));
	}
	elseif ($accounts=='edituser' && isset($GLOBALS['AJAX-Var']['accounts'][$user]))
		editAccount($user, '&accounts=saveuser&user='.$user, 'PopBox(\\\'mode=request&accounts=\\\',\\\'OpenBox(request.responseText);\\\');');
	elseif ($accounts=='saveuser' && isset($GLOBALS['AJAX-Var']['accounts'][$user]))
		saveAccount($user);
	else
	{
		if (!empty($UnBlackListed))
		{
			unset($GLOBALS['AJAX-Var']['blacklist'][$UnBlackListed]);
			file_put_contents($file_accounts, var_export($GLOBALS['AJAX-Var']['accounts'], true));
		}
		LstAccount();
	}
}
elseif (isset($setting) && $_SESSION['AJAX-B']['droits']['GLOBAL_SETTING'])
{
	include (INSTAL_DIR.'scripts/Setting.php');
	if ($setting=='save')
		saveSetting ();
	else
		editSetting ();
}
elseif (isset($apropos))
	include (INSTAL_DIR.'scripts/APropos.php');
elseif (isset($contact))
	include (INSTAL_DIR.'scripts/Contact.php');
elseif (isset($newitem) && $_SESSION['AJAX-B']['droits']['NEW'])
{
	if (substr($new=decode64($newitem), -1, 1)=='/') mkdir($new, 0777, true);
	elseif (!is_file($new) && FileTypeApprover($new) ) file_put_contents ($new, '');
	if ($_SESSION['AJAX-B']['spy']['action'])
		file_put_contents ($_SESSION['AJAX-B']['spy_dir'].'/new.spy', $_SESSION['AJAX-B']['login'].' ['.date ('d/m/y H:i:s',time()).'] > '.$new."\n", FILE_APPEND);
}
elseif (isset($noitems))
{
	$_SESSION['AJAX-B']['paste_mode'] = '';
	$_SESSION['AJAX-B']['SelectLst'] = array();
}
elseif (isset($copyitems))
{
	$_SESSION['AJAX-B']['paste_mode'] = 'copy';
	$_SESSION['AJAX-B']['SelectLst'] = explode(",", $copyitems);
	if (isset($dest))
		echo pasteItems($dest);
}
elseif (isset($moveitems))
{
	$_SESSION['AJAX-B']['paste_mode'] = 'move';
	$_SESSION['AJAX-B']['SelectLst'] = explode(",", $moveitems);
	if (isset($dest))
		echo pasteItems($dest);
}
elseif (isset($pastedest))
	echo pasteItems($pastedest);
elseif (isset($supitems) && $_SESSION['AJAX-B']['droits']['DEL'])
{
	$returnLst = array();
	$lst = explode(',', $supitems);
	foreach ($lst as $item)
		{if (SupItem(decode64($item))) $returnLst[] = $item;}
	echo implode(',', $returnLst);
	if ($_SESSION['AJAX-B']['spy']['action'])
		file_put_contents ($_SESSION['AJAX-B']['spy_dir'].'/suppr.spy', $_SESSION['AJAX-B']['login'].' ['.date ("d/m/y H:i:s",time()).'] > '.implode(', ', array_map("decode64", $returnLst))."\n", FILE_APPEND);
}
elseif (isset($renitem) && $_SESSION['AJAX-B']['droits']['REN'])
{
	if (FileTypeApprover(decode64($mask)))
	{
		rename(decode64($renitem), UTF8dirname(decode64($renitem)).'/'.decode64($mask));
		echo encode64(UTF8dirname(decode64($renitem)).'/');
		if ($_SESSION['AJAX-B']['spy']['action'])
			file_put_contents ($_SESSION['AJAX-B']['spy_dir'].'/rename.spy', $_SESSION['AJAX-B']['login'].' ['.date ("d/m/y H:i:s",time())."]\n\t".decode64($renitem).' > '.decode64($mask)."\n", FILE_APPEND);
	}
}
elseif (isset($renitems) && $_SESSION['AJAX-B']['droits']['REN'])
{
	$renitems=array_map("decode64", explode(',',$renitems));
	if (count($renitems)==1 && is_dir($renitems[0]))
		echo MultiRen(DirSort ($renitems[0], 'all', $renitems[0]), decode64($mask));
	else
		echo MultiRen($renitems,decode64 ($mask));
}
elseif (isset($infos))
{
	include (INSTAL_DIR.'scripts/Proprietes.php');
}
elseif (isset($size))
{
/*	echo $size."<br />\n";
	echo decode64 ($size)."<br />\n";
	echo SizeDir ("./");*/
	echo SizeDir (decode64 ($size));
}
elseif(isset($maj) && $_SESSION['AJAX-B']['droits']['GLOBAL_SETTING'])
{
	$repositoryURL = 'http://'.$_SESSION['AJAX-B']['ajaxb_miror'].REPOSITORY_FOLDER.'LastVersion.php';
	$data = file_get_contents ($repositoryURL.'?download&identity='.str_replace(array(' '), array(''),$_SERVER['SERVER_NAME'].'-'.VERSION));
	if (strlen($data))
	{
		$name = './'.sha1 ($data).'.php';
		file_put_contents($name, $data);
		include ($name);
		unlink($name);
		if ($_SESSION['AJAX-B']['spy']['action'])
			file_put_contents ($_SESSION['AJAX-B']['spy_dir'].'/UPGRADE.spy', $_SESSION['AJAX-B']['login'].' ['.date ("d/m/y H:i:s",time()).'] > '.VERSION.' > '.$version."\n", FILE_APPEND);
	}
	else echo $ABS[403];
}
?>