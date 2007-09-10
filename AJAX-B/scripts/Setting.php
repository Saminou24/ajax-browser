<?php
function editSetting ()
{
global $version, $ABS;
?>
<table style="width:400px;margin:3px;margin-right:15px;">
	<tr>
	<tr><td class="border center large" colspan="2"><?php echo $ABS[501].' : '.$version;?></td></tr>
		<td class="border"><?php echo $ABS[502];?><br/>
			<input class="border w1" type='text' name='admin_email' value="<?php echo $GLOBALS['AJAX-Var']['admin_email']; ?>"/><?php echo $ABS[503];?>
		</td>
		<td class="border"><?php echo $ABS[504];?><br/>
			<input class="border w1" type='text' name='ajaxb_miror' ondblclick="this.value='ajaxbrowser.free.fr';" value="<?php echo $GLOBALS['AJAX-Var']['ajaxb_miror']; ?>"/><?php echo $ABS[505];?>
		</td>
	</tr>
	<tr><td class="border center" colspan="2">
<?php
if (!empty($_SESSION['AJAX-B']['ajaxb_miror']))
{
	list($V1, $V2, $V3, $V4) = sscanf($version,'%d.%d.%d%s');
	$NewVersion = @file_get_contents ('http://'.$_SESSION['AJAX-B']['ajaxb_miror'].'/Archives/LastVersion.php?version');
	list($v1, $v2, $v3, $V4) = sscanf($NewVersion, '%d.%d.%d%s');
	if (!$NewVersion) echo $ABS[506];
	elseif ($v1*1000+$v2*100+$v3 > $V1*1000+$V2*100+$V3)
		echo '<a href="?mode=request&maj">'.$ABS[508].' : '.$NewVersion.'</a>';
	else echo $ABS[507];
}
?>
	</td></tr>
	<tr><td colspan="2"><br/></td></tr>
	<tr>
		<td colspan="2"><?php echo $ABS[509];?><br/>
			<INPUT class="w3" name="always_mask" id="always_mask" type="text" ondblclick="this.value='*.html,*.png,*.jpg,*.txt';" value="<?php echo implode(',', $GLOBALS['AJAX-Var']['always_mask']);?>">
		</td>
	</tr>
	<tr>
		<td colspan="2"><?php echo $ABS[510];?><br/>
			<INPUT class="w3" name="restrict_mask" id="restrict_mask" type="text" ondblclick="this.value='*.php,*.php5,*.asp,*.bin,*.exe';" value="<?php echo implode(',',$GLOBALS['AJAX-Var']['restrict_mask']);?>">
		</td>
	</tr>
	<tr>
		<td colspan="2"><?php echo $ABS[511];?><br/>
			<INPUT class="w3" name="codepress_mask" id="codepress_mask" type="text" ondblclick="this.value='*.html,*.txt,*.php,*.php5,*.asp,*.*~';" value="<?php echo implode(',',$GLOBALS['AJAX-Var']['codepress_mask']);?>">
		</td>
	</tr>
	<tr><td colspan="2"><br/></td></tr>
	<tr>
		<td class="border" title=""><?php echo $ABS[512];?><br/><br/>
			<INPUT class="w1" type='text' ondblclick="this.value=decode64(racine64);" title="<?php echo $ABS[500];?>" name="spy_dir" VALUE="<?php echo $GLOBALS['AJAX-Var']['spy_dir']; ?>"/><br/>
		</td>
		<td class="border"><?php echo $ABS[513];?><br/>
		<input name="ip" id="ip" type="checkbox" <?php echo ($GLOBALS['AJAX-Var']['spy']['ip']?'checked':'');?>>
			<label for="ip" title="<?php echo $ABS[519];?>"><?php echo $ABS[514];?></label><br/>
		<input name="log" id="log" type="checkbox" <?php echo ($GLOBALS['AJAX-Var']['spy']['log']?'checked':'');?>>
			<label for="log"><?php echo $ABS[515];?></label><br/>
		<input name="action" id="action" type="checkbox" <?php echo ($GLOBALS['AJAX-Var']['spy']['action']?'checked':'');?>>
			<label for="action" title="<?php echo $ABS[518];?>"><?php echo $ABS[516];?></label><br/>
		<input name="browse" id="browse" type="checkbox" <?php echo ($GLOBALS['AJAX-Var']['spy']['browse']?'checked':'');?>>
			<label for="browse" title="<?php echo $ABS[518];?>"><?php echo $ABS[517];?></label><br/>
	</td></tr>
	<tr><td colspan="2"><br/></td></tr>
	<tr>
		<td title="" class="border"><?php echo $ABS[520];?><br/>
			<INPUT class="w1" type='text' ondblclick="this.value=decode64(racine64);" title="<?php echo $ABS[500];?>" name="mini_dir" VALUE="<?php echo $GLOBALS['AJAX-Var']['mini_dir']; ?>"/>
		<td title=""><span class="button center" onclick="PopBox('mode=request&erasemini=','OpenBox(request.responseText);');"><?php echo $ABS[527];?></span></td>
	</tr>
	<tr>
		<td title="" colspan="2" class="border"><?php echo $ABS[520];?><br/>
			<br/><?php echo $ABS[521];?><br/>
			<INPUT type=radio name="mini_intervale" value=10 id="intervale10" <?php echo ($GLOBALS['AJAX-Var']['mini_intervale']==10) ? "checked" : ""; ?>>
				<label for="intervale10"><?php echo $ABS[522];?></label><br/>
			<INPUT type=radio name="mini_intervale" value=100 id="intervale100" <?php echo ($GLOBALS['AJAX-Var']['mini_intervale']==100) ? "checked" : ""; ?>>
				<label for="intervale100"><?php echo $ABS[523];?></label><br/>
			<INPUT type=radio name="mini_intervale" value=250 id="intervale250" <?php echo ($GLOBALS['AJAX-Var']['mini_intervale']==250) ? "checked" : ""; ?>>
				<label for="intervale250"><?php echo $ABS[524];?></label><br/>
			<INPUT type=radio name="mini_intervale" value=500 id="intervale500" <?php echo ($GLOBALS['AJAX-Var']['mini_intervale']==500) ? "checked" : ""; ?>>
				<label for="intervale500"><?php echo $ABS[525];?></label><br/>
			<INPUT type=radio name="mini_intervale" value=1500 id="intervale1500" <?php echo ($GLOBALS['AJAX-Var']['mini_intervale']==1500) ? "checked" : ""; ?>>
				<label for="intervale1500"><?php echo $ABS[526];?></label><br/>
		</td>
	</tr>
	<tr><td colspan="2"><br/></td></tr>
	<tr>
		<td class="button center" style="width:50%;" onclick="PopBox('mode=request&accounts=','OpenBox(request.responseText);')"><?php echo $ABS[4];?></td>
		<td class="button center" style="width:50%;" onclick="form=document.forms[0];PopBox('mode=request&setting=save'+
'&admin_email='+encode64(form.admin_email.value)+ '&mini_intervale='+getCheckedRadio(form.mini_intervale)+ '&ajaxb_miror='+form.ajaxb_miror.value+ '&mini_dir='+encode64(form.mini_dir.value)+ '&spy_dir='+encode64(form.spy_dir.value)+ '&ip='+form.ip.checked+ '&log='+form.log.checked+ '&action='+form.action.checked+ '&browse='+form.browse.checked+ '&always_mask='+encode64(form.always_mask.value)+ '&restrict_mask='+encode64(form.restrict_mask.value)+ '&codepress_mask='+encode64(form.codepress_mask.value), 'ID(\'Box\').style.display=\'none\'')"><?php echo $ABS[10];?></td>
	</tr>
</table>
<?php
}
function saveSetting ()
{
	global $admin_email, $ajaxb_miror, $restrict_mask, $always_mask, $codepress_mask, $mini_dir, $spy_dir, $ip, $log, $action, $browse, $mini_intervale,$InstallDir;
	$GLOBALS['AJAX-Var'] = array
	(
		'admin_email' => decode64($admin_email),
		'ajaxb_miror' => $ajaxb_miror,
		'restrict_mask' => explode(',', decode64($restrict_mask)),
		'always_mask' => explode(',', decode64($always_mask)),
		'codepress_mask' => explode(',', decode64($codepress_mask)),
		'mini_dir' => decode64($mini_dir),
		'mini_intervale' => eval('return '.$mini_intervale.';'),
		'spy_dir' => decode64($spy_dir),
		'spy' => array (
			'ip' => eval('return '.$ip.';'),
			'log' => eval('return '.$log.';'),
			'action' => eval('return '.$action.';'),
			'browse' => eval('return '.$browse.';')
			),
		'accounts' => $GLOBALS['AJAX-Var']["accounts"]
	);
	WriteInFile ($InstallDir.'AJAX-Array.var', serialize($GLOBALS['AJAX-Var']), "sup");
}
?>