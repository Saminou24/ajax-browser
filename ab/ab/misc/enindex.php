<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<meta name="verify-v1" content="cCR8Mg7d/fHehqZ0k8WFHTEPwEp3EIu8flx/TxP0hVY=" />
	<meta http-equiv="Content-Language" content="fr-fr" />
	<meta name="description" content="AJAX-Browser est un explorateur de domaine enti&egrave;rement &eacute;crit en AJAX qui vous permet de gerer votre domaine exclusivement par protocole HTTP, sous licence LGPL." />
	<meta name="keywords" content="ajaxbrowser, ajax-browser, ajax, java, javascript, php, explorateur, dossiers, fichiers, dossier, fichier, folder, file, manager, domaine, gallerie, arborescence, miniature, " />
	<title>AJAX-Browser is a Domaine Web Browser</title>
	<script type="text/javascript" src="index.js"></script>
	<style type="text/css">@import url(index.css);</style>
<script src="http://www.google-analytics.com/urchin.js" type="text/javascript">
</script>
<script type="text/javascript">
_uacct = "UA-1990419-1";
urchinTracker();
</script>
</head>
<?
include ('Menu.php');
require '../../banner.html';
?>
<div id="previous">
<div><object width="280" height="220"><param name="movie" value="http://www.dailymotion.com/swf/7F1bsmmGS1nEWomqW"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed src="http://www.dailymotion.com/swf/7F1bsmmGS1nEWomqW" type="application/x-shockwave-flash" width="280" height="220" allowFullScreen="true" allowScriptAccess="always"></embed></object><br /><b><a href="http://www.dailymotion.com/video/x3gg0u_demo_ads">Dailymotion</a></b></div>
<a href="../../Archives/Videos/Demo.ogg">Demo (hight quality)</a><br/>
<a href="../../Archives/Videos/AJAX-B_Download_and_Install.ogg">Instalation (hight quality)</a><br/>
<a href="../../Archives/Videos/AJAX-B_Setting.ogg">Setting (hight quality)</a><br/></div>
<div id="main">
	<h4 style="text-align:justify;">
	<b>Ajax-Browser </b> (or Ajaxbrowser) is a free (LGPL license) file manager for web sites, primarily write in AJAX and using the HTTP protocol. Ajax-Browser massively uses AJAX technology to increase web page's interactivity, speed/fluidity, functionality, and usability compare to the widely use FireFTP FTP protocol software and its heavyness.<br/>

<br/>
<h3>More :</h3>
Ajax Browser is an unique project on the web which aims to ease the management of files by webmasters, but also by common users by providing a free and optimized AJAX based portable application : You just need a web browser to manage website's files and folders like files and folders on your own computer, allowing cut/slide/paste actions, drag'n drop actions, displaying gallery/thumbnails or list/tree view, compress, etc.<br/>
Visitors are usually allowed to rename, move, compress and download/upload files, while Administrators can have some more features such the abilities to edit source files online and make (hard risk) deletions. Rights of each users are according to the main administrator will.<br/>
For more efficiency, I choses to integrate some other small and really good softs/class in Ajax-Browser : <a href="../ViewCode.php?file=../AJAX-B/scripts/EasyArchive.class.php">EasyArchive.class.php</a> (by myself) to manage compressed files, and <a href=" http://codepress.free.fr">CodePress</a> (by Fernando M.A.d.S. and Michael Hurni) to allow online editions of source files. This two tools add in functionality and are them also provide under LGPL License.<br/></h4>
<h3>Main features :</h3>
<p style="text-align:justify;">Being a online file manager AJAX-Browser give advanced features to manage your files and folders on your website, avoiding FTP weakness and constraint it's a powerful tool to manange you website from everywhere.</p><br>
<ul><li>    * <b>100% compatible</b> with <b>Firefox</b>, <b>Opera</b> and <b>Konqueror</b>, developped on a GNU/Linux system (Ubuntu);</li>
<li>    * HTTP protocol to make it portable;</li>
<li>    * <b>drag'n drop</b> actions and cut/copy/past [...] actions with keyboard;</li>
<li>    * <b>Multi-account</b> system to manage users;</li>
<li>    * <b>Rights management</b> for each user;</li>
<li>    * <b>Thumbnails</b> or <b>tree view</b> mode as well;</li>
<li>    * <b>Upload</b> file (according to user's rights);</li>
<li>    * <b>Download</b> file <b>and</b> folder (according to user's rights);</li>
<li>    * Batch <b>renaming</b>;</li>
<li>    * Complex <b>selection</b> using SHIFT or CTRL;</li>
<li>    * Files and folders <b>properties</b>;</li>
<li>    * etc.</li></ul>
<p>NB: AjaxBrowser is "0% compatible with Internet Explorer", why ? This because Internet Explorer doesn't respect the World Wide Web recommandations for coding, it's in fact I.E. which is by its own will, uncompatible with other correctly coded softwares.</p>
<h3>Author & copyrights</h3>
<p>AJAX-Browser is distributed under <a href="http://www.opensource.org/licenses/lgpl-license.php">LGPL</a> license. If you want to include AJAX-Browser in your projet, you just need to be under the same licence or under <a href="http://creativecommons.org/">Creative Commons</a>. You also need to <a href="http://code.google.com/p/ajax-browser/source">SVN @ code.google</a> the original author (me) : Alban Lopez.</p>
</div>
<h3>Comments</h3>
<div id="comments">
<?
$lst=explode('Comment-name:',file_get_contents("../comment.lst"));
foreach ($lst as $n => $cmt)
{
	$comment=explode("\t",substr($cmt,0,strpos($cmt,"\n")));
	$comment[3]=substr($cmt,strpos($cmt,"\n")+1);
	if (strpos(strtolower($comment[0]),"admin")===false)
	{
?>
<div class="comment">
	<a href="<?=$comment[1]?>">
		<strong class="name"><?=$comment[0]?></strong>
	</a> : <strong><?=$comment[2]?></strong>
	<p><?=ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]", "<a href=\"\\0\">\\0</a>", HighlightComment($comment[3]))?></p>
</div>
<?
	}
	else
	{
?>
<div class="comment me">
	<a href="http://ajaxbrowser.free.fr/">
		<strong class="name">admin</strong>
	</a> : <strong><?=$comment[2]?></strong>
	<p><?=ereg_replace("[[:alpha:]]+://[^<>[:space:]]+[[:alnum:]/]", "<a href=\"\\0\">\\0</a>", HighlightComment($comment[3]))?></p>
</div>
<?
	}
}
?>
	<div id="newcomments"></div>
	<h3>Poster un commentaire</h3>
	<div id="yourcomment" class="comment">
		<a href="http://" id="yoururl"><strong id="yourname" class="name">Your Name</strong></a> : <strong id="yourdate"><?=date("Y-m-d",time())?></strong>
		<p id="yourtext">Your comments</p>
	</div>
<!--/comments-->
	<div id="postcomment">
		<form name="comm">
			<input type="text" name="cname" value="Your Name" onkeyup="commentPreview()" onclick="if(this.value=='Votre nom')this.value=''" /><br />
			<input type="text" name="curl" value="http://" onkeyup="commentPreview()" /><br />
			<textarea name="ccomment" onkeyup="commentPreview()" onclick="if(this.value=='Votre commentaire')this.value=''" onfocus="if(this.value=='Votre commentaire')this.value=''">Your comments</textarea><br />
		</form>
		<p>Framing the code snippets by tags &lt;code&gt; and &lt;/code&gt;</p>
		<button onclick="commentAdd()">Send</button>
			<div id="comment-msg"></div>
		<script type="text/javascript">commentPreview(1)</script>
	</div>
</div>
</body>
</html>
<?
function HighlightComment($str)
{
	$str = explode ('<code>',$str);
	foreach ($str as $key=>$line)
	{
		$code = substr($line,0,strpos($line,'</code>'));
		$txt = substr($line,strpos($line,'</code>')!==false?strpos($line,'</code>')+7:0);
		$result .= str_replace(array($code,'</code>',$txt),array('<div class="codesource">'.highlight_string($code,true).'</div>','', htmlentities($txt, ENT_QUOTES,'UTF-8')),$line);
	}
	return nl2br($result); // str_replace(array('<code>','</code>'), array('',''),
}
?>