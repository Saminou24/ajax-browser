<?php
/*
 * CodePress - Real Time Syntax Highlighting Editor written in JavaScript -  http://codepress.fermads.net/
 *
 * Copyright (C) 2006 Fernando M.A.d.S. <fermads@gmail.com>
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the
 * GNU Lesser General Public License as published by the Free Software Foundation.
 *
 * Read the full licence: http://www.opensource.org/licenses/lgpl-license.php
 *
 * Very simple implementation of server side script
 * to open files and send to CodePress interface
 */

$code = "";
$language = "php";

if(isset($_GET['file']))
{
    $full_file = $_GET['file'];
	if(file_exists($full_file))
	{
		$code = file_get_contents($full_file);
		$code = preg_replace("/&shy;|&amp;shy;/","\\xad",$code);
		$code = preg_replace("/</","&lt;",$code);
		$code = preg_replace("/>/","&gt;",$code);
		$language = getLanguage($full_file);
	}
}
if(isset($_GET['language'])) $language = $_GET['language'];
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
<head>
	<title>CodePress - Real Time Syntax Highlighting Editor written in JavaScript</title>
	<meta name="description" content="CodePress source code editor window" />

	<link type="text/css" href="./.AJAX-B/CodePress/codepress.css?timestamp=<?=time()?>" rel="stylesheet" />
	<link type="text/css" href="./.AJAX-B/CodePress/languages/codepress-<?=$language?>.css?timestamp=<?=time()?>" rel="stylesheet" id="cp-lang-style" />
	<script type="text/javascript" src="./.AJAX-B/CodePress/codepress.js?timestamp=<?=time()?>"></script>
	<script type="text/javascript" src="./.AJAX-B/CodePress/languages/codepress-<?=$language?>.js?timestamp=<?=time()?>"></script>
	<script type="text/javascript">CodePress.language = '<?=$language?>';</script>
</head>
<body id="ffedt" style="font-size:11px;"><pre id="ieedt"><?=$code?></pre></body>
</html>

<?php
/*
Function that get language to use based on file extension
*/
function getLanguage($file)
{
	switch(pathinfo($file, PATHINFO_EXTENSION))
	{
		case 'php':
		case 'php4':
		case 'php5':
		case 'phtml':
			$ext =  'php';
			break;
		case 'js':
		case 'jsp':
			$ext =  'javascript';
			break;
		case 'java':
			$ext =  'java';
			break;
		case 'perl':
		case 'pl':
		case 'cgi':
			$ext =  'perl';
			break;
		case 'html':
		case 'htm':
			$ext =  'html';
			break;
		case 'css':
			$ext =  'css';
			break;
		break;
		default:
			$ext =  'text';
	}
	return $ext;
}
?>