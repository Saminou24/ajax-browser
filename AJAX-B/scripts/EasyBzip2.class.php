<?
/**-------------------------------------------------
 | EasyBzip2.class  -  by Alban LOPEZ
 | Copyright (c) 2007 Alban LOPEZ
 | Email bugs/suggestions to alban.lopez+eazybzip2@gmail.com
 +--------------------------------------------------
 | This script has been created and released under
 | the GNU GPL and is free to use and redistribute
 | only if this copyright statement is not removed
 +--------------------------------------------------
 http://www.phpclasses.org/browse/package/4239.html **/
class bzip2
{
/**
// You can use this class like that.
$test = new bzip2;
$test->makeBzip2('./','./toto.bzip2');
var_export($test->infosBzip2('./toto.bzip2'));
$test->extractBzip2('./toto.bzip2', './new/');
**/
	function makeBzip2($src, $dest=false)
	{
		$Bzip2 = bzcompress((is_file($src) ? file_get_contents ($src) : $src), 6);
		if (empty($dest)) return $Bzip2;
		elseif (file_put_contents($dest, $Bzip2)) return $dest;
		return false;
	}
	function infosBzip2 ($src, $data=true)
	{
		$data = $this->extractBzip2 ($src);
		$content = array(
			'Ratio'=>strlen($data) ? round(100 - filesize($src) / strlen($data)*100, 1) : false,
			'Size'=>filesize($src),
			'NormalSize'=>strlen($data));
		if ($data) $content['Data'] = $data;
		return $content;
	}
	function extractBzip2($src, $dest=false)
	{
		$bz = bzopen($src, "r");
		$data = '';
		while (!feof($bz))
			$data .= bzread($bz, 1024*1024);
		bzclose($bz);
		echo $data;
		if (empty($dest)) return $data;
		elseif (file_put_contents($dest, $data)) return $dest;
		return false;
	}
}
?>