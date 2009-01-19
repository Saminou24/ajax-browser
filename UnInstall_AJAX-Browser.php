<?php

function SupItem($Item)
{
	if (is_dir($Item))
	{
		if (is_array($SubFile = scandir ($Item)))
			foreach ($SubFile as $File)
				if ($File != '.' && $File != '..') SupItem($Item."/".$File);
		return (!rmdir($Item));
	}
	else return (!unlink($Item));
}

SupItem('./Mini/');
SupItem('./Spy/');
SupItem('./AJAX-B/');
SupItem('./AJAX-Browser.php');
SupItem('./UnInstall_AJAX-Browser.php');

?>
