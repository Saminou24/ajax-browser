<div class="Gal">
	<div id="<?php echo encode64($parent=ereg_replace('^'.realpath('./'),'.',realpath(decode64($racine64).'../').'/'));?>" title='<?php echo $parent?>' onclick="location.href='<?php echo str_replace($racine64, encode64($parent), RebuildURL())?>'">
		<table><tbody><tr><td>
			<img src="./.AJAX-B/icones/type-folder...png"><br>
			<p class="name"><?php echo $parent?></p>
		</td></tr></tbody></table>
	</div>
</div>
<div id="Gal">
<?php
if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== FALSE || isset($ie))
{
	$Lst=DirSort (decode64($racine64),'all');
	if ($Lst)
		foreach ($Lst as $item)
			echo DegradeMode (decode64($racine64).$item);
	echo '<a href="">'.$ABS['getFF'].'</a>';
}?>
</div>
<?php
function DegradeMode ($Item)
{
	global $racine64, $modelGal;
	$item=InfosByURL($Item);
	$ReplaceLst = array (
		'%item%' => $item['basename'],
		'%item64%' => encode64($Item),
				       '%icone%' =>(is_dir($Item) || !isset($item['content0'])) ? $InstallDir."icones/type-".FileIco($Item).".png" : CreatMini($Item,$_SESSION['AJAX-B']['mini_dir'], $_SESSION['AJAX-B']['mini_size']),
		'%name%' =>(is_dir($Item) || !isset($item['content0'])) ? '<p class="name">'.$item['basename'].'</p>' : '',
		'%real_size%' => $item['size'],
		'%size%' => SizeConvert ($item['size']),
		'%type%' => $item['type'],
		'%link%'=>is_dir($Item)?str_replace($racine64, encode64($Item), RebuildURL()):'?mode=request&view='.encode64($Item)
);
	if ($_SESSION['AJAX-B']['droits']['.VIEW'] || !ereg ('^\.',$item['basename']))
		return str_replace (array_keys($ReplaceLst),($ReplaceLst),$modelGal);
	else return '';
}
?>
