<?php
/*# -------- INCLUDE -------- */
require(INSTALLPATH.'core.php');
// Load all modules in sorting order
$modules = glob(MODPATH.'*/core.php');
foreach($modules as $m)
{
	require ($m);
}

?>
