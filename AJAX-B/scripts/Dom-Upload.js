/** PHP
 * Evrard Ludovic
 * Web-Creator.be
 */

/*document.getElementById('uploadMessage').style.display = 'none';
document.getElementById('titleWaitFile').style.display = 'none';*/
var i = 1;
var alreadySend = 0;
var currentFile = new Array();
var currentDisplayFile = new Array();
createNewUpload(i);

function createNewUpload(num){
	createNewNode(num);
	document.getElementById('uploadContent'+num).innerHTML += '<form action="" id="formUp'+num+'" method="post" target="upload_iframe'+num+'" enctype="multipart/form-data"><input type="hidden" name="dest" value="<?php echo $dest;?>"><input type="hidden" name="send" id="send" value="true" /><input type="file" name="file" id="file" onChange="addFile(this)" /></form>';
	document.getElementById('uploadContent'+num).innerHTML += '<iframe frameborder="1" height="35" width="300" style="display:none" name="upload_iframe'+num+'"></iframe>';
}
function createNewNode(num){
	var div = document.createElement("input");
	var i2 = num+1;
	document.getElementById('parent'+num).innerHTML = '<div class="test" id="uploadContent'+num+'">Fichier '+num+':</div>';
	document.getElementById('parent'+num).innerHTML += '<span id="parent'+i2+'">chargement</span>';
	document.getElementById('parent'+i2).style.display = 'none';
}
function addFile(file){
	var divToDisplay = i+1;
	var divToHidden = i;
	currentFile.push(file.value);
	currentDisplayFile.push(file.value);
	modifyDisplayWait();
	document.getElementById('titleWaitFile').style.display = 'block';
	document.getElementById('parent'+divToDisplay).style.display = 'block';
	document.getElementById('uploadContent'+divToHidden).style.display = 'none';
	i++;
	createNewUpload(i);
}

function modifyDisplayWait(){
	document.getElementById('waitFile').innerHTML =  '';
	for(j = 0; j < currentFile.length; j++)
	{
		if(currentDisplayFile[j] != undefined)
		{
			document.getElementById('waitFile').innerHTML +=  currentDisplayFile[j]+'<br />';
		}
	}
}

function deleteUpload(champ){
	var Parent;
	var Obj = document.getElementById(champ);
	if( Obj)
		Parent = Obj.parentNode;      
    if( Parent)
    	Parent.removeChild( Obj);
}

function jsUpload(num)
{
	if(currentFile.length > 0)
	{
		document.getElementById('uploadContent'+i).style.display = 'none';
		document.getElementById('uploadMessage').style.display = 'block';
		document.getElementById('uploadMessage').innerHTML = ' <img src="<?php echo INSTAL_DIR; ?>icones/loader-2.gif" />Chargement du fichier <strong>'+num+'</strong> sur <strong>'+currentFile.length+'</strong>';
		alreadySend = num;
		document.forms['formUp'+num].submit();
	}
	else
	{
		alert('Aucun fichier en attente');
	}
}