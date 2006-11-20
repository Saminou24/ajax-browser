/**-------------------------------------------------
 | AJAX-Browser  -  by Alban LOPEZ
 | Copyright (c) 2006 Alban LOPEZ
 | Email bugs/suggestions to alban.lopez@gmail.com
 +--------------------------------------------------
 | This script has been created and released under
 | the GNU GPL and is free to use and redistribute
 | only if this copyright statement is not removed
 +--------------------------------------------------*/

function SDGCA(ptr,childNode)		// SBGC    to    Select BackGround Color Arborescence
{
	if (ptr.checked==true)
		ptr.parentNode.parentNode.parentNode.style.backgroundColor="rgb(220,230,255)";
	else
		ptr.parentNode.parentNode.parentNode.style.backgroundColor="";
}
function RequestSize (file)
{
	var PtrSize = ID (file).childNodes[1].childNodes[3].childNodes[5];
	if (window.XMLHttpRequest)
	{
		var xhr_size = null;
		PtrSize.innerHTML = '<IMG src=./.AJAX-Ico/spinner.gif />';
		xhr_size = new XMLHttpRequest();
		xhr_size.open ("GET", GET_add("size="+UrlFormat (file)), true);
		xhr_size.send(null);
		xhr_size.onreadystatechange = function ()
		{
			if (xhr_size.readyState == 4 && xhr_size.status == 200)
			{
				PtrSize.innerHTML = SizeConvert(xhr_size.responseText);
				PtrSize.style.title = xhr_size.responseText+' Octés';
				flux("size :",xhr_size.responseText);
			}
		};
	}
	else XMLHttpRequestERROR()
}
function WhatIndent (IndentImg)		// copie l'indentation du dossier parent
{
	var i=0, LstDevImg = "";
	for (i=0;i<IndentImg.childNodes.length-1;i++)
		LstDevImg += "<IMG  src='"+IndentImg.childNodes[i].src+"' />";
	if (IndentImg.childNodes[i].src.indexOf("EndDir")!=-1)
		LstDevImg += "<IMG  src='./.AJAX-Ico/Vide.png' />";
	else
		LstDevImg += "<IMG  src='./.AJAX-Ico/Next.png' />";
	return LstDevImg;
}
function ReloadDir (id)
{
	var Ptr;
	if (Ptr = ID (id))
	{
		var PtrIndent = Ptr.childNodes[1].childNodes[1].childNodes[3];
		PtrIndent.childNodes[PtrIndent.childNodes.length-1].src = PtrIndent.childNodes[PtrIndent.childNodes.length-1].src.replace("Loading.gif", "DirPlus.png");
		PtrIndent.childNodes[PtrIndent.childNodes.length-1].src = PtrIndent.childNodes[PtrIndent.childNodes.length-1].src.replace("DirMoin.png", "DirPlus.png");
		Ptr.childNodes[3].style.display='';
		Ptr.childNodes[3].innerHTML = "";
			flux("Reload :",id);
		LOHD (id);
		Ptr.childNodes[3].style.display='block';
	}
}
function LOHD (id) // LOHD pour Load Or Hide Dir
{
	var Ptr = ID (id), PtrIndent = Ptr.childNodes[1].childNodes[1].childNodes[3];
	if (PtrIndent.childNodes[PtrIndent.childNodes.length-1].src.indexOf("DirPlus.png")!=-1)
	{
		if (Ptr.childNodes[3].style.display=='none')
		{
			Ptr.childNodes[3].style.display='block';
			PtrIndent.childNodes[PtrIndent.childNodes.length-1].src = PtrIndent.childNodes[PtrIndent.childNodes.length-1].src.replace("DirPlus.png", "DirMoin.png");
			flux("OpenDir :",id);
		}
		else
		{
			var xhr_arbs = null;
			var IndentLstImg = WhatIndent (PtrIndent);
			PtrIndent.childNodes[PtrIndent.childNodes.length-1].src = PtrIndent.childNodes[PtrIndent.childNodes.length-1].src.replace("DirPlus.png", "Loading.gif");
			if (window.XMLHttpRequest) // Firefox
			{
				xhr_arbs = new XMLHttpRequest();
				xhr_arbs.open ("GET", GET_add("subdir="+UrlFormat(id)));
				xhr_arbs.send(null);
				xhr_arbs.onreadystatechange = function ()
				{
					if (xhr_arbs.readyState == 4 && xhr_arbs.status == 200)
					{
						var i, StrContent="", SubLst = xhr_arbs.responseText.split("\n");
						for (i=0; SubLst[i]; i++)
							StrContent += AddContent (SubLst[i].split("\t"), IndentLstImg, SubLst.length-2-i ? "" : "End").join('\n')+"\n";
						Ptr.childNodes[3].innerHTML = StrContent;
						PtrIndent.childNodes[PtrIndent.childNodes.length-1].src = PtrIndent.childNodes[PtrIndent.childNodes.length-1].src.replace("Loading.gif", "DirMoin.png");
						Ptr.childNodes[3].style.display='block';
						flux("LoadDir :",xhr_arbs.responseText);
					}
				};
			}
			else XMLHttpRequestERROR();
		}
	}
	else if (PtrIndent.childNodes[PtrIndent.childNodes.length-1].src.indexOf("DirMoin.png")!=-1)
	{
		PtrIndent.childNodes[PtrIndent.childNodes.length-1].src = PtrIndent.childNodes[PtrIndent.childNodes.length-1].src.replace("DirMoin.png", "Loading.gif");
			Ptr.childNodes[3].style.display='none';
		PtrIndent.childNodes[PtrIndent.childNodes.length-1].src = PtrIndent.childNodes[PtrIndent.childNodes.length-1].src.replace("Loading.gif", "DirPlus.png");
		flux("CloseDir :",id);
	}
	else ReloadDir (id);
}
function AddContent (infos, Indent, ImgPrefix)// oncontextmenu='return false;'
{
	var INFOS = new Array();
	var i=0;
	INFOS[i++] = "	<div class='DivGroup' id='"+infos[0]+infos[1]+"'>";
	if (infos.length>11)		// Nous somme face a un dossier
	{
		INFOS[i++] = "		<div class='This' onmousedown='MCE(this.parentNode,event);' onmouseover=\"this.childNodes[1].childNodes[4].onmousedown = thisOnMouseDown;this.onmouseup = thisPaste;\">";
		INFOS[i++] = "			<span class='left' title='"+infos[10]+" Dossier(s) et "+infos[11]+" Fichier(s)'>";
		INFOS[i++] = "				<input onchange='SDGCA(this);' type=\"checkbox\" name=\"Lst[]\" value='"+infos[0]+infos[1]+"'/>";
		INFOS[i++] = "				<span class='IndentImg'>"+Indent+"<IMG src='./.AJAX-Ico/"+ImgPrefix+"DirPlus.png' onclick='LOHD(this.parentNode.parentNode.parentNode.parentNode.id);'/></span><span class='IcoName'><IMG src='./.AJAX-Ico/type-folder..png' onclick='OpenClick(this.parentNode.parentNode.parentNode.parentNode);'/>";
	}
	else if (infos.length>10)	// Nous somme face a un fichier Image
	{
		INFOS[i++] = "		<div class='This' onmousedown='MCE(this.parentNode,event);' onmouseover=\"this.childNodes[1].childNodes[4].onmousedown = thisOnMouseDown;this.onmouseup = thisPaste;\">";
		INFOS[i++] = "			<span class='left' title='"+infos[10]+"'>";
		INFOS[i++] = "				<input onchange='SDGCA(this);' type=\"checkbox\" name=\"Lst[]\" value='"+infos[0]+infos[1]+"'/>";
		INFOS[i++] = "				<span class='IndentImg'>"+Indent+"<IMG src='./.AJAX-Ico/"+ImgPrefix+"File.png'/></span><span class='IcoName'><IMG onclick='OpenClick(this.parentNode.parentNode.parentNode.parentNode.id);' src='./.AJAX-Ico/"+FileIco (infos[1])+".png' />";
	}
	else						// ici nous somme face a une a un fichier "normal"
	{
		INFOS[i++] = "		<div class='This' onmousedown='MCE(this.parentNode,event);' onmouseover=\"this.childNodes[1].childNodes[4].onmousedown = thisOnMouseDown;this.onmouseup = thisPaste;\">";
		INFOS[i++] = "			<span class='left'>";
		INFOS[i++] = "				<input onchange='SDGCA(this);' type=\"checkbox\" name=\"Lst[]\" value='"+infos[0]+infos[1]+"'/>";
		INFOS[i++] = "				<span class='IndentImg'>"+Indent+"<IMG src='./.AJAX-Ico/"+ImgPrefix+"File.png'/></span><span class='IcoName'><IMG onclick='window.open(this.parentNode.parentNode.parentNode.parentNode.id);' src='./.AJAX-Ico/"+FileIco(infos[1])+".png' />";
	}
	INFOS[i++] = "					<span class='Name' onclick=\"fastRename(this);\">"+basename(infos[1])+"</span>";
	INFOS[i++] = "				</span>";
	INFOS[i++] = "			</span>";
	INFOS[i++] = "			<span class=\"right\">";
	INFOS[i++] = "				<div class=\"RowInfos\" onclick=\"PopBox('infos='+UrlFormat (this.parentNode.parentNode.parentNode.id));\"></div>";
	INFOS[i++] = "				<div class=\"RowMenu\" onclick=\"ShowMenuMAI (this.parentNode.parentNode.parentNode.id, event)\"></div>";
	if (infos[2]==-1)
		INFOS[i++] = "				<div class=\"RowOverTaille\" onclick=\"RequestSize(this.parentNode.parentNode.parentNode.id)\" title='Calculer maintenant'></div>";
	else
		INFOS[i++] = "				<div class=\"RowTaille\" title='"+infos[2]+" Octés'>"+SizeConvert(infos[2])+"</div>";
	INFOS[i++] = "				<div class=\"RowMIME\" title='"+infos[3]+"'>"+(infos[3].split("/"))[0]+"</div>";
	INFOS[i++] = "				<div class=\"RowDate\" title='"+infos[4]+"'>"+infos[4].slice(0,8)+"</div>";
	INFOS[i++] = "				<div class=\"RowDroits\" title=\"UID:"+infos[6]+" ("+infos[7]+") , GID:"+infos[8]+" ("+infos[9]+")\">"+infos[5]+"</div>";
	INFOS[i++] = "			</span>";
	INFOS[i++] = "		</div>";
	if (infos.length>11)		// Nous somme face a un dossier
	{
		INFOS[i++] = "		<div class='Content'>";
		INFOS[i++] = "		</div>";
	}
	INFOS[i++] = "	</div>";
	return INFOS;
}