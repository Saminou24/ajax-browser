<?
/**-------------------------------------------------
 | AJAX-Browser  -  by Alban LOPEZ
 | Copyright (c) 2006 Alban LOPEZ
 | Email bugs/suggestions to alban.lopez@gmail.com
 +--------------------------------------------------
 | This script has been created and released under
 | the GNU GPL and is free to use and redistribute
 | only if this copyright statement is not removed
 +--------------------------------------------------*/
?>
	<span class="close">
		<span style='padding:2px;'><a href="javascript:void(0)" onclick="location.href=location.href.replace(<? echo ($_GET['mode']=='arborescence') ? "'arborescence','gallerie'":"'gallerie','arborescence'";?>);"><? echo ($_GET['mode']=='arborescence')?'Mode Gallerie':'Mode Arborescence'; ?></a></span>
		<span style='padding:2px;'><a href="?stop"/>Sign Out</a></span><br>
		<span style='padding:2px;'><a href="http://sctfic.free.fr/Documentation/index.php">Documentation</a></span>
	</span>
	<img class="bottomleft" src="./.AJAX-Ico/Chat.png" onclick="HideBavar();">
	<img class="bottomright" src="./.AJAX-Ico/Chat.png" onclick="HideBavar();">
	<div style="position:fixed;bottom:0px;padding:1px;left:20px;right:20px;z-index:5;">
		<img class='close' style='margin-right:15px;' src='./.AJAX-Ico/Sup.png' onclick="ID('BavarZone').innerHTML = '';flux('Clear','');">
		<div id="BavarZone">
		</div>
	</div>
<div class="italic" style="margin:3px;"><span class="bold">
<?
class ACT_LNK
{
	var $level;
	var $img;
	var $lnk;
	var $info;
	function ACT_LNK ($level, $img, $lnk, $info)
	{
		$this->level	= $level;
		$this->img	= $img;
		$this->lnk	= $lnk;
		$this->info	= $info;
	}
}
	$REN		=	new ACT_LNK (3, "./.AJAX-Ico/Ren.png", "Rename();", "Renomer cet element, la selaction ou les contenus...");
	$NEW		=	new ACT_LNK (2, "./.AJAX-Ico/New.png", "New('".$racine."');", "Nouveau dossier ou fichier");
	$DOWNLOAD	=	new ACT_LNK (1, "./.AJAX-Ico/Download.png", "Download();", "Forcer le Telechargement");
	$UPLOAD		=	new ACT_LNK (2, "./.AJAX-Ico/Upload.png", "Upload('".$racine."');", "Depposer des fichiers ici");
	$DEL		=	new ACT_LNK (3, "./.AJAX-Ico/Sup.png", "Erase();", "Supprimer toute la selection");
	$MOVE		=	new ACT_LNK (3, "./.AJAX-Ico/Move.png", "Move();", "Deplacer la selection ici");
	$COPY		=	new ACT_LNK (2, "./.AJAX-Ico/Copy.png", "Copy();", "Copier la selection ici");
	$EDIT		=	new ACT_LNK (3, "./.AJAX-Ico/Edit.png", "Edit(SelFile);", "Editer en mode Colorisé");
	$LINK		=	new ACT_LNK (1, "./.AJAX-Ico/LinkAdd.png", "document.location=GET_add('login=anonymous');", "Extraire le lien vers ce dossier");
	$FIND_FILTER =	new ACT_LNK (1, "./.AJAX-Ico/FindFilter.png", "FindFilter();", "Filtre le contenu visible selon le masque.");

	$RELOAD	=	new ACT_LNK (1, "./.AJAX-Ico/Reload.png", "ReloadDir(SelFile);", "Recharger ce dossier");
	$MAIL	=	new ACT_LNK (1, "./.AJAX-Ico/E-mail.png", "PopBox('email');", "Contacter l'administrateur du Browser");
	$SETTING =	new ACT_LNK (4, "./.AJAX-Ico/Setting.png", "PopBox('setting');", "Config du browser");
	$USRCONF =	new ACT_LNK (1, "./.AJAX-Ico/User_edit.png", "PopBox('usrconf');", "Gestion de mon profil Utilisateur");
	$ACCOUNT =	new ACT_LNK (4, "./.AJAX-Ico/Account.png", "PopBox('account');", "Gestion des comptes Utilisateurs");
	$APROPOS =	new ACT_LNK (1, "./.AJAX-Ico/APropos.png", "PopBox('apropos');", "A Propos de AJAX-Icorowser.php");

	$BAR_LST = compact("NEW", "REN", "DEL", "DOWNLOAD", "UPLOAD", "MAIL", "FIND_FILTER");
	$MENU_LST = compact("NEW", "SOURCE", "EDIT", "REN", "DEL", "DOWNLOAD", "UPLOAD", "RELOAD", "MAIL");
	$RIGHT_LST = compact("LINK", "SETTING", "ACCOUNT", "USRCONF", "APROPOS");

	echo $_SESSION['name']." [".$_SERVER['REMOTE_ADDR']."] : </span>\n";
	echo $leveltxt[$_SESSION['level']].", (Level : ".$_SESSION['level'].")<br />\nLast loged : ".$_SESSION['last'].", Visit : ".array_sum ($_SESSION['IP-count'])."</div>\n";
	echo "<table id='MAM' class='width'><colgroup> <col width='295'><col><col width='150'></colgroup><tbody><tr><td style='padding-top:2px;'>";
	foreach ($BAR_LST as $key => $class)
		if ($_SESSION['level'] >= $class->level && (isset($GLOBALS['AJAX-Var'][$key])?$GLOBALS['AJAX-Var'][$key]:true))
			echo "<IMG onclick=\"".$class->lnk."\" src=\"".$class->img."\" title=\"".$class->info."\"/>\n";
	echo "</td><td style='font-size:11px;font-weight:bold;font-style:italic;text-align:center;'>$racine</td><td style='text-align: right;'>";
	foreach ($RIGHT_LST as $key => $class)
		if ($_SESSION['level'] >= $class->level && (isset($GLOBALS['AJAX-Var'][$key])?$GLOBALS['AJAX-Var'][$key]:true))
			echo "<IMG onclick=\"".$class->lnk."\" src=\"".$class->img."\" title=\"".$class->info."\"/>\n";
	echo "</td></tr></tbody></table>"
?>
