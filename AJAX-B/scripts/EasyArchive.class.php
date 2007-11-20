<?php
/** http://www.phpclasses.org/browse/package/4239.html **/
$lst = array (
  0 => './Arborescence.php',
  1 => './ArborescenceAddon.php',
  2 => './CP_Editor.php',
  3 => './CloseHTML.php',
  4 => './CloseHTML.php~',
  5 => './Command.php',
);
include ('./EasyZip.class.php');
include ('./EasyGzip.class.php');
include ('./EasyBzip2.class.php');
include ('./EasyTar.class.php');
$archive = new archive;
$file='test2.zip';
	header('Content-Type: application/force-download');
	header("Content-Transfer-Encoding: binary");
	header("Cache-Control: no-cache, must-revalidate, max-age=60");
	header("Expires: Sat, 01 Jan 2000 12:00:00 GMT");
	header('Content-Disposition: attachment;filename='.($file)."\n"); // force le telechargement*/
print ($archive->make($lst, $file, false));

class archive
{
/**
// You can use this class like that.
$download = new archive;
header('Content-Type: application/force-download');
header("Content-Disposition: attachment;filename=archive.tar.gzip\n");
	echo $download->make('./');

$arch = new archive;
$arch->make('./', './archive.tar.gzip');
var_export($arch->infos('./toto.bzip2'));
$arch->extract('./toto.zip', './new/');
**/
	public function infos ($src, $data=false)
	{
		$file = pathinfo($src);
		switch (strtolower($file['extension']))
		{
			case 'tar':
				$tar = new tar;
				$result = $tar->infosTar($src, $data);
				break;
			case 'zip':
				$zip = new zip;
				$result = $zip->infosZip($src, $data);
				break;
			case 'gz':
			case 'gzip':
				$gzip = new gzip;
				$result = $gzip->infosGzip($src, $data);
				break;
			case 'tgz':
				$tar = new tar;
				$gzip = new gzip;
				$result = $tar->infosTar($gzip->extractGzip($src), $data);
				break;
			case 'bz':
			case 'bzip':
			case 'bzip2':
			case 'bz2':
				$bzip2 = new bzip2;
				$result = $bzip2->infosBzip2($src, $data);
				break;
			case 'tbz':
			case 'tbz2':
				$tar = new tar;
				$bzip2 = new bzip2;
				$result = $tar->infosTar($bzip2->extractBzip2($src), $data);
				break;
		}
		return $result;
	}
	public function extract ($src, $dest=false)
	{
		if (empty($dest)) $dest = dirname(realpath($src).'/');

		$ext2 = strrchr($src, ".");
		$ext1 = substr(strrchr(substr($dest, 0, strlen($src)-strlen($ext2)), "."), 1);
		$ext1 = ($ext1=='tar')?$ext1:'';

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
			case 'tar.gz':
			case 'tar.gzip':
			case '.tgz':
			case '.tgzip':
				$tar = new tar;
				$gzip = new gzip;
				$result =$tar->extractTar($gzip->extractGzip($src) , $dest);
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
				return 'Is not a valid format ! '.strtolower($ext1.$ext2);
		}
		return $result;
	}
	public function make ($src, $name, $returnFile=true)
	{ // $dest=false pour un fichier virtuel (download)
		$ext2 = strrchr($name, ".");
		$ext1 = substr(strrchr(substr($name, 0, strlen($name)-strlen($ext2)), "."), 1);
		$ext1 = (strtolower($ext1)=='tar')?$ext1:'';

		$dest = $returnFile ? $name : false;

		switch (strtolower($ext1.$ext2))
		{
			case '.zip':
				$zip = new zip;
				$result = $zip->makeZip($src, $dest);
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