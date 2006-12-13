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

if (isset($_GET['save']))
{
	$GLOBALS['AJAX-Var']["ip-spy"] = $_POST['IP_SPY']=='true'?true:false;
	$GLOBALS['AJAX-Var']["E-Mail"] = $_POST['E_MAIL'];
	$GLOBALS['AJAX-Var']["restrict-type"] = explode(",",$_POST['RESTRICT_TYPE']);
	$GLOBALS['AJAX-Var']["always-type"] = explode(",",$_POST['ALWAYS_TYPE']);
		$GLOBALS['AJAX-Var']["REN"] = $_POST['RENAME']=='true'?true:false;
		$GLOBALS['AJAX-Var']["NEW"] = $_POST['NEW']=='true'?true:false;
		$GLOBALS['AJAX-Var']["DOWNLOAD"] = $_POST['DOWNLOAD']=='true'?true:false;
		$GLOBALS['AJAX-Var']["UPLOAD"] = $_POST['UPLOAD']=='true'?true:false;
		$GLOBALS['AJAX-Var']["DEL"] = $_POST['DEL']=='true'?true:false;
		$GLOBALS['AJAX-Var']["MOVE"] = $_POST['MOVE']=='true'?true:false;
		$GLOBALS['AJAX-Var']["COPY"] = $_POST['COPY']=='true'?true:false;
		$GLOBALS['AJAX-Var']["EDIT"] = $_POST['EDIT']=='true'?true:false;
		$GLOBALS['AJAX-Var']["MAIL"] = $_POST['CONTACT']=='true'?true:false;
		$GLOBALS['AJAX-Var']["LINK"] = $_POST['LINK']=='true'?true:false;
	WriteInFile ($File, serialize($GLOBALS['AJAX-Var']), "remplace");
	var_export($GLOBALS['AJAX-Var']);
	exit();
}
else
{
?>
<table width="400px">
	<tr title='Adresse des administrateurs'>
		<td>Admin E-Mail : </td>
		<td style="text-align:right;"><input style="width:260px;" name='E_MAIL' value="<? echo $GLOBALS['AJAX-Var']["E-Mail"];?>"></td>
	</tr>
	<tr title='Seul les ADMIN peuvent editer, modifier ou uploader'>
		<td>Restrict files types : </td>
		<td style="text-align:right;"><input style="width:260px;" name='RESTRICT_TYPE' value="<? echo implode(',',$GLOBALS['AJAX-Var']['restrict-type']);?>"></td>
	</tr>
	<tr title='Type de fichier ouvert a tous en upload, sauf au Reader'>
		<td>Uploader files types : </td>
		<td style="text-align:right;"><input style="width:260px;" name='ALWAYS_TYPE' value="<? echo implode(',',$GLOBALS['AJAX-Var']['always-type']);?>"></td>
	</tr>
	<tr>
		<td colspan=2 style="text-align:center;"><input type='checkbox' name='IP_SPY' id='IP_SPY' <? echo ($GLOBALS['AJAX-Var']['ip-spy'] ? "checked": "");?>><label for='IP_SPY'>Espion de Log</label></td>
	</tr>
</table>
<table id="ActFunc" width="400px">
	<colgroup><col width='50%'><col width='50%'></colgroup>
	<tr><td colspan=2 style="text-align:center;font-weight:bold;"><br>Functions Activées :</td></tr>
	<tr>
		<td><input type='checkbox' name='DEL' id='DEL' <? echo ($GLOBALS['AJAX-Var']['DEL'] ? "checked": "");?>><label for="DEL"><IMG src="./.AJAX-Ico/Sup.png">SUPPRIMER</label></td>
		<td style="text-align:right;"><label for='NEW'>CREER<IMG src="./.AJAX-Ico/New.png"></label><input type='checkbox' name='NEW' id='NEW' <? echo ($GLOBALS['AJAX-Var']['NEW'] ? "checked": "");?>></td>
	</tr>
	<tr>
		<td><input type='checkbox' name='DOWNLOAD' id='DOWNLOAD'<? echo ($GLOBALS['AJAX-Var']['DOWNLOAD'] ? "checked": "");?>><label for='DOWNLOAD'><IMG src="./.AJAX-Ico/Download.png">TELECHARGER</label></td>
		<td style="text-align:right;"><label for='UPLOAD'>UPLODER<IMG src="./.AJAX-Ico/Upload.png"></label><input type='checkbox' name='UPLOAD' id='UPLOAD' <? echo ($GLOBALS['AJAX-Var']['UPLOAD'] ? "checked": "");?>></td>
	</tr>
	<tr>
		<td><input type='checkbox' name='COPY' id='COPY' <? echo ($GLOBALS['AJAX-Var']['COPY'] ? "checked": "");?>><label for='COPY'><IMG src="./.AJAX-Ico/Copy.png">COPIER</label></td>
		<td style="text-align:right;"><label for='MOVE'>DEPLACER<IMG src="./.AJAX-Ico/Move.png"></label><input type='checkbox' name='MOVE' id='MOVE' <? echo ($GLOBALS['AJAX-Var']['MOVE'] ? "checked": "");?>></td>
	</tr>
	<tr>
		<td><input type='checkbox' name='RENAME' id='RENAME' <? echo ($GLOBALS['AJAX-Var']['REN'] ? "checked": "");?>><label for='RENAME'><IMG src="./.AJAX-Ico/Ren.png">RENOMER</label></td>
		<td style="text-align:right;"><label for='EDIT'>EDITER<IMG src="./.AJAX-Ico/Edit.png"></label><input type='checkbox' name='EDIT' id='EDIT' <? echo ($GLOBALS['AJAX-Var']['EDIT'] ? "checked": "");?>></td>
	</tr>
	<tr>
		<td><input type='checkbox' name='CONTACT' id='CONTACT' <? echo ($GLOBALS['AJAX-Var']['MAIL'] ? "checked": "");?>><label for='CONTACT'><IMG src="./.AJAX-Ico/E-mail.png">CONTACTER L'ADMIN</label></td>
		<td style="text-align:right;"><label for='LINK'>OBTENIR L'URL DIRECT<IMG src="./.AJAX-Ico/LinkAdd.png"></label><input type='checkbox' name='LINK' id='LINK' <? echo ($GLOBALS['AJAX-Var']['LINK'] ? "checked": "");?>></td>
	</tr>
</table>
<table width="400px"><tr><td style="width:50%;"><a href="javascript:void(0)" onclick="location.href='?update'">Update Now !</a>
</td><td class="button center" style="width:50%;" onclick="submitSetting('setting&save');this.parentNode.parentNode.parentNode.parentNode.parentNode.style.display='none';">OK</td></tr></table>
<?
}
?>
