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

var OffsetX=0, OffsetY=0, PtrThis=null;
var SelFile;
var AJAX_ERROR = "<br>Le AJAX Standard n'est pas supporté par votre naviguateur !<br><br>Utiliser Firefox :<br>Version instalable : <a href='http://www.mozilla-europe.org/fr/products/firefox/'>Download Mozilla Firefox<br></a>Version autonome : <a href='http://portableapps.com/apps/internet/browsers/portable_firefox'>Download Portable Firefox</a><br><br>Ou passé a LINUX<br>";
var GET=new Array();
var MoveList = new Array();

	Para_GET = window.location.search.slice(1,window.location.search.length).split("&");
	for(i=0;Para_GET[i];i++)
		GET[(Para_GET[i].split("="))[0]] = Para_GET[i];

function fastRename (Ptr)
{
	if (ID("NewFastName"))
		RestorFastRen();
	flux("Start FastRen","");
	document.onkeydown = EndFastRen;
	PtrFile = Ptr.parentNode.parentNode.parentNode.parentNode;
		Ptr.parentNode.parentNode.parentNode.onmouseover = false;
		Ptr.parentNode.onmousedown = false;
		Ptr.onclick = false;
	Ptr.innerHTML = "<INPUT id='NewFastName' NAME='New' VALUE='"+Ptr.innerHTML+"' style='font-size:10px;height:15px;border:inset 1px gray;padding:0px;margin:1px 0px 0px -1px;'>";//length:1000px;
	document.BrowsAct.New.defaultValue = basename(PtrFile.id);
	document.BrowsAct.New.focus();
	document.BrowsAct.New.selectionStart = 0;
	document.BrowsAct.New.selectionEnd = document.BrowsAct.New.value.length;
}
function RestorFastRen()
{
	divName = document.BrowsAct.New.parentNode;
		divName.setAttribute('onclick',"fastRename(this);");
		divName.parentNode.parentNode.parentNode.childNodes[1].childNodes[4].onmousedown=thisOnMouseDown;
		divName.parentNode.parentNode.parentNode.onmouseup=thisPaste;
		divName.parentNode.onmousedown=thisOnMouseDown;//	divName.parentNode.setAttribute('onmousedown', "thisOnMouseDown;alert('onmousedown');");
		divName.innerHTML = document.BrowsAct.New.defaultValue;
	if (document.BrowsAct.New)
	{
	document.body.style.background="red";
	ReloadDir (dirname(document.BrowsAct.New.parentNode.parentNode.parentNode.parentNode.parentNode.id));
	document.body.style.background="white";
		alert("JS-Common.php\ndocument.BrowsAct.New , est mal effacé !!!\n"+
			document.BrowsAct.New.id+"\n"+document.BrowsAct.New.value+"\n"+document.BrowsAct.New.name+
				"\n"+document.BrowsAct.New.nodeValue);
	}
}
function EndFastRen(e)
{
	switch (e.which)
	{
		case 13: // enter
			SendFastRen();
			break;
		case 27: // echap
			RestorFastRen();
			break;
	}
}
function FileIco (File)			// choisi l'icone le mieu adapté parmis ceux present
{
	var ext = File.split(".");
// Vous pouvez ajouter des icones pour d'autre type de fichier
// si vous les placé dans ./.AJAX-Ico/
// l'image doit etre au format PNG de taille 17px * 17px
// son nom doit etre de la forme : "type-" puis l'extention de fichier, au format png
	switch(ext = ext[ext.length-1].toLowerCase())
	{
		case "folder":
			ico="type-folder.";
			break;
<?
	$IcoLst = DirSort ("./.AJAX-Ico/",array("type-*.png"));
	foreach ($IcoLst as $Ico)
		echo "		case \"".substr($Ico,5,-4)."\":\n";
?>
			ico="type-"+ext;
			break;
		default:
			if(ext[ext.length-1]=="~")
				ico="type-recycled";
			else
				ico="type-unknown";
	}
	return ico;
}
function flux(titre, str)
{
	ptr = ID("BavarZone");
	while (str.length != (str=str.replace('<','&lt;').replace('>','&gt;')).length);
	while (str.length != (str=str.replace('\n','<br>')).length);
<?
if ($_SESSION['level']>=3) echo 	"ptr.innerHTML = \"<div class='titleflux'>\"+titre+\"</div>\"+str+\"<br>\\n\"+ptr.innerHTML;";
else echo 	"	ptr.innerHTML = \"<div class='titleflux'>\"+titre+\"</div><br>\\n\"+ptr.innerHTML;";
?>
}
function GET_add (val)
{
	return window.location.search + "&" + val;
}
function HideBavar()
{
	ptr = ID('BavarZone').style;
	if (ptr.display == 'block')
		ptr.display = 'none';
	else
		ptr.display = 'block';
}
function OpenClick(ptr)
{
	if (ptr.id.charAt(ptr.id.length-1)==('/'))
		document.location = window.location.search.replace(GET['racine'],'racine='+UrlFormat (ptr.id));
	else
	{
		window.open( "?open="+UrlFormat(ptr.id));
		flux("Open "+id,ptr.id);
	}
}
function Center(PtrObj)
{
	Style = PtrObj.style;
	if (!PtrObj.Paste || PtrObj.Paste != true)
	{
		Style.top = (window.innerHeight - PtrObj.offsetHeight)/2+document.body.scrollTop;
		Style.left = (window.innerWidth - PtrObj.offsetWidth)/2+document.body.scrollLeft;
	}
	F5_Div(PtrObj);
}
function F5_Div(Ptr)
{
	Ptr.style.left = Ptr.offsetLeft+1;
	Ptr.style.left = Ptr.offsetLeft-1;
}
function XMLHttpRequestERROR()
{
	ID('MPOP').childNodes[3].innerHTML = AJAX_ERROR;
	ID('MPOP').style.display='block';
	Center(ID('MPOP'));
	flux("Erreur AJAX",AJAX_ERROR);
}
function MCE(PtrId, event) // MCE   to   Manage Click Event
{
	if (event.which == 2)
	{
		PopBox('infos='+UrlFormat (PtrId.id));			// click Roulette
		flux("Proprieté click roulette :",id);
	}
	else if (event.which == 3)
	{
		ShowMenuMAI(PtrId.id,event);					// click Droit
		flux("Menu click droit :",id);
	}
}
var ShowMenuMAI = function (id, event)
{
	ptrMAI = ID ("MAI");
	SelFile = id;
	ptrMAI.childNodes[1].childNodes[3].innerHTML = basename (id);
	ptrMAI.style.display = "block";
	if (!ptrMAI.Paste || ptrMAI.Paste != true)
	{
		ptrMAI.style.top = event.clientY+document.body.scrollTop;
		ptrMAI.style.left = event.clientX+document.body.scrollLeft;
	}
	ptrMAI.childNodes[1].onmousedown = divOnMouseDown;
	flux("Affichage du menu :",id);
}
function SearchToReload(Lst)
{
	var tablo = new Array(), i;
	for (i=0,j=0;Lst[i];i++)
	{
		if (ArrayExist (dirname(Lst[i]), tablo))
			ReloadDir (tablo[j++] = ((Lst[i]==(GET['racine'].split("="))[1]) ? Lst[i] : dirname(Lst[i])));
	}
}
function ArrayExist (val, tablo)
{
	for (i=0;tablo[i];i++)
		if (tablo[i]==val) return false;
	return true;
}
function basename (str)			// renvoi le nom du fichier
{
	var tmp = str.split('/').pop();
	if (tmp=="") return str.slice(0,-1).split("/").pop();
	return tmp;
}
function dirname (str)			// renvoi le nom du dossier
{
	var tmp = str.split('/');
	if(tmp.pop()=="")tmp.pop();
	return tmp.join('/')+"/";
}
function SizeConvert (Size)		// converti un nombre d'octés en taille en Ko, Mo, Go, To
{
	var UnitArray = new Array("Oct","Ko","Mo","Go","To");
	var POW = new Array(1, 1024, 1048576, 1073741824, 1099511627776);
	var Unit=0;
	if (Size==-1) return " - - ";
	while (Size/POW[Unit]>1024) Unit=Unit+1;
	return Math.round(Size/POW[Unit]*Math.pow(10,Unit))/Math.pow(10,Unit)+" "+UnitArray[Unit];
}
function UrlFormat (url)
{
	while ( url.length != (url = url.replace("'","%27").replace("#","%23").replace("\"","%22").replace("&","%26").replace("=","%3d").replace("?","%3f").replace(" ","%20")).length);
	return url;
}
function PopBox(para)
{
	PtrMPOP = ID('MPOP');
	PtrMPOP.childNodes[1].childNodes[1].innerHTML = (para.split("="))[0]; // (para.indexOf('=', 0)!=-1) ? para.substr(0, para.indexOf('=', 0)) : para;
	PtrMPOP.style.display='block';
	if (window.XMLHttpRequest) // Firefox
	{
		xhr_Box = new XMLHttpRequest();
		xhr_Box.open ("GET", GET_add(para), true);
		xhr_Box.send(null);
		xhr_Box.onreadystatechange = function ()
		{
			if (xhr_Box.readyState == 4 && xhr_Box.status == 200)
			{
				PtrMPOP.childNodes[3].innerHTML = xhr_Box.responseText;
				Center(ID('MPOP'));
				flux("Affichage MPOP "+para,xhr_Box.responseText);
			}
		};
	}
	else
	{
		PtrMPOP.childNodes[3].innerHTML = AJAX_ERROR;
		Center(ID('MPOP'));
	}
	PtrMPOP.childNodes[1].onmousedown = divOnMouseDown;
}

var divOnMouseUp = function ()
{
	OffsetX=0;
	OffsetY=0;
	PtrThis.style.opacity = "1";
	document.onmouseup = null;
	document.onmousemove = null;
	document.onmousedown = new Function ("return true");
}
var divOnMouseDown = function(event)
{
	PtrThis = this.parentNode;
	OffsetY = event.clientY - PtrThis.offsetTop;
	OffsetX = event.clientX - PtrThis.offsetLeft;
	PtrThis.style.opacity = "0.8";
	document.onmouseup = divOnMouseUp;
	document.onmousemove = divOnMouseSlide;
	document.onmousedown = new Function ("return false");
}
var divOnMouseSlide = function (event)
{
	PtrThis.style.top = event.clientY-OffsetY;
	PtrThis.style.left = event.clientX-OffsetX;
	PtrThis.Paste=true;
}
var noPaste = function ()
{
	document.onmouseup = null;
	document.onmousemove = null;
	document.onmousedown = null;
	PtrThis.innerHTML = "";
	PtrThis.style.visibility = 'hidden';
	MoveList=Array();
	flux("Eléments abandonné","");
}
var thisOnMouseSlide = function (event)
{
	PtrThis.style.top = event.clientY+5+document.body.scrollTop;
	PtrThis.style.left = event.clientX+5+document.body.scrollLeft;
}
var thisPaste = function (event)
{
	if (MoveList.length>0)
	{
		var Dest = (this.parentNode.id.charAt(this.parentNode.id.length-1) == "/") ? this.parentNode.id : dirname(this.parentNode.id);
		PtrThis.innerHTML = "";
		PtrThis.style.visibility = 'hidden';
		document.onclick = function () {ID('CpMv').style.visibility = 'hidden'; document.onclick = null;};
		document.onmouseup = null;
		document.onmousemove = null;
		document.onmousedown = null;
		PtrCpMv = ID('CpMv');
		PtrCpMv.style.top = event.clientY+document.body.scrollTop;
		PtrCpMv.style.left = event.clientX+document.body.scrollLeft;
		PtrCpMv.childNodes[1].onclick = function () {Move(Dest);};
		PtrCpMv.childNodes[3].onclick = function () {Copy(Dest);};
		PtrCpMv.childNodes[5].onclick = noPaste;
		PtrCpMv.style.visibility = 'visible';
	}
}
var thisOnMouseDown = function(event)
{
	var Str = '';
	var FORM = document.forms[0];
	MoveList = new Array();
	PtrThis = ID('mover');
	if (this.parentNode.childNodes[1].checked == true)
	{
		for (i=0,j=0; FORM.elements[i]; i++)
		{
			if (FORM.elements[i].type == 'checkbox' && FORM.elements[i].checked == true)
			{
				Str += "<div class='IcoName'>"+FORM.elements[i].parentNode.childNodes[4].innerHTML+"</div>\n";
				MoveList[j++] = FORM.elements[i].value;
			}
		}
	}
	else
	{
		MoveList[0] = this.parentNode.parentNode.parentNode.id;
		Str = "<div class='IcoName'>"+this.parentNode.childNodes[4].innerHTML+"</div>\n";
	}
	PtrThis.innerHTML = Str;
	PtrThis.style.visibility = 'visible';
	PtrThis.style.top = event.clientY+5+document.body.scrollTop;
	PtrThis.style.left = event.clientX+5+document.body.scrollLeft;
	PtrThis.style.opacity = "0.7";
	this.parentNode.parentNode.onmouseup = null;			// pour evité les depot intempestif qui gêne les autres actions
	document.onmouseup = noPaste;							// en cas de depot vers rien...
	document.onmousedown = new Function ("return false");	// annule la selection du texte pendant le deplacement
	document.onmousemove = thisOnMouseSlide;
	flux("Déplacement d'éléments :",MoveList.join("\n"));
}
function ID (id) { return document.getElementById (id); }
</script>