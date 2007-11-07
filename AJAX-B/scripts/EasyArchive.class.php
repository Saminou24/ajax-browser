<?php
$test = new archive;
echo 'make : '.$test->make('./RACINE/', './test.tar').'<br>';
echo 'extract : '.$test->extract('./test.tar').'<br>';
class archive
{
	public function infos ($src, $data=false)
	{
		$file = pathinfo($src);
		switch (strtolower($file['extension']))
		{
			case 'tar':
				$tar = new tar;
				break;
			case 'zip':
				$zip = new zip;
				$result = $zip->infosZip($src, $data);
				break;
			case 'gz':
			case 'gzip':
			case 'tgz':
				$tar = new tar;
				$gzip = new gzip;
				$result = $gzip->infosGzip($src, $data);
				break;
			case 'bz':
			case 'bzip':
			case 'bzip2':
			case 'bz2':
			case 'tbz':
			case 'tbz2':
				$tar = new tar;
				$bzip2 = new bzip2;
				$result = $bzip2->infosGzip($src, $data);
				break;
		}
		return $result;
	}
	public function extract ($src, $dest=false)
	{
		if (empty($dest)) $dest = dirname($src);

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
				$gzip = new gzip;
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
	public function make ($src, $dest=false)
	{ // $dest=false pour un fichier virtuel (download)
		$ext2 = strrchr($dest, ".");
		$ext1 = substr(strrchr(substr($dest, 0, strlen($dest)-strlen($ext2)), "."), 1);
		$ext1 = ($ext1=='tar')?$ext1:'';

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
				return 'Specifie a valid format at the end of $dest filename ! '.strtolower($ext1.$ext2);
		}
		return $result;
	}
}

class zip
{
	public function infosZip ($src, $data=true)
	{
		if ($zip = zip_open($src))
		{
			while ($zip_entry = zip_read($zip))
			{
				$path = zip_entry_name($zip_entry);
				if (zip_entry_open($zip, $zip_entry, "r"))
				{
					$content[$path] = array (
						'Ratio' => zip_entry_filesize($zip_entry) ? round(100-zip_entry_compressedsize($zip_entry) / zip_entry_filesize($zip_entry)*100, 1) : false,
						'Size' => zip_entry_compressedsize($zip_entry),
						'NormalSize' => zip_entry_filesize($zip_entry));
					if ($data)
						$content[$path]['Data'] = zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
					zip_entry_close($zip_entry);
				}
				else
					$content[$path] = false;
			}
			zip_close($zip);
			return $content;
		}
		return false;
	}
	public function extractZip ($src, $dest)
	{
		$zip = new ZipArchive;
		if ($zip->open($src)===true)
		{
			$zip->extractTo($dest);
			$zip->close();
			return true;
		}
		return false;
	}
	public function makeZip ($src, $dest)
	{
		$zip = new ZipArchive;
		if ($zip->open($dest, ZipArchive::CREATE) === true)
		{
			foreach ($src as $item)
				$this->addZipItem($zip, realpath(basename($item)).'/', realpath($item).'/');
			$zip->close();
			return true;
		}
		return false;
	}
	private function addZipItem ($zip, $racine, $dir)
	{
		if (is_dir($dir))
		{
			$zip->addEmptyDir(str_replace($racine, '', $dir));
			$lst = scandir($dir);
				array_shift($lst);
				array_shift($lst);
			foreach ($lst as $item)
			{
				if (is_dir($dir.$item))
					$this->addZipItem($zip, $racine, $dir.$item.'/');
				else
					$zip->addFile($dir.$item, str_replace($racine, '', $dir.$item));
			}
		}
		elseif (is_file($dir))
			$zip->addFile($dir, str_replace($racine, '', $dir));
	}
}

class gzip
{
	public function makeGzip($src, $dest)
	{
		if (file_put_contents($dest, gzencode((is_file($src) ? file_get_contents ($src) : $src), 6)))
			return true;
		return false;
	}
	public function infosGzip ($src, $data=true)
	{
		$zp = gzopen( $src, "r" );
		$data = '';
		while (!gzeof($zp))
			$data .= gzread($zp, 1024*1024);
		gzclose( $zp );
		$content = array(
			'Ratio'=>strlen($data) ? round(100-filesize($src) / strlen($data)*100, 1) : false,
			'Size'=>filesize($src),
			'NormalSize'=>strlen($data));
		if ($data) $content['Data'] = $data;
		return $content;
	}
	public function extractGzip ($src, $dest)
	{
		$zp = gzopen( $src, "r" );
		$data = '';
		while (!gzeof($zp))
			$data .= gzread($zp, 1024*1024);
		gzclose( $zp );
		file_put_contents($dest, $data);
		return true;
	}
}

class bzip2
{
	function makeBzip2($src, $dest)
	{
		if (file_put_contents($dest, bzcompress((is_file($src) ? file_get_contents ($src) : $src), 6)))
			return true;
		return false;
	}
	public function infosBzip2 ($src, $data=true)
	{
		$bz = bzopen($src, "r");
		$data = '';
		while (!feof($bz))
			$data .= bzread($bz, 1024*1024);
		bzclose($bz);
		$content = array(
			'Ratio'=>strlen($data) ? round(100-filesize($src) / strlen($data)*100, 1) : false,
			'Size'=>filesize($src),
			'NormalSize'=>strlen($data));
		if ($data) $content['Data'] = $data;
		return $content;
	}
	function extractBzip2($src, $dest)
	{
		$bz = bzopen($src, "r");
		$data = '';
		while (!feof($bz))
			$data .= bzread($bz, 1024*1024);
		bzclose($bz);
		file_put_contents($dest, $data);
		return true;
	}
}

class tar
{
	function tarHeader512($infos)
	{ /** http://www.mkssoftware.com/docs/man4/tar.4.asp **/
		$bigheader = $header = '';
		if (strlen($infos['name100'])>100)
		{
			$bigheader = pack("a124a24a8a1a100a6a2a32a32a173", // book the memorie area 512bits
				'././@LongLink',
				sprintf("%011o", strlen($infos['name100'])),
				'        ', 'L', '', 'ustar ', '0',
				$infos['userName32'],
				$infos['groupName32'],
				'');

			$bigheader .= str_pad($infos['name100'], floor((strlen($infos['name100']) + 512 - 1) / 512) * 512, "\0");

			$checksum = 0;
			for ($i = 0; $i < 512; $i++)
				$checksum += ord(substr($bigheader, $i, 1));
			$bigheader = substr_replace($bigheader, sprintf("%06o", $checksum)."\0 ", 148, 8);
		}

		$header = pack("a100a8a8a8a12a12a8a1a100a6a2a32a32a8a8a155a12", // book the memorie area
			substr($infos['name100'],0,100),		//  0 	100 	File name
			sprintf("%07o", $infos['mode8']),		// 100 	8 		File mode
			sprintf("%07o", $infos['uid8']),		// 108 	8 		Owner user ID
			sprintf("%07o", $infos['gid8']),		// 116 	8 		Group user ID
			sprintf("%011o", $infos['size12']),		// 124 	12 		File size in bytes
			sprintf("%011o", $infos['mtime12']),	// 136 	12 		Last modification time
			'        ',								// 148 	8 		Check sum for header block
			$infos['link1'],						// 156 	1 		Link indicator / ustar Type flag
			$infos['link100'],						// 157 	100 	Name of linked file
			'ustar ',								// 257 	6 		USTAR indicator "ustar"
			' ',									// 263 	2 		USTAR version "00"
			$infos['userName32'],				// 265 	32 		Owner user name
			$infos['groupName32'],				// 297 	32 		Owner group name
			'',									// 329 	8 		Device major number
			'',									// 337 	8 		Device minor number
			$infos['prefix155'],					// 345 	155 	Filename prefix
			'');									// 500 	12 		??

		$checksum = 0;
		for ($i = 0; $i < 512; $i++)
			$checksum += ord(substr($header, $i, 1));
		$header = substr_replace($header, sprintf("%06o", $checksum)."\0 ", 148, 8);

		return $bigheader.$header;
	}
	function addTarItem ($item, $dest, $racine)
	{
		$infos['name100'] = str_replace($racine, '', $item);
		list (, , $infos['mode8'], , $infos['uid8'], $infos['gid8'], , , , $infos['mtime12'] ) = stat($item);
		$infos['size12'] = is_dir($item) ? 0 : filesize($item);
		$infos['link1'] = is_link($item) ? 2 : is_dir ($item) ? 5 : 0;
		$infos['link100'] == 2 ? readlink($item) : "";

			$a=function_exists('posix_getpwuid')?posix_getpwuid (fileowner($item)):array('name'=>'Unknown');
		$infos['userName32'] = $a['name'];

			$a=function_exists('posix_getgrgid')?posix_getgrgid (filegroup($item)):array('name'=>'Unknown');
		$infos['groupName32'] = $a['name'];
		$infos['prefix155'] = '';

		$header = $this->tarHeader512($infos);

		$data = str_pad(file_get_contents($item), floor(($infos['size12'] + 512 - 1) / 512) * 512, "\0");

		file_put_contents($dest, $header.$data, FILE_APPEND);

		if (is_dir($item))
		{
			$lst = scandir($item);
			array_shift($lst); // remove  ./  of $lst
			array_shift($lst); // remove ../  of $lst
			foreach ($lst as $subitem)
				$this->addTarItem($item.$subitem.(is_dir($item.$subitem)?'/':''), $dest, $racine);
		}
	}
	function makeTar($src, $dest)
	{
		$src = !empty($src) ?
			(is_array($src) ? $src : array($src)) :
			(is_array($this->src) ? $this->src : array($this->src));
		$dest = !empty($dest) ? $dest : $this->dest;
			file_put_contents($dest, '');
		foreach ($src as $item)
			$this->addTarItem($item.((is_dir($item) && substr($item, -1)!='/')?'/':''), $dest, dirname($item).'/');
		file_put_contents($dest, str_repeat("\0", 10240 - (filesize($dest) % 10240)) % 10240, FILE_APPEND);
		return file_get_contents($dest);
	}
	function readTarHeader (&$ptr)
	{
		$hdr = unpack("a100name/a8mode/a8uid/a8gid/a12size/a12mtime/a8checksum/a1type/a100symlink/a6magic/a2temp/a32temp/a32temp/a8temp/a8temp/a155prefix/a12temp", $block = fread($ptr, 512));
			$hdr['mode']=octdec($hdr['mode']);
			$hdr['uid']=octdec($hdr['uid']);
			$hdr['gid']=octdec($hdr['gid']);
			$hdr['size']=octdec($hdr['size']);
			$hdr['mtime']=octdec($hdr['mtime']);
			$hdr['checksum']=octdec($hdr['checksum']);
		$checksum = 0;
		$block = substr_replace($block, '        ', 148, 8);
		for ($i = 0; $i < 512; $i++)
			$checksum += ord(substr($block, $i, 1));
		if ($hdr['checksum']==$checksum)
		{
			if ($hdr['name']=='././@LongLink')
			{
				$realName = fread($ptr, (($hdr['size'] + 512 - 1) / 512) * 512);
				$hdr = readTarHeader ($ptr);
				$hdr['name'] = $realName;
				$hdr['data'] = fread($ptr, (($hdr['size'] + 512 - 1) / 512) * 512);
			}
			elseif (substr($hdr['magic'], 0, 5) == 'ustar')
				$hdr['data'] = fread($ptr, (($hdr['size'] + 512 - 1) / 512) * 512);
			return $hdr;
		}
		return $hdr;
	}
	function extractTar ($src, $dest)
	{
		$ptr = fopen($src, 'r');
		while (!feof($ptr))
		{
			$infos = $this->readTarHeader ($ptr);
			var_export ($infos);
			$data []= fread($ptr, $infos['size']);
		}
		return $data;
	}
}?>