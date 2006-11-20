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

$GLOBALS['AJAX-Var'] = unserialize(file_get_contents($File));
if (isset($_GET['usrconf']) && isset($_GET['save']))
{
	$UserName = $_SESSION['name'];
	if (!empty($_POST['NewCode'])){ echo "code modifier => ".$_POST['NewCode'];
		$GLOBALS['AJAX-Var']["users-infos"][$UserName]["code"] = crypt($_POST['CODE'],$UserName);}
	$GLOBALS['AJAX-Var']["users-infos"][$UserName]["hidden-file"] = $_POST['FICHIER_CACHER']=='true'?true:false;
	$GLOBALS['AJAX-Var']["users-infos"][$UserName]["def-mode"] = $_POST['DEF_VIEW'];
	$GLOBALS['AJAX-Var']["users-infos"][$UserName]["def-racine"] = $_POST['DEF_DIR'];
	list($GLOBALS['AJAX-Var']["users-infos"][$UserName]["mini-size"]) = sscanf($_POST['MINI_SIZE'], "%d");
	$GLOBALS['AJAX-Var']["users-infos"][$UserName]["speed"] = $_POST['SPEED'];
	WriteInFile ($File, serialize($GLOBALS['AJAX-Var']), "remplace");
	var_export($GLOBALS['AJAX-Var']["users-infos"][$UserName]);
		$_SESSION = $GLOBALS['AJAX-Var']["users-infos"][$UserName];
		$_SESSION['name'] = $UserName;
	exit();
}
elseif (isset($_GET['usrconf']))
{
	$UserName = $_SESSION['name'];
?>
	<div class="center bold italic"><? echo $UserName; ?>
		<table class="LstArray center" style="width:200px;margin:3px;">
			<tr><td colspan=2><input style="float:left;" title="Code crypté (modifier pour le remplacer)" disabled=true type='text' name='CODE' value="<? echo $GLOBALS['AJAX-Var']['users-infos'][$UserName]['code']; ?>"/><input style="float:right;" title="Spécifier un nouveau code" type='checkbox' onchange="this.previousSibling.disabled=!this.checked;this.previousSibling.value='';" name="NewCode"/> </td></tr>
			<tr><td colspan=2 title="Mode d'affichage par defaut"><SELECT name="DEF_VIEW">
						<OPTION VALUE="arborescence" <? echo ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['def-mode']=='arborescence') ? "selected=true" : ""; ?> >Arborescence</OPTION>
						<OPTION VALUE="gallerie" <? echo ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['def-mode']=='gallerie') ? "selected=true" : ""; ?> >Gallerie</OPTION>
				</SELECT></td></tr>
			<tr><td colspan=2 title="Repertoire par defaut">
					<INPUT style="float:left;" type='text' name="DEF_DIR" VALUE="<? echo $GLOBALS['AJAX-Var']['users-infos'][$UserName]['def-racine']; ?>"/><span style="float:right;" class="button" onclick="this.previousSibling.value=(GET['racine'].split('='))[1];">ici</span>
				</td></tr>
			<tr><td colspan=2 title="Taille des miniature de la gallerie"><SELECT name="MINI_SIZE">
						<OPTION VALUE="100" <? echo ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['mini-size']==100)?"selected=true":"";?> >Moyenne (100px)</OPTION>
						<OPTION VALUE="200" <? echo ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['mini-size']==200)?"selected=true":"";?> >Grande (200px)</OPTION>
						<OPTION VALUE="300" <? echo ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['mini-size']==300)?"selected=true":"";?> >Enorme (300px)</OPTION>
				</SELECT></td></tr>
			<tr><td colspan=2 title="Calculer la taille des dossiers"><SELECT name="SPEED">
						<OPTION VALUE="auto" <? echo ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['speed']=="auto")?"selected=true":"";?> >Automatique</OPTION>
						<OPTION VALUE="yes" <? echo ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['speed']=="yes")?"selected=true":"";?> >Jamais</OPTION>
						<OPTION VALUE="no" <? echo ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['speed']=="no")?"selected=true":"";?> >Toujours</OPTION>
				</SELECT></td></tr>
			<? if ($_SESSION['level']>2) echo "<tr><td colspan=2 title='Voit les fichiers cachés'><input type='checkbox' name='FICHIER_CACHER' id='FICHIER_CACHER' ".($GLOBALS['AJAX-Var']['users-infos'][$UserName]['hidden-file'] ? "checked": "")."><label for='FICHIER_CACHER'>Voit les fichiers cachés</label></td></tr>"; ?>
			<tr><td colspan=2 title="Detail des connection"><SELECT>
		<? foreach ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['IP-count'] as $ip => $n) echo "<OPTION>".$n." => [".$ip."]</OPTION>";?>
				</SELECT></td></tr>
			<tr><td class="button" style="width:50%;" onclick="this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.style.display='none';">Cancel</td><td class="button" style="width:50%;" onclick="submitMy('usrconf&save');this.parentNode.parentNode.parentNode.parentNode.parentNode.parentNode.style.display='none';">OK</td></tr>
		</table>
	</div>
<?
}
elseif ($_SESSION['level']<4) exit();

// ============= le reste est reservé aux ADMIN ===========

if (isset($_GET['account']) && empty($_GET['account']))
{
?>
<div style="max-height:160px;overflow:auto;">
	<table id='UsrLst' class="LstArray">
		<colgroup><col width='130px'><col width='30px'></colgroup>
			<?
			foreach ($GLOBALS['AJAX-Var']['users-infos'] as $UserName => $UserConf)
			{
			?>
			<tr title="Derniere visite : <? echo $GLOBALS['AJAX-Var']['users-infos'][$UserName]['last']; ?>">
				<td class="bold italic"><? echo $UserName;?></td>
				<td>
					<IMG src='./.AJAX-Ico/Infos.png' title='Modifier ce compte' onclick="PopBox('account='+UrlFormat ('<? echo $UserName;?>')+'&edit');"/>
					<IMG src='./.AJAX-Ico/Trash.png' title='Supprimer ce compte' onclick="DelUsr (UrlFormat ('<? echo $UserName;?>'));"/>
				</td>
			</tr>

			<?
			}
			?>
	</table>
</div>
<div class="button center"  onclick="MakeNewUsr ();">Ajouter un Utilisateur</div>
<?
}
elseif (!empty($_GET['account']) && isset($_GET['new']))
{
	if (!isset($GLOBALS['AJAX-Var']["users-infos"][$_GET['account']]))
	{
		$GLOBALS['AJAX-Var']["users-infos"][$_GET['account']] = array ('level' => 1,'code' => crypt('',$_GET['account']),'def-mode' => 'gallerie','hidden-file' => false,'mini-size' => 200,'IP-count' => array (),'last' => '',);
		WriteInFile ($File, serialize($GLOBALS['AJAX-Var']), "remplace");
	}
}
elseif (!empty($_GET['account']) && isset($_GET['edit']))
{
	$UserName = $_GET['account'];
?>
	<div class="center bold italic"><? echo $UserName; ?>
		<table class="LstArray center" style="width:200px;margin:3px;">
			<tr><td colspan=2><input style="float:left;" title="Code crypté (modifier pour le remplacer)" disabled=true type='text' name='CODE' value="<? echo $GLOBALS['AJAX-Var']['users-infos'][$UserName]['code']; ?>"/><input style="float:right;" title="Spécifier un nouveau code" type='checkbox' onchange="this.previousSibling.disabled=!this.checked;this.previousSibling.value='';" name="NewCode"/> </td></tr>
			<tr><td colspan=2 title="Niveau d'accée aux a travers AJAX-Browser"><SELECT name="LEVEL">
						<OPTION VALUE=1 <? echo ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['level']==1)?"selected=true":"";?> title="Ne peut que lire">Reader</OPTION>
						<OPTION VALUE=2 <? echo ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['level']==2)?"selected=true":"";?> title="Peut lire, créer, uploader mais ni modifier, ecraser ou supprimer">Uploader</OPTION>
						<OPTION VALUE=3 <? echo ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['level']==3)?"selected=true":"";?> title="Peut tous faire, mais ne gère pas les comptes">Writer</OPTION>
						<OPTION VALUE=4 <? echo ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['level']==4)?"selected=true":"";?> title="Peut tous faire, et gere les comptes">Admin</OPTION>
				</SELECT></td></tr>
			<tr><td colspan=2 title="Mode d'affichage par defaut"><SELECT name="DEF_VIEW">
						<OPTION VALUE="arborescence" <? echo ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['def-mode']=='arborescence') ? "selected=true" : ""; ?> >Arborescence</OPTION>
						<OPTION VALUE="gallerie" <? echo ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['def-mode']=='gallerie') ? "selected=true" : ""; ?> >Gallerie</OPTION>
				</SELECT></td></tr>
			<tr><td colspan=2 title="Repertoire par defaut">
					<INPUT style="float:left;" type='text' name="DEF_DIR" VALUE="<? echo $GLOBALS['AJAX-Var']['users-infos'][$UserName]['def-racine']; ?>"/><span style="float:right;" class="button" onclick="this.previousSibling.value=(GET['racine'].split('='))[1];">ici</span>
				</td></tr>
			<tr><td colspan=2 title="Taille des miniature de la gallerie"><SELECT name="MINI_SIZE">
						<OPTION VALUE="100" <? echo ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['mini-size']==100)?"selected=true":"";?> >Moyenne (100px)</OPTION>
						<OPTION VALUE="200" <? echo ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['mini-size']==200)?"selected=true":"";?> >Grande (200px)</OPTION>
						<OPTION VALUE="300" <? echo ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['mini-size']==300)?"selected=true":"";?> >Enorme (300px)</OPTION>
				</SELECT></td></tr>
			<tr><td colspan=2 title="Calculer la taille des dossiers"><SELECT name="SPEED">
						<OPTION VALUE="auto" <? echo ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['speed']=="auto")?"selected=true":"";?> >Automatique</OPTION>
						<OPTION VALUE="yes" <? echo ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['speed']=="yes")?"selected=true":"";?> >Jamais</OPTION>
						<OPTION VALUE="no" <? echo ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['speed']=="no")?"selected=true":"";?> >Toujours</OPTION>
				</SELECT></td></tr>
			<tr><td colspan=2 title="Voit les fichiers cachés"><input type='checkbox' name='FICHIER_CACHER' id='FICHIER_CACHER'<? echo ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['hidden-file'] ? "checked": "");?>><label for='FICHIER_CACHER'>Voit les fichiers cachés</label></td></tr>
			<tr><td colspan=2 title="Detail des connection"><SELECT>
		<? foreach ($GLOBALS['AJAX-Var']['users-infos'][$UserName]['IP-count'] as $ip => $n) echo "<OPTION>".$n." => [".$ip."]</OPTION>";?>
				</SELECT></td></tr>
			<tr><td class="button" style="width:50%;" onclick="PopBox('account');">Cancel</td><td class="button" style="width:50%;" onclick="submitUsr('account='+UrlFormat ('<? echo $UserName; ?>')+'&save');">OK</td></tr>
		</table>
	</div>
<?
}
elseif (!empty($_GET['account']) && isset($_GET['save']))
{
	if ($_POST['NewCode'])
		$GLOBALS['AJAX-Var']["users-infos"][$_GET['account']]["code"] = crypt($_POST['CODE'],$_GET['account']);
	list($GLOBALS['AJAX-Var']["users-infos"][$_GET['account']]["level"]) = sscanf($_POST['LEVEL'], "%d");
	$GLOBALS['AJAX-Var']["users-infos"][$_GET['account']]["hidden-file"] = $_POST['FICHIER_CACHER']=='true'?true:false;
	$GLOBALS['AJAX-Var']["users-infos"][$_GET['account']]["def-mode"] = $_POST['DEF_VIEW'];
	$GLOBALS['AJAX-Var']["users-infos"][$_GET['account']]["def-racine"] = $_POST['DEF_DIR'];
	list($GLOBALS['AJAX-Var']["users-infos"][$_GET['account']]["mini-size"]) = sscanf($_POST['MINI_SIZE'], "%d");
	$GLOBALS['AJAX-Var']["users-infos"][$_GET['account']]["speed"] = $_POST['SPEED'];
	WriteInFile ($File, serialize($GLOBALS['AJAX-Var']), "remplace");
	var_export($GLOBALS['AJAX-Var']["users-infos"][$_GET['account']]);
}
elseif (!empty($_GET['account']) && isset($_GET['delete']))
{
	if (isset($GLOBALS['AJAX-Var']["users-infos"][$_GET['account']]))
	{
		unset($GLOBALS['AJAX-Var']["users-infos"][$_GET['account']]);
		WriteInFile ($File, serialize($GLOBALS['AJAX-Var']), "remplace");
	}
}
?>
