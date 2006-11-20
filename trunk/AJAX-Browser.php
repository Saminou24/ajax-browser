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
	<body onload="LOHD('<? echo $racine; ?>');">
	<form name="BrowsAct" id="BrowsAct" METHOD='post' action="" onSubmit="alert('AJAX-Browser.php\nBrowsAct.submit');return false;" enctype='multipart/form-data'>
		<input name="Action" id="Action" type="hidden" value="" />
		<input name="Mask" id="Mask" type="hidden" value="" />
			<div id="TableFile" border=0 width="100%">
<div class='DivGroup' <? echo ($infos[0]!=$infos[1]) ? "id='".UrlSimplied($infos[0])."'" : ""; ?>>
	<div class='This' onmousedown='MCE(this.parentNode,event);' onmouseover="this.childNodes[1].childNodes[4].onmousedown = thisOnMouseDown;this.onmouseup = thisPaste;">
		<span class='left'>
			<input onchange='SDGCA(this);' type="checkbox" name="Lst[]" value="<? echo UrlSimplied($infos[0]);?>"/>
			<span class="IndentImg"></span><span class="IcoName">
				<IMG src="./.AJAX-Ico/type-folder...png" <? echo ($infos[0]!=$infos[1]) ? "onclick='OpenClick(this.parentNode.parentNode.parentNode.parentNode);'" : ""; ?>/>
				<span class="Name"><? echo UrlSimplied($infos[0]); ?></span>
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
		<div class='DivGroup' id="<? echo $racine; ?>">
			<div onmousedown='MCE(this.parentNode,event);' class='This' onmouseover="this.childNodes[1].childNodes[4].onmousedown = thisOnMouseDown;this.onmouseup = thisPaste;">
				<span class='left' title="<? echo $infos[9]." Dossier(s) et ".$infos[10]." Fichier(s)"; ?>">
					<input onchange='SDGCA(this);' type="checkbox" name="Lst[]" value="<? echo $racine;?>"/>
					<span class="IndentImg"><IMG src='./.AJAX-Ico/EndDirPlus.png' onclick="LOHD(this.parentNode.parentNode.parentNode.parentNode.id);"/></span><span class="IcoName"><IMG src="./.AJAX-Ico/type-folder..png"/>
						<span class="Name"><? echo $infos[1];?></span>
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
	</body>
</html>