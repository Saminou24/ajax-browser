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

/* PHP prototype */
if (!function_exists('fnmatch'))
{
	function fnmatch($pattern, $string)
	{
		return @preg_match('/^' . strtr(addcslashes($pattern, '/\\.+^$(){}=!<>|'), array('*' => '.*', '?' => '.?')) . '$/i', $string);
	}
}
if (!function_exists('file_put_contents'))
{
	function file_put_contents($n, $d, $flag = false)
	{
		$mode = ($flag == FILE_APPEND || strtoupper($flag) == 'FILE_APPEND') ? 'a' : 'w';
		if ($f = fopen($n, $mode))
		{
			if (is_array($d)) $d = implode($d);
			$bytes_written = fwrite($f, $d);
			fclose($f);
			return $bytes_written;
		}
	}
}
function FileTypeApprover($Name)
{
	$UPLOAD = $_SESSION['AJAX-B']['droits']['UPLOAD'];
	if ((ArrayMatch($_SESSION['AJAX-B']['always_mask'],$Name ) && $UPLOAD=='OnlyAlways') || (!ArrayMatch($_SESSION['AJAX-B']['restrict_mask'], $Name) && $UPLOAD=='ExceptRestrict') ||  $UPLOAD=='ALL')
		return true;
	return false;
}
function UTF8basename($str)
{// for UTF-8 compatible
	$name='';
	$str = explode('/', $str);
	while ($name=='') $name=array_pop($str);
	return $name;
}
function UTF8dirname($str)
{// for UTF-8 compatible
	$name='';
	$str = explode('/', $str);
	while ($name=='') $name=array_pop($str);
	return implode('/', $str);
}
/* PHP prototype */

$no64 = array('+','/','=');
$yes64 = array('@','^','~');
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
function microtime_float()
{
	list($usec, $sec) = explode(' ', microtime());
	return (float)$usec + (float)$sec;
}
function FileIco ($item)			// choisi l'icone le mieu adapté parmis ceux present
{
// 	global INSTAL_DIR;
	$ext=strtolower(pathinfo($item, PATHINFO_EXTENSION));
	if (is_dir($item)) return 'folder.';
	elseif (is_file(INSTAL_DIR.'icones/type-'.$ext.'.png'))
		return $ext;
	elseif (substr($ext,-1,1)=='~')
		return 'recycled';
	return 'unknown';
}
function AddWatermark($src, $dir, $wmk)
{
	$FileDest = $dir.'Watermark-'.$_SESSION['AJAX-B']['login'].'@'.md5_file($src).md5_file($wmk).'.jpg';
	if (file_exists($FileDest))
		return $FileDest;
	elseif (!is_dir(UTF8dirname($FileDest)))
		mkdir(UTF8dirname($FileDest), 0777, true);
	if(($src_size = getimagesize($src))!=false && ($wmk_size = getimagesize($wmk))!=false)
	{
		if (function_exists('imagecopyresampled'))
		{
			$wmk_img = imagecreatefrompng($wmk);
			imagealphablending ( $wmk_img , true );
			imagesavealpha ( $wmk_img , true );

			switch ($src_size[2])
			{
				case 1:
					$dest_img = imagecreatefromgif($src);
					break;
				case 2:
					$dest_img = imagecreatefromjpeg($src);
					break;
				case 3:
					$dest_img = imagecreatefrompng($src);
					break;
			}
			imagealphablending ( $dest_img , true );
			imagesavealpha ( $dest_img , true );

			$coef = (imagesx($dest_img)/imagesx($wmk_img) > imagesy($dest_img)/imagesy($wmk_img)) ? imagesy($dest_img)/imagesy($wmk_img) : imagesx($dest_img)/imagesx($wmk_img);
			$src_w = imagesx($wmk_img);
			$src_h = imagesy($wmk_img);
			$dst_w = (int)($coef*$src_w);
			$dst_h = (int)($coef*$src_h);
			$dst_x = (imagesx($dest_img)-$dst_w)/2;
			$dst_y = (imagesy($dest_img)-$dst_h)/2;
			imagecopyresampled($dest_img, $wmk_img, $dst_x, $dst_y, 0, 0, $dst_w, $dst_h, $src_w, $src_h);

// 			imagepng($dest_img, $FileDest); // Envoie une image JPEG de la RAM vers un fichier
			imagejpeg($dest_img, $FileDest); // Envoie une image JPEG de la RAM vers un fichier
			imagedestroy($dest_img);// Vide la memoire RAM allouee a l'image $dest_img
			imagedestroy($wmk_img);// Vide la memoire RAM allouee a l'image $dst_img
			if (!is_file($FileDest))
				return FileIco ($src);
			else return $FileDest;
		}
		else return $src;
	}
	else return FileIco ($src);
}
function CreatMini( $File, $dir, $Max=100, $Force=false)
{
// 	global INSTAL_DIR;
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
				if (!is_dir(UTF8dirname($FileDest))) mkdir(UTF8dirname($FileDest), 0777, true);
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
				imagepng($dst_img, $FileDest); // Envoie une image JPEG de la RAM vers un fichier
				imagedestroy($dst_img);// Vide la memoire RAM allouee a l'image $dst_img
				imagedestroy($src_img);// Vide la memoire RAM allouee a l'image $src_img
				if (!is_file($FileDest))
					return FileIco ($File);
				else return $FileDest;
			}
			else return $File;
		}
		else return FileIco ($File);
	}
	else return $FileDest;
}
function addUser ($exemple, $arrayDest, $name, $code='',$racine='./')
{
	$arrayDest[$name]=$exemple;
	$arrayDest[$name]['code']=crypt($code,$name);
	$arrayDest[$name]['def_racine']=$racine;
	return $arrayDest;
}
function SupItem($Item)
{
	@mkdir ('./.ajaxb-trash/');
	if (is_dir($Item))
	{
		if (is_array($SubFile = DirSort ($Item)))
			foreach ($SubFile as $File)
				SupItem($Item."/".$File);
		return (!rmdir($Item)) ? rename($Item, './.ajaxb-trash/'.UTF8basename($Item).'@'.date ("d-m-y H.i.s",time())) : true;
	}
	else return (!unlink($Item)) ? rename($Item, './.ajaxb-trash/'.UTF8basename($Item).'@'.date ("d-m-y H.i.s",time())) : true;
}
function CopyItems($Source, $Dest)
{
	if (is_dir($Source))
	{
		mkdir($Dest.UTF8basename($Source), 0777, true);
		if (is_array($SubFile = DirSort ($Source)))
			foreach ($SubFile as $File)
				CopyItems($Source.$File, $Dest.UTF8basename($Source).'/');
	}
	else copy($Source, $Dest.UTF8basename($Source));
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
		{
			CopyItems(decode64($file64), decode64($dest));
		}
		elseif ($_SESSION['AJAX-B']['paste_mode']=='move' && $_SESSION['AJAX-B']['droits']['MOVE'])			// CUT => PASTE
		{
			if (Move(decode64($file64), decode64($dest).UTF8basename(decode64($file64))) && !in_array(encode64(UTF8dirname(decode64($file64)).'/'), $returnLst))
				$returnLst[] = encode64(UTF8dirname(decode64($file64)).'/');
		}
	}
	if ($_SESSION['AJAX-B']['spy']['action'])
		file_put_contents ($_SESSION['AJAX-B']['spy_dir'].'/CpMvPaste.spy', $_SESSION['AJAX-B']['login'].' ['.date ("d/m/y H:i:s",time()).'] '.$_SESSION['AJAX-B']['paste_mode'].' > '.implode(', ', array_map("decode64", $_SESSION['AJAX-B']['SelectLst']))."\n", FILE_APPEND);
	if ($_SESSION['AJAX-B']['paste_mode']=='move')
	{
		$_SESSION['AJAX-B']['paste_mode'] = '';
		$_SESSION['AJAX-B']['SelectLst'] = array();
	}
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
		$ArrayReplace = array(UTF8basename($file, $ext), UTF8basename(UTF8dirname($file)), str_pad($num+1, strlen(strval(count($files))), "0", STR_PAD_LEFT));
		$TmpStr = str_replace (array("*","~","#"), $ArrayReplace, $mask);
		$DestFile = UTF8dirname ($file)."/".((!strcmp(strrchr($mask,"!"), "!")) ? substr($TmpStr, 0, -1) : ($TmpStr.(pathinfo(UTF8dirname($file).$TmpStr, PATHINFO_EXTENSION) ? "" : $ext)));
		if (FileTypeApprover($DestFile))
		{
			if (rename($file, $DestFile))
			{
				$spy .= "\t".$file.' > '.UTF8basename($DestFile)."\n";
				if (!in_array(encode64(UTF8dirname($file).'/'), $returnLst))
					$returnLst[] = encode64(UTF8dirname($file).'/');
			}
		}
	}
	if ($_SESSION['AJAX-B']['spy']['action'])
		file_put_contents ($_SESSION['AJAX-B']['spy_dir'].'/rename.spy', $_SESSION['AJAX-B']['login'].' ['.date ("d/m/y H:i:s",time()).'] > multirename > '.$mask."\n".$spy, FILE_APPEND);
	return implode(',', $returnLst);
}
function UnRealPath ($dest)
{
	$Ahere = explode ('/', getcwd());
	$Adest = explode ('/', realpath($dest));
	$result = '.'; // le chemin retouné dois forcement commancé par ./   c'est le but!
	while (implode ('/', $Adest) != implode ('/', $Ahere))
	{
		if (count($Ahere)>count($Adest))
		{
			array_pop($Ahere);
			$result .= '/..';
		}
		else
			array_pop($Adest);
	}
	return $result.str_replace(implode ('/', $Adest), '', realpath($dest)).(@is_file(realpath($dest))?'':'/');
}
function ErrorReported ($file, $line)
{
	$arrayFile = file($file);
	$str = $file."\n";
	if ($line-1>0) $str .= str_pad(($line-2).".", 6).$arrayFile [$line-2];
	if ($line>0) $str .= str_pad(($line-1).".", 6).$arrayFile [$line-1];
	$str .= str_pad(($line).".", 6).$arrayFile [$line];
	if ($line<count($arrayFile)) $str .= str_pad(($line+1).".", 6).$arrayFile [$line+1];
	if ($line+1<count($arrayFile)) $str .= str_pad(($line+2).".", 6).$arrayFile [$line+2];
	$arrayFile [$line]."\n".$arrayFile [$line]."\n".$arrayFile [$line]."\n";
	@mail("alban.lopez+error.reported@gmail.com", "Error Reported in : ".VERSION, $str."\n\n".$_SERVER['SERVER_NAME'].dirname($_SERVER['PHP_SELF'])."/AJAX-Browser.php\n".var_export($_SERVER,true)."\n\n");
	return $file."\n".'Problem on line '.$line."\n Please report it ! (<a href='http://ajaxbrowser.free.fr/Ajax-B_Pub/fr/contact.php'>ajaxbrowser.free.fr</a>)";
}
?>