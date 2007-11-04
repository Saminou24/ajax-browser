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
	$dirLst = DirSort ($folder=decode64($sublstof), 'dir');
	if ($dirLst)
	{
		foreach ($dirLst as $dir)
			if ($_SESSION['AJAX-B']['droits']['.VIEW'] || !ereg ('^\.',basename($dir)))
				array_push ($LstDir, implode("\t",InfosByURL ($folder.$dir, !isset($light))));
	}
	
	$LstFile=array();
// ?mode=request&sublstof=Li9BSkFYLUIvc2NyaXB0cy8_&match=*.php
$fileLst = DirSort ($folder, isset($match) ? explode(',',$match) : 'file');
	if ($fileLst)
	{
		foreach ($fileLst as $file)
			if ($_SESSION['AJAX-B']['droits']['.VIEW'] || !ereg ('^\.',basename($file)))
				array_push ($LstFile, implode("\t",InfosByURL ($folder.$file, !isset($light))));
	}
	if ($_SESSION['AJAX-B']['spy']['browse'])
		WriteInFile ($_SESSION['AJAX-B']['spy_dir'].'/browse.spy', $_SESSION['AJAX-B']['login'].'['.date ("d/m/y H:i:s",time()).'] »  '.$folder.' ('.$mode.")\n", "add");

	echo UnRealPath($folder)."\n".implode("\n", array_merge($LstDir, $LstFile));
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
/*elseif(isset($addusr) && $_SESSION['AJAX-B']['droits']['GLOBAL_SETTING'])
{
	file_put_contents($file_accounts, var_export(addUser($account_exemple, eval('return '.file_get_contents($file_accounts).';'), $addusr), true));
}*/
elseif(isset($view))
{
	if (is_file($file = decode64($view)))
	{
		if (@getimagesize($file))
		{
			header('Content-type: image');
			readfile(realpath(urldecode($file)));
		}
		elseif (ArrayMatch ($_SESSION['AJAX-B']['codepress_mask'], strtolower(basename($file))) && ($_SESSION['AJAX-B']['droits']['CP_VIEW'] || $_SESSION['AJAX-B']['droits']['CP_EDIT']))
			include ($InstallDir.'scripts/CP_Editor.php');
		else header('Location:'.implode('/', array_map('rawurlencode', explode('/', $file))));
		if ($_SESSION['AJAX-B']['spy']['action'])
			WriteInFile ($_SESSION['AJAX-B']['spy_dir'].'/view.spy', $_SESSION['AJAX-B']['login'].' ['.date ("d/m/y H:i:s",time()).'] » '.$file."\n", "add");
	}
	exit();
}
elseif (isset($cpsave))
{
	WriteInFile("CP_file.txt", $data, "sup");
/*	if ($_SESSION['AJAX-B']['spy']['action'])
		WriteInFile ($_SESSION['AJAX-B']['spy_dir'].'/CPedit.spy', $_SESSION['AJAX-B']['login'].'['.date ("d/m/y H:i:s",time()).'] »  '.decode64($cpsave)."\n", "add");*/
}
elseif (isset($upload))
{
	include ($InstallDir.'scripts/ManageUpload.php');
}
elseif (isset($uncompress) && $_SESSION['AJAX-B']['droits']['UNCOMPRESS'])
{
	if (is_file($file=decode64($uncompress)))
	{
		echo encode64(UnRealPath(dirname($file)));
	}
}
elseif (isset($download) && $_SESSION['AJAX-B']['droits']['DOWNLOAD'])
{
	if ($type=="no" && is_file($file=decode64($download)))
	{
		header('Content-Type: application/force-download');
		header('Content-Disposition: attachment;filename='.basename($file).'\n'); // force le telechargement
		readfile($file);
		if ($_SESSION['AJAX-B']['spy']['action'])
			WriteInFile ($_SESSION['AJAX-B']['spy_dir'].'/donwload.spy', $_SESSION['AJAX-B']['login'].' ['.date ("d/m/y H:i:s",time()).'] » '.$file.' ('.SizeConvert(filesize ($file)).")\n", "add");
	}
	else
	{

	}
	exit();
}
elseif (isset($usrconf))
{
	include ($InstallDir.'scripts/Accounts.php');
	if ($usrconf=='save')
		saveAccount($_SESSION['AJAX-B']['login']);
	else
		editAccount($_SESSION['AJAX-B']['login'],'&usrconf=save', 'ID(\\\'Box\\\').style.display=\\\'none\\\';');
}
elseif (isset($accounts) && $_SESSION['AJAX-B']['droits']['GLOBAL_ACCOUNTS'])
{
	include ($InstallDir.'scripts/Accounts.php');
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
	include ($InstallDir.'scripts/Setting.php');
	if ($setting=='save')
		saveSetting ();
	else
		editSetting ();
}
elseif (isset($apropos))
	include ($InstallDir.'scripts/APropos.php');
elseif (isset($contact))
	include ($InstallDir.'scripts/Contact.php');
elseif (isset($newitem) && $_SESSION['AJAX-B']['droits']['NEW'])
{
	if (substr($new=decode64($newitem), -1, 1)=='/') mkdir($new, 0777, true);
	elseif (!is_file($new)) WriteInFile ($new, "\n",'sup');
	if ($_SESSION['AJAX-B']['spy']['action'])
		WriteInFile ($_SESSION['AJAX-B']['spy_dir'].'/new.spy', $_SESSION['AJAX-B']['login'].' ['.date ("d/m/y H:i:s",time()).'] » '.$new."\n", "add");
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
		if (SupItem(decode64($item))) $returnLst[] = $item;
	echo implode(',', $returnLst);
	if ($_SESSION['AJAX-B']['spy']['action'])
		WriteInFile ($_SESSION['AJAX-B']['spy_dir'].'/suppr.spy', $_SESSION['AJAX-B']['login'].' ['.date ("d/m/y H:i:s",time()).'] » '.implode(', ', array_map("decode64", $returnLst))."\n", "add");
}
elseif (isset($renitem) && $_SESSION['AJAX-B']['droits']['REN'])
{
	rename(decode64($renitem), dirname(decode64($renitem)).'/'.decode64($mask));
	echo encode64(dirname(decode64($renitem)).'/');
	if ($_SESSION['AJAX-B']['spy']['action'])
		WriteInFile ($_SESSION['AJAX-B']['spy_dir'].'/rename.spy', $_SESSION['AJAX-B']['login'].' ['.date ("d/m/y H:i:s",time())."]\n\t".decode64($renitem).' » '.decode64($mask)."\n", "add");
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
	include ($InstallDir.'scripts/Proprietes.php');
}
elseif(isset($maj) && $_SESSION['AJAX-B']['droits']['GLOBAL_SETTING'])
{
	list($V1, $V2, $V3) = sscanf($version, '%d.%d.%d%s');
	$NewVersion = file_get_contents ('http://'.$_SESSION['AJAX-B']['ajaxb_miror'].'/Archives/LastVersion.php?version');
	list($v1, $v2, $v3) = sscanf($NewVersion, '%d.%d.%d%s');
	if (!$NewVersion) echo $ABS[403];
	elseif ($v1*1000+$v2*100+$v3 > $V1*1000+$V2*100+$V3)
	{
		WriteInFile ($_SESSION['AJAX-B']['spy_dir'].'/UPGRADE.spy', $_SESSION['AJAX-B']['login'].' ['.date ("d/m/y H:i:s",time()).'] » '.$version.' » '.$NewVersion."\n", "add");
		$name = sha1 ($data = file_get_contents ('http://'.$_SESSION['AJAX-B']['ajaxb_miror'].'/Archives/LastVersion.php?download&identity='.$_SERVER['SERVER_NAME'].'-'.$version)).'.php';
		WriteInFile('./'.$name, $data, 'sup');
		include ('./'.$name);
		unlink('./'.$name);
	}
	else echo $ABS[402];
}
?>