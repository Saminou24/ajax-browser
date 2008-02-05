<?
/**-------------------------------------------------
 | EasyGzip.class V0.8 -  by Alban LOPEZ
 | Copyright (c) 2007 Alban LOPEZ
 | Email bugs/suggestions to alban.lopez+easygzip@gmail.com
 +--------------------------------------------------
 | This script has been created and released under
 | the GNU GPL and is free to use and redistribute
 | only if this copyright statement is not removed
 +--------------------------------------------------
 http://www.phpclasses.org/browse/package/4239.html **/
class gzip
{
/**
// You can use this class like that.
$test = new gzip;
$test->makeGzip('./','./toto.gzip');
var_export($test->infosGzip('./toto.gzip'));
$test->extractGzip('./toto.gzip', './new/');
**/
	function makeGzip($src, $dest=false)
	{
		$Gzip = gzencode((is_file($src) ? file_get_contents ($src) : $src), 6);
		if (empty($dest)) return $Gzip;
		elseif (file_put_contents($dest, $Gzip)) return $dest;
		return false;
	}
	function infosGzip ($src, $data=true)
	{
		$data = $this->extractGzip ($src);
		$content = array(
			'UnCompSize'=>strlen($data),
			'Size'=>filesize($src),
			'Ratio'=>strlen($data) ? round(100 - filesize($src) / strlen($data)*100, 1) : false,);
		if ($data) $content['Data'] = $data;
		return $content;
	}
	function extractGzip ($src, $dest=false)
	{
		$zp = gzopen( $src, "r" );
		$data = '';
		while (!gzeof($zp))
			$data .= gzread($zp, 1024*1024);
		gzclose( $zp );
		if (empty($dest)) return $data;
		elseif (file_put_contents($dest, $data)) return $dest;
		return false;
	}
}
?>