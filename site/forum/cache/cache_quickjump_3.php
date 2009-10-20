<?php

if (!defined('FORUM')) exit;
define('FORUM_QJ_LOADED', 1);
$forum_id = isset($forum_id) ? $forum_id : 0;

?><form id="qjump" method="get" accept-charset="utf-8" action="http://ajaxb.homelinux.org/forum/viewforum.php">
	<div class="frm-fld frm-select">
		<label for="qjump-select"><span><?php echo $lang_common['Jump to'] ?></span></label><br />
		<span class="frm-input"><select id="qjump-select" name="id">
			<optgroup label="AjaxBrowser [Pro]">
				<option value="2"<?php echo ($forum_id == 2) ? ' selected="selected"' : '' ?>>[Pro] Installation</option>
				<option value="3"<?php echo ($forum_id == 3) ? ' selected="selected"' : '' ?>>[Pro] Feature requests</option>
				<option value="4"<?php echo ($forum_id == 4) ? ' selected="selected"' : '' ?>>[Pro] Howto</option>
			</optgroup>
			<optgroup label="AjaxBrowser [Free]">
				<option value="7"<?php echo ($forum_id == 7) ? ' selected="selected"' : '' ?>>[Free] Feature requests</option>
				<option value="8"<?php echo ($forum_id == 8) ? ' selected="selected"' : '' ?>>[Free] Howto</option>
				<option value="6"<?php echo ($forum_id == 6) ? ' selected="selected"' : '' ?>>[Free] Installation</option>
			</optgroup>
		</select>
		<input type="submit" value="<?php echo $lang_common['Go'] ?>" onclick="return Forum.doQuickjumpRedirect(forum_quickjump_url, sef_friendly_url_array);" /></span>
	</div>
</form>
<script type="text/javascript">
		var forum_quickjump_url = "http://ajaxb.homelinux.org/forum/viewforum.php?id=$1";
		var sef_friendly_url_array = new Array(6);
	sef_friendly_url_array[2] = "pro-installation";
	sef_friendly_url_array[3] = "pro-feature-requests";
	sef_friendly_url_array[4] = "pro-howto";
	sef_friendly_url_array[7] = "free-feature-requests";
	sef_friendly_url_array[8] = "free-howto";
	sef_friendly_url_array[6] = "free-installation";
</script>
