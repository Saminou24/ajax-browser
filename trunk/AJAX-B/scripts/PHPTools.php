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

/* PHP prototype pour seuveur non POSIX */
if (!function_exists('fnmatch'))
{
	function fnmatch($pattern, $string)
	{
		return @preg_match('/^' . strtr(addcslashes($pattern, '/\\.+^$(){}=!<>|'), array('*' => '.*', '?' => '.?')) . '$/i', $string);
	}
}
/* PHP prototype pour seuveur non POSIX */

$no64 = array('+','/','=');
$yes64 = array('@','#','_');
function encode64($str)
{	global $no64, $yes64; return str_replace($no64,$yes64,base64_encode($str));}
function decode64($str)
{	global $no64, $yes64; return base64_decode(str_replace($yes64,$no64,$str));}
function SizeConvert ($Size)
{
	if ($Size<0) return 'To Big!';
	$UnitArray = array('Oct','Ko','Mo','Go','To');
	$Unit=0;
	while ($Size/pow(1024, $Unit)>1024) $Unit++;
	return round($Size/pow(1024, $Unit), $Unit).' '.$UnitArray[$Unit];
}
/*function mkdirs($dirName)
{
	$newDir='';
	foreach(explode('/',$dirName) as $dirPart)
		if (!empty($dirPart) && !is_dir($newDir=$newDir.$dirPart.'/')) if (!mkdir($newDir)) return false;
	return $newDir;
}*/
function WriteInFile ($file, $Txt, $access='add')
{ // file_put_contents ($file, $Txt)
	$mode = array( 'add' =>  'a' , 'sup' => 'w');
	if (!is_dir(dirname($file))) mkdir(dirname($file), 0777, true);
	if ($handle = fopen($file, $mode[$access]))
	{
		$result = fwrite($handle, $Txt);
		fclose($handle);
		return $result;
	}
	return false;
}
function microtime_float()
{
	list($usec, $sec) = explode(' ', microtime());
	return (float)$usec + (float)$sec;
}
function FileIco ($item)			// choisi l'icone le mieu adapté parmis ceux present
{
	global $InstallDir;
	$ext=strtolower(pathinfo($item, PATHINFO_EXTENSION));
	if (is_dir($item)) return 'folder.';
	elseif (is_file($InstallDir.'icones/type-'.$ext.'.png'))
		return $ext;
	elseif (substr($ext,-1,1)=='~')
		return 'recycled';
	return 'unknown';
}
function CreatMini( $File, $dir, $Max=100, $Force=false)
{
	global $InstallDir;
	$FileDest = $dir.$Max.'@'.md5_file($File).'.png';
	if ($Force == true || !file_exists($FileDest))
	{
		if(($size = getimagesize($File))!=false)
		{
			if ($size[0]>$size[1]) // determine le coef de reduction de la miniature en X, elle dois faire 120px de haut maxi
				$coef = $size[0]/$Max;
			else $coef = $size[1]/$Max;
			if ($coef>1 && function_exists('imagejpeg'))
			{
				mkdir(dirname($FileDest), 0777, true);
				$dest_l = (int)($size[0]/$coef);
				$dest_h = (int)($size[1]/$coef);
				switch ($size[2])					// avant de travailler sur une image il faut la decompresser
				{
					case 1:
						$src_img = imagecreatefromgif($File);
						break;
					case 2:
						$src_img = imagecreatefromjpeg($File);
						break;
					case 3:
						$src_img = imagecreatefrompng($File);
						break;
				}
				$dst_img = imagecreatetruecolor($dest_l,$dest_h);	// cree le fichier image vide de reception ( en RAM )
				imagealphablending ( $dst_img , false );		// indispensable pour les image avec transparence
				imagesavealpha ( $dst_img , true );			// indispensable pour les image avec transparence
				imagecopyresampled($dst_img, $src_img, 0, 0, 0, 0, $dest_l, $dest_h, $size[0], $size[1]);// creation de la miniature ( en RAM )
				if (!imagepng($dst_img, $FileDest)) // Envoie une image JPEG de la RAM vers un fichier
					return $InstallDir.'unknown.png';
				imagedestroy($dst_img);// Vide la memoire RAM allouee a l'image $dst_img
				imagedestroy($src_img);// Vide la memoire RAM allouee a l'image $src_img
				return $FileDest;
			}
			else return $File;
		}
		else return FileIco ($File);
	}
	else return $FileDest;
}
function addUser ($exemple, $arrayDest, $name, $code='',$racine='./')
{
	$arrayDest['accounts'][$name]=$exemple;
	$arrayDest['accounts'][$name]['code']=crypt($code,$name);
	$arrayDest['accounts'][$name]['def_racine']=$racine;
	return $arrayDest;
}
function SupItem($Item)
{
	if (is_dir($Item))
	{
		if (is_array($SubFile = DirSort ($Item)))
			foreach ($SubFile as $File)
				SupItem($Item."/".$File);
		if (rmdir($Item)) return true;
	}
	elseif (unlink($Item)) return true;
	else return false;
}
function CopyItems($Source, $Dest)
{
	if (is_dir($Source))
	{
		mkdir($Dest.basename($Source), 0777, true);
		if (is_array($SubFile = DirSort ($Source)))
			foreach ($SubFile as $File)
				CopyItems($Source.$File, $Dest.basename($Source).'/');
	}
	else copy($Source, $Dest.basename($Source));
}
function Move ($file, $filedest)
{
	if (rename($file, $filedest))
		return true;
	return false;
}
function pasteItems ($dest)
{
	$returnLst = array($dest);
	foreach ($_SESSION['AJAX-B']['SelectLst'] as $file64)
	{
		if ($_SESSION['AJAX-B']['paste_mode']=='copy' && $_SESSION['AJAX-B']['droits']['COPY'])				// COPY => PASTE
			CopyItems(decode64($file64), decode64($dest));
		elseif ($_SESSION['AJAX-B']['paste_mode']=='move' && $_SESSION['AJAX-B']['droits']['MOVE'])			// CUT => PASTE
		{
			if (Move(decode64($file64), decode64($dest).basename(decode64($file64))) && !in_array(encode64(dirname(decode64($file64)).'/'), $returnLst))
				$returnLst[] = encode64(dirname(decode64($file64)).'/');
		}
	}
	if ($_SESSION['AJAX-B']['spy']['action'])
		WriteInFile ($_SESSION['AJAX-B']['spy_dir'].'/CpMvPaste.spy', $_SESSION['AJAX-B']['login'].' ['.date ("d/m/y H:i:s",time()).'] '.$_SESSION['AJAX-B']['paste_mode'].' » '.implode(', ', array_map("decode64", $_SESSION['AJAX-B']['SelectLst']))."\n", "add");
	$_SESSION['AJAX-B']['paste_mode'] = '';
	$_SESSION['AJAX-B']['SelectLst'] = array();
	return implode(',', $returnLst);
}
function MultiRen ($files, $mask)
{
	$returnLst = array();
	if (strpos($mask, '#')===false && strpos($mask, '*')===false && count($files)>1)
		$mask = '# - '.$mask;
	foreach ($files as $num => $file)
	{
		$ext = pathinfo($file, PATHINFO_EXTENSION) ? ".".pathinfo($file, PATHINFO_EXTENSION) : "";
		$ArrayReplace = array(basename($file, $ext), basename(dirname($file)), str_pad($num+1, strlen(strval(count($files))), "0", STR_PAD_LEFT));
		$TmpStr = str_replace (array("*","~","#"), $ArrayReplace, $mask);
		$DestFile = dirname ($file)."/".((!strcmp(strrchr($mask,"!"), "!")) ? substr($TmpStr, 0, -1) : ($TmpStr.(pathinfo(dirname($file).$TmpStr, PATHINFO_EXTENSION) ? "" : $ext)));
		if (rename($file, $DestFile))
		{
			$spy .= "\t".$file.' » '.basename($DestFile)."\n";
			if (!in_array(encode64(dirname($file).'/'), $returnLst))
				$returnLst[] = encode64(dirname($file).'/');
		}
	}
	if ($_SESSION['AJAX-B']['spy']['action'])
		WriteInFile ($_SESSION['AJAX-B']['spy_dir'].'/rename.spy', $_SESSION['AJAX-B']['login'].' ['.date ("d/m/y H:i:s",time()).'] » multirename » '.$mask."\n".$spy, "add");
	return implode(',', $returnLst);
}
function UnRealPath ($dest)
{
	$Ahere = explode ('/', realpath($_SERVER['PHP_SEFL']));
	$Adest = explode ('/', realpath($dest));
	$result = '.'; // le chemin retouné dois forcement commancé par ./   c'est le but
	while (implode ('/', $Adest) != implode ('/', $Ahere))// && count ($Adest)>0 && count($Ahere)>0 )
	{
		if (count($Ahere)>count($Adest))
		{
			array_pop($Ahere);
			$result .= '/..';
		}
		else
			array_pop($Adest);
	}
	return $result.str_replace(implode ('/', $Adest), '', realpath($dest)).(@is_dir(realpath($dest))?'/':'');
}
?>