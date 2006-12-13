<style type="text/css">
/*-------------------------------------------------
 | AJAX-Browser  -  by Alban LOPEZ
 | Copyright (c) 2006 Alban LOPEZ
 | Email bugs/suggestions to alban.lopez@gmail.com
 +--------------------------------------------------
 | This script has been created and released under
 | the GNU GPL and is free to use and redistribute
 | only if this copyright statement is not removed
 +--------------------------------------------------*/

body,table {font-size:10px;font-family:sans-serif;padding:0px;}
body {margin:1px;}
.italic {font-style:italic;}
.bold {font-weight:bold;}
.center {text-align:center;}
.width {width:100%;}
.left_ {position:absolute;left:1px;}
.right_ {position:absolute;right:1px;}
.nopadding {padding:0px;}

/* ============ Style du format des Menus et formulaires ============ */

.button {background:#ffffff;font-style:italic;font-weight:bold;font-size:10px;border:outset 1px gray;padding:2px;margin:1px;}
.button:hover{background-color:rgb(230,250,210);}
/* input, select {border:inset 1px gray;z-index:4;background-color:transparent;} */
iframe {padding:0px;margin:0px;overflow:hidden;}

#MPOP {position:absolute;font-size:10px;display:none;background:#ffffff;border:outset 1px gray;padding:4px 0px 0px 1px;z-index:4;}
	.mail {position:relative;width:400px;text-align:left;font-size:10px;font-style:italic;border:1px solid black;margin:5px 0px;padding:2px;}
	.mail:hover {background:rgb(230,250,210);}
	.alert {font-style:italic;font-weight:bold;text-align:center;color: #DD0000;}
	.PopTxt {overflow:auto;max-height:300px;max-width:400px;}
	#ActFunc td {/*vertical-align:top;*/}
	#ActFunc img {margin:0px 4px;vertical-align:bottom;}

#MAI {position:absolute;font-size:10px;display:none;background:#ffffff;min-width:150px;border:outset 1px gray;padding:4px 1px;z-index:4;}
.TitleBar {cursor:move;height:16px;border-bottom:1px solid gray;}
.titre {font-style:italic;margin-left:18px;margin-right:18px;}
.onglet {position:absolute;top:1px;left:1px;font-size:10px;}
.onglet img {cursor:pointer;margin:0px;}
.close {position:absolute;top:1px;right:1px;text-align:right;}
.close img {cursor:pointer;}
.action img {vertical-align:bottom;padding:0px 10px 0px 6px;}
#act div:hover {background:rgb(230,250,210);}
SELECT {width:100%;}

/* ============ Style du format de la bare d'outil (bleu) ============ */

#MAM {background-color:rgb(220,230,255);border-top:1px solid gray;border-bottom:1px solid gray;border-spacing:0px;padding:0px;margin:0px;margin-bottom:1px;}
#MAM img {margin:0px 3px;}
#MAM img:hover {cursor:pointer;}

.LstArray input {vertical-align:middle;}
.LstArray td {vertical-align:middle;}
.LstArray tr:hover {background:rgb(230,250,210);}
.LstArray img:hover{cursor:pointer;}

#mover {position:absolute;visibility:hidden;z-index:5;}

#CpMv {position:absolute;visibility:hidden;width:90px;z-index:10;background:#ffffff;border:1px solid gray;padding:1px;}
#CpMv div:hover {background:rgb(220,230,255);}

#zipper {position:absolute;top:60px;left:70px;visibility:hidden;width:90px;z-index:10;background:#ffffff;border:1px solid gray;padding:1px;}
#zipper div:hover {background:rgb(220,230,255);}

#FindFilter {position:absolute;visibility:hidden;top:48px;left:186px;height:17px;width:150px;z-index:10;background:#ffffff;border:outset 1px gray;padding:1px;}
#FindFilter input {width:150px;border:inset 1px gray;}

#BavarZone {background-color:white;font-size:9px;display:none;border-top:1px solid gray;border-right:1px solid gray;border-left:1px solid gray;overflow:auto;max-height:200px;}
.bottomleft {position:fixed;bottom:0px;left:0px;margin:2px;z-index:6;}
.bottomright {position:fixed;bottom:0px;right:0px;margin:2px;z-index:6;}
.titleflux {font-size:10px;font-style:italic;font-weight:bold;}
</style>