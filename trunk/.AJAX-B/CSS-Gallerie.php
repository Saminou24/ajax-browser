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

#Gal div
{
	position:relative;
	border:1px solid #DDD;
	float:left;
	height:<?php echo $_SESSION['mini-size']+2; ?>px;
	width:<?php echo $_SESSION['mini-size']+2; ?>px;
	margin:0px 1px 1px 0px;
	padding:0px;
	z-index:3;
}
#Gal div:hover
{
	background:rgb(230,250,210);
	border:solid 1px #777;
}
#Gal table
{
	font-size:10px;
	padding:0px;
	margin:-1px;
	border:0px;
}
#Gal td {
	height:<?php echo $_SESSION['mini-size']; ?>px;
	width:<?php echo $_SESSION['mini-size']; ?>px;
	vertical-align:middle;
	text-align:center;
	white-space:normal;
	padding:0px;
	margin:0px;
	border:0px;
}
p.name {overflow: hidden;}
#Gal img
{
	max-width:<?php echo $_SESSION['mini-size']; ?>px;
	max-height:<?php echo $_SESSION['mini-size']; ?>px;
	padding:0px;
	margin:0px;
}
#Gal input
{
	position:absolute;
	bottom:2px;
	left:0px;
	padding:0px 3px;
	z-index:3;
}
span.menu
{
	position:absolute;
	top:2px;
	right:2px;
	padding:0px;
	margin:0px;
	height:<?php echo $_SESSION['mini-size']-2; ?>px;
	width:<?php echo $_SESSION['mini-size']-2; ?>px;
	z-index:2;
}
span.menu:hover
{
	background:url(/.AJAX-Ico/MiniMenu.png) no-repeat top right;
}
span.info
{
	position:absolute;
	bottom:0px;
	right:0px;
	padding:0px;
	margin:0px;
	height:<?php echo $_SESSION['mini-size']-2; ?>px;
	width:<?php echo $_SESSION['mini-size']-2; ?>px;
	z-index:2;
}
span.info:hover
{
	background:url(/.AJAX-Ico/Infos.png) no-repeat bottom right;
}
span.menuClicker
{
	position:absolute;
	top:1px;
	right:1px;
	padding:0px;
	margin:0px;
	width:15;
	height:20;
	z-index:3;
}
span.infoClicker
{
	position:absolute;
	bottom:1px;
	right:1px;
	padding:0px;
	margin:0px;
	width:15;
	height:16;
	z-index:3;
}
</style>