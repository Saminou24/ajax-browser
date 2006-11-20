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

function Edit($file)
{
?>
<html>
	<head>
		<meta content="text/html; charset=UTF-8" http-equiv="content-type">
		<title>AJAX-Browser Editor with CodePress</title>
	</head>
	<script>
		function getCode()
		{
			var xhr_obj = null;
			var IFrameObj = document.getElementById('codepress');
			if (window.XMLHttpRequest)
			{
				xhr_obj = new XMLHttpRequest();
				xhr_obj.onreadystatechange = function()
				{
					if(xhr_obj.readyState == 4)
					{
						if(xhr_obj.status == 200 && xhr_obj.responseText.length==19)
							IFrameObj.parentNode.childNodes[3].childNodes[1].innerHTML = "Last Saved : "+xhr_obj.responseText;
						else
							alert("Erreur d'enregistrement :\n"+xhr_obj.responseText);
					}
				};
				xhr_obj.open("POST", "?edit="+UrlFormat('<? echo urlencode($file);?>'), true);
				xhr_obj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr_obj.send("save="+UrlFormat(IFrameObj.contentWindow.CodePress.getCode()));
			}
			else XMLHttpRequestERROR()
		}
		function UrlFormat (url)
		{
			while ( url.length != (url = url.replace("'","%27").replace("#","%23").replace("\"","%22").replace("&","%26").replace("=","%3d").replace("?","%3f").replace(" ","%20")).length);
			return url;
		}
	</script>
	<body style="font-size:11;">
		<div style="margin-bottom:40px;font-size:18;font-weight:bold;font-style:italic;"><? echo $file;?></div>
		<span style="position:absolute;top:3px;right:3px;text-align:right;">
			<a id="save" href="javascript:void(0)" onclick="getCode()">Enregistrer</a><br>
	<?
			if ($GLOBALS['AJAX-Var']["DOWNLOAD"])
				echo "	<a href='?download=".urlencode($file)."'>Télécharger</a><br>";
			echo "	<a href='".substr($file,2)."'>Executer</a><br>";
			if ($_SESSION['level']>=3 && $GLOBALS['AJAX-Var']["SOURCE"])
				echo "	<a href='?source=".urlencode($file)."'>Colorisée</a><br>";
	?>
		</span>
	<iframe id="codepress" width="100%" height="400px" src="?edit&file=<? echo $file; ?>&bulk"></iframe>
	</body>
</html>
<?
}
function Source($file)
{
	if (is_file($file))
	{
		if (filesize ($file)<300000)
		{
?>
<html>
	<body style="font-size:11;">
		<h3 style="font-size:15;font-weight:bold;font-style:italic;"><? echo $file;?></h3><br>
		<span style="position:absolute;top:3px;right:3px;text-align:right;">
<?
		if ($GLOBALS['AJAX-Var']["DOWNLOAD"])
			echo "	<a href='?download=".urlencode($file)."'>Télécharger</a><br>";
		echo "	<a href='".substr($file,2)."'>Executer</a><br>";
		if ($_SESSION['level']>=3 && $GLOBALS['AJAX-Var']["EDIT"])
			echo "	<a href='?edit=".urlencode($file)."'>Editer</a><br>";
?>
		</span>
		<hr>
<?
			if (filesize ($file)<100000)  echo show_source($file, TRUE);
			else echo file_get_contents($file);
?>
	</body>
</html>
<?
		}
		else echo "<html>	<body>\"".$file."\" : est trop volumineux pour etre ouvert a distance</body></html>";
	}
	else echo "<html>	<body>\"".$file."\" : est introuvable</body></html>";
}
function Copie($Source, $Dest)
{
	if (is_dir($Source))
	{
		mkdirs(DirUrl($Dest.basename($Source)));
		if (is_array($SubFile = DirSort ($Source)))
			foreach ($SubFile as $File)
				Copie(DirUrl($Source).$File, DirUrl($Dest.basename($Source)));// $New,($_SESSION['level']>2?true:false))
	}
	else copy($Source, NewFile($Dest.basename($Source),($_SESSION['level']>2?true:false)));
}
function MultiRen ($Files, $Str)
{
	foreach ($Files as $num => $file)
	{
		$ext = pathinfo($file, PATHINFO_EXTENSION) ? ".".pathinfo($file, PATHINFO_EXTENSION) : "";
		$ArraySearch = array("*","~","#");
		$ArrayReplace = array(basename($file, $ext), basename(dirname($file)), str_pad($num+1, strlen(strval(count($Files))), "0", STR_PAD_LEFT));
		$TmpStr = str_replace ($ArraySearch, $ArrayReplace, $Str);
		$DestFile = dirname ($file)."/".((!strcmp(strrchr($Str,"!"), "!")) ? substr($TmpStr, 0, -1) : ($TmpStr.(pathinfo(dirname($file).$TmpStr, PATHINFO_EXTENSION) ? "" : $ext)));
		rename($file, NewFile($DestFile));
	}
}
function EMail()
{
	?>
	<label for="expediteur">Votre adresse e-mail (obligatoire):</label>
	<br>
	<input class="mail" name="expediteur" id="expediteur" value="<?	if (!empty($_POST["adress"])) echo stripslashes($_POST["adress"]);?>" />
	<br>
	<label for="titre">Titre de message (facultatif):</label>
	<br>
	<input class="mail" size="30" name="titre" id="titre" value="<?	if (!empty($_POST["title"])) echo stripslashes($_POST["title"]);?>" />
	<br>
	<label for="message">Message (obligatoire):</label>
	<br>
	<textarea class="mail" name="message" id="message" rows="10"><?	if (!empty($_POST["message"])) echo stripslashes($_POST["message"]);?></textarea>
	<br>
	<input class="mail" right="0" style="text-align:center;" onclick="sendmail();" value="Envoyer"/>
	<?
}
function SendMail ()
{
	if (empty($_POST["adress"]))
	{
		echo "<div class='alert'>Saisissez votre adresse email...</div>";
		EMail();
	}
	elseif (!eregi ("^[0-9a-z]([-_.]?[0-9a-z])*@[0-9a-z]([-.]?[0-9a-z])*\.[a-z]{2,3}$", $_POST["adress"]))
	{
		echo "<div class='alert'>Votre adresse e-mail n'est pas valide...</div>";
		EMail();
	}
	elseif (empty($_POST["message"]))
	{
		echo "<div class='alert'>Saisissez un message...</div>";
		EMail();
	}
	else
	{
		if (mail($GLOBALS['AJAX-Var']["E-Mail"], trim(stripslashes($_POST["title"])), trim(stripslashes($_POST["message"]))."\n\nAJAX-Browser : ".$_SESSION['name'], "From: ".$_POST["adress"]." <".$_POST["adress"].">\nMIME-Version: 1.0"))
			echo "Votre message a ete envoyee:<br><br>Titre :\n".$_POST["titre"]."<br><br>Message :\n".$_POST["message"]."<br><br>\n";
		else
		{
			echo "<div class='alert'>Un probleme s'est produit lors de l'envoi du message.<br>Ressayez...<br></div>\n";
			EMail();
		}
	}
}
function SupFile($FileUrl)
{// supprime un fichier ou un dossier (mais pas l'interieur des dossiers)
	if (is_dir($FileUrl))
	{
		if (is_array($SubFile = DirSort ($FileUrl)))
			foreach ($SubFile as $File)
				SupFile($FileUrl."/".$File);
		if (rmdir($FileUrl)) echo "\"".$FileUrl."\" supprimé.\n";
		else echo "Erreur, impossible de supprimer : \"".$FileUrl."\"\n";
	}
	elseif (basename($FileUrl)=='AJAX-Array.var') echo "\"AJAX-Array.var\" ne doit pas etre supprimé\n";
	elseif (unlink($FileUrl)) echo "\"".$FileUrl."\" supprimé.\n";
	else echo "Erreur, impossible de supprimer : \"".$FileUrl."\"\n";
}
function MakeFile($file)
{
	if (is_file($file)) echo "'$file' existe deja.";
	elseif (mkdirs(dirname($_GET['new'])) && WriteInFile (NewFile($file,($_SESSION['level']>2?true:false)), "\n","remplace")) echo "Fichier '$file' creer.";
	else echo "Impossible de creer '$file'.";
}
function ManageUpload($dest)
{
?><html style="padding:0px;margin:0px;">
<body style="font-size:10px;padding:0px;margin:0px;">
<?php
	if (!empty($_FILES)) echo UploadFile($dest);
	else
{
?>
	<form METHOD='post' action='' enctype='multipart/form-data' style="padding:0px;margin:0px;">
		<input type='file' name='aFile' style="text-align:center;margin-top:1px;" onchange="this.parentNode.submit();">
	</form>
<?
}
?>
</body>
</html>
<?
}
function UploadFile($DestFold)
{
ini_set('max_input_time','600');
ini_set('memory_limit','204M');
ini_set('post_max_size','202M');
ini_set('upload_max_filesize','200M');
?>
<html style="padding:0px;margin:0px;">
<body style="font-size:10px;padding:0px;margin:0px;" onload="top.ReloadDir('<? echo $DestFold;?>');">
<?php
	if (!empty($_FILES['aFile']))
	{
		if (!$Error)
		{
			$ext = strtolower(pathinfo($_FILES['aFile']['name'], PATHINFO_EXTENSION));
			if ((in_array($ext, $GLOBALS['AJAX-Var']['always-type']) && $_SESSION['level'] == 2) ||
					(in_array($ext, $GLOBALS['AJAX-Var']['restrict-type']) && $_SESSION['level'] == 3) ||
						$_SESSION['level'] == 4)
			{
				$Dest = NewFile($DestFold.$_FILES['aFile']['name'],($_SESSION['level']>2?true:false));
				move_uploaded_file($_FILES['aFile']['tmp_name'], $Dest);
				if (is_file($DestFold.$_FILES['aFile']['name'])) return $Dest." >> Complet.<br>\n";
				else return "Une erreur c'est produite sur ".$_FILES['aFile']['name']."<br> Verrifier les droits d'ecriture de ".$DestFold;
			}
			else echo "Ce type de fichier ne vous est pas autorisé a l'upload.";
		}
		else return "Erreur, fichier non recu : \"".$DestFold.$_FILES['aFile']['name']."\"<br />\n";
	}
	else echo "No file uploaded";
?>
</body>
</html>
<?
}
?>
