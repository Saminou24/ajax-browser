<script type="text/javascript">
/**-------------------------------------------------
 | AJAX-Browser  -  by Alban LOPEZ
 | Copyright (c) 2006 Alban LOPEZ
 | Email bugs/suggestions to alban.lopez@gmail.com
 +--------------------------------------------------
 | This script has been created and released under
 | the GNU GPL and is free to use and redistribute
 | only if this copyright statement is not removed
 +--------------------------------------------------*/
function Edit (SelFile)
{
	window.open(GET_add("edit="+UrlFormat (SelFile)));
	flux("Edit :",SelFile);
}
function Copy (Dest)
{
	var xhr_obj = null;
	if (window.XMLHttpRequest)
	{
		xhr_obj = new XMLHttpRequest();
		xhr_obj.onreadystatechange = function()
		{
			if(xhr_obj.readyState == 4 && xhr_obj.status == 200)
			{
				MoveList[MoveList.length] = Dest+"*";
				SearchToReload(MoveList);
				MoveList=Array();
				flux("Copy to "+Dest,xhr_obj.responseText);
			}
		};
		xhr_obj.open("POST", GET_add('copy='+UrlFormat(Dest)), true);
		xhr_obj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr_obj.send("ToCopy="+UrlFormat(MoveList.join('\n')));
	}
	else XMLHttpRequestERROR()
}
function Move (Dest)
{
	var xhr_obj = null;
	if (window.XMLHttpRequest)
	{
		xhr_obj = new XMLHttpRequest();
		xhr_obj.onreadystatechange = function()
		{
			if(xhr_obj.readyState == 4 && xhr_obj.status == 200)
			{
				MoveList[MoveList.length] = Dest+"*";
				SearchToReload(MoveList);
				MoveList=Array();
				flux("Move to "+Dest,xhr_obj.responseText);
			}
		};
		xhr_obj.open("POST", GET_add('move='+UrlFormat(Dest)), true);
		xhr_obj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr_obj.send("ToMove="+UrlFormat(MoveList.join('\n')));
	}
	else XMLHttpRequestERROR()
}
function Rename ()
{
	Lst = OneOrSelect();
	if (SelFile) fastRename (SelFile)
	else if ((Mask=prompt("Specifier un nouveau nom pour la selection.\nPour une selection multiple vous pouvez utliser ces carateres generique :\n*	=> nom actuel\n~	=> dossier\n#	=> compteur\n!	=> sans extention\nexemple si vous entrez : ~ - * (#)!\n./MyDir/MyFile.EXT >> ./MyDir/MyDir - MyFile (1)", ID ('MAI').childNodes[1].childNodes[3].textContent)))
		SendRenRequest (Lst, Mask);
}
function SendRenRequest (Lst, Mask)
{
	var xhr_obj = null;
	if (window.XMLHttpRequest)
	{
		xhr_obj = new XMLHttpRequest();
		xhr_obj.onreadystatechange = function()
		{
			if(xhr_obj.readyState == 4 && xhr_obj.status == 200)
			{
				SearchToReload(Lst);
				flux("Ren to "+Mask,xhr_obj.responseText);
			}
		};
		xhr_obj.open("POST", GET_add('ren='+UrlFormat(Mask)), true);
		xhr_obj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr_obj.send("ToRename="+UrlFormat(Lst.join('\n')));
	}
	else XMLHttpRequestERROR()
}
function SendFastRen()
{
	var xhr_obj = null;
	PtrId = document.BrowsAct.New.parentNode.parentNode.parentNode.parentNode.parentNode.id;
	if (window.XMLHttpRequest)
	{
		xhr_obj = new XMLHttpRequest();
		xhr_obj.open("GET", GET_add('RenOld='+UrlFormat(PtrId)+'&RenNew='+UrlFormat(document.BrowsAct.New.value)), true);
		xhr_obj.send(null);
		xhr_obj.onreadystatechange = function()
		{
			if(xhr_obj.readyState == 4 && xhr_obj.status == 200)
			{
				flux("FastRen ", PtrId+" to "+document.BrowsAct.New.value+"<br>"+xhr_obj.responseText);
				ReloadDir (dirname(PtrId));
			}
		};
	}
	else XMLHttpRequestERROR()
	document.BrowsAct.New.parentNode.innerHTML = document.BrowsAct.New.value;
}
function RequestInfosSize (ptr, file)
{
	var xhr_size;
	ptr.innerHTML = '<IMG src=./.AJAX-Ico/spinner.gif />';
	if (window.XMLHttpRequest) // Firefox
	{
		xhr_size = new XMLHttpRequest();
		xhr_size.open ("GET", GET_add('size='+UrlFormat (file)), true);
		xhr_size.send(null);
		xhr_size.onreadystatechange = function ()
		{
			if (xhr_size.readyState == 4 && xhr_size.status == 200)
			{
				ptr.innerHTML = SizeConvert(xhr_size.responseText)+' ('+xhr_size.responseText+' Octés)';
				flux("Size of "+file,xhr_size.responseText);
			}
		};
	}
	else XMLHttpRequestERROR()
}
function DelUsr (usrname)
{
	if (confirm('Etes-vous sur de vouloir supprimer le compte : '+usrname))
	{
		if (window.XMLHttpRequest) // Firefox
		{
			xhr_obj = new XMLHttpRequest();
			xhr_obj.open ("GET", GET_add('account='+UrlFormat (usrname)+'&delete'), true);
			xhr_obj.send(null);
			xhr_obj.onreadystatechange = function ()
			{
				if (xhr_obj.readyState == 4 && xhr_obj.status == 200)
				{
					PopBox('account');
					flux("DelUsr "+usrname,xhr_obj.responseText);
				}
			};
		}
	}
}
function MakeNewUsr ()
{
	var NewUser, xhr_new;
	if (NewUser=prompt("Specifier un nouveau nom d'utilisateur :"))
	{
		if (window.XMLHttpRequest) // Firefox
		{
			xhr_new = new XMLHttpRequest();
			xhr_new.open ("GET", GET_add('account='+UrlFormat (NewUser)+'&new'), true);
			xhr_new.send(null);
			xhr_new.onreadystatechange = function ()
			{
				if (xhr_new.readyState == 4 && xhr_new.status == 200)
				{
					PopBox('account');
					flux("NewUsr "+NewUser,xhr_new.responseText);
				}
			}
		}
	}
	else XMLHttpRequestERROR();
}
function submitMy(para)
{
	var xhr_post = null;
	if (window.XMLHttpRequest)
	{
		xhr_post = new XMLHttpRequest();
		FORM = document.forms[1];
		xhr_post.onreadystatechange = function()
		{
			if(xhr_post.readyState == 4 && xhr_post.status == 200)
			{
				flux("ModifMy "+para,xhr_post.responseText);
				ReloadDir ((GET['racine'].split('='))[1]);
				PopBox('account');
			}
		};
		xhr_post.open("POST", GET_add(para), true);
		xhr_post.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr_post.send(
(FORM.NewCode.checked ? "CODE="+UrlFormat(FORM.CODE.value)+
"&NewCode="+FORM.NewCode.checked+"&" : "")+
"SPEED="+(FORM.SPEED.value)+
(FORM.FICHIER_CACHER ? "&FICHIER_CACHER="+FORM.FICHIER_CACHER.checked : '')+
"&DEF_VIEW="+FORM.DEF_VIEW.value+
(FORM.DEF_DIR ? "&DEF_DIR="+UrlFormat(FORM.DEF_DIR.value) : '')+
"&MINI_SIZE="+FORM.MINI_SIZE.value);
	}
	else XMLHttpRequestERROR()
}
function submitUsr(para)
{
	var xhr_post = null;
	if (window.XMLHttpRequest)
	{
		xhr_post = new XMLHttpRequest();
		FORM = document.forms[1];
		xhr_post.onreadystatechange = function()
		{
			if(xhr_post.readyState == 4 && xhr_post.status == 200)
			{
				flux("ModifUsr "+para,xhr_post.responseText);
				PopBox('account');
			}
		};
		xhr_post.open("POST",GET_add(para), true);
		xhr_post.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr_post.send(
(FORM.NewCode.checked ? "CODE="+UrlFormat(FORM.CODE.value)+
"&NewCode="+FORM.NewCode.checked+"&" : "")+
"LEVEL="+(FORM.LEVEL.value)+
"&SPEED="+(FORM.SPEED.value)+
"&FICHIER_CACHER="+(FORM.FICHIER_CACHER.checked)+
"&DEF_VIEW="+(FORM.DEF_VIEW.value)+
"&DEF_DIR="+UrlFormat(FORM.DEF_DIR.value)+
"&MINI_SIZE="+(FORM.MINI_SIZE.value)
);
	}
	else XMLHttpRequestERROR()
}
function submitSetting(para)
{
	var xhr_post = null;
	if (window.XMLHttpRequest)
	{
		xhr_post = new XMLHttpRequest();
		FORM = document.forms[1];
		xhr_post.onreadystatechange = function()
		{
			if(xhr_post.readyState == 4 && xhr_post.status == 200)
			{
				flux("Setting "+para,xhr_post.responseText);
			}
		};
		xhr_post.open("POST",GET_add(para), true);
		xhr_post.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr_post.send(
"&E_MAIL="+UrlFormat(FORM.E_MAIL.value)+
"&RESTRICT_TYPE="+UrlFormat(FORM.RESTRICT_TYPE.value)+
"&ALWAYS_TYPE="+UrlFormat(FORM.ALWAYS_TYPE.value)+
"&IP_SPY="+(FORM.IP_SPY.checked)+
"&EDIT="+(FORM.EDIT.checked)+
"&DEL="+(FORM.DEL.checked)+
"&DOWNLOAD="+(FORM.DOWNLOAD.checked)+
"&UPLOAD="+(FORM.UPLOAD.checked)+
"&COPY="+(FORM.COPY.checked)+
"&MOVE="+(FORM.MOVE.checked)+
"&RENAME="+(FORM.RENAME.checked)+
"&LINK="+(FORM.LINK.checked)+
"&NEW="+(FORM.NEW.checked)+
"&CONTACT="+(FORM.CONTACT.checked));
	}
	else XMLHttpRequestERROR()
}
function sendmail()
{
	var xhr_mail = null;
	if (window.XMLHttpRequest)
	{
		xhr_mail = new XMLHttpRequest();
		FORM = document.forms[1];
		xhr_mail.onreadystatechange = function()
		{
			if(xhr_mail.readyState == 4 && xhr_mail.status == 200)
			{
				ID('MPOP').childNodes[3].innerHTML = xhr_mail.responseText;
				flux("Mail "+FORM.titre.value,xhr_mail.responseText);
			}
		};
		xhr_mail.open("POST", GET_add('email'), true);
		xhr_mail.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr_mail.send(
"adress="+UrlFormat(FORM.expediteur.value)+
"&title="+UrlFormat(FORM.titre.value)+
"&message="+UrlFormat(FORM.message.value)
);
	}
	else XMLHttpRequestERROR()
}
function New (Ou)
{
	if (SelFile)
	{
		if (SelFile.charAt(SelFile.length-1) == "/") Ou = SelFile;
		else Ou = dirname(SelFile);
	}
	if (NewElement=prompt("("+Ou+")\nSpecifier un nom (terminer par / pour creer un dossier):\n", "New/"))
	{
		var xhr_obj = null;
		if (window.XMLHttpRequest)
		{
			xhr_obj = new XMLHttpRequest();
			xhr_obj.onreadystatechange = function()
			{
				if(xhr_obj.readyState == 4 && xhr_obj.status == 200)
				{
					ReloadDir (Ou);
					flux("New \""+NewElement+"\" in \""+Ou+"\"",xhr_obj.responseText);
				}
			};
			xhr_obj.open("GET", GET_add('new='+UrlFormat(Ou+NewElement)), true);
			xhr_obj.send(null);
		}
		else XMLHttpRequestERROR()
	}
}
function Erase ()
{
	Lst = OneOrSelect();
	if (confirm("Etes vous certain de vouloir supprimer deffinitivement :\n"+Lst.join('\n')))
	{
		var xhr_obj = null;
		if (window.XMLHttpRequest)
		{
			xhr_obj = new XMLHttpRequest();
			xhr_obj.onreadystatechange = function()
			{
				if(xhr_obj.readyState == 4 && xhr_obj.status == 200)
				{
					SearchToReload(Lst);
					flux("Supprimer :",xhr_obj.responseText);
				}
			};
			xhr_obj.open("POST", GET_add('erase'), true);
			xhr_obj.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
			xhr_obj.send("ToErase="+UrlFormat(Lst.join('\n')));
		}
		else XMLHttpRequestERROR()
	}
}
function Download ()
{
	Lst = OneOrSelect ();
	if (Lst.length>1 || Lst[0].charAt(Lst[0].length-1) == "/")
	{
		zipper_style = ID("zipper").style;
		zipper_style.visibility='visible';
		flux("Multi Download :",Lst);
	}
	else
	{
		NewWin = window.open(GET_add("download="+UrlFormat (Lst.join('%;'))), 'download','top=0,left=0,width=100,height=100');
		flux("Download :",Lst);
		NewWin.setTimeout("close()",60000);
	}
}
function Upload (Ou)
{
	var i=0;
	var INFOS = new Array();
	if (SelFile) Ou = SelFile;
	INFOS[i++] = "<div value='Add Other File' class='button center' onclick=\"str=ID('Uploader').rows[0].innerHTML;ID('Uploader').insertRow(0).innerHTML=str;\" title='Selectionner plus de fichier a envoyer...'>Add Other File</div>";
	INFOS[i++] = "<table id='Uploader'><tr><td>";
	INFOS[i++] = "	<IFRAME src='?upload="+UrlFormat (Ou)+"' width=300 height=25 scrolling=auto frameborder=0></IFRAME>";
	INFOS[i++] = "</td></tr></table>";
	PtrMPOP = ID('MPOP');
	PtrMPOP.childNodes[1].childNodes[1].innerHTML = Ou;
	PtrMPOP.style.display='block';
	PtrMPOP.childNodes[3].innerHTML = INFOS.join('\n');
	Center(PtrMPOP);
}
function OneOrSelect ()
{
	if (SelFile) return new Array (SelFile);
	else return MakeCheckboxToPost();
}
function MakeCheckboxToPost()
{
	FORM = document.forms[0];
	Lst = new Array();
	for (i=0,j=0; FORM.elements[i]; i++)
	{
		if (FORM.elements[i].type == 'checkbox' && FORM.elements[i].checked == true)
			Lst[j++] = FORM.elements[i].value;
	}
	return Lst; // UrlFormat()
}
</script>