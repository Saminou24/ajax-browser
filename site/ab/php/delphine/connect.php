<?php
$SERVEUR="localhost";
$LOGIN="idc";
$MDP="dpegef";
$MABASE="idc";
// $MABASE="projet_ue116bis";

$CONNEXION=mysql_connect($SERVEUR,$LOGIN,$MDP);

mysql_select_db($MABASE);
mysql_query("SET CHARACTER SET utf8;
						SET character_set_client = 'utf8';
						SET character_set_connection = 'utf8';
						SET character_set_results = 'utf8';"); // pour travailler en UTF-8
?>