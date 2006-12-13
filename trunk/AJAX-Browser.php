<?php
/**-------------------------------------------------
 | AJAX-Browser  -  by Alban LOPEZ
 | Copyright (c) 2006 Alban LOPEZ
 | Email bugs/suggestions to alban.lopez@gmail.com
 +--------------------------------------------------
 | This script has been created and released under
 | the GNU GPL and is free to use and redistribute
 | only if this copyright statement is not removed
 +--------------------------------------------------*/

	require ("./.AJAX-B/PHP-Init.php");
	$infos = InfosByURL ($racine);
?>
<html>
	<head>
		<meta content="text/html; charset=UTF-8" http-equiv="content-type">
		<title>AJAX-Browser : Gestionnaire de site WEB par protocole http</title>
	</head>
<?
	include ("./.AJAX-B/CSS-Common.php");
	include ("./.AJAX-B/JS-Common.php");
	include ("./.AJAX-B/JS-PostFunc.php");
	include ("./.AJAX-B/PHP-MenuBar.php");
if ($_GET['mode']=="arborescence")
{
	$OverTime = 1;
	include ("./.AJAX-B/CSS-Arborescence.php");?>
	<script type="text/javascript" src="./.AJAX-B/JS-Arborescence.js"></script>
	<body onload="LOHD('<? echo str_replace('%2F','/',rawurlencode($racine)); ?>');">
	<form name="BrowsAct" id="BrowsAct" METHOD='post' action="" onSubmit="alert('AJAX-Browser.php\nBrowsAct.submit');return false;" enctype='multipart/form-data'>
		<input name="Action" id="Action" type="hidden" value="" />
		<input name="Mask" id="Mask" type="hidden" value="" />
			<div id="TableFile" border=0 width="100%">
<div class='DivGroup' <? echo ($infos[0]!=$infos[1]) ? "id='".str_replace('%2F','/',rawurlencode(UrlSimplied(rawurldecode($infos[0]))))."'" : ""; ?>>
	<div class='This' onmousedown='MCE(this.parentNode,event);' onmouseover="this.childNodes[1].childNodes[4].onmousedown = thisOnMouseDown;this.onmouseup = thisPaste;">
		<span class='left'>
			<input onchange='SDGCA(this);' type="checkbox" name="Lst[]" value="<? echo UrlSimplied($infos[0]);?>"/>
			<span class="IndentImg"></span><span class="IcoName">
				<IMG src="./.AJAX-Ico/type-folder...png" <? echo ($infos[0]!=$infos[1]) ? "onclick='OpenClick(this.parentNode.parentNode.parentNode.parentNode);'" : ""; ?>/>
				<span class="Name"><? echo UrlSimplied(rawurldecode($infos[0])); ?></span>
			</span>
		</span>
		<span class="right bold italic">
			<div class="RowInfos">Inf</div>
			<div class="RowMenu">Menu</div>
			<div class="RowTaille">Taille</div>
			<div class="RowMIME">MIME</div>
			<div class="RowDate">Date</div>
			<div class="RowDroits">Droits</div>
		</span>
	</div>
	<div class='Content' style='display:block;'>
		<div class='DivGroup' id="<? echo str_replace('%2F','/',rawurlencode($racine)); ?>">
			<div onmousedown='MCE(this.parentNode,event);' class='This' onmouseover="this.childNodes[1].childNodes[4].onmousedown = thisOnMouseDown;this.onmouseup = thisPaste;">
				<span class='left' title="<? echo $infos[9]." Dossier(s) et ".$infos[10]." Fichier(s)"; ?>">
					<input onchange='SDGCA(this);' type="checkbox" name="Lst[]" value="<? echo str_replace('%2F','/',rawurlencode($racine));?>"/>
					<span class="IndentImg"><IMG src='./.AJAX-Ico/EndDirPlus.png' onclick="LOHD(this.parentNode.parentNode.parentNode.parentNode.id);"/></span><span class="IcoName"><IMG src="./.AJAX-Ico/type-folder..png"/>
						<span class="Name"><? echo rawurldecode($infos[1]);?></span>
					</span>
				</span>
				<span class="right">
					<div class="RowInfos" onclick="PopBox('infos='+UrlFormat (this.parentNode.parentNode.parentNode.id));"></div>
					<div class="RowMenu" onclick="ShowMenuMAI (this.parentNode.parentNode.parentNode.id, event);"></div>
					<? if (($tmp=SizeDir ($racine))!=-1) { echo "<div class='RowTaille' title='".$tmp." Octés'>".SizeConvert ($tmp)."</div>\n";} else { ?><div class='RowOverTaille' onclick="RequestSize('<? echo $racine; ?>');" title="Calculer maintenant"></div><? } ?>
					<div class="RowMIME"><? echo $infos[3]; ?></div>
					<div class="RowDate" title="<? echo $infos[4]; ?>"><? echo substr ($infos[4],0,8);?></div>
					<div class="RowDroits" title="UID:<? echo $infos[6];?> (<? echo $infos[7]; ?>) , GID:<? echo $infos[8];?> (<? echo $infos[9]; ?>)"><? echo $infos[5];?></div>
				</span>
			</div>
			<div class='Content'>
			</div>
		</div>
	</div>
				</div>
			</div>
<? } elseif ($_GET['mode']=="gallerie") {
	include ("./.AJAX-B/CSS-Gallerie.php");?>
	<script type="text/javascript" src="./.AJAX-B/JS-Gallerie.js"></script>
	<body onload="OCG('shortsubdir='+UrlFormat ('<? echo $racine;?>'));">
	<form name="BrowsAct" id="BrowsAct" METHOD='post' action="" onSubmit="alert('AJAX-Browser.php\nBrowsAct.submit');return false;" enctype='multipart/form-data'>
		<input name="Action" id="Action" type="hidden" value="" />
		<input name="Mask" id="Mask" type="hidden" value="" />
		<div id='Gal'>
			<div id="<? echo $infos[0];?>" title="<? echo UrlSimplied($infos[0]);?>" ondblclick="OpenClick(this);" onmousedown='MCE(this,event);'>
				<table><tbody><tr><td>
					<img src="./.AJAX-Ico/type-folder...png"><br>
					<p class="name"><? echo UrlSimplied($infos[0]);?></p>
				</td></tr></tbody></table>
				<input onchange="SDGCG(this);" name="Lst[]" value="<? echo $infos[0];?>" type="checkbox">
			<span class="menu">
				<span class="info">
					<span class="menuClicker" onclick="ShowMenuMAI (this.parentNode.parentNode.parentNode.id, event);"></span>
					<span class="infoClicker" onclick="PopBox('infos='+UrlFormat(this.parentNode.parentNode.parentNode.id));"></span>
				</span>
			</span>
			</div>
		</div>
<?
}
?>
	</form>
<?
	include ("./.AJAX-B/PHP-MenuPop.php");
?>
<form action="https://www.paypal.com/cgi-bin/webscr" method="post" style="text-align:right;">
	<input type="hidden" name="cmd" value="_s-xclick">
	<input type="image" src="https://www.paypal.com/fr_FR/i/btn/x-click-but04.gif" border="0" name="submit" alt="Effectuez vos paiements via PayPal : une solution rapide, gratuite et sécurisée">
	<img alt="" border="0" src="https://www.paypal.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
	<input type="hidden" name="encrypted" value="-----BEGINPKCS7-----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-----ENDPKCS7-----">
</form>
	</body>
</html>