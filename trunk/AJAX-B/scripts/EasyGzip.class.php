<?
class gzip
{
/**
// You can use this class like that.
$test = new gzip;
$test->makeGzip('./','./toto.gzip');
var_export($test->infosGzip('./toto.gzip'));
$test->extractGzip('./toto.gzip', './new/');
**/
	public function makeGzip($src, $dest=false)
	{
		$Gzip = gzencode((is_file($src) ? file_get_contents ($src) : $src), 6);
		if (empty($dest)) return $Gzip;
		elseif (file_put_contents($dest, $Gzip)) return $dest;
		return false;
	}
	public function infosGzip ($src, $data=true)
	{
		$data = $this->extractGzip ($src);
		$content = array(
			'Ratio'=>strlen($data) ? round(100 - filesize($src) / strlen($data)*100, 1) : false,
			'Size'=>filesize($src),
			'NormalSize'=>strlen($data));
		if ($data) $content['Data'] = $data;
		return $content;
	}
	public function extractGzip ($src, $dest=false)
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