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

function InfosByURL ($url)
{
	$infos = array();
	if (is_file($url))
	{
		$infos[] = dirname($url)."/";				// dirname
		$infos[] = basename($url);					// name
		$infos[] = @filesize($url);					// size
		$infos[] = function_exists("mime_content_type") ? @mime_content_type($url) : "mime_type()";			// type mime
	}
	else
	{
		$infos[] = UrlSimplied($url."../");				// dirname
		$infos[] = basename($url)."/";					// name
		$infos[] = SizeDir ($url);						// size
		$infos[] = "Dossier";	// filetype($url);		// type mime
	}
	$infos[] = date ("d/m/y H:i:s",@filemtime($url));	// date
	$infos[] = Permission ($url);						// perm
	$usr = function_exists("posix_getpwuid") ? @posix_getpwuid(fileowner($url)) : array("name" => "?", "uid" => "posix_getpwuid()");
		$infos[] = $usr['name'];
		$infos[] = $usr['uid'];
	$grp = function_exists("posix_getgrgid") ? @posix_getgrgid (filegroup($url)) : array("name" => "?", "gid" => "posix_getgrgid()");
		$infos[] = $grp['name'];
		$infos[] = $grp['gid'];
	if (@getimagesize($url))
	{
		list ($L, $H) = getimagesize($url, $info);
		$infos[] = "[X:".$L."px, Y:".$H."px]";			// [ImgSizeX, ImgSizeY]
	}
	elseif (is_dir($url))
	{
		$infos[] = ($tmp=DirSort ($url,'dir'))?count ($tmp):0;	// count(subdir)
		$infos[] = ($tmp=DirSort ($url,'file'))?count ($tmp):0;	// count(subfile)
	}
	return $infos;

}
function mkdirs($dirName)
{
	$newDir="";
	foreach(explode('/',$dirName) as $dirPart)
		if (!empty($dirPart) && !is_dir($newDir=$newDir.$dirPart."/")) if (!mkdir($newDir)) return false;
	return $newDir;
}
function microtime_float()
{
	list($usec, $sec) = explode(" ", microtime());
	return (float)$usec + (float)$sec;
}
function UrlSimplied($Url)
{
	return DirUrl(str_replace(realpath('./'),".",DirUrl(realpath($Url)))); // $_SERVER["DOCUMENT_ROOT"]
} // realpath("./")
function DirUrl($Dir)
{
	if (ereg ("/$", $Dir))
		return $Dir;
	else return $Dir."/";
}
function SizeDir ($Folder)
{
	global $speed, $StartPhpScripte, $OverTime;
	if ($speed=="no" || (microtime_float()-$StartPhpScripte < $OverTime && $speed =="auto"))
	{
		$SizeAll=0;
		$dirLst=DirSort ($Folder,'dir');
		if ($dirLst)
			foreach ($dirLst as $dir)
				$SizeAll += SizeDir ($Folder.$dir.'/');
		$fileLst=DirSort ($Folder, isset($_GET['match']) ? explode(',',$_GET['match']) : 'file');
		if ($fileLst)
			foreach ($fileLst as $key => $file)
				$SizeAll += @filesize ($Folder.$file);
		if ($speed=="no" || (microtime_float()-$StartPhpScripte < $OverTime && $speed =="auto")) return $SizeAll;
		else return -1;
	}
	else
		return -1;
}
function SizeConvert ($Size)
{
	$UnitArray = array("Oct","Ko","Mo","Go","To");
	$Unit=0;
	while ($Size/pow(1024, $Unit)>1024) $Unit++;
	return round($Size/pow(1024, $Unit), $Unit)." ".$UnitArray[$Unit];
}
function Permission ($url)
{// revoie une chaine decrivant les droits d'accees du fichier ou dossier (a la maniere linux...)
	$perms = @fileperms($url);

	if (($perms & 0xC000) == 0xC000)
	$info = 's';
	elseif (($perms & 0xA000) == 0xA000)
	$info = 'l';
	elseif (($perms & 0x8000) == 0x8000)
	$info = '-';
	elseif (($perms & 0x6000) == 0x6000)
	$info = 'b';
	elseif (($perms & 0x4000) == 0x4000)
	$info = 'd';
	elseif (($perms & 0x2000) == 0x2000)
	$info = 'c';
	elseif (($perms & 0x1000) == 0x1000)
	$info = 'p';
	else  // Inconnu
	$info = 'u';

	$info .= (($perms & 0x0100) ? 'r' : '-');// Proprietaire
	$info .= (($perms & 0x0080) ? 'w' : '-');
	$info .= (($perms & 0x0040) ? (($perms & 0x0800) ? 's' : 'x' ) : (($perms & 0x0800) ? 'S' : '-'));
	$info .= (($perms & 0x0020) ? 'r' : '-');// Groupe
	$info .= (($perms & 0x0010) ? 'w' : '-');
	$info .= (($perms & 0x0008) ? (($perms & 0x0400) ? 's' : 'x' ) : (($perms & 0x0400) ? 'S' : '-'));
	$info .= (($perms & 0x0004) ? 'r' : '-');// Tous
	$info .= (($perms & 0x0002) ? 'w' : '-');
	$info .= (($perms & 0x0001) ? (($perms & 0x0200) ? 't' : 'x' ) : (($perms & 0x0200) ? 'T' : '-'));

	return $info;
}
function CreatMini( $File, $dir, $Max=100, $Force=false)
{
	$FileDest = $dir.ereg_replace("^./|^/","",dirname($File))."/".$Max."@".basename($File, pathinfo($File, PATHINFO_EXTENSION))."png";
	if ($Force == true || !file_exists($FileDest))
	{
		$size = getimagesize($File);
		if ($size[0]>$size[1]) // determine le coef de reduction de la miniature en X, elle dois faire 120px de haut maxi
			$coef = $size[0]/$Max;
		else $coef = $size[1]/$Max;
		if ($coef>1 && function_exists(imagejpeg))
		{
			mkdirs(dirname($FileDest));
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
				return "./.AJAX-B/unknown.png' title='echec de la miniature";
			imagedestroy($dst_img);// Vide la memoire RAM allouee a l'image $dst_img
			imagedestroy($src_img);// Vide la memoire RAM allouee a l'image $src_img
			return $FileDest;
		}
		else return $File;
	}
	else return $FileDest;
}
function ListDir ($Folder)
{
	$INFOS="";
	$dirLst = DirSort ($Folder=DirUrl($Folder), 'dir');
	if ($dirLst)
	{
		foreach ($dirLst as $dir)
			if ($_SESSION['hidden-file'] || !ereg ('^\.',$dir))
				$INFOS .= implode("\t",InfosByURL (DirUrl($Folder.$dir)))."\n";
	}
	$fileLst = DirSort ($Folder, isset($_GET['match']) ? explode(',',$_GET['match']) : 'file');
	if ($fileLst)
	{
		foreach ($fileLst as $file)
			if ($_SESSION['hidden-file'] || !ereg ('^\.',$file))
				$INFOS .=  implode("\t",InfosByURL ($Folder.$file))."\n";
	}
	return $INFOS;
}
function ListDirShort ($Folder)
{
	$INFOS="";
	$dirLst = DirSort ($Folder=DirUrl($Folder), 'dir');
	if ($dirLst)
	{
		foreach ($dirLst as $dir)
			if ($_SESSION['hidden-file'] || !ereg ('^\.',$dir))
				$INFOS .= DirUrl($Folder)."\t".$dir."/\n";	// name
	}
	$fileLst = DirSort ($Folder,  isset($_GET['match']) ? explode(',',$_GET['match']) : 'file');
	if ($fileLst)
	{
		foreach ($fileLst as $file)
			if ($_SESSION['hidden-file'] || !ereg ('^\.',$file))
				$INFOS .= DirUrl($Folder)."\t".$file."\n";
	}
	return $INFOS;
}
function WriteInFile ($file, $Txt, $access)
{
	$mode = array( "ajoute" =>  "a" , "remplace" => "w");
	if ($handle = fopen($file, $mode[$access])) // le 2ieme parametre permet de choisir le mode d'ouverture (lecture, ecriture, ... )
	{
		$result = fwrite($handle, $Txt);
		fclose($handle);
		return $result;
	}
	return false;
}
function ArrayMatch ($ArrayMask, $str)
{
	foreach ($ArrayMask as $mask)
		if (fnmatch($mask, $str)) return true;
	return false;
}
function DirSort ($rep, $mask='all', $Prefixe='')
{
	$type = array( "dir" =>  true , "file" => false);
	$Lst = false;
	if ($mask=='all')
	{
		$Lst1 = DirSort ($rep, "dir", $Prefixe);		// cree une liste ordonnee des repertoires
		$Lst2 = DirSort ($rep,  isset($_GET['match']) ? explode(',',$_GET['match']) : 'file', $Prefixe);		// cree une liste ordonnee des fichiers ( isset($_GET['match']) ? explode(',',$_GET['match']) : 'file' )
		if ($Lst2 || $Lst1)				// si l'un des 2 n'est pas vide...
			return array_merge( $Lst1 ? $Lst1 : array(), $Lst2 ? $Lst2 : array() );       // alors on renvois la concatenation des 2 string
		else return false;				// resultat d'un dossier vide
	}
	elseif (is_readable($rep) && $dh = opendir($rep))
	{
		while (($f = readdir($dh)) !== false)	// parcoure le contenu de Rep
		{
			if ($f != "." && $f != "..")		// ignore les dossiers '.' et '..'
			{
				if (!is_array($mask))	// si on a demander tous le contenu (fichiers ou dossiers)
				{
					if ($type[$mask]==is_dir($rep.$f))
						$Lst[] = $Prefixe.$f;	// Liste un type de contenu (repertoires ou fichiers)
				}
				elseif ( ArrayMatch($mask, $f) && is_file($rep.$f) )
					$Lst[] = $Prefixe.$f;       // Liste un type de contenu (fichier de d'extension demander)
			}
		}
		closedir($dh);
	}
	if (is_array($Lst))        // si la liste n'est pas vide
	{
		natcasesort($Lst);       //classe le contenu
		return array_values($Lst);   // pour que les clef soit dans l'ordre...
	}
	else return false;
}
function NewFile($New,$mode=false) // NewFile($New,($_SESSION['level']>2?true:false))
{
	list($folder,$file,$ext) = array_values(pathinfo($New));
	if(strlen($ext))
	{
		$ext = ".".$ext;
		$file = substr($file,0,strlen($file)-strlen($ext));
	}
	if ($mode && file_exists($OldName = $folder."/".$file.$Count.$ext))
	{
		rename($OldName,$Old = NewFile($folder."/".$file." - Old".$ext)); // l'ancien fichier est renomé (conservation de meta-données)
		copy($Old,$OldName); // mais il est aussi restitué sous sont non d'orrigine pour les cas ou il est utilisé comme source
		return $New;
	}
	$Count = "";
	while (file_exists($NewName = $folder."/".$file.$Count.$ext))
	{
		$NewName;
		$Count++ ;
	}
	return $NewName;
}
?>