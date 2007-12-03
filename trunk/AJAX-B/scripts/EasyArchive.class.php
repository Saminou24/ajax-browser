<?php
/**-------------------------------------------------
 | EasyArchive.class  -  by Alban LOPEZ
 | Copyright (c) 2007 Alban LOPEZ
 | Email bugs/suggestions to alban.lopez+eazyarchive@gmail.com
 +--------------------------------------------------
 | This script has been created and released under
 | the GNU GPL and is free to use and redistribute
 | only if this copyright statement is not removed
 +--------------------------------------------------
 http://www.phpclasses.org/browse/package/4239.html **/

	include (dirname(__FILE__).'/EasyZip.class.php');
	include (dirname(__FILE__).'/EasyTar.class.php');
	include (dirname(__FILE__).'/EasyGzip.class.php');
	include (dirname(__FILE__).'/EasyBzip2.class.php');

/**
// You can use this class like that.
$arch = new archive;
$arch->make('./', './archive.tar.gzip');
var_export($arch->infos('./toto.bzip2'));
$arch->extract('./toto.zip', './new/');
$arch->download('./toto/', './toto.tar.gz');
**/

class archive
{
	public function download ($src, $name)
	{
		header('Content-Type: application/force-download');
		header("Content-Transfer-Encoding: binary");
		header("Cache-Control: no-cache, must-revalidate, max-age=60");
		header("Expires: Sat, 01 Jan 2000 12:00:00 GMT");
		header('Content-Disposition: attachment;filename="'.$name."\"\n");
		$data = $this->make($src, $name, false);
		header("Content-Length: " . strlen($data));
		print($data);
	}
	public function infos ($src, $data=false)
	{
		$result = false;
		$ext2 = strrchr($src, ".");
		$ext1 = substr(strrchr(substr($src, 0, strlen($src)-strlen($ext2)), "."), 1);
		$ext1 = (strtolower($ext1)=='tar')?$ext1:'';

		switch (strtolower($ext1.$ext2))
		{
			case '.zip':
				$zip = new zip;
				$result = $zip->infosZip($src, $data);
				break;
			case '.tar':
				$tar = new tar;
				$result = $tar->infosTar($src, $data);
				break;
			case '.gz':
			case '.gzip':
				$gzip = new gzip;
				$result = $gzip->infosGzip($src, $data);
				break;
			case '.bz':
			case '.bzip':
			case '.bzip2':
			case '.bz2':
				$bzip2 = new bzip2;
				$result = $bzip2->infosBzip2($src, $data);
				break;
			case 'tar.gz':
			case 'tar.gzip':
			case '.tgz':
			case '.tgzip':
				$tar = new tar;
				$gzip = new gzip;
				$result = $tar->infosTar($gzip->extractGzip($src), $data);
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
				$result = $tar->infosTar($bzip2->extractBzip2($src), $data);
				break;
			default ;
				$result = false;
		}
		return $result;
	}
	public function extract ($src, $dest=false)
	{
		if (empty($dest)) $dest = dirname(realpath($src)).'/';
		$result = false;
		$ext2 = strrchr($src, ".");
		$ext1 = substr(strrchr(substr($src, 0, strlen($src)-strlen($ext2)), "."), 1);
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
			default ;
				$result = false;
		}
		return $result;
	}
	public function make ($src, $name, $returnFile=true)
	{
		$ext2 = strrchr($name, ".");
		$ext1 = substr(strrchr(substr($name, 0, strlen($name)-strlen($ext2)), "."), 1);
		$ext1 = (strtolower($ext1)=='tar')?$ext1:'';
		$result = false;

		$dest = $returnFile ? $name : false;

		switch (strtolower($ext1.$ext2))
		{
			case '.zip':
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
				break;
			case '.tar':
				$tar = new tar;
				$gzip = new gzip;
				$result = $tar->makeTar($src, $dest);
				break;
			case '.gz':
			case '.gzip':
				$gzip = new gzip;
				$result = $gzip->makeGzip($src, $dest);
				break;
			case '.bz':
			case '.bz2':
			case '.bzip':
			case '.bzip2':
				$bzip2 = new bzip2;
				$result = $bzip2->makeBzip2($src, $dest);
				break;
			case 'tar.gz':
			case 'tar.gzip':
			case '.tgz':
			case '.tgzip':
				$tar = new tar;
				$gzip = new gzip;
				$result = $gzip->makeGzip($tar->makeTar($src), $dest);
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
				$result = $bzip2->makeBzip2($tar->makeTar($src), $dest);
				break;
			default ;
				return 'Specifie a valid format at the end of $name filename ! '.strtolower($ext1.$ext2);
		}
		return $result;
	}
}
?>