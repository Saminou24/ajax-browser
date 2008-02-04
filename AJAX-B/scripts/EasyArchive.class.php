<?php
/**-------------------------------------------------
 | EasyArchive.class  -  by Alban LOPEZ
 | Copyright (c) 2007 Alban LOPEZ
 | Email bugs/suggestions to alban.lopez+eazyarchive@gmail.com
 +--------------------------------------------------
 | This script has been created and released under
 | the GNU GPL and is free to use and redistribute
 | only if this copyright statement is not removed
 +-------------------------------------------------- **/
//www.phpclasses.org/browse/package/4239.html

	require (dirname(__FILE__).'/EasyZip.class.php');
	require (dirname(__FILE__).'/EasyTar.class.php');
	require (dirname(__FILE__).'/EasyGzip.class.php');
	require (dirname(__FILE__).'/EasyBzip2.class.php');

/**
// You can use this class like that.
$arch = new archive;
$arch->make('./', './archive.tar.gzip');
var_export($arch->infos('./toto.bzip2'));
$arch->extract('./toto.zip', './my_dir/');
$arch->download('./my_dir/');
**/

class archive
{
	var $WathArchive = array (
		'.zip'		=>'zip',
		'.tar'		=>'tar',
		'.gz'		=>'gz',
		'.gzip'		=>'gz',
		'.bzip'		=>'bz',
		'.bz'		=>'bz',
		'.bzip2'	=>'bz',
		'.bz2'		=>'bz',
		'.tgz'		=>'gz',
		'.tgzip'	=>'gz',
		'.tbzip'	=>'bz',
		'.tbz'		=>'bz',
		'.tbzip2'	=>'bz',
		'.tbz2'		=>'bz',
	);
	function download ($src, $name)
	{
		header('Content-Type: application/force-download');
		header("Content-Transfer-Encoding: binary");
		header("Cache-Control: no-cache, must-revalidate, max-age=60");
		header("Expires: Sat, 01 Jan 2000 12:00:00 GMT");
		header('Content-Disposition: attachment;filename="'.$name."\"\n");
		$data = $this->make($src, $name, false);
		header("Content-Length: ".strlen($data));
		print($data);
	}
	function make ($src, $name="Archive.tgz", $returnFile=true)
	{
		$ext = '.'.pathinfo ($name, PATHINFO_EXTENSION);
		foreach ($this->WathArchive as $key=>$val)
			if (stripos($ext, $key)!==false) $comp=$val;
		if ($comp == 'zip')
		{
			$zip = new zip;
			if ($returnFile)
				$result = $zip->makeZip($src, $dest);
			else
			{
				$tmpZip = './'.md5(serialize($src)).'.zip';
				$result = $zip->makeZip($src, $tmpZip);
				$result = file_get_contents($tmpZip);
				unlink($tmpZip);
			}
			return $result;
		}
		elseif (strlen($comp)>1)
		{
			if (count($src)>1 || is_dir($src[0]) || $comp == 'tar')
			{
				$tar = new tar;
				$src = $tar->makeTar($src);
			}
			if ($comp == 'bz')
			{
				$bzip2 = new bzip2;
				$src = $bzip2->makeBzip2($src);
			}
			elseif ($comp == 'gz')
			{
				$gzip = new gzip;
				$src = $gzip->makeGzip($src);
			}
			if ($returnFile)
			{
				file_put_contents($src, $dest);
				return $dest;
			}
			return $src;
		}
		else return 'Specifie a valid format at the end of '.$name.' filename ! ';
	}
	function infos ($src, $data=false)
	{
		$ext = '.'.pathinfo ($src, PATHINFO_EXTENSION);
		foreach ($this->WathArchive as $key=>$val)
			if (stripos($ext, $key)!==false) $comp=$val;
		if ($comp == 'zip')
		{
			$zip = new zip;
			$zipresult = $zip->infosZip($src, $data);
			$result ['Items'] = count($zipresult);
			foreach($zipresult as $key=>$val)
				$result['UnCompSize'] += $zipresult[$key]['UnCompSize'];
			$result['Size']=filesize($src);
			$result['Ratio'] = $result['UnCompSize'] ? round(100 - $result['Size'] / $result['UnCompSize']*100, 1) : false;
		}
		elseif (strlen($comp)>1)
		{
			$tar = new tar;
			if ($comp == 'bz')
			{
				$bzip2 = new bzip2;
				$result = $bzip2->infosBzip2($src, true);
				$src=$result['Data'];
			}
			elseif ($comp == 'gz')
			{
				$gzip = new gzip;
				$result = $gzip->infosGzip($src, true);
				$src=$result['Data'];
			}
			if ($tar->is_tar($src) || is_file($src))
			{
				$tarresult = $tar->infosTar($src, false);
				$result ['Items'] = count($tarresult);
				$result ['UnCompSize'] = 0;
				if (empty($result['Size']))
					$result['Size']=is_file($src)?filesize($src):strlen($src);
				foreach($tarresult as $key=>$val)
					$result['UnCompSize'] += $tarresult[$key]['size'];
				$result['Ratio'] = $result['UnCompSize'] ? round(100 - $result['Size'] / $result['UnCompSize']*100, 1) : false;
				
			}
			if (!$data) unset($result['Data']);
		}
		else return false;
		return array('Items'=>$result['Items'], 'UnCompSize'=>$result['UnCompSize'], 'Size'=>$result['Size'], 'Ratio'=>$result['Ratio'],);
	}
	function extract ($src, $dest=false)
	{
		if (empty($dest)) $dest = dirname(realpath($src)).'/';
		$result = false;
		$ext2 = strrchr($src, '.');
		$ext1 = substr(strrchr(substr($src, 0, strlen($src)-strlen($ext2)), '.'), 1);
		$ext1 = (strtolower($ext1)=='tar')?$ext1:'';

		switch (strtolower($ext1.$ext2))
		{
			case '.zip':
				$zip = new zip;
				$result = $zip->extractZip($src, $dest);
				break;
			case '.tar':
				$tar = new tar;
				$result =$tar->extractTar($src , $dest);
				break;
			case '.gz':
			case '.gzip':
				$gzip = new gzip;
				$result = $gzip->extractGzip($src, $dest.substr(basename($src),0,-1*strlen($ext2)));
				break;
			case '.bz':
			case '.bzip':
			case '.bzip2':
			case '.bz2':
				$bzip2 = new bzip2;
				$result = $bzip2->extractBzip2($src, $dest.substr(basename($src),0,-1*strlen($ext2)));
				break;
			case 'tar.gz':
			case 'tar.gzip':
			case '.tgz':
			case '.tgzip':
				$tar = new tar;
				$gzip = new gzip;
				$result = $tar->extractTar($gzip->extractGzip($src) , $dest);
				break;
			case 'tar.bz':
			case 'tar.bz2':
			case 'tar.bzip':
			case 'tar.bzip2':
			case '.tbz':
			case '.tbz2':
			case '.tbzip':
			case '.tbzip2':
				$tar = new tar;
				$bzip2 = new bzip2;
				$result = $tar->extractTar($bzip2->extractBzip2($src), $dest);
				break;
			default:
				$result = false;
		}
		return $result;
	}
}
?>