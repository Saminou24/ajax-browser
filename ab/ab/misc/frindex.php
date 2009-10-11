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
<div><object width="280" height="220"><param name="movie" value="http://www.dailymotion.com/swf/7F1bsmmGS1nEWomqW"></param><param name="allowFullScreen" value="true"></param><param name="allowScriptAccess" value="always"></param><embed src="http://www.dailymotion.com/swf/7F1bsmmGS1nEWomqW" type="application/x-shockwave-flash" width="280" height="220" allowFullScreen="true" allowScriptAccess="always"></embed></object><br /><b><a href="http://www.dailymotion.com/video/x3gg0u_demo_ads">Demo</a></b><br /></div>
<a href="../../Archives/Videos/Demo.ogg">Demo</a><br/><br/>
<a href="../../Archives/Videos/AJAX-B_Download_and_Install.ogg">Video haute qualitée (Instalation)</a><br/>
<a href="../../Archives/Videos/AJAX-B_Setting.ogg">Video haute qualitée (Setting)</a><br/>
</div>
<div id="main">
	<h4 style="text-align:justify;">
	AJAX-Browser permet de parcourir votre domaine web, de visualiser les fichiers en mode arborescence ou gallerie, et vous rendra un grand nombre de services li&eacute;s &agrave; la gestion de fichiers.<br/><br/>
	Enti&egrave;rement &eacute;crit en AJAX pour un maximun de fluidit&eacute; (contrairement aux equivalents PHP, tr&eacute;s lourds &agrave; l'usage).<br/><br/>
	AJAX-Browser utilise exclusivement le protocole HTTP afin de contourner les restrictions FTP.<br/><br/>
	L'int&eacute;gration d'outils tels que <a href="../ViewCode.php?file=../AJAX-B/scripts/EasyArchive.class.php">EasyArchive.class.php</a> (par moi, Alban LOPEZ ;-) pour la gestion des fichiers compr&eacute;ss&eacute;s et <a href="http://codepress.free.fr">CodePress</a> (par Fernando M.A.d.S. et Michael Hurni) pour l'edition de fichiers sources en ligne, ajoute en polyvalence, le tout distribu&eacute; gratuitement sous licence LGPL.
	</h4>
<h3>Pr&eacute;sentation</h3>
	<p style="text-align:justify;">AJAX-Bowser est un explorateur de domaine permettant une gestion compl&egrave;te des fichiers et dossiers pr&eacute;sents sur votre domaine.
	il permet de contourner certains aspects du FTP qui sur certains serveurs ou depuis certains clients s'av&egrave;rent restrictifs.<br></p>
<ul>
	<li><strong>100% compatible Konqueror et Firefox (0% IE)</strong></br>oui je developpe sur un environnement 100% linux (kubuntu) donc IE... </li>
	<li>Une <strong>refonte totale</strong> du logiciel est en cours suite &agrave; un bug profond sur la gestion des fichiers contenant dans leur nom un caract&eacute;re accentu&eacute; ou exotique.</li>
</ul>
</div>
<h3>Contraintes et probl&egrave;mes connus</h3>
<ul>
	<li>AJAX-Browser ne fonctionne pas avec Internet Explorer, le d&eacute;veloppement d'un mode d&eacute;grad&eacute; vient d'&eacute;tre achev&eacute; (&eacute; l'image d'IE, tr&eacute;s d&eacute;grad&eacute; ;-)</li>
	<li>Plusieurs browsers sur une m&ecirc;me page ne fonctionnent pas (encore) sauf par IFRAME.</li>
	<li>La gestion des caract&eacute;res sp&eacute;ciaux dans les noms de fichiers et dossiers est en cours de d&eacute;veloppement.</li>
</ul>
<p>Cependant, grace au lien de mise a jour automatique (savamment developp&eacute;), vous pourrez b&eacute;n&eacute;ficier de toutes ces am&eacute;liorations d&egrave;s leur developpement et ce sur un simple click, depuis la page de config de votre AJAX-Browser.</p>
<h3>Licence & auteur</h3>
<p>
	AJAX-Browser est distribu&eacute; sous licence <a href="http://www.opensource.org/licenses/lgpl-license.php">LGPL</a>. Si votre logiciel est <a href="http://www.gnu.org/philosophy/license-list.html#GPLCompatibleLicenses">compatible</a> avec cette licence ou est plac&eacute; sous licence <a href="http://creativecommons.org/">Creative Commons</a>, vous pouvez l'utiliser sans contraintes. Seul le maintient des copyrights est n&eacute;c&eacute;ssaire.
</p>
<p>
	L'auteur, c'est moi, alban LOPEZ mais ne pensez pas que je suis tout seul a develop&eacute; parceque je suis bon, la r&eacute;alit&eacute;e est que je ne sais pas me sevir de <a href="http://ajax-browser.googlecode.com/svn/trunk/">SVN</a> !!!<br />
	Mais bon j'y travaille ...
	<a href="http://code.google.com/p/ajax-browser/source">SVN sur code.google</a>
</p>
<h3>Commentaires</h3>
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
		<a href="http://" id="yoururl"><strong id="yourname" class="name">Votre Nom</strong></a> : <strong id="yourdate"><?=date("Y-m-d",time())?></strong>
		<p id="yourtext">Votre commentaires</p>
	</div>
<!--/comments-->
	<div id="postcomment">
		<form name="comm">
			<input type="text" name="cname" value="Votre nom" onkeyup="commentPreview()" onclick="if(this.value=='Votre nom')this.value=''" /><br />
			<input type="text" name="curl" value="http://" onkeyup="commentPreview()" /><br />
			<textarea name="ccomment" onkeyup="commentPreview()" onclick="if(this.value=='Votre commentaire')this.value=''" onfocus="if(this.value=='Votre commentaire')this.value=''">Votre commentaire</textarea><br />
		</form>
		<p>Encadrer les extraits de code par les balises &lt;code&gt; et &lt;/code&gt;</p>
		<button onclick="commentAdd()">Envoyer</button>
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