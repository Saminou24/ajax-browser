<?php

define('FORUM_HOOKS_LOADED', 1);

$forum_hooks = array (
  'po_pre_post_contents' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($fid && $forum_user[\'g_pun_tags_allow\'])
			{

				?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text required longtext">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_tags[\'Topic tags\']; ?></span><small><?php echo $lang_pun_tags[\'Enter tags\']; ?></small></label><br />
							<span class="fld-input"><input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="pun_tags" value="<?php echo empty($_POST[\'pun_tags\']) ? \'\' : forum_htmlencode($_POST[\'pun_tags\']) ?>" size="80" maxlength="100"/></span>
					</div>
				</div>
			<?php

			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ed_pre_message_box' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($can_edit_subject && $forum_user[\'g_pun_tags_allow\'])
			{
				$res_tags = array();
				if (isset($pun_tags[\'topics\'][$cur_post[\'tid\']]))
				{
					foreach ($pun_tags[\'topics\'][$cur_post[\'tid\']] as $tag_id)
						$res_tags[] = $pun_tags[\'index\'][$tag_id];
				}

			?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text required longtext">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_tags[\'Topic tags\']; ?></span><small><?php echo $lang_pun_tags[\'Enter tags\']; ?></small></label><br />
							<span class="fld-input"><input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="pun_tags" value="<?php if (!empty($res_tags)) echo implode(\', \', $res_tags); else echo \'\';  ?>" size="80" maxlength="100"/></span>
					</div>
				</div>
			<?php

			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'co_modify_url_scheme' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_broadcast_email\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_broadcast_email\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_broadcast_email\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$forum_url[\'pun_broadcast_email\'] = \'admin/extensions.php?section=broadcast_email\';
			$forum_url[\'pun_broadcast_email_help\'] = \'admin/extensions.php?section=broadcast_email&amp;help\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (file_exists($ext_info[\'path\'].\'/url/\'.$forum_config[\'o_sef\'].\'.php\'))
				require $ext_info[\'path\'].\'/url/\'.$forum_config[\'o_sef\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/url/Default.php\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aex_new_action' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_broadcast_email\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_broadcast_email\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_broadcast_email\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($section == \'broadcast_email\')
			{
				if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
					include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				else
					include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				include $ext_info[\'path\'].\'/functions.php\';

				$forum_page = array();
				$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = $forum_page[\'fld_count\'] = 0;

				$forum_page[\'selected_groups\'] = array();
				$forum_page[\'email_subject\'] = \'\';
				$forum_page[\'email_message\'] = \'\';
				$forum_page[\'errors\'] = array();
				if (isset($_POST[\'form_sent\']) || isset($_GET[\'start_at\']))
				{
					if (isset($_POST[\'form_sent\']))
					{
						$forum_page[\'selected_groups\']= isset($_POST[\'groups\']) && is_array($_POST[\'groups\']) ? $_POST[\'groups\'] : array();
						$forum_page[\'parse_mail\'] = isset($_POST[\'parse_mail\']) && $_POST[\'parse_mail\'] == \'1\' ? true : false;
						$forum_page[\'email_subject\'] = forum_trim($_POST[\'req_subject\']);
						$forum_page[\'email_message\'] = forum_linebreaks(forum_trim($_POST[\'req_message\']));
						$forum_page[\'per_page\'] = isset($_POST[\'per_page\']) && intval($_POST[\'per_page\']) > 0 ? intval($_POST[\'per_page\']) : false;
					}
					//Start at determined, fetch info from cookie
					if (isset($_GET[\'start_at\']))
					{
						$forum_page[\'start_at\'] = intval($_GET[\'start_at\']) > 0 ? intval($_GET[\'start_at\']) : false;
						if (!$forum_page[\'start_at\'])
							message($lang_common[\'Bad request\']);
						$cookie_data = pun_admin_broadcast_email_get_cookie_data();
						if (!$cookie_data)
							message($lang_pun_admin_broadcast_email[\'Cookie fail\']);
						$forum_page[\'selected_groups\'] = explode(\',\', $cookie_data[\'groups\']);
						$parse_mail = forum_trim($cookie_data[\'parse_mail\']);
						$use_tpl_vars = substr($parse_mail, strrpos($parse_mail, \':\') + 1);
						if ($use_tpl_vars != \'0\' && $use_tpl_vars != \'1\')
							message($lang_common[\'Bad request\']);
						$forum_page[\'parse_mail\'] = $use_tpl_vars;
						$forum_page[\'email_subject\'] = forum_trim($cookie_data[\'req_subject\']);
						$forum_page[\'email_message\'] = forum_linebreaks(forum_trim($cookie_data[\'req_message\']));
						$forum_page[\'per_page\'] = isset($_GET[\'per_page\']) && intval($_GET[\'per_page\']) > 0 ? intval($_GET[\'per_page\']) : false;
					}
					$forum_page[\'selected_groups\'] = array_map(\'intval\', $forum_page[\'selected_groups\']);

					if (empty($forum_page[\'selected_groups\']))
						$forum_page[\'errors\'][] = $lang_pun_admin_broadcast_email[\'Err no groups\'];
					if (in_array(FORUM_GUEST, $forum_page[\'selected_groups\']))
						$forum_page[\'errors\'][] = $lang_pun_admin_broadcast_email[\'Err guest group\'];

					if (!$forum_page[\'per_page\'])
						$forum_page[\'errors\'][] = $lang_pun_admin_broadcast_email[\'Err per page\'];

					if (empty($forum_page[\'email_subject\']))
						$forum_page[\'errors\'][] = $lang_pun_admin_broadcast_email[\'Err no subject\'];
					else if (utf8_strlen($forum_page[\'email_subject\']) > 70)
						$forum_page[\'errors\'][] = $lang_pun_admin_broadcast_email[\'Err long subject\'];

					// Clean up message from POST
					if (empty($forum_page[\'email_message\']))
						$forum_page[\'errors\'][] = $lang_pun_admin_broadcast_email[\'Err no message\'];
					if (strlen($forum_page[\'email_message\']) > FORUM_MAX_POSTSIZE_BYTES)
						$forum_page[\'errors\'][] = sprintf($lang_pun_admin_broadcast_email[\'Err long message\'], forum_number_format(strlen($forum_page[\'email_message\'])), forum_number_format(FORUM_MAX_POSTSIZE_BYTES));

					if (empty($forum_page[\'errors\']) && !isset($_POST[\'preview\']))
					{
						//Sending e-mails
						if (!defined(\'FORUM_EMAIL_FUNCTIONS_LOADED\'))
							include FORUM_ROOT.\'/include/email.php\';

						@set_time_limit(0);
						$pun_broadcast_query = array(
							\'SELECT\'	=>	\'*\',
							\'FROM\'		=>	\'users\',
							\'WHERE\'		=>	\'group_id IN (\'.implode(\',\', $forum_page[\'selected_groups\']).\')\'
						);
						if (isset($forum_page[\'start_at\']))
						{
							$pun_broadcast_query[\'LIMIT\'] = $forum_page[\'start_at\'].\', \'.$forum_page[\'per_page\'];
							$forum_page[\'start_at\'] = $forum_page[\'start_at\'] + $forum_page[\'per_page\'];
						}
						else
						{
							$pun_broadcast_query[\'LIMIT\'] = $forum_page[\'per_page\'];
							$forum_page[\'start_at\'] = $forum_page[\'per_page\'];
						}
						$pun_broadcast_result = $forum_db->query_build($pun_broadcast_query) or error(__FILE__, __LINE__);

						if (!$forum_db->num_rows($pun_broadcast_result))
							redirect(forum_link($forum_url[\'pun_broadcast_email\']), $lang_pun_admin_broadcast_email[\'Task finished\'].$lang_common[\'Redirecting\'].\'…\');

						$forum_page[\'email_num\'] = 0;
						while ($cur_user = $forum_db->fetch_assoc($pun_broadcast_result))
						{
							pun_admin_broadcast_email_send_mail($forum_page[\'email_subject\'], $forum_page[\'email_message\'], $cur_user, $forum_page[\'parse_mail\']);
							$forum_page[\'email_num\']++;
						}
						if ($forum_page[\'per_page\'] == $forum_page[\'email_num\'])
						{
							pun_admin_broadcast_email_set_cookie_data($forum_page[\'selected_groups\'], \'use_vars:\'.(int) $forum_page[\'parse_mail\'], $forum_page[\'email_subject\'], $forum_page[\'email_message\']);
							$query_str = \'&start_at=\'.$forum_page[\'start_at\'].\'&per_page=\'.$forum_page[\'per_page\'];
							exit(\'<script type="text/javascript">window.location="\'.forum_link($forum_url[\'pun_broadcast_email\']).$query_str .\'"</script><br />\'.$lang_pun_admin_broadcast_email[\'Javascript redirect\'].\' <a href="\'.forum_link($forum_url[\'pun_broadcast_email\']).$query_str.\'">\'.$lang_pun_admin_broadcast_email[\'Click to continue\'].\'</a>.\');
						}
						redirect(forum_link($forum_url[\'pun_broadcast_email\']), $lang_pun_admin_broadcast_email[\'Task finished\'].$lang_common[\'Redirecting\'].\'…\');
					}
				}

				if (isset($_GET[\'help\']))
				{
					$forum_page[\'help_vars\'] = array();
					$forum_page[\'help_vars\'][\'%_username_%\'] = array(\'description\' => $lang_pun_admin_broadcast_email[\'Help username\'], \'example\' => $forum_user[\'username\']);
					$forum_page[\'help_vars\'][\'%_title_%\'] = array(\'description\' => $lang_pun_admin_broadcast_email[\'Help user title\'], \'example\' => $forum_user[\'title\']);
					$forum_page[\'help_vars\'][\'%_realname_%\'] = array(\'description\' => $lang_pun_admin_broadcast_email[\'Help realname\'], \'example\' => $forum_user[\'realname\']);
					$forum_page[\'help_vars\'][\'%_num_posts_%\'] = array(\'description\' => $lang_pun_admin_broadcast_email[\'Help num posts\'], \'example\' => $forum_user[\'num_posts\']);
					$forum_page[\'help_vars\'][\'%_last_post_%\'] = array(\'description\' => $lang_pun_admin_broadcast_email[\'Help last post\'], \'example\' => format_time($forum_user[\'last_post\']));
					$forum_page[\'help_vars\'][\'%_registered_%\'] = array(\'description\' => $lang_pun_admin_broadcast_email[\'Help reg date\'], \'example\' => format_time($forum_user[\'registered\']));
					$forum_page[\'help_vars\'][\'%_registration_ip_%\'] = array(\'description\' => $lang_pun_admin_broadcast_email[\'Help reg IP\'], \'example\' => $forum_user[\'registration_ip\']);
					$forum_page[\'help_vars\'][\'%_last_visit_%\'] = array(\'description\' => $lang_pun_admin_broadcast_email[\'Help last visit\'], \'example\' => format_time($forum_user[\'last_visit\']));
					$forum_page[\'help_vars\'][\'%_admin_note_%\'] = array(\'description\' => $lang_pun_admin_broadcast_email[\'Help admin note\'], \'example\' => $forum_user[\'admin_note\']);
					$forum_page[\'help_vars\'][\'%_profile_url_%\'] = array(\'description\' => $lang_pun_admin_broadcast_email[\'Help user profile\'], \'example\' => forum_link($forum_url[\'user\'], $forum_user[\'id\']));
				}
				else
				{
					//Fetch all groups
					$pun_broadcast_query = array(
						\'SELECT\'	=>	\'group_id, g_title, g_user_title, COUNT(id) AS user_count\',
						\'FROM\'		=>	\'users AS u\',
						\'JOINS\'		=>	array(
							array(
								\'LEFT JOIN\'	=>	\'groups AS g\',
								\'ON\'		=>	\'u.group_id = g.g_id\'
							)
						),
						\'WHERE\'		=>	\'group_id <> \'.FORUM_GUEST,
						\'GROUP BY\'	=>	\'group_id\'
					);
					$pun_broadcast_result = $forum_db->query_build($pun_broadcast_query) or error(__FILE__, __LINE__);

					require FORUM_ROOT.\'lang/\'.$forum_user[\'language\'].\'/admin_users.php\';

					$forum_page[\'groups\'] = array();
					while ($cur_group = $forum_db->fetch_assoc($pun_broadcast_result))
					{
						if ($cur_group[\'group_id\'] == FORUM_UNVERIFIED)
							$forum_page[\'groups\'][] = array(\'group_id\' => FORUM_UNVERIFIED, \'g_title\' => $lang_admin_users[\'Unverified users\'], \'g_user_title\' => $lang_admin_users[\'Unverified users\'], \'user_count\' => $cur_group[\'user_count\']);
						else
							$forum_page[\'groups\'][] = $cur_group;
					}

					$forum_page[\'form_action\'] = forum_link($forum_url[\'pun_broadcast_email\']);

					$forum_page[\'hidden_fields\'] = array();
					$forum_page[\'hidden_fields\'][\'csrf_token\'] = generate_form_token($forum_page[\'form_action\']);
					$forum_page[\'hidden_fields\'][\'form_sent\'] = 1;
				}
				if (empty($forum_page[\'errors\']) && isset($_POST[\'preview\']))
				{
					$pattern = array("\\n", "\\t", \'  \', \'  \');
					$replace = array(\'<br />\', \'&nbsp; &nbsp; \', \'&nbsp; \', \' &nbsp;\');
					$forum_page[\'preview\'][\'email_subject\'] = str_replace($pattern, $replace, $forum_page[\'parse_mail\'] ? pun_admin_broadcast_email_parse_string($forum_page[\'email_subject\'], $forum_user) : $forum_page[\'email_subject\']);
					$forum_page[\'preview\'][\'email_message\'] = str_replace($pattern, $replace, $forum_page[\'parse_mail\'] ? pun_admin_broadcast_email_parse_string($forum_page[\'email_message\'], $forum_user) : $forum_page[\'email_message\']);
				}
				// Setup breadcrumbs
				$forum_page[\'crumbs\'] = array(
					array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
					array($lang_admin_common[\'Forum administration\'], forum_link($forum_url[\'admin_index\'])),
					array($lang_admin_common[\'Management\'], forum_link($forum_url[\'admin_reports\'])),
					array(\'Broadcast email\', forum_link($forum_url[\'pun_broadcast_email\']))
				);

				define(\'FORUM_PAGE_SECTION\', \'management\');
				define(\'FORUM_PAGE\', \'admin-broadcast_email\');
				if (isset($_GET[\'help\']))
					include $ext_info[\'path\'].\'/pages/help.php\';
				else
					include $ext_info[\'path\'].\'/pages/main.php\';
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

// Clear pun_repository cache
if (isset($_GET[\'pun_repository_update\']))
{
	// Validate CSRF token
	if (!isset($_POST[\'csrf_token\']) && (!isset($_GET[\'csrf_token\']) || $_GET[\'csrf_token\'] !== generate_form_token(\'pun_repository_update\')))
		csrf_confirm_form();

	if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\'))
		include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\';
	else
		include $ext_info[\'path\'].\'/lang/English/pun_repository.php\';

	@unlink(FORUM_CACHE_DIR.\'cache_pun_repository.php\');
	if (file_exists(FORUM_CACHE_DIR.\'cache_pun_repository.php\'))
		message($lang_pun_repository[\'Unable to remove cached file\'], \'\', $lang_pun_repository[\'PunBB Repository\']);

	redirect($base_url.\'/admin/extensions.php?section=manage\', $lang_pun_repository[\'Cache has been successfully cleared\']);
}

if (isset($_GET[\'pun_repository_download_and_install\']))
{
	$ext_id = preg_replace(\'/[^0-9a-z_]/\', \'\', $_GET[\'pun_repository_download_and_install\']);

	// Validate CSRF token
	if (!isset($_POST[\'csrf_token\']) && (!isset($_GET[\'csrf_token\']) || $_GET[\'csrf_token\'] !== generate_form_token(\'pun_repository_download_and_install_\'.$ext_id)))
		csrf_confirm_form();

	// TODO: Should we check again for unresolved dependencies here?

	if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\'))
		include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\';
	else
		include $ext_info[\'path\'].\'/lang/English/pun_repository.php\';

	require_once $ext_info[\'path\'].\'/pun_repository.php\';

	($hook = get_hook(\'pun_repository_download_and_install_start\')) ? eval($hook) : null;

	// Download extension
	$pun_repository_error = pun_repository_download_extension($ext_id, $ext_data);

	if ($pun_repository_error == \'\')
	{
		if (empty($ext_data))
			redirect($base_url.\'/admin/extensions.php?section=manage\', $lang_pun_repository[\'Incorrect manifest.xml\']);

		// Validate manifest
		$errors = validate_manifest($ext_data, $ext_id);
		if (!empty($errors))
			redirect($base_url.\'/admin/extensions.php?section=manage\', $lang_pun_repository[\'Incorrect manifest.xml\']);

		// Everything is OK. Start installation.
		redirect($base_url.\'/admin/extensions.php?install=\'.urlencode($ext_id), $lang_pun_repository[\'Download successful\']);
	}

	($hook = get_hook(\'pun_repository_download_and_install_end\')) ? eval($hook) : null;
}

// Handling the download and update extension action
if (isset($_GET[\'pun_repository_download_and_update\']))
{
	$ext_id = preg_replace(\'/[^0-9a-z_]/\', \'\', $_GET[\'pun_repository_download_and_update\']);

	// Validate CSRF token
	if (!isset($_POST[\'csrf_token\']) && (!isset($_GET[\'csrf_token\']) || $_GET[\'csrf_token\'] !== generate_form_token(\'pun_repository_download_and_update_\'.$ext_id)))
		csrf_confirm_form();

	if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\'))
		include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\';
	else
		include $ext_info[\'path\'].\'/lang/English/pun_repository.php\';

	require_once $ext_info[\'path\'].\'/pun_repository.php\';

	$pun_repository_error = \'\';

	($hook = get_hook(\'pun_repository_download_and_update_start\')) ? eval($hook) : null;

	@pun_repository_rm_recursive(FORUM_ROOT.\'extensions/\'.$ext_id.\'.old\');

	// Check dependancies
	$query = array(
		\'SELECT\'	=> \'e.id\',
		\'FROM\'		=> \'extensions AS e\',
		\'WHERE\'		=> \'e.disabled=0 AND e.dependencies LIKE \\\'%|\'.$forum_db->escape($ext_id).\'|%\\\'\'
	);

	($hook = get_hook(\'aex_qr_get_disable_dependencies\')) ? eval($hook) : null;
	$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);

	if ($forum_db->num_rows($result) != 0)
	{
		$dependency = $forum_db->fetch_assoc($result);
		$pun_repository_error = sprintf($lang_admin[\'Disable dependency\'], $dependency[\'id\']);
	}

	if ($pun_repository_error == \'\' && ($ext_id != $ext_info[\'id\']))
	{
		// Disable extension
		$query = array(
			\'UPDATE\'	=> \'extensions\',
			\'SET\'		=> \'disabled=1\',
			\'WHERE\'		=> \'id=\\\'\'.$forum_db->escape($ext_id).\'\\\'\'
		);

		($hook = get_hook(\'aex_qr_update_disabled_status\')) ? eval($hook) : null;
		$forum_db->query_build($query) or error(__FILE__, __LINE__);

		// Regenerate the hooks cache
		require_once FORUM_ROOT.\'include/cache.php\';
		generate_hooks_cache();
	}

	if ($pun_repository_error == \'\')
	{
		if ($ext_id == $ext_info[\'id\'])
		{
			// Hey! That\'s me!
			// All the necessary files should be included before renaming old directory
			// NOTE: Self-updating is to be tested more in real-life conditions
			if (!defined(\'PUN_REPOSITORY_TAR_EXTRACT_INCLUDED\'))
				require $ext_info[\'path\'].\'/pun_repository_tar_extract.php\';
		}

		$pun_repository_error = pun_repository_download_extension($ext_id, $ext_data, FORUM_ROOT.\'extensions/\'.$ext_id.\'.new\'); // Download the extension

		if ($pun_repository_error == \'\')
		{
			if (is_writable(FORUM_ROOT.\'extensions/\'.$ext_id))
				pun_repository_dir_copy(FORUM_ROOT.\'extensions/\'.$ext_id.\'.new/\'.$ext_id, FORUM_ROOT.\'extensions/\'.$ext_id);
			else
				$pun_repository_error = sprintf($lang_pun_repository[\'Copy fail\'], FORUM_ROOT.\'extensions/\'.$ext_id);
		}
	}

	if ($pun_repository_error == \'\')
	{
		// Do we have extension data at all? :-)
		if (empty($ext_data))
			$errors = array(true);

		// Validate manifest
		if (empty($errors))
			$errors = validate_manifest($ext_data, $ext_id);

		if (!empty($errors))
			$pun_repository_error = $lang_pun_repository[\'Incorrect manifest.xml\'];
	}

	if ($pun_repository_error == \'\')
	{
		($hook = get_hook(\'pun_repository_download_and_update_ok\')) ? eval($hook) : null;

		// Everything is OK. Start installation.
		pun_repository_rm_recursive(FORUM_ROOT.\'extensions/\'.$ext_id.\'.new\');
		redirect($base_url.\'/admin/extensions.php?install=\'.urlencode($ext_id), $lang_pun_repository[\'Download successful\']);
	}

	($hook = get_hook(\'pun_repository_download_and_update_error\')) ? eval($hook) : null;

	// Enable extension
	$query = array(
		\'UPDATE\'	=> \'extensions\',
		\'SET\'		=> \'disabled=0\',
		\'WHERE\'		=> \'id=\\\'\'.$forum_db->escape($ext_id).\'\\\'\'
	);

	($hook = get_hook(\'aex_qr_update_enabled_status\')) ? eval($hook) : null;
	$forum_db->query_build($query) or error(__FILE__, __LINE__);

	// Regenerate the hooks cache
	require_once FORUM_ROOT.\'include/cache.php\';
	generate_hooks_cache();

	($hook = get_hook(\'pun_repository_download_and_update_end\')) ? eval($hook) : null;
}

// Do we have some error?
if (!empty($pun_repository_error))
{
	// Setup breadcrumbs
	$forum_page[\'crumbs\'] = array(
		array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
		array($lang_admin_common[\'Forum administration\'], forum_link($forum_url[\'admin_index\'])),
		array($lang_admin_common[\'Extensions\'], forum_link($forum_url[\'admin_extensions_manage\'])),
		array($lang_admin_common[\'Manage extensions\'], forum_link($forum_url[\'admin_extensions_manage\'])),
		$lang_pun_repository[\'PunBB Repository\']
	);

	($hook = get_hook(\'pun_repository__pre_header_load\')) ? eval($hook) : null;

	define(\'FORUM_PAGE_SECTION\', \'extensions\');
	define(\'FORUM_PAGE\', \'admin-extensions-pun-repository\');
	require FORUM_ROOT.\'header.php\';

	// START SUBST - <!-- forum_main -->
	ob_start();

	($hook = get_hook(\'pun_repository_display_error_output_start\')) ? eval($hook) : null;

?>
	<div class="main-subhead">
		<h2 class="hn"><span><?php echo $lang_pun_repository[\'PunBB Repository\'] ?></span></h2>
	</div>
	<div class="main-content">
		<div class="ct-box warn-box">
			<p class="warn"><?php echo $pun_repository_error ?></p>
		</div>
	</div>
<?php

	($hook = get_hook(\'pun_repository_display_error_pre_ob_end\')) ? eval($hook) : null;

	$tpl_temp = trim(ob_get_contents());
	$tpl_main = str_replace(\'<!-- forum_main -->\', $tpl_temp, $tpl_main);
	ob_end_clean();
	// END SUBST - <!-- forum_main -->

	require FORUM_ROOT.\'footer.php\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    2 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($section == \'manage_tags\')
			{
				//Get some info about topics with tags
				$topic_info = array();
				if (!empty($pun_tags[\'topics\']))
				{
					$pun_tags_query = array(
						\'SELECT\'	=>	\'id, subject\',
						\'FROM\'		=>	\'topics\',
						\'WHERE\'		=>	\'id IN (\'.implode(\',\', array_keys($pun_tags[\'topics\'])).\')\'
					);
					$pun_tags_result = $forum_db->query_build($pun_tags_query) or error(__FILE__, __LINE__);
					while ($cur_topic = $forum_db->fetch_assoc($pun_tags_result))
						$topic_info[$cur_topic[\'id\']] = $cur_topic[\'subject\'];
				}
			
				if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
					require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				else
					require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
				require $ext_info[\'path\'].\'/pun_tags_url.php\';
			
				if (isset($_POST[\'change_tags\']) && !empty($_POST[\'line_tags\']) && !empty($pun_tags[\'topics\']))
				{
					foreach ($_POST[\'line_tags\'] as $topic_id => $tag_line)
					{
						if (intval($topic_id) < 1)
							break;
						$cur_tags_new = pun_tags_parse_string(utf8_trim($tag_line));
			
						//All tags was removed?
						if (empty($cur_tags_new))
						{
							$pun_tags_query = array(
								\'DELETE\'	=>	\'topic_tags\',
								\'WHERE\'		=>	\'topic_id = \'.$topic_id
							);
							$forum_db->query_build($pun_tags_query) or error(__FILE__, __LINE__);
							continue;
						}
			
						//Collect old tags
						$cur_tags_old = array();
						if (!empty($pun_tags[\'topics\'][$topic_id]))
						{
							foreach ($pun_tags[\'topics\'][$topic_id] as $old_tag_id)
								$cur_tags_old[$old_tag_id] = $pun_tags[\'index\'][$old_tag_id];
						}
						//Nothing changed
						if (implode(\', \', $cur_tags_new) == implode(\', \', array_values($cur_tags_old)))
							continue;
						//This array contain indexes of processed new tags
						$processed_tags = array();
						//The array with tags for removal
						$remove_tags_id = array();
						foreach ($cur_tags_old as $tag_old_id => $tag_old)
						{
							$srch_index = array_search($tag_old, $cur_tags_new);
							//Tag was not changed
							if ($srch_index !== FALSE)
							{
								$processed_tags[] = $srch_index;
								continue;
							}
							//Was tag edited?
							$not_found_edited = TRUE;
							foreach ($cur_tags_new as $cur_tag_new)
								if (strcasecmp($cur_tag_new, $tag_old) == 0)
								{
									$not_found_edited = FALSE;
									$edited_tag_id = $tag_old_id;
									$edited_tag = $cur_tag_new;
									break;
								}
							//Tag removed?
							if ($not_found_edited)
							{
								$remove_tags_id[] = $tag_old_id;
								$processed_tags[] = $tag_old_id;
							}
							else
							{
								//Is this tag already persist in the tag list?
								$edited_tag_id_new = tag_cache_index($edited_tag);
								if ($edited_tag_id_new !== FALSE)
								{
									$pun_tags_query = array(
										\'UPDATE\'	=>	\'topic_tags\',
										\'SET\'		=>	\'tag_id = \'.$edited_tag_id_new,
										\'WHERE\'		=>	\'topic_id = \'.$topic_id.\' AND tag_id = \'.$edited_tag_id
									);
									$forum_db->query_build($pun_tags_query) or error(__FILE__, __LINE__);
								}
								else
									pun_tags_add_new($edited_tag, $topic_id);
			
								$remove_tags_id[] = $tag_old_id;
								$processed_tags[] = $tag_old_id;
							}
						}
						//Is there some new tags
						if (count($processed_tags) != count($cur_tags_new))
						{
							foreach ($cur_tags_new as $cur_new_tag_id => $cur_new_tag)
							{
								if (in_array($cur_new_tag_id, $processed_tags))
									continue;
								$tag_exist_index = tag_cache_index($cur_new_tag);
								if ($tag_exist_index === FALSE)
									pun_tags_add_new($cur_new_tag, $topic_id);
								else
									pun_tags_add_existing_tag($tag_exist_index, $topic_id);
							}
						}
						if (!empty($remove_tags_id))
						{
							$pun_tags_query = array(
								\'DELETE\'	=>	\'topic_tags\',
								\'WHERE\'		=>	\'topic_id = \'.$topic_id.\' AND tag_id IN (\'.implode(\',\', $remove_tags_id).\')\'
							);
							$forum_db->query_build($pun_tags_query) or error(__FILE__, __LINE__);
						}
					}
					pun_tags_remove_orphans();
					pun_tags_generate_cache();
			
					redirect(forum_link($pun_tags_url[\'Section pun_tags\']), $lang_pun_tags[\'Redirect with changes\'].\' \'.$lang_admin_common[\'Redirect\']);
				}
				$forum_page[\'form_action\'] = forum_link($pun_tags_url[\'Section tags\']);
				$forum_page[\'item_count\'] = 1;
			
				$forum_page[\'table_header\'] = array();
				$forum_page[\'table_header\'][\'name\'] = \'<th class="tc1" scope=col">\'.$lang_pun_tags[\'Name topic\'].\'</th>\';
				$forum_page[\'table_header\'][\'tags\'] = \'<th class="tc2" scope=col">\'.$lang_pun_tags[\'Tags of topic\'].\'</th>\';
			
				// Setup breadcrumbs
				$forum_page[\'crumbs\'] = array(
					array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
					array($lang_admin_common[\'Forum administration\'], forum_link($forum_url[\'admin_index\'])),
					array($lang_admin_common[\'Management\'], forum_link($forum_url[\'admin_reports\'])),
					array($lang_pun_tags[\'Section tags\'], forum_link($pun_tags_url[\'Section tags\']))
				);
			
				define(\'FORUM_PAGE_SECTION\', \'management\');
				define(\'FORUM_PAGE\', \'admin-management-manage_tags\');
				require FORUM_ROOT.\'header.php\';
			
				ob_start();
			
				if (!empty($topic_info))
				{
					// Load the userlist.php language file
					if (file_exists(FORUM_ROOT.\'lang/\'.$forum_user[\'language\'].\'/userlist.php\'))
						require FORUM_ROOT.\'lang/\'.$forum_user[\'language\'].\'/userlist.php\';
					else
						require FORUM_ROOT.\'lang/English/userlist.php\';
			
					?>
					<div class="main-subhead">
						<h2 class="hn">
							<span><?php echo $lang_pun_tags[\'Section tags\']; ?></span>
						</h2>
					</div>
					<div class="main-content main-forum">
						<form class="frm-form" id="afocus" method="post" accept-charset="utf-8" action="<?php echo $forum_page[\'form_action\'] ?>">
							<div class="hidden">
								<input type="hidden" name="form_sent" value="1" />
								<input type="hidden" name="csrf_token" value="<?php echo generate_form_token($forum_page[\'form_action\']) ?>" />
							</div>
							<div class="ct-group">
								<table cellspacing="0" summary="<?php echo $lang_ul[\'Table summary\'] ?>">
									<thead>
										<tr><?php echo implode("\\n\\t\\t\\t\\t\\t\\t", $forum_page[\'table_header\'])."\\n" ?></tr>
									</thead>
									<tbody>
									<?php
			
										foreach ($topic_info as $topic_id => $topic_subject)
										{
											$tags_arr = $pun_tags[\'topics\'][$topic_id];
											$cur_tags_arr = array();
											foreach ($tags_arr as $tag_id)
												$cur_tags_arr[] = $pun_tags[\'index\'][$tag_id];
			
									?>
										<tr class="<?php echo ($forum_page[\'item_count\'] % 2 != 0) ? \'odd\' : \'even\' ?><?php echo ($forum_page[\'item_count\'] == 1) ? \' row1\' : \'\' ?>">
											<td class="tc0" scope=col"><a class="permalink" rel="bookmark" href="<?php echo forum_link($forum_url[\'topic\'], $topic_id) ?>"><?php echo forum_htmlencode($topic_subject) ?></a></td>
											<td class="tc1" scope=col"><input id="fld\'<?php echo $forum_page[\'item_count\']; ?>\'" type="text" value="<?php echo forum_htmlencode(implode(\', \', $cur_tags_arr)) ?>" size="100%" name="line_tags[<?php echo $topic_id; ?>]"/></td>
										</tr>
									<?php
			
										}
			
									?>
									</tbody>
								</table>
							</div>
							<div class="frm-buttons">
								<span class="submit"><input type="submit" name="change_tags" value="<?php echo $lang_pun_tags[\'Submit changes\'] ?>" /></span>
							</div>
						</form>
					</div>
				<?php
			
				}
				else
				{
			
					?>
						<div class="main-subhead">
							<h2 class="hn">
								<span><?php echo $lang_pun_tags[\'Section tags\']; ?></span>
							</h2>
						</div>
						<div class="main-content main-forum">
							<div class="ct-box">
								<h3 class="hn"><span><strong><?php echo $lang_pun_tags[\'No tags\']; ?></strong></span></h3>
							</div>
						</div>
			
					<?php
			
				}
			
				$tpl_pun_tags = trim(ob_get_contents());
				$tpl_main = str_replace(\'<!-- forum_main -->\', $tpl_pun_tags, $tpl_main);
				ob_end_clean();
			
				require FORUM_ROOT.\'footer.php\';
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ca_fn_generate_admin_menu_new_sublink' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_admin_broadcast_email\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_admin_broadcast_email\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_admin_broadcast_email\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_user[\'g_id\'] == FORUM_ADMIN && FORUM_PAGE_SECTION == \'management\')
			{
				if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
					include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
				else
					include $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

				$forum_page[\'admin_submenu\'][\'broadcast_mail\'] = \'<li class="\'.((FORUM_PAGE == \'admin-broadcast_email\') ? \'active\' : \'normal\').((empty($forum_page[\'admin_submenu\'])) ? \' first-item\' : \'\').\'"><a href="\'.forum_link($forum_url[\'pun_broadcast_email\']).\'">\'.$lang_pun_admin_broadcast_email[\'Ext name\'].\'</a></li>\';
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

require $ext_info[\'path\'].\'/url.php\';
if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
	require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
else
	require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

if ((FORUM_PAGE_SECTION == \'management\') && ($forum_user[\'g_id\'] == FORUM_ADMIN))
	$forum_page[\'admin_submenu\'][\'pun_attachment_management\'] = \'<li class="\'.((FORUM_PAGE == \'admin-attachment-manage\') ? \'active\' : \'normal\').((empty($forum_page[\'admin_menu\'])) ? \' first-item\' : \'\').\'"><a href="\'.forum_link($attach_url[\'admin_attachment_manage\']).\'">\'.$lang_attach[\'Attachment\'].\'</a></li>\';
if ((FORUM_PAGE_SECTION == \'settings\') && ($forum_user[\'g_id\'] == FORUM_ADMIN))
	$forum_page[\'admin_submenu\'][\'pun_attachment_settings\'] = \'<li class="\'.((FORUM_PAGE == \'admin-options-attach\') ? \'active\' : \'normal\').((empty($forum_page[\'admin_menu\'])) ? \' first-item\' : \'\').\'"><a href="\'.forum_link($attach_url[\'admin_options_attach\']).\'">\'.$lang_attach[\'Attachment\'].\'</a></li>\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    2 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
			require $ext_info[\'path\'].\'/pun_tags_url.php\';
			
			if ((FORUM_PAGE_SECTION == \'management\') && ($forum_user[\'g_id\'] == FORUM_ADMIN))
				$forum_page[\'admin_submenu\'][\'pun_tags_management\'] = \'<li class="\'.((FORUM_PAGE == \'admin-management-manage_tags\') ? \'active\' : \'normal\').((empty($forum_page[\'admin_menu\'])) ? \' first-item\' : \'\').\'"><a href="\'.forum_link($pun_tags_url[\'Section pun_tags\']).\'">\'.$lang_pun_tags[\'Section tags\'].\'</a></li>\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aex_section_manage_pre_header_load' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\'))
	include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\';
else
	include $ext_info[\'path\'].\'/lang/English/pun_repository.php\';

require_once $ext_info[\'path\'].\'/pun_repository.php\';

if (!defined(\'PUN_REPOSITORY_EXTENSIONS_LOADED\') && file_exists(FORUM_CACHE_DIR.\'cache_pun_repository.php\'))
	include FORUM_CACHE_DIR.\'cache_pun_repository.php\';

if (!defined(\'FORUM_EXT_VERSIONS_LOADED\') && file_exists(FORUM_CACHE_DIR.\'cache_ext_version_notifications.php\'))
	include FORUM_CACHE_DIR.\'cache_ext_version_notifications.php\';

// Regenerate cache only if automatic updates are enabled and if the cache is more than 12 hours old
if (!defined(\'PUN_REPOSITORY_EXTENSIONS_LOADED\') || !defined(\'FORUM_EXT_VERSIONS_LOADED\') || ($pun_repository_extensions_timestamp < $forum_ext_versions_update_cache))
{
	if (pun_repository_generate_cache($pun_repository_error))
		require FORUM_CACHE_DIR.\'cache_pun_repository.php\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aex_section_manage_pre_ext_actions' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (defined(\'PUN_REPOSITORY_EXTENSIONS_LOADED\') && isset($pun_repository_extensions[$id]) && version_compare($ext[\'version\'], $pun_repository_extensions[$id][\'version\'], \'<\') && is_writable(FORUM_ROOT.\'extensions/\'.$id))
{
	// Check for unresolved dependencies
	if (isset($pun_repository_extensions[$id][\'dependencies\']))
		$pun_repository_extensions[$id][\'dependencies\'] = pun_repository_check_dependencies($inst_exts, $pun_repository_extensions[$id][\'dependencies\']);

	if (empty($pun_repository_extensions[$id][\'dependencies\'][\'unresolved\']))
		$forum_page[\'ext_actions\'][] = \'<span><a href="\'.$base_url.\'/admin/extensions.php?pun_repository_download_and_update=\'.$id.\'&amp;csrf_token=\'.generate_form_token(\'pun_repository_download_and_update_\'.$id).\'">\'.$lang_pun_repository[\'Download and update\'].\'</a></span>\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'co_common' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$pun_extensions_used = array_merge(isset($pun_extensions_used) ? $pun_extensions_used : array(), array($ext_info[\'id\']));

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$pun_extensions_used = array_merge(isset($pun_extensions_used) ? $pun_extensions_used : array(), array($ext_info[\'id\']));

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    2 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$pun_extensions_used = array_merge(isset($pun_extensions_used) ? $pun_extensions_used : array(), array($ext_info[\'id\']));

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    3 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$pun_extensions_used = array_merge(isset($pun_extensions_used) ? $pun_extensions_used : array(), array($ext_info[\'id\']));

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    4 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$pun_extensions_used = array_merge(isset($pun_extensions_used) ? $pun_extensions_used : array(), array($ext_info[\'id\']));
			if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

			define(\'PUN_TAGS_CACHE_UPDATE\', 12);
			require_once $ext_info[\'path\'].\'/functions.php\';

			if (file_exists(FORUM_CACHE_DIR.\'cache_pun_tags.php\'))
				include FORUM_CACHE_DIR.\'cache_pun_tags.php\';
			// Regenerate cache
			if ((!defined(\'PUN_TAGS_LOADED\') || $pun_tags[\'cached\'] < (time() - 3600 * PUN_TAGS_CACHE_UPDATE)))
			{
				pun_tags_generate_cache();
				require FORUM_CACHE_DIR.\'cache_pun_tags.php\';
			}

			if (file_exists(FORUM_CACHE_DIR.\'cache_pun_tags_groups_perms.php\'))
				include FORUM_CACHE_DIR.\'cache_pun_tags_groups_perms.php\';
			// Regenerate cache if the it is more than $pun_cache_period hours old
			if ((!defined(\'PUN_TAGS_GROUPS_PERMS\') || $pun_tags_groups_perms[\'cached\'] < (time() - 3600 * PUN_TAGS_CACHE_UPDATE)))
			{
				pun_tags_generate_forum_perms_cache();
				require FORUM_CACHE_DIR.\'cache_pun_tags_groups_perms.php\';
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    5 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_quote\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_quote\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_quote\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$pun_extensions_used = array_merge(isset($pun_extensions_used) ? $pun_extensions_used : array(), array($ext_info[\'id\']));

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aex_section_manage_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\'))
	include $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/pun_repository.php\';
else
	include $ext_info[\'path\'].\'/lang/English/pun_repository.php\';

require_once $ext_info[\'path\'].\'/pun_repository.php\';

($hook = get_hook(\'pun_repository_pre_display_ext_list\')) ? eval($hook) : null;

?>
	<div class="main-subhead">
		<h2 class="hn"><span><?php echo $lang_pun_repository[\'PunBB Repository\'] ?></span></h2>
	</div>
	<div class="main-content main-extensions">
		<p class="content-options options"><a href="<?php echo $base_url ?>/admin/extensions.php?pun_repository_update&amp;csrf_token=<?php echo generate_form_token(\'pun_repository_update\') ?>"><?php echo $lang_pun_repository[\'Clear cache\'] ?></a></p>
<?php

if (!defined(\'PUN_REPOSITORY_EXTENSIONS_LOADED\') && file_exists(FORUM_CACHE_DIR.\'cache_pun_repository.php\'))
	include FORUM_CACHE_DIR.\'cache_pun_repository.php\';

if (!defined(\'FORUM_EXT_VERSIONS_LOADED\') && file_exists(FORUM_CACHE_DIR.\'cache_ext_version_notifications.php\'))
	include FORUM_CACHE_DIR.\'cache_ext_version_notifications.php\';

// Regenerate cache only if automatic updates are enabled and if the cache is more than 12 hours old
if (!defined(\'PUN_REPOSITORY_EXTENSIONS_LOADED\') || !defined(\'FORUM_EXT_VERSIONS_LOADED\') || ($pun_repository_extensions_timestamp < $forum_ext_versions_update_cache))
{
	$pun_repository_error = \'\';

	if (pun_repository_generate_cache($pun_repository_error))
	{
		require FORUM_CACHE_DIR.\'cache_pun_repository.php\';
	}
	else
	{

		?>
		<div class="ct-box warn-box">
			<p class="warn"><?php echo $pun_repository_error ?></p>
		</div>
		<?php

		// Stop processing hook
		return;
	}
}

$pun_repository_parsed = array();
$pun_repository_skipped = array();

// Display information about extensions in repository
foreach ($pun_repository_extensions as $pun_repository_ext)
{
	// Skip installed extensions
	if (isset($inst_exts[$pun_repository_ext[\'id\']]))
	{
		$pun_repository_skipped[\'installed\'][] = $pun_repository_ext[\'id\'];
		continue;
	}

	// Skip uploaded extensions (including incorrect ones)
	if (is_dir(FORUM_ROOT.\'extensions/\'.$pun_repository_ext[\'id\']))
	{
		$pun_repository_skipped[\'has_dir\'][] = $pun_repository_ext[\'id\'];
		continue;
	}

	// Check for unresolved dependencies
	if (isset($pun_repository_ext[\'dependencies\']))
		$pun_repository_ext[\'dependencies\'] = pun_repository_check_dependencies($inst_exts, $pun_repository_ext[\'dependencies\']);

	if (empty($pun_repository_ext[\'dependencies\'][\'unresolved\']))
	{
		// \'Download and install\' link
		$pun_repository_ext[\'options\'] = array(\'<a href="\'.$base_url.\'/admin/extensions.php?pun_repository_download_and_install=\'.$pun_repository_ext[\'id\'].\'&amp;csrf_token=\'.generate_form_token(\'pun_repository_download_and_install_\'.$pun_repository_ext[\'id\']).\'">\'.$lang_pun_repository[\'Download and install\'].\'</a>\');
	}
	else
		$pun_repository_ext[\'options\'] = array();

	$pun_repository_parsed[] = $pun_repository_ext[\'id\'];

	// Direct links to archives
	$pun_repository_ext[\'download_links\'] = array();
	foreach (array(\'zip\', \'tgz\', \'7z\') as $pun_repository_archive_type)
		$pun_repository_ext[\'download_links\'][] = \'<a href="\'.PUN_REPOSITORY_URL.\'/\'.$pun_repository_ext[\'id\'].\'/\'.$pun_repository_ext[\'id\'].\'.\'.$pun_repository_archive_type.\'">\'.$pun_repository_archive_type.\'</a>\';

	($hook = get_hook(\'pun_repository_pre_display_ext_info\')) ? eval($hook) : null;

	// Let\'s ptint it all out
?>
		<div class="ct-box info-box extension available" id="<?php echo $pun_repository_ext[\'id\'] ?>">
			<h3 class="ct-legend hn"><span><?php echo forum_htmlencode($pun_repository_ext[\'title\']).\' \'.$pun_repository_ext[\'version\'] ?></span></h3>
			<p><?php echo forum_htmlencode($pun_repository_ext[\'description\']) ?></p>
<?php

	// List extension dependencies
	if (!empty($pun_repository_ext[\'dependencies\'][\'dependency\']))
		echo \'
			<p>\', $lang_pun_repository[\'Dependencies:\'], \' \', implode(\', \', $pun_repository_ext[\'dependencies\'][\'dependency\']), \'</p>\';

?>
			<p><?php echo $lang_pun_repository[\'Direct download links:\'], \' \', implode(\' \', $pun_repository_ext[\'download_links\']) ?></p>
<?php

	// List unresolved dependencies
	if (!empty($pun_repository_ext[\'dependencies\'][\'unresolved\']))
		echo \'
			<div class="ct-box warn-box">
				<p class="warn">\', $lang_pun_repository[\'Resolve dependencies:\'], \' \', implode(\', \', array_map(create_function(\'$dep\', \'return \\\'<a href="#\\\'.$dep.\\\'">\\\'.$dep.\\\'</a>\\\';\'), $pun_repository_ext[\'dependencies\'][\'unresolved\'])), \'</p>
			</div>\';

	// Actions
	if (!empty($pun_repository_ext[\'options\']))
		echo \'
			<p class="options">\', implode(\' \', $pun_repository_ext[\'options\']), \'</p>\';

?>
		</div>
<?php

}

?>
		<div class="ct-box warn-box">
			<p class="warn"><?php echo $lang_pun_repository[\'Files mode and owner\'] ?></p>
		</div>
<?php

if (empty($pun_repository_parsed) && (count($pun_repository_skipped[\'installed\']) > 0 || count($pun_repository_skipped[\'has_dir\']) > 0))
{
	($hook = get_hook(\'pun_repository_no_extensions\')) ? eval($hook) : null;

	?>
		<div class="ct-box info-box">
			<p class="warn"><?php echo $lang_pun_repository[\'All installed or downloaded\'] ?></p>
		</div>
	<?php

}

($hook = get_hook(\'pun_repository_after_ext_list\')) ? eval($hook) : null;

?>
	</div>
<?php

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'rg_start' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

// Load the captcha language file
if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
	require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
else
	require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aop_start' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

// Load the captcha language file
if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
	require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
else
	require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

require $ext_info[\'path\'].\'/include/attach_func.php\';
if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
	require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
else
	require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
require $ext_info[\'path\'].\'/url.php\';

$section = isset($_GET[\'section\']) ? $_GET[\'section\'] : null;

if (isset($_POST[\'apply\']) && ($section == \'list_attach\') && isset($_POST[\'form_sent\']))
	unset($_POST[\'form_sent\']);

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'li_start' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

// Load the captcha language file
if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
	require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
else
	require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'po_start' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

// Load the captcha language file
if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
	require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
else
	require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
{
	require $ext_info[\'path\'].\'/include/attach_func.php\';
	if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
		require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
	else
		require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
	require $ext_info[\'path\'].\'/url.php\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'rg_register_form_submitted' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_config[\'o_pun_antispam_captcha_register\'] == \'1\')
{
	if (session_id() == "")
		session_start();

	if (empty($_SESSION[\'pun_antispam_confirmed_user\']))
	{
		if ((empty($_SESSION[\'pun_antispam_text\']) || strcasecmp(trim($_POST[\'pun_antispam_input\']), $_SESSION[\'pun_antispam_text\']) !== 0))
			$errors[] = $lang_pun_antispam[\'Invalid Text\'];
		else
			$_SESSION[\'pun_antispam_confirmed_user\'] = 1;
	}

	$_SESSION[\'pun_antispam_text\'] = \'\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'rg_register_pre_add_user' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$_SESSION[\'pun_antispam_confirmed_user\'] = 0;

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'rg_register_pre_language' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_config[\'o_pun_antispam_captcha_register\'] == \'1\' && empty($_SESSION[\'pun_antispam_confirmed_user\']))
{
?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text required">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_antispam[\'Captcha\'] ?> <em><?php echo $lang_common[\'Required\'] ?></em></span> <small><?php echo $lang_pun_antispam[\'Captcha Info\'] ?></small></label><br />
						<span class="fld-input"><input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="pun_antispam_input" value="" size="20" maxlength="10" /></span>
					</div>
					<img id="pun_antispam_image" src="<?php echo $ext_info[\'url\'].\'/image.php?\'.md5(time()) ?>" style="vertical-align: middle; margin: 0 1em;" alt="<?php echo $lang_pun_antispam[\'img alt\'] ?>" /><br />
					<script type="text/javascript">document.write("<small><a href=\\"#\\" onclick=\\"document.getElementById(\'pun_antispam_image\').src = \'<?php echo $ext_info[\'url\'].\'/image.php?\' ?>\' + Math.random(); return false\\"><?php echo $lang_pun_antispam[\'reload image\'] ?></a></small>");</script>
				</div>
<?php
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'li_login_form_submitted' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (session_id() == "")
	session_start();

if ($forum_config[\'o_pun_antispam_captcha_login\'] == \'1\' && (isset($_SESSION[\'pun_antispam_logins\']) && $_SESSION[\'pun_antispam_logins\'] > 5) && (empty($_SESSION[\'pun_antispam_text\']) || strcasecmp(trim($_POST[\'pun_antispam_input\']), $_SESSION[\'pun_antispam_text\']) !== 0))
	$errors[] = $lang_pun_antispam[\'Invalid Text\'];

$_SESSION[\'pun_antispam_text\'] = \'\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'li_login_pre_auth_message' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($authorized && empty($errors))
	$_SESSION[\'pun_antispam_logins\'] = 0;

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'li_login_pre_remember_me_checkbox' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_config[\'o_pun_antispam_captcha_login\'] == \'1\')
{
	if (empty($errors) && session_id() == "")
		session_start();

	if (!isset($_SESSION[\'pun_antispam_logins\']))
		$_SESSION[\'pun_antispam_logins\'] = 1;
	else
		$_SESSION[\'pun_antispam_logins\']++;

	// Output CAPTCHA if first attempts failed
	if ($_SESSION[\'pun_antispam_logins\'] > 5)
	{
?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text required">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_antispam[\'Captcha\'] ?> <em><?php echo $lang_common[\'Required\'] ?></em></span> <small><?php echo $lang_pun_antispam[\'Captcha Info\'] ?></small></label><br />
						<span class="fld-input"><input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="pun_antispam_input" value="" size="20" maxlength="10" /></span>
					</div>
					<img id="pun_antispam_image" src="<?php echo $ext_info[\'url\'].\'/image.php?\'.md5(time()) ?>" style="vertical-align: middle; margin: 0 1em;" alt="<?php echo $lang_pun_antispam[\'img alt\'] ?>" /><br />
					<script type="text/javascript">document.write("<small><a href=\\"#\\" onclick=\\"document.getElementById(\'pun_antispam_image\').src = \'<?php echo $ext_info[\'url\'].\'/image.php?\' ?>\' + Math.random(); return false\\"><?php echo $lang_pun_antispam[\'reload image\'] ?></a></small>");</script>
				</div>
<?php
	}
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'li_forgot_pass_selected' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (isset($_POST[\'form_sent\']))
{
	if (session_id() == "")
		session_start();

	if ($forum_config[\'o_pun_antispam_captcha_restorepass\'] == \'1\' && (empty($_SESSION[\'pun_antispam_text\']) || strcasecmp(trim($_POST[\'pun_antispam_input\']), $_SESSION[\'pun_antispam_text\']) !== 0))
		$errors[] = $lang_pun_antispam[\'Invalid Text\'];

	$_SESSION[\'pun_antispam_text\'] = \'\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'li_forgot_pass_pre_group_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_config[\'o_pun_antispam_captcha_restorepass\'] == \'1\')
{
?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text required">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_antispam[\'Captcha\'] ?> <em><?php echo $lang_common[\'Required\'] ?></em></span> <small><?php echo $lang_pun_antispam[\'Captcha Info\'] ?></small></label><br />
						<span class="fld-input"><input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="pun_antispam_input" value="" size="20" maxlength="10" /></span>
					</div>
					<img id="pun_antispam_image" src="<?php echo $ext_info[\'url\'].\'/image.php?\'.md5(time()) ?>" style="vertical-align: middle; margin: 0 1em;" alt="<?php echo $lang_pun_antispam[\'img alt\'] ?>" /><br />
					<script type="text/javascript">document.write("<small><a href=\\"#\\" onclick=\\"document.getElementById(\'pun_antispam_image\').src = \'<?php echo $ext_info[\'url\'].\'/image.php?\' ?>\' + Math.random(); return false\\"><?php echo $lang_pun_antispam[\'reload image\'] ?></a></small>");</script>
				</div>
<?php
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'po_end_validation' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_user[\'is_guest\'] && $forum_config[\'o_pun_antispam_captcha_guestpost\'] == \'1\')
{
	if (session_id() == "")
		session_start();

	if (empty($_SESSION[\'pun_antispam_confirmed_user\']))
	{
		if (!isset($_SESSION[\'pun_antispam_text\']))
		{
			if (!isset($_POST[\'preview\']))
				$errors[] = $lang_pun_antispam[\'No cookies\'];
		}
		else if ((empty($_SESSION[\'pun_antispam_text\']) || strcasecmp(trim($_POST[\'pun_antispam_input\']), $_SESSION[\'pun_antispam_text\']) !== 0))
		{
			if (!isset($_POST[\'preview\']))
				$errors[] = $lang_pun_antispam[\'Invalid Text\'];
		}
		else
			$_SESSION[\'pun_antispam_confirmed_user\'] = 1;
	}

	$_SESSION[\'pun_antispam_text\'] = \'\';

	// Post is to be written to DB, ask CAPTCHA for the next posting
	if (empty($errors) && !isset($_POST[\'preview\']))
		$_SESSION[\'pun_antispam_confirmed_user\'] = 0;
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
{
	foreach (array_keys($_POST) as $key)
	{
		if (preg_match(\'~delete_(\\d+)~\', $key, $matches))
		{
			$attach_delete_id = $matches[1];
			break;
		}
	}
	if (isset($attach_delete_id))
	{
		foreach ($uploaded_list as $attach_index => $attach)
			if ($attach[\'id\'] == $attach_delete_id)
			{
				$delete_attach = $attach;
				$attach_delete_index = $attach_index;
				break;
			}
		if (isset($delete_attach) && ($forum_user[\'g_id\'] == FORUM_ADMIN || $cur_posting[\'g_pun_attachment_allow_delete_own\']))
		{
			$attach_query = array(
				\'DELETE\'	=>	\'attach_files\',
				\'WHERE\'		=>	\'id = \'.$delete_attach[\'id\']
			);
			$forum_db->query_build($attach_query) or error(__FILE__, __LINE__);
			unset($uploaded_list[$attach_delete_index]);
			if ($forum_config[\'attach_create_orphans\'] == \'0\')
				unlink($forum_config[\'attach_basefolder\'].$delete_attach[\'file_path\']);
		}
		else
			$errors[] = $lang_attach[\'Del perm error\'];
		$_POST[\'preview\'] = 1;
	}
	else if (isset($_POST[\'add_file\']))
	{
		attach_create_attachment($attach_secure_str, $cur_posting);
		$_POST[\'preview\'] = 1;
	}
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    2 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!empty($_POST[\'pun_tags\']) && $forum_user[\'g_pun_tags_allow\'])
				$new_tags = pun_tags_parse_string(utf8_trim($_POST[\'pun_tags\']));

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'po_pre_guest_info_fieldset_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_config[\'o_pun_antispam_captcha_guestpost\'] == \'1\' && empty($_SESSION[\'pun_antispam_confirmed_user\']))
{
?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text required">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_antispam[\'Captcha\'] ?> <em><?php echo $lang_common[\'Required\'] ?></em></span> <small><?php echo $lang_pun_antispam[\'Captcha Info\'] ?></small></label><br />
						<span class="fld-input"><input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="pun_antispam_input" value="" size="20" maxlength="10" /></span>
					</div>
					<img id="pun_antispam_image" src="<?php echo $ext_info[\'url\'].\'/image.php?\'.md5(time()) ?>" style="vertical-align: middle; margin: 0 1em;" alt="<?php echo $lang_pun_antispam[\'img alt\'] ?>" /><br />
					<script type="text/javascript">document.write("<small><a href=\\"#\\" onclick=\\"document.getElementById(\'pun_antispam_image\').src = \'<?php echo $ext_info[\'url\'].\'/image.php?\' ?>\' + Math.random(); return false\\"><?php echo $lang_pun_antispam[\'reload image\'] ?></a></small>");</script>
				</div>
<?php
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aop_features_pre_sig_content_fieldset' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

?>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_antispam[\'Min posts for sig\'] ?></span><small><?php echo $lang_pun_antispam[\'Min posts for sig info\'] ?></small></label><br />
						<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="form[sig_min_posts]" size="5" maxlength="5" value="<?php echo $forum_config[\'p_sig_min_posts\'] ?>" /></span>
					</div>
				</div>
<?php

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aop_features_avatars_fieldset_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$forum_page[\'group_count\'] = $forum_page[\'item_count\'] = 0;

?>
			<div class="content-head">
				<h2 class="hn"><span><?php echo $lang_pun_antispam[\'Captcha admin head\'] ?></span></h2>
			</div>
			<div class="ct-box"><p><?php echo $lang_pun_antispam[\'Captcha admin info\'] ?></p></div>
			<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
				<legend class="group-legend"><span><?php echo $lang_pun_antispam[\'Captcha admin legend\'] ?></span></legend>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_antispam_captcha_register]" value="1"<?php if ($forum_config[\'o_pun_antispam_captcha_register\'] == \'1\') echo \' checked="checked"\' ?> /></span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_antispam[\'Captcha admin legend\'] ?></span><?php echo $lang_pun_antispam[\'Captcha registrations info\'] ?></label>
					</div>
				</div>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_antispam_captcha_login]" value="1"<?php if ($forum_config[\'o_pun_antispam_captcha_login\'] == \'1\') echo \' checked="checked"\' ?> /></span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"> <?php echo $lang_pun_antispam[\'Captcha login info\'] ?></label>
					</div>
				</div>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_antispam_captcha_guestpost]" value="1"<?php if ($forum_config[\'o_pun_antispam_captcha_guestpost\'] == \'1\') echo \' checked="checked"\' ?> /></span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"> <?php echo $lang_pun_antispam[\'Captcha guestpost info\'] ?></label>
					</div>
				</div>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="form[pun_antispam_captcha_restorepass]" value="1"<?php if ($forum_config[\'o_pun_antispam_captcha_restorepass\'] == \'1\') echo \' checked="checked"\' ?> /></span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"> <?php echo $lang_pun_antispam[\'Captcha reset info\'] ?></label>
					</div>
				</div>
			</fieldset>
<?php

// Reset fieldset counter
$forum_page[\'set_count\'] = 0;

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

?>
					<div class="content-head">
						<h2 class="hn"><span><?php echo $lang_pun_poll[\'Name plugin\'] ?></span></h2>
					</div>
					<fieldset class="frm-group group1">
						<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
							<div class="sf-box checkbox">
								<span class="fld-input">
									<input id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" type="checkbox" name="form[pun_poll_enable_revote]" value="1"<?php if ($forum_config[\'p_pun_poll_enable_revote\'] == \'1\') echo \' checked="checked"\' ?>/>
								</span>
								<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>">
									<span><?php echo $lang_pun_poll[\'Disable revoting info\'] ?></span>
									<?php echo $lang_pun_poll[\'Disable revoting\'] ?>
								</label>
							</div>
						</div>
						<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
							<div class="sf-box checkbox">
								<span class="fld-input">
									<input id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" type="checkbox" name="form[pun_poll_enable_read]" value="1"<?php if ($forum_config[\'p_pun_poll_enable_read\'] == \'1\') echo \' checked="checked"\' ?>/>
								</span>
								<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>">
									<span><?php echo $lang_pun_poll[\'Disable see results\'] ?></span>
									<?php echo $lang_pun_poll[\'Disable see results info\'] ?>
								</label>
							</div>
						</div>
						<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
							<div class="sf-box text">
								<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>">
									<span><?php echo $lang_pun_poll[\'Maximum answers info\'] ?></span>
									<small><?php echo $lang_pun_poll[\'Maximum answers\'] ?></small>
								</label>
								</br>
								<span class="fld-input">
									<input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="form[pun_poll_max_answers]" size="6" maxlength="6" value="<?php echo $forum_config[\'p_pun_poll_max_answers\'] ?>"/>
								</span>
							</div>
						</div>
					</fieldset>
			<?php

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    2 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

?>
			<div class="content-head">
				<h2 class="hn">
					<span><?php echo $lang_pun_tags[\'Pun Tags\']; ?></span>
				</h2>
			</div>
			<fieldset class="frm-group group1">
				<legend class="group-legend">
					<span><?php echo $lang_pun_tags[\'Settings\']; ?></span>
				</legend>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box checkbox">
						<span class="fld-input">
							<input id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" type="checkbox" <?php if ($forum_config[\'o_pun_tags_show\'] == \'1\') echo \' checked="checked"\' ?> value="1" name="form[pun_tags_show]"/>
						</span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>">
							<span><?php echo $lang_pun_tags[\'Show Pun Tags\']; ?></span>
							<?php echo $lang_pun_tags[\'Pun Tags notice\']; ?>
						</label>
					</div>
				</div>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text">
						<span class="fld-input">
							<input id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" type="text" value="<?php echo $forum_config[\'o_pun_tags_count_in_cloud\']; ?>" maxlength="6" size="6" name="form[pun_tags_count_in_cloud]"/>
						</span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>">
							<span><?php echo $lang_pun_tags[\'Tags count\']; ?></span>
							<small><?php echo $lang_pun_tags[\'Tags count info\']; ?></small>
						</label>
					</div>
				</div>
				<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<div class="sf-box text">
						<span class="fld-input">
							<input id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" type="text" value="<?php echo $forum_config[\'o_pun_tags_separator\']; ?>" maxlength="10" size="6" name="form[pun_tags_separator]"/>
						</span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>">
							<span><?php echo $lang_pun_tags[\'Separator\']; ?></span>
							<small><?php echo $lang_pun_tags[\'Separator info\']; ?></small>
						</label>
					</div>
				</div>
			</fieldset>
			<?php

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aop_features_validation' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!isset($form[\'pun_antispam_captcha_register\']) || $form[\'pun_antispam_captcha_register\'] != \'1\') $form[\'pun_antispam_captcha_register\'] = \'0\';
if (!isset($form[\'pun_antispam_captcha_login\']) || $form[\'pun_antispam_captcha_login\'] != \'1\') $form[\'pun_antispam_captcha_login\'] = \'0\';
if (!isset($form[\'pun_antispam_captcha_guestpost\']) || $form[\'pun_antispam_captcha_guestpost\'] != \'1\') $form[\'pun_antispam_captcha_guestpost\'] = \'0\';
if (!isset($form[\'pun_antispam_captcha_restorepass\']) || $form[\'pun_antispam_captcha_restorepass\'] != \'1\') $form[\'pun_antispam_captcha_restorepass\'] = \'0\';
$form[\'sig_min_posts\'] = isset($form[\'sig_min_posts\']) ? intval($form[\'sig_min_posts\']) : \'0\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!isset($form[\'pun_poll_enable_read\']) || $form[\'pun_poll_enable_read\'] != \'1\') $form[\'pun_poll_enable_read\'] = \'0\';
			if (!isset($form[\'pun_poll_enable_revote\']) || $form[\'pun_poll_enable_revote\'] != \'1\') $form[\'pun_poll_enable_revote\'] = \'0\';
			$form[\'pun_poll_max_answers\'] = intval($form[\'pun_poll_max_answers\']);

			if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
			if ($form[\'pun_poll_max_answers\'] > 100)
				$form[\'pun_poll_max_answers\'] = 100;
			if ($form[\'pun_poll_max_answers\'] < 2)
				$form[\'pun_poll_max_answers\'] = 2;

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    2 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!isset($form[\'pun_tags_show\']) || $form[\'pun_tags_show\'] != \'1\')
				$form[\'pun_tags_show\'] = \'0\';
			if (isset($form[\'pun_tags_count_in_cloud\']) && !empty($form[\'pun_tags_count_in_cloud\']) && intval($form[\'pun_tags_count_in_cloud\']) > 0)
				$form[\'pun_tags_count_in_cloud\'] = intval($form[\'pun_tags_count_in_cloud\']);
			else
				$form[\'pun_tags_count_in_cloud\'] = 25;
			if (isset($form[\'pun_tags_separator\']) && !empty($form[\'pun_tags_separator\']))
				$form[\'pun_tags_separator\'] = $form[\'pun_tags_separator\'];
			else
				$form[\'pun_tags_separator\'] = \' \';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'pf_change_details_signature_pre_fieldset' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (isset($forum_page[\'sig_demo\']) && $forum_page[\'sig_demo\'] != \'\' && !$forum_user[\'is_admmod\'] && $forum_user[\'num_posts\'] < $forum_config[\'p_sig_min_posts\'])
{
	if (!isset($lang_pun_antispam))
	{
		if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
			require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
		else
			require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
	}

?>
			<div class="ct-box info-box">
				<p class="warn"><?php echo $lang_pun_antispam[\'No signature yet\']; ?></p>
			</div>
<?php

}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'pf_change_details_identity_contact_fieldset_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ((isset($form[\'url\']) ? forum_htmlencode($form[\'url\']) : forum_htmlencode($user[\'url\'])) != \'\' && !$forum_user[\'is_admmod\'] && $forum_user[\'num_posts\'] < $forum_config[\'p_sig_min_posts\'])
{
	if (!isset($lang_pun_antispam))
	{
		if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
			require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
		else
			require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
	}

?>
			<div class="ct-box info-box">
				<p class="warn"><?php echo $lang_pun_antispam[\'No website yet\']; ?></p>
			</div>
<?php

}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'vt_post_loop_start' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($cur_post[\'g_id\'] != FORUM_ADMIN && $cur_post[\'num_posts\'] < $forum_config[\'p_sig_min_posts\'])
{
	$cur_post[\'signature\'] = \'\';
	$cur_post[\'url\'] = \'\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'agr_start' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

require $ext_info[\'path\'].\'/include/attach_func.php\';
if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
	require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
else
	require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'agr_add_edit_group_flood_fieldset_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

?>

	<div class="content-head">
		<h3 class="hn"><span><?php echo $lang_attach[\'Group attach part\'] ?></span></h3>
	</div>
	<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
		<legend><span><?php echo $lang_attach[\'Attachment rules\'] ?></span></legend>
		<div class="mf-box">
			<div class="mf-item">
				<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="download" value="1"<?php if ($group[\'g_pun_attachment_allow_download\'] == \'1\') echo \' checked="checked"\' ?> /></span>
				<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_attach[\'Download\']?></label>
			</div>
			<div class="mf-item">
				<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="upload" value="1"<?php if ($group[\'g_pun_attachment_allow_upload\'] == \'1\') echo \' checked="checked"\' ?> /></span>
				<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_attach[\'Upload\'] ?></label>
			</div>
			<div class="mf-item">
				<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="delete" value="1"<?php if ($group[\'g_pun_attachment_allow_delete\'] == \'1\') echo \' checked="checked"\' ?> /></span>
				<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_attach[\'Delete\'] ?></label>
			</div>
			<div class="mf-item">
				<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="owner_delete" value="1"<?php if ($group[\'g_pun_attachment_allow_delete_own\'] == \'1\') echo \' checked="checked"\' ?> /></span>
				<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_attach[\'Owner delete\'] ?></label>
			</div>
		</div>
	</fieldset>
	<div class="sf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
		<div class="sf-box text">
			<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_attach[\'Size\'] ?></span> <small><?php echo $lang_attach[\'Size comment\'] ?></small></label><br />
			<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="max_size" size="15" maxlength="15" value="<?php echo $group[\'g_pun_attachment_upload_max_size\'] ?>" /></span>
		</div>
		<div class="sf-box text">
			<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_attach[\'Per post\'] ?></span></label><br />
			<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="per_post" size="4" maxlength="5" value="<?php echo $group[\'g_pun_attachment_files_per_post\'] ?>" /></span>
		</div>
		<div class="sf-box text">
			<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_attach[\'Allowed files\'] ?></span><small><?php echo $lang_attach[\'Allowed comment\'] ?></small></label><br />
			<span class="fld-input"><input type="text" id="fld<?php echo $forum_page[\'fld_count\'] ?>" name="file_ext" size="80" maxlength="80" value="<?php echo $group[\'g_pun_attachment_disallowed_extensions\'] ?>" /></span>
		</div>
	</div>

<?php

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

?>
				<div class="content-head">
					<h3 class="hn"><span><?php echo $lang_pun_tags[\'Permissions\']; ?></span></h3>
				</div>
				<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<legend><span><?php echo $lang_pun_tags[\'Create tags perms\']; ?></span></legend>
					<div class="mf-box">
						<div class="mf-item">
							<span class="fld-input"><input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="pun_tags_allow" value="1"<?php if ($group[\'g_pun_tags_allow\'] == \'1\') echo \' checked="checked"\' ?> /></span>
						<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_tags[\'Name check\']; ?></label>
						</div>
					</div>
				</fieldset>
			<?php

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'agr_add_edit_end_validation' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$group_id = isset($_POST[\'group_id\']) ? intval($_POST[\'group_id\']) : \'\';
if ($_POST[\'mode\'] == \'add\' || (!empty($group_id) && $group_id != FORUM_ADMIN))
{
	$allow_down = isset($_POST[\'download\']) && $_POST[\'download\'] == \'1\' ? \'1\' : \'0\';
	$allow_upl = isset($_POST[\'upload\']) && $_POST[\'upload\'] == \'1\' ? \'1\' : \'0\';
	$allow_del = isset($_POST[\'delete\']) && $_POST[\'delete\'] == \'1\' ? \'1\' : \'0\';
	$allow_del_own = isset($_POST[\'owner_delete\']) && $_POST[\'owner_delete\'] == \'1\' ? \'1\' : \'0\';

	$size = isset($_POST[\'max_size\']) ? intval($_POST[\'max_size\']) : \'0\';
	$upload_max_filesize = get_bytes(ini_get(\'upload_max_filesize\'));
	$post_max_size = get_bytes(ini_get(\'post_max_size\'));
	if ($size > $upload_max_filesize ||  $size > $post_max_size)
		$size = min($upload_max_filesize, $post_max_size);

	$per_post = isset($_POST[\'per_post\']) ? intval($_POST[\'per_post\']) : \'1\';
	$file_ext = isset($_POST[\'file_ext\']) ? trim($_POST[\'file_ext\']) : \'\';

	if (!empty($file_ext))
	{
		$file_ext = preg_replace(\'/\\s/\', \'\', $file_ext);
		$match = preg_match(\'/(^[a-zA-Z0-9])+(([a-zA-Z0-9]+\\,)|([a-zA-Z0-9]))+([a-zA-Z0-9]+$)/\', $file_ext);

		if (!$match)
			message($lang_attach[\'Wrong allowed\']);
	}
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'agr_add_end_qr_add_group' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$query[\'INSERT\'] .= \', g_pun_attachment_allow_download, g_pun_attachment_allow_upload, g_pun_attachment_allow_delete, g_pun_attachment_allow_delete_own, g_pun_attachment_upload_max_size, g_pun_attachment_files_per_post, g_pun_attachment_disallowed_extensions\';
$query[\'VALUES\'] .= \', \'.implode(\',\', array($allow_down, $allow_upl, $allow_del, $allow_del_own, $size, $per_post, \'\\\'\'.$forum_db->escape($file_ext).\'\\\'\'));

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'agr_edit_end_qr_update_group' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (isset($allow_down))
	$query[\'SET\'] .= \', g_pun_attachment_allow_download = \'.$allow_down.\', g_pun_attachment_allow_upload = \'.$allow_upl.\', g_pun_attachment_allow_delete = \'.$allow_del.\', g_pun_attachment_allow_delete_own = \'.$allow_del_own.\', g_pun_attachment_upload_max_size = \'.$size.\', g_pun_attachment_files_per_post = \'.$per_post.\', g_pun_attachment_disallowed_extensions = \\\'\'.$forum_db->escape($file_ext).\'\\\'\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$query[\'SET\'] .= \', g_poll_add=\'.((isset($_POST[\'poll_add\']) && $_POST[\'poll_add\'] == \'1\') ? 1 : 0);

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    2 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$pun_tags_allow = isset($_POST[\'pun_tags_allow\']) ? intval($_POST[\'pun_tags_allow\']) : \'0\';
			$query[\'SET\'] .= \', g_pun_tags_allow=\'.$pun_tags_allow;

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'hd_head' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'] && in_array(FORUM_PAGE, array(\'viewtopic\', \'postedit\', \'attachment-preview\')))
{
	if (is_dir($ext_info[\'path\'].\'/styles/\'.$forum_user[\'style\']))
	{
		$forum_head[\'style_attch\'] = \'<link rel="stylesheet" type="text/css" media="screen" href="\'.$ext_info[\'url\'].\'/style/\'.$forum_user[\'style\'].\'/\'.$forum_user[\'style\'].\'.css" />\';
		$forum_head[\'style_attch_css\'] = \'<link rel="stylesheet" type="text/css" media="screen" href="\'.$ext_info[\'url\'].\'/style/\'.$forum_user[\'style\'].\'/\'.$forum_user[\'style\'].\'_cs.css" />\';
	}
	else
	{
		$forum_head[\'style_attch\'] = \'<link rel="stylesheet" type="text/css" media="screen" href="\'.$ext_info[\'url\'].\'/style/Oxygen/Oxygen.css" />\';
		$forum_head[\'style_attch_css\'] = \'<link rel="stylesheet" type="text/css" media="screen" href="\'.$ext_info[\'url\'].\'/style/Oxygen/Oxygen_cs.css" />\';
	}
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

// Aattach pun_tags CSS file
			if (in_array(FORUM_PAGE, array(\'index\', \'viewforum\', \'viewtopic\', \'searchtopics\', \'searchposts\')))
			{
				$forum_head[\'style_pun_tag\'] = \'<link rel="stylesheet" type="text/css" media="screen" href="\'.$ext_info[\'url\'].\'/style/\'.$forum_user[\'style\'].\'.css" />\';
				$forum_head[\'style_cs_pun_tag\'] = \'<link rel="stylesheet" type="text/css" media="screen" href="\'.$ext_info[\'url\'].\'/style/\'.$forum_user[\'style\'].\'_cs.css" />\';
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    2 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_quote\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_quote\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_quote\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_user[\'is_guest\'] && FORUM_PAGE == \'viewtopic\')
				$forum_head[\'quote_js\'] = \'<script type="text/javascript" src="\'.$ext_info[\'url\'].\'/scripts.js"></script>\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'po_qr_get_topic_forum_info' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
{
	$query[\'SELECT\'] .= \', g_pun_attachment_allow_upload, g_pun_attachment_upload_max_size, g_pun_attachment_files_per_post, g_pun_attachment_disallowed_extensions, g_pun_attachment_allow_delete_own\';
	$query[\'JOINS\'][] = array(\'LEFT JOIN\' => \'groups AS g\', \'ON\' => \'g.g_id = \'.$forum_user[\'g_id\']);
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'po_qr_get_forum_info' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
{
	$query[\'SELECT\'] .= \', g_pun_attachment_allow_upload, g_pun_attachment_upload_max_size, g_pun_attachment_files_per_post, g_pun_attachment_disallowed_extensions, g_pun_attachment_allow_delete_own\';
	$query[\'JOINS\'][] = array(\'LEFT JOIN\' => \'groups AS g\', \'ON\' => \'g.g_id = \'.$forum_user[\'g_id\']);
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'po_form_submitted' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
{
	$attach_secure_str = $forum_user[\'id\'].($tid ? \'t\'.$tid : \'f\'.$fid);
	$uploaded_list = array();
	$attach_query = array(
		\'SELECT\'	=>	\'id, owner_id, post_id, topic_id, filename, file_ext, file_mime_type, file_path, size, download_counter, uploaded_at, secure_str\',
		\'FROM\'		=>	\'attach_files\',
		\'WHERE\'		=>	\'secure_str = \\\'\'.$forum_db->escape($attach_secure_str).\'\\\'\'
	);
	
	$attach_result = $forum_db->query_build($attach_query) or error(__FILE__, __LINE__);
	if ($forum_db->num_rows($attach_result) > 0)
	{
		while ($cur_attach = $forum_db->fetch_assoc($attach_result))
			$uploaded_list[] = $cur_attach;	
	}
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!empty($error_poll))
			{
				$count_err = count($error_poll);
				for($iter = 0; $iter < $count_err; $iter++)
					$errors[] = $error_poll[$iter];
				$error_poll = array();
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'po_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'] && isset($_POST[\'submit\']))
{
	$attach_query = array(
		\'UPDATE\'	=>	\'attach_files\',
		\'SET\'		=>	\'owner_id = \'.$forum_user[\'id\'].\', topic_id = \'.(isset($new_tid) ? $new_tid : $tid).\', post_id = \'.$new_pid.\', secure_str = NULL\',
		\'WHERE\'		=>	\'secure_str = \\\'\'.$forum_db->escape($attach_secure_str).\'\\\'\'
	);
	$forum_db->query_build($attach_query) or error(__FILE__, __LINE__);
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($fid > 0 && !$forum_user[\'is_guest\'])
			{
				$question = (isset($_POST[\'question_of_poll\'])) ? forum_trim($_POST[\'question_of_poll\']) : \'\';

				//Validate of pull_answers
				$answers = array();
				if ($poll_answers != null)
				{
					for ($ans_num = 0; $ans_num < count($poll_answers); $ans_num++)
					{
						 $ans = forum_trim($poll_answers[$ans_num]);
						 if (!empty($ans))
							$answers[] = $ans;
					}
					if (!empty($answers))
						$answers = array_unique($answers);
				}
				if (!empty($question) && !empty($answers) && count($answers) > 1 && strlen($question) >= 5)
				{
					//Can unvoted user read voting results?
					$read_unvote_users = ($forum_config[\'p_pun_poll_enable_read\'] && isset($_POST[\'read_unvote_users\']) && $_POST[\'read_unvote_users\'] == 1) ? 1 : 0;
					//Can user change opinion?
					$revote = ($forum_config[\'p_pun_poll_enable_revote\'] && isset($_POST[\'revouting\']) && $_POST[\'revouting\'] == 1) ? 1 : 0;

					if ($days_poll != null)
						$votes_poll = \'\\\'NULL\\\'\';
					else
						$days_poll = \'\\\'NULL\\\'\';

					$query_poll = array(
						\'INSERT\'	=>	\'topic_id, question, read_unvote_users, revote, created, days_count, votes_count\',
						\'INTO\'		=>	\'questions\',
						\'VALUES\'	=>	$new_tid.\', \\\'\'.$forum_db->escape($question).\'\\\', \'.$read_unvote_users.\', \'.$revote.\', \'.time().\', \'.intval($days_poll).\', \'.intval($votes_poll)
					);
					$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);

					//Add answers to DB
					foreach ($answers as $ans)
					{
						$query_poll = array(
							\'INSERT\'	=>	\'topic_id, answer\',
							\'INTO\'		=>	\'answers\',
							\'VALUES\'	=>	$new_tid.\', \\\'\'.$forum_db->escape($ans).\'\\\'\'
						);
						$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);
					}
				}
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'po_pre_header_load' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
	$forum_page[\'form_attributes\'][\'enctype\'] = \'enctype="multipart/form-data"\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!empty($error_poll))
			{
				$count_err = count($error_poll);
				for($iter = 0; $iter < $count_err; $iter++)
					$errors[] = $error_poll[$iter];
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'po_pre_req_info_fieldset_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
	show_attachments(isset($uploaded_list) ? $uploaded_list : array(), $cur_posting);

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'vt_start' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
{
	require $ext_info[\'path\'].\'/include/attach_func.php\';
	if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
		require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
	else
		require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
	require $ext_info[\'path\'].\'/url.php\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'vt_qr_get_topic_info' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
{
	$query[\'SELECT\'] .= \', g_pun_attachment_allow_download\';
	$query[\'JOINS\'][] = array(\'LEFT JOIN\' => \'groups AS g\', \'ON\' => \'g.g_id = \'.$forum_user[\'g_id\']);
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'vt_main_output_start' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
{
	$attach_query = array(
		\'SELECT\'	=>	\'id, post_id, filename, file_ext, file_mime_type, size, download_counter, uploaded_at, file_path\',
		\'FROM\'		=>	\'attach_files\',
		\'WHERE\'		=>	\'topic_id = \'.$id,
		\'ORDER BY\'	=>	\'filename\'
	);
	$attach_result = $forum_db->query_build($attach_query) or error(__FILE__, __LINE__);
	$attach_list = array();
	while ($cur_attach = $forum_db->fetch_assoc($attach_result))
	{
		if (!isset($attach_list[$cur_attach[\'post_id\']]))
			$attach_list[$cur_attach[\'post_id\']] = array();
		$attach_list[$cur_attach[\'post_id\']][] = $cur_attach;
	}
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'vt_row_pre_display' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'] && isset($attach_list[$cur_post[\'id\']]))
{
	if (isset($forum_page[\'message\'][\'signature\']))
		$forum_page[\'message\'][\'signature\'] = show_attachments_post($attach_list[$cur_post[\'id\']], $cur_post[\'id\'], $cur_topic).$forum_page[\'message\'][\'signature\'];
	else
		$forum_page[\'message\'][\'attachments\'] = show_attachments_post($attach_list[$cur_post[\'id\']], $cur_post[\'id\'], $cur_topic);
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ed_start' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
{
	require $ext_info[\'path\'].\'/include/attach_func.php\';
	if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
		require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
	else
		require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
	require $ext_info[\'path\'].\'/url.php\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ed_qr_get_post_info' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
{
	$query[\'SELECT\'] .= \', g_pun_attachment_allow_upload, g_pun_attachment_upload_max_size, g_pun_attachment_files_per_post, g_pun_attachment_disallowed_extensions, g_pun_attachment_allow_delete_own, g_pun_attachment_allow_delete\';
	$query[\'JOINS\'][] = array(\'LEFT JOIN\' => \'groups AS g\', \'ON\' => \'g.g_id = \'.$forum_user[\'g_id\']);
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ed_post_selected' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
{
	$attach_secure_str = $forum_user[\'id\'].\'t\'.$cur_post[\'tid\'];
	$uploaded_list = array();
	$attach_query = array(
		\'SELECT\'	=>	\'id, owner_id, post_id, topic_id, filename, file_ext, file_mime_type, file_path, size, download_counter, uploaded_at, secure_str\',
		\'FROM\'		=>	\'attach_files\',
		\'WHERE\'		=>	\'post_id = \'.$id.\' OR secure_str = \\\'\'.$attach_secure_str.\'\\\'\',
		\'ORDER BY\'	=>	\'filename\'
	);

	$attach_result = $forum_db->query_build($attach_query) or error(__FILE__, __LINE__);
	if ($forum_db->num_rows($attach_result) > 0)
	{
		while ($cur_attach = $forum_db->fetch_assoc($attach_result))
			$uploaded_list[] = $cur_attach;	
	}
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
			
			$poll = false;
			$error_poll = array();
			
			//Validate of input in pun_poll form
			if ($can_edit_subject && !$forum_user[\'is_guest\'])
			{
				//Get info about poll
				$query_pun_poll = array(
					\'SELECT\'	=>	\'question, read_unvote_users, revote, created, days_count, votes_count\',
					\'FROM\'		=>	\'questions\',
					\'WHERE\'		=>	\'topic_id = \'.$cur_post[\'tid\']
				);
				$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);

				if ($forum_db->num_rows($result_pun_poll) > 0)
				{
					$poll = true;
					list($question, $read_unvote_users, $revote, $created, $days_count, $max_votes_count) = $forum_db->fetch_row($result_pun_poll);
				}
				else
					$poll = false;
				
				//If its editing or voting doesn\'t exist
				if ($forum_user[\'g_id\'] == FORUM_ADMIN || (isset($_POST[\'form_sent\']) && !$poll))
				{
					//User press update poll
					if (isset($_POST[\'update_poll\']))
					{
						unset($_POST[\'form_sent\']);
						
						$subject = forum_trim($_POST[\'req_subject\']);
						if ($subject == \'\')
							$error_poll[] = $lang_post[\'No subject\'];
						else if (utf8_strlen($subject) > 70)
							$error_poll[] = $lang_post[\'Too long subject\'];
						else if ($forum_config[\'p_subject_all_caps\'] == \'0\' && utf8_strtoupper($subject) == $subject && !$forum_page[\'is_admmod\'])
							$error_poll[] = $lang_post[\'All caps subject\'];
	
						// Clean up message from POST
						$message = forum_linebreaks(forum_trim($_POST[\'req_message\']));
						if (strlen($message) > FORUM_MAX_POSTSIZE_BYTES)
							$error_poll[] = sprintf($lang_post[\'Too long message\'], forum_number_format(strlen($message)), forum_number_format(FORUM_MAX_POSTSIZE_BYTES));
						else if ($forum_config[\'p_message_all_caps\'] == \'0\' && utf8_strtoupper($message) == $message && !$forum_page[\'is_admmod\'])
							$error_poll[] = $lang_post[\'All caps message\'];
					}
					else
						$options_count = (isset($_POST[\'poll_answer\'])) ? count($_POST[\'poll_answer\']) : 2;

					$poll_answers = (isset($_POST[\'poll_answer\']) && !empty($_POST[\'poll_answer\']) && is_array($_POST[\'poll_answer\'])) ? array_values( $_POST[\'poll_answer\']) : null;
					if ($poll_answers == null && !empty($_POST[\'poll_answer\']))
						$error_poll[] = $lang_common[\'Bad request\'];
					$options_count = (!isset($_POST[\'poll_ans_count\']) || intval($_POST[\'poll_ans_count\']) < 2) ? null : intval($_POST[\'poll_ans_count\']);
					if ($options_count > $forum_config[\'p_pun_poll_max_answers\'])
					{
						$error_poll[] = sprintf($lang_pun_poll[\'Max cnt options\'], $forum_config[\'p_pun_poll_max_answers\']);
					}
					if (($options_count == null) && (isset($_POST[\'form_sent\']) || isset($_POST[\'update_poll\'])))
						$error_poll[] = $lang_pun_poll[\'Min cnt options\'];
					$days_poll = (isset($_POST[\'allow_poll_days\']) && !empty($_POST[\'allow_poll_days\'])) ? intval($_POST[\'allow_poll_days\']) : null;
					if ($days_poll != null && ($days_poll > 90 || $days_poll < 1))
						$error_poll[] = $lang_pun_poll[\'Days limit\'];
					$votes_poll = isset($_POST[\'allow_poll_votes\']) && !empty($_POST[\'allow_poll_votes\']) ? intval($_POST[\'allow_poll_votes\']) : null;
					if ($votes_poll != null && ($votes_poll > 500 || $votes_poll < 2))
						$error_poll[] = $lang_pun_poll[\'Votes count\'];
					if (isset($_POST[\'form_sent\']) && !empty($_POST[\'question_of_poll\']) && $days_poll != null && $votes_poll != null)
						$error_poll[] = $lang_pun_poll[\'Input error\'];
					//If there is some answers
					if ($poll_answers == null)
					{
						//User didn\'t edit smth
						$query_pun_poll = array(
							\'SELECT\'	=>	\'id, answer\',
							\'FROM\'		=>	\'answers\',
							\'WHERE\'		=>	\'topic_id = \'.$cur_post[\'tid\'],
							\'ORDER BY\'	=>	\'id ASC\'
						);
						$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
						
						$poll_answers = array();
						$num_rows = $forum_db->num_rows($result_pun_poll);
						if ($num_rows > 0)
						{
							while ($row = $forum_db->fetch_assoc($result_pun_poll))
								$poll_answers[] = $row[\'answer\'];
							$options_count = $num_rows;
						}
					}
					else if ((isset($_POST[\'poll_ans_count\'])) && ($_POST[\'poll_ans_count\'] > 2))
					{
						if ($_POST[\'poll_ans_count\'] > $forum_config[\'p_pun_poll_max_answers\'])
							$options_count = $forum_config[\'p_pun_poll_max_answers\'];
						else
							$options_count = $_POST[\'poll_ans_count\'];
					}
				}
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ed_end_validation' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
{
	foreach (array_keys($_POST) as $key)
	{
		if (preg_match(\'~delete_(\\d+)~\', $key, $matches))
		{
			$attach_delete_id = $matches[1];
			break;
		}
	}
	if (isset($attach_delete_id))
	{
		foreach ($uploaded_list as $attach_index => $attach)
			if ($attach[\'id\'] == $attach_delete_id)
			{
				$delete_attach = $attach;
				$attach_delete_index = $attach_index;
				break;
			}
		if (isset($delete_attach) && ($forum_user[\'g_id\'] == FORUM_ADMIN || $cur_post[\'g_pun_attachment_allow_delete\'] || ($cur_post[\'g_pun_attachment_allow_delete_own\'] && $forum_user[\'id\'] == $delete_attach[\'owner_id\'])))
		{
			$attach_query = array(
				\'DELETE\'	=>	\'attach_files\',
				\'WHERE\'		=>	\'id = \'.$delete_attach[\'id\']
			);
			$forum_db->query_build($attach_query) or error(__FILE__, __LINE__);
			unset($uploaded_list[$attach_delete_index]);
			if ($forum_config[\'attach_create_orphans\'] == \'0\')
				unlink($forum_config[\'attach_basefolder\'].$delete_attach[\'file_path\']);
		}
		else
			$errors[] = $lang_attach[\'Del perm error\'];
		$_POST[\'preview\'] = 1;
	}
	else if (isset($_POST[\'add_file\']))
	{
		attach_create_attachment($attach_secure_str, $cur_post);
		$_POST[\'preview\'] = 1;
	}
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ed_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'] && isset($_POST[\'submit\']))
{
	$attach_query = array(
		\'UPDATE\'	=>	\'attach_files\',
		\'SET\'		=>	\'owner_id = \'.$forum_user[\'id\'].\', topic_id = \'.$cur_post[\'tid\'].\', post_id = \'.$id.\', secure_str = NULL\',
		\'WHERE\'		=>	\'secure_str = \\\'\'.$forum_db->escape($attach_secure_str).\'\\\'\'
	);
	$forum_db->query_build($attach_query) or error(__FILE__, __LINE__);
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ed_pre_header_load' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
	$forum_page[\'form_attributes\'][\'enctype\'] = \'enctype="multipart/form-data"\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!empty($error_poll))
			{
				$count_err = count($error_poll);
				for($iter = 0; $iter < $count_err; $iter++)
					$errors[] = $error_poll[$iter];
			}
			
			// Setup error messages
			if ((!empty($errors)))
			{
				$forum_page[\'errors\'] = array();
				
				foreach ($errors as $cur_error)
					$forum_page[\'errors\'][] = \'<li><span>\'.$cur_error.\'</span></li>\';
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ed_pre_main_fieldset_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
	show_attachments(isset($uploaded_list) ? $uploaded_list : array(), $cur_post);

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aop_new_section' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($section == \'pun_attach\')
	require $ext_info[\'path\'].\'/pun_attach.php\';
else if ($section == \'pun_list_attach\')
	require $ext_info[\'path\'].\'/pun_list_attach.php\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aop_pre_update_configuration' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($section == \'pun_attach\')
{
	while (list($key, $input) = @each($form))
	{
		if ($forum_config[\'attach_\'.$key] != $input)
		{
			if ($input != \'\' || is_int($input))
				$value = \'\\\'\'.$forum_db->escape($input).\'\\\'\';
			else
				$value = \'NULL\';

			$query = array(
				\'UPDATE\'	=> \'config\',
				\'SET\'		=> \'conf_value=\'.$value,
				\'WHERE\'		=> \'conf_name=\\\'attach_\'.$key.\'\\\'\'
			);

			$forum_db->query_build($query) or error(__FILE__,__LINE__);
		}
	}

	require_once FORUM_ROOT.\'include/cache.php\';
	generate_config_cache();

	redirect(forum_link($attach_url[\'admin_options_attach\']), $lang_admin_settings[\'Settings updated\'].\' \'.$lang_admin_common[\'Redirect\']);
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aop_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($section == \'pun_attach\')
	redirect(forum_link($attach_url[\'admin_options_attach\']), $lang_admin_settings[\'Settings updated\'].\' \'.$lang_admin_common[\'Redirect\']);

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aop_new_section_validation' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($section == \'pun_attach\')
{
	if (!isset($form[\'use_icon\']) || $form[\'use_icon\'] != \'1\') $form[\'use_icon\'] = \'0\';
	if (!isset($form[\'create_orphans\']) || $form[\'create_orphans\'] != \'1\') $form[\'create_orphans\'] = \'0\';
	if (!isset($form[\'disable_attach\']) || $form[\'disable_attach\'] != \'1\') $form[\'disable_attach\'] = \'0\';
	if (!isset($form[\'disp_small\']) || $form[\'disp_small\'] != \'1\') $form[\'disp_small\'] = \'0\';
	
	if ($form[\'always_deny\'])
	{
		$form[\'always_deny\'] = preg_replace(\'/\\s/\',\'\',$form[\'always_deny\']);
		$match = preg_match(\'/(^[a-zA-Z0-9])+(([a-zA-Z0-9]+\\,)|([a-zA-Z0-9]))+([a-zA-Z0-9]+$)/\',$form[\'always_deny\']);
	
		if (!$match)
			message($lang_attach[\'Wrong deny\']);
	}
	
	if (preg_match(\'/^[0-9]+$/\', $form[\'small_height\']))
		$form[\'small_height\'] = intval($form[\'small_height\']);
	else
		$form[\'small_height\'] = $forum_config[\'attach_small_height\'];
	
	if (preg_match(\'/^[0-9]+$/\',$form[\'small_width\']))
		$form[\'small_width\'] = intval($form[\'small_width\']);
	else
		$form[\'small_width\'] = $forum_config[\'attach_small_width\'];
	
	$names = explode(\',\', $forum_config[\'attach_icon_name\']);
	$icons = explode(\',\', $forum_config[\'attach_icon_extension\']);
	
	$num_icons = count($icons);
	for ($i = 0; $i < $num_icons; $i++)
	{
		if (!empty($_POST[\'attach_ext_\'.$i]) && !empty($_POST[\'attach_ico_\'.$i]))
		{
			if (!preg_match("/^[a-zA-Z0-9]+$/", forum_trim($_POST[\'attach_ext_\'.$i])) && !preg_match("/^([a-zA-Z0-9]+\\.+(png|gif|jpeg|jpg|ico))+$/", forum_trim($_POST[\'attach_ico_\'.$i])))
				message($lang_attach[\'Wrong icon/name\']);
	
			$icons[$i] = trim($_POST[\'attach_ext_\'.$i]);
			$names[$i] = trim($_POST[\'attach_ico_\'.$i]);
		}
	}
	
	if (isset($_POST[\'add_field_icon\']) && isset($_POST[\'add_field_file\']))
	{
		if (!empty($_POST[\'add_field_icon\']) && !empty($_POST[\'add_field_file\']))
		{
			if (!(preg_match("/^[a-zA-Z0-9]+$/",trim($_POST[\'add_field_icon\'])) && preg_match("/^([a-zA-Z0-9]+\\.+(png|gif|jpeg|jpg|ico))+$/",trim($_POST[\'add_field_file\']))))
				message ($lang_attach[\'Wrong icon/name\']);
	
			$icons[] = trim($_POST[\'add_field_icon\']);
			$names[] = trim($_POST[\'add_field_file\']);
		}
	}
	
	$icons = implode(\',\', $icons);
	$icons = preg_replace(\'/\\,{2,}/\',\',\',$icons);
	$icons = preg_replace(\'/\\,{1,}+$/\',\'\',$icons);
	
	$names = implode(\',\', $names);
	$names = preg_replace(\'/\\,{2,}/\',\',\',$names);
	$names = preg_replace(\'/\\,{1,}+$/\',\'\',$names);
	
	$query = array(
		\'UPDATE\'	=> \'config\',
		\'SET\'		=> \'conf_value=\\\'\'.$forum_db->escape($icons).\'\\\'\',
		\'WHERE\'		=> \'conf_name = \\\'attach_icon_extension\\\'\'
	);
	$result = $forum_db->query_build($query) or error (__FILE__, __LINE__);
	
	$query = array(
		\'UPDATE\'	=> \'config\',
		\'SET\'		=> \'conf_value=\\\'\'.$forum_db->escape($names).\'\\\'\',
		\'WHERE\'		=> \'conf_name=\\\'attach_icon_name\\\'\'
	);
	$result = $forum_db->query_build($query) or error (__FILE__, __LINE__);
	}
	
	if ($section == \'list_attach\')
	{
	$query = array(
		\'SELECT\'	=> \'count(id) as num_attach\',
		\'FROM\'		=> \'attach_files\'
	);
	
	$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);
	
	if ($forum_db->num_rows($result))
	{
		$num_attach = $forum_db->fetch_assoc($result);
		for ($i = 0; $i < $num_attach[\'num_attach\']; $i++)
		{
			if (isset($_POST[\'attach_\'.$i]))
			{
				if (isset($_POST[\'attach_to_post_\'.$i]) && !empty($_POST[\'attach_to_post_\'.$i]))
				{
					$post_id = intval($_POST[\'attach_to_post_\'.$i]);
					$attach_id = intval($_POST[\'attachment_\'.$i]);
					$query = array(
						\'SELECT\'	=> \'id, topic_id, poster_id\',
						\'FROM\'		=> \'posts\',
						\'WHERE\'		=> \'id=\'.$post_id
					);
					$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);
	
	
					if (!$forum_db->num_rows($result))
						message ($lang_attach[\'Wrong post\']);
					$info = $forum_db->fetch_assoc($result);
	
					$query = array(
						\'UPDATE\'	=> \'attach_files\',
						\'SET\'		=> \'post_id=\'.intval($info[\'id\']).\', topic_id=\'.intval($info[\'topic_id\']).\', owner_id=\'.intval($info[\'poster_id\']),
						\'WHERE\'		=> \'id=\'.$attach_id
					);
					$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);
	
					redirect(forum_link($attach_url[\'admin_attachment_manage\']), $lang_attach[\'Attachment added\']);
				}
				else
					message ($lang_attach[\'Wrong post\']);
			}
		}
	}
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'mi_new_action' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'] && isset($_GET[\'item\']))
{
	$attach_item = intval($_GET[\'item\']);
	if ($attach_item < 1)
		message($lang_common[\'Bad request\']);

	if (isset($_GET[\'secure_str\']))
	{
		if (preg_match(\'~(\\d+)f(\\d+)~\', $_GET[\'secure_str\'], $match))
		{
			$query = array(
				\'SELECT\'	=>	\'a.id, post_id, topic_id, owner_id, filename, file_ext, file_mime_type, size, file_path, secure_str\',
				\'FROM\'		=>	\'attach_files AS a\',
				\'JOINS\'		=>	array(
					array(
						\'INNER JOIN\' => \'forums AS f\',
						\'ON\'		=> \'f.id = \'.$match[2]
					),
					array(
						\'LEFT JOIN\'	=> \'forum_perms AS fp\',
						\'ON\'		=> \'(fp.forum_id = f.id AND fp.group_id = \'.$forum_user[\'g_id\'].\')\'
					)
				),
				\'WHERE\'		=> \'a.id = \'.$attach_item.\' AND (fp.read_forum IS NULL OR fp.read_forum = 1) AND secure_str = \\\'\'.$_GET[\'secure_str\'].\'\\\'\'
			);
		}
		else if (preg_match(\'~(\\d+)t(\\d+)~\', $_GET[\'secure_str\'], $match))
		{
			$query = array(
				\'SELECT\'	=>	\'a.id, post_id, topic_id, owner_id, filename, file_ext, file_mime_type, size, file_path, secure_str\',
				\'FROM\'		=>	\'attach_files AS a\',
				\'JOINS\'		=>	array(
					array(
						\'INNER JOIN\'	=> \'topics AS t\',
						\'ON\'		=> \'t.id = \'.$match[2]
					),
					array(
						\'INNER JOIN\'	=> \'forums AS f\',
						\'ON\'		=> \'f.id = t.forum_id\'
					),
					array(
						\'LEFT JOIN\'		=> \'forum_perms AS fp\',
						\'ON\'		=> \'(fp.forum_id = f.id AND fp.group_id = \'.$forum_user[\'g_id\'].\')\'
					)
				),
				\'WHERE\'		=> \'a.id = \'.$attach_item.\' AND (fp.read_forum IS NULL OR fp.read_forum = 1) AND secure_str = \\\'\'.$_GET[\'secure_str\'].\'\\\'\'
			);
		}
		else
			message($lang_common[\'Bad request\']);
		if ($forum_user[\'id\'] != $match[1])
			message($lang_common[\'Bad request\']);
	}
	else
		$query = array(
			\'SELECT\'	=>	\'a.id, post_id, topic_id, owner_id, filename, file_ext, file_mime_type, size, file_path, secure_str\',
			\'FROM\'		=>	\'attach_files AS a\',
			\'JOINS\'		=>	array(
				array(
					\'INNER JOIN\'	=> \'topics AS t\',
					\'ON\'		=> \'t.id = a.topic_id\'
				),
				array(
					\'INNER JOIN\'	=> \'forums AS f\',
					\'ON\'	=> \'f.id = t.forum_id\'
				),
				array(
					\'LEFT JOIN\'		=> \'forum_perms AS fp\',
					\'ON\'		=> \'(fp.forum_id = f.id AND fp.group_id = \'.$forum_user[\'g_id\'].\')\'
				)
			),
			\'WHERE\'		=> \'a.id = \'.$attach_item.\' AND (fp.read_forum IS NULL OR fp.read_forum = 1)\'
		);

	$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);
	if (!$forum_db->num_rows($result))
		message($lang_common[\'Bad request\']);
	$attach_info = $forum_db->fetch_assoc($result);

	$query = array(
		\'SELECT\'	=> \'g_pun_attachment_allow_download\',
		\'FROM\'		=> \'groups\',
		\'WHERE\'		=> \'g_id = \'.$forum_user[\'group_id\']
	);
	$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);

	if (!$forum_db->num_rows($result))
		message($lang_common[\'Bad request\']);

	$perms = $forum_db->fetch_assoc($result);
	if ($forum_user[\'g_id\'] != FORUM_ADMIN && !$perms[\'g_pun_attachment_allow_download\'])
		message($lang_common[\'Bad request\']);
	if (isset($_GET[\'preview\']) && in_array($attach_info[\'file_ext\'], array(\'png\', \'jpg\', \'gif\', \'tiff\')))
	{
		if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
			require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
		else
			require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
		require $ext_info[\'path\'].\'/url.php\';

		$forum_page = array();
		$forum_page[\'download_link\'] = !empty($attach_info[\'secure_str\']) ? forum_link($attach_url[\'misc_download_secure\'], array($attach_item, $attach_info[\'secure_str\'])) : forum_link($attach_url[\'misc_download\'], $attach_item);
		$forum_page[\'view_link\'] = !empty($attach_info[\'secure_str\']) ? forum_link($attach_url[\'misc_view_secure\'], array($attach_item, $attach_info[\'secure_str\'])) : forum_link($attach_url[\'misc_view\'], $attach_info[\'id\']);

		// Setup breadcrumbs
		$forum_page[\'crumbs\'] = array(
			array($forum_config[\'o_board_title\'], forum_link($forum_url[\'index\'])),
			$lang_attach[\'Image preview\']
		);

		define(\'FORUM_PAGE\', \'attachment-preview\');
		require FORUM_ROOT.\'header.php\';

		// START SUBST - <!-- forum_main -->
		ob_start();

		?>
		<div class="main-head">
			<h2 class="hn"><span><?php echo $lang_attach[\'Image preview\']; ?></span></h2>
		</div>

		<div class="main-content main-frm">
			<div class="content-head">
				<h2 class="hn"><span><?php echo $attach_info[\'filename\']; ?></span></h2>
			</div>
			<fieldset class="frm-group group1">
				<span class="show-image"><img src="<?php echo $forum_page[\'view_link\']; ?>" alt="<?php echo forum_htmlencode($attach_info[\'filename\']); ?>" /></span>
				<p><?php echo $lang_attach[\'Download:\']; ?> <a href="<?php echo $forum_page[\'download_link\']; ?>"><?php echo forum_htmlencode($attach_info[\'filename\']); ?></a></p>
			</fieldset>
		</div>
		<?php

		$tpl_temp = trim(ob_get_contents());
		$tpl_main = str_replace(\'<!-- forum_main -->\', $tpl_temp, $tpl_main);
		ob_end_clean();
		// END SUBST - <!-- forum_main -->

		require FORUM_ROOT.\'footer.php\';
	}
	else
	{
		$fp = fopen($forum_config[\'attach_basefolder\'].$attach_info[\'file_path\'], \'rb\');

		if (!$fp)
			message($lang_common[\'Bad request\']);
		else
		{
			header(\'Content-Disposition: attachment; filename="\'.$attach_info[\'filename\'].\'"\');
			header(\'Content-Type: \'.$attach_info[\'file_mime_type\']);
			header(\'Pragma: no-cache\');
			header(\'Expires: 0\');
			header(\'Connection: close\');
			header(\'Content-Length: \'.$attach_info[\'size\']);

			fpassthru ($fp);

			if (isset($_GET[\'download\']) && intval($_GET[\'download\']) == 1 && $attach_info[\'owner_id\'] != 0 && $forum_user[\'id\'] != $attach_info[\'owner_id\'])
			{
				$query = array(
					\'UPDATE\'	=> \'attach_files\',
					\'SET\'		=> \'download_counter = download_counter + 1\',
					\'WHERE\'		=> \'id = \'.$attach_item
				);
				$result = $forum_db->query_build($query) or error(__FILE__, __LINE__);
			}
			exit();
		}
	}
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'dl_start' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

require $ext_info[\'path\'].\'/include/attach_func.php\';
if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
	require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
else
	require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'mr_start' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

require $ext_info[\'path\'].\'/include/attach_func.php\';
if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
	require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
else
	require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'dl_qr_get_post_info' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
{
	$query[\'SELECT\'] .= \', g_pun_attachment_allow_upload, g_pun_attachment_upload_max_size, g_pun_attachment_files_per_post, g_pun_attachment_disallowed_extensions, g_pun_attachment_allow_delete_own, g_pun_attachment_allow_delete\';
	$query[\'JOINS\'][] = array(\'LEFT JOIN\' => \'groups AS g\', \'ON\' => \'g.g_id = \'.$forum_user[\'g_id\']);
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'dl_form_submitted' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
{
	$attach_query = array(
		\'SELECT\'	=>	\'id, file_path, owner_id\',
		\'FROM\'		=>	\'attach_files\'
	);
	$attach_query[\'WHERE\'] = $cur_post[\'is_topic\'] ? \'post_id != 0 AND topic_id = \'.$cur_post[\'tid\'] : \'post_id = \'.$id;
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'dl_topic_deleted_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
	remove_attachments($attach_query, $cur_post);

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'dl_post_deleted_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
	remove_attachments($attach_query, $cur_post);

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'mr_qr_get_forum_data' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
{
	$query[\'SELECT\'] .= \', g_pun_attachment_allow_upload, g_pun_attachment_upload_max_size, g_pun_attachment_files_per_post, g_pun_attachment_disallowed_extensions, g_pun_attachment_allow_delete_own, g_pun_attachment_allow_delete\';
	$query[\'JOINS\'][] = array(\'LEFT JOIN\' => \'groups AS g\', \'ON\' => \'g.g_id = \'.$forum_user[\'g_id\']);
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (isset($_POST[\'merge_topics\']) || isset($_POST[\'merge_topics_comply\']))
			{
				$poll_topics = isset($_POST[\'topics\']) && !empty($_POST[\'topics\']) ? $_POST[\'topics\'] : array();
				$poll_topics = array_map(\'intval\', (is_array($poll_topics) ? $poll_topics : explode(\',\', $poll_topics)));

				if (empty($poll_topics))
					message($lang_misc[\'No topics selected\']);

				if (count($poll_topics) == 1)
					message($lang_misc[\'Merge error\']);

				$query_poll = array(
					\'SELECT\'	=>	\'topic_id\',
					\'FROM\'		=>	\'questions\',
					\'WHERE\'		=>	\'topic_id IN(\'.implode(\',\', $poll_topics).\')\'
				);
				$result_pun_poll = $forum_db->query_build($query_poll) or error(__FILE__, __LINE__);
				$num_polls = $forum_db->num_rows($result_pun_poll);

				if ($num_polls > 1)
				{
					if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
						include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					else
						include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
					message($lang_pun_poll[\'Merge error\']);
				}
				else if ($num_polls == 1)
					list($question_id) = $forum_db->fetch_row($result_pun_poll);

				unset($num_polls);
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'mr_confirm_delete_posts_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
{
	$attach_query = array(
		\'SELECT\'	=>	\'id, file_path, owner_id\',
		\'FROM\'		=>	\'attach_files\',
		\'WHERE\'		=>	isset($posts) ? \'post_id IN(\'.implode(\',\', $posts).\')\' : \'topic_id IN(\'.implode(\',\', $topics).\')\'
	);
	$forum_page[\'is_admmod\'] = true;
	remove_attachments($attach_query, $cur_forum);
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'mr_confirm_delete_topics_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_config[\'attach_disable_attach\'])
{
	$attach_query = array(
		\'SELECT\'	=>	\'id, file_path, owner_id\',
		\'FROM\'		=>	\'attach_files\',
		\'WHERE\'		=>	isset($posts) ? \'post_id IN(\'.implode(\',\', $posts).\')\' : \'topic_id IN(\'.implode(\',\', $topics).\')\'
	);
	$forum_page[\'is_admmod\'] = true;
	remove_attachments($attach_query, $cur_forum);
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

pun_tags_remove_orphans();
			pun_tags_generate_cache();

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'mr_confirm_split_posts_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$attach_query = array(
	\'UPDATE\'	=>	\'attach_files\',
	\'SET\'		=>	\'topic_id=\'.$new_tid,
	\'WHERE\'		=>	\'post_id IN (\'.implode(\',\', $posts).\')\'
);
$forum_db->query_build($attach_query) or error(__FILE__, __LINE__);

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!empty($new_tags) && $forum_user[\'g_pun_tags_allow\'])
			{
				foreach ($new_tags as $pun_tag)
					pun_tags_add_new($pun_tag, $new_tid);
				pun_tags_generate_cache();
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'mr_confirm_merge_topics_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$attach_query = array(
	\'UPDATE\'	=>	\'attach_files\',
	\'SET\'		=>	\'topic_id=\'.$merge_to_tid,
	\'WHERE\'		=>	\'topic_id IN(\'.implode(\',\', $topics).\')\'
);
$forum_db->query_build($attach_query) or error(__FILE__, __LINE__);

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (isset($question_id) && $question_id != $merge_to_tid)
			{
				$query_poll = array(
					\'UPDATE\'	=>	\'questions\',
					\'SET\'		=>	\'topic_id = \'.$merge_to_tid,
					\'WHERE\'		=>	\'topic_id = \'.$question_id
				);
				$forum_db->query_build($query) or error(__FILE__, __LINE__);
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    2 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$query = array(
				\'UPDATE\'	=>	\'topic_tags\',
				\'SET\'		=>	\'topic_id = \'.$merge_to_tid,
				\'WHERE\'		=>	\'topic_id IN(\'.implode(\',\', $topics).\') AND topic_id != \'.$merge_to_tid
			);
			$forum_db->query_build($query) or error(__FILE__, __LINE__);
			pun_tags_generate_cache();

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ed_preview_pre_display' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
			
			$question = (isset($_POST[\'question_of_poll\'])) ? forum_trim($_POST[\'question_of_poll\']) : \'\';
			
			$poll_answers = (isset($_POST[\'poll_answer\']) && !empty($_POST[\'poll_answer\']) && is_array($_POST[\'poll_answer\'])) ? array_values( $_POST[\'poll_answer\']) : null;
			
			$answers = array();
			if ($poll_answers != null)
			{
				for ($ans_num = 0; $ans_num < count($poll_answers); $ans_num++)
				{
					 $ans = forum_trim($poll_answers[$ans_num]);
					 if (!empty($ans))
						$answers[] = $ans;
				}
				if (!empty($answers))
					$answers = array_unique($answers);
			}
			if (!empty($question) && !empty($answers) && count($answers) > 1 && strlen($question) >= 5)
			{
				?>
					<div class="main-subhead">
						<h2 class="hn"><span><?php echo $lang_pun_poll[\'Preview poll\']; ?></span></h2>
					</div>
					<div id="post-preview" class="main-content main-frm">
						<fieldset class="mf-set set1" style="padding:0 0 0 2em">
							<legend>
									<?php $poll_question = sprintf($lang_pun_poll[\'Preview poll question\'], forum_htmlencode($question)); echo "\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t".$poll_question; ?>
							</legend>
							<div class="mf-box">
								<?php
									$count_poll = 0;
									
									if ($forum_config[\'p_pun_poll_max_answers\'] < count($answers))
										$count_poll = $forum_config[\'p_pun_poll_max_answers\'];
									else
										$count_poll = count($answers);
									$_POST[\'poll_ans_count\'] = $count_poll;
									
									for($iter = 0; $iter < $count_poll; $iter++)
									{
										echo \'<div class="mf-item"><span class="fld-input">\'.($iter + 1).\'</span>\';
										echo \'<label>\'.$answers[$iter].\'</label>\';
										echo \'</div>\';
									}
								?>
							</div>
						</fieldset>
					</div>
				<?php
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'po_preview_pre_display' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
			
			$question = (isset($_POST[\'question_of_poll\'])) ? forum_trim($_POST[\'question_of_poll\']) : \'\';
			
			$poll_answers = (isset($_POST[\'poll_answer\']) && !empty($_POST[\'poll_answer\']) && is_array($_POST[\'poll_answer\'])) ? array_values( $_POST[\'poll_answer\']) : null;
			
			$answers = array();
			if ($poll_answers != null)
			{
				for ($ans_num = 0; $ans_num < count($poll_answers); $ans_num++)
				{
					 $ans = forum_trim($poll_answers[$ans_num]);
					 if (!empty($ans))
						$answers[] = $ans;
				}
				if (!empty($answers))
					$answers = array_unique($answers);
			}
			if (!empty($question) && !empty($answers) && count($answers) > 1 && strlen($question) >= 5)
			{
				?>
					<div class="main-subhead">
						<h2 class="hn"><span><?php echo $lang_pun_poll[\'Preview poll\']; ?></span></h2>
					</div>
					<div id="post-preview" class="main-content main-frm">
						<fieldset class="mf-set set1" style="padding:0 0 0 2em">
							<legend>
									<?php $poll_question = sprintf($lang_pun_poll[\'Preview poll question\'], forum_htmlencode($question)); echo "\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t\\t".$poll_question; ?>
							</legend>
							<div class="mf-box">
								<?php
									$count_poll = 0;
									
									if ($forum_config[\'p_pun_poll_max_answers\'] < count($answers))
										$count_poll = $forum_config[\'p_pun_poll_max_answers\'];
									else
										$count_poll = count($answers);
									$_POST[\'poll_ans_count\'] = $count_poll;
									
									for($iter = 0; $iter < $count_poll; $iter++)
									{
										echo \'<div class="mf-item"><span class="fld-input">\'.($iter + 1).\'</span>\';
										echo \'<label>\'.$answers[$iter].\'</label>\';
										echo \'</div>\';
									}
								?>
							</div>
						</fieldset>
					</div>
				<?php
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ca_fn_prune_qr_prune_topics' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$pun_poll_topic_ids = isset($topic_ids) ? $topic_ids : implode(\',\', $topics);
			$query_poll = array(
				\'DELETE\'	=>	\'voting\',
				\'WHERE\'		=>	\'topic_id IN(\'.$pun_poll_topic_ids.\')\'
			);
			$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);
			
			$query_poll = array(
				\'DELETE\'	=>	\'questions\',
				\'WHERE\'		=>	\'topic_id IN(\'.$pun_poll_topic_ids.\')\'
			);
			$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);

			$query_poll = array(
				\'DELETE\'	=>	\'answers\',
				\'WHERE\'		=>	\'topic_id IN(\'.$pun_poll_topic_ids.\')\'
			);
			$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);
			unset($pun_poll_topic_ids);

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'mr_confirm_delete_topics_qr_delete_topics' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$pun_poll_topic_ids = isset($topic_ids) ? $topic_ids : implode(\',\', $topics);
			$query_poll = array(
				\'DELETE\'	=>	\'voting\',
				\'WHERE\'		=>	\'topic_id IN(\'.$pun_poll_topic_ids.\')\'
			);
			$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);
			
			$query_poll = array(
				\'DELETE\'	=>	\'questions\',
				\'WHERE\'		=>	\'topic_id IN(\'.$pun_poll_topic_ids.\')\'
			);
			$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);

			$query_poll = array(
				\'DELETE\'	=>	\'answers\',
				\'WHERE\'		=>	\'topic_id IN(\'.$pun_poll_topic_ids.\')\'
			);
			$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);
			unset($pun_poll_topic_ids);

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$query_tags = array(
				\'DELETE\'	=>	\'topic_tags\',
				\'WHERE\'		=>	\'topic_id IN(\'.implode(\',\', $topics).\')\'
			);
			$forum_db->query_build($query_tags) or error(__FILE__, __LINE__);

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'fn_delete_topic_qr_delete_topic' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$query_poll = array(
				\'DELETE\'	=>	\'voting\',
				\'WHERE\'		=>	\'topic_id = \'.$topic_id
			);
			$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);

			$query_poll = array(
				\'DELETE\'	=>	\'questions\',
				\'WHERE\'		=>	\'topic_id = \'.$topic_id
			);
			$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);

			$query_poll = array(
				\'DELETE\'	=>	\'answers\',
				\'WHERE\'		=>	\'topic_id = \'.$topic_id
			);
			$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'po_posting_location_selected' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

			//Validate of input in pun_poll form
			$error_poll = array();
			
			$options_count = (isset($_POST[\'poll_answer\'])) ? count($_POST[\'poll_answer\']) : 2;
			
			if ($fid > 0 && isset($_POST[\'form_sent\']) && !$forum_user[\'is_guest\'])
			{
				//User press update poll
				if (isset($_POST[\'update_poll\']))
				{
					//Reset form sent
					unset($_POST[\'form_sent\']);

					$subject = forum_trim($_POST[\'req_subject\']);
					if ($subject == \'\')
						$error_poll[] = $lang_post[\'No subject\'];
					else if (utf8_strlen($subject) > 70)
						$error_poll[] = $lang_post[\'Too long subject\'];
					else if ($forum_config[\'p_subject_all_caps\'] == \'0\' && utf8_strtoupper($subject) == $subject && !$forum_page[\'is_admmod\'])
						$error_poll[] = $lang_post[\'All caps subject\'];

					// Clean up message from POST
					$message = forum_linebreaks(forum_trim($_POST[\'req_message\']));
					if (strlen($message) > FORUM_MAX_POSTSIZE_BYTES)
						$error_poll[] = sprintf($lang_post[\'Too long message\'], forum_number_format(strlen($message)), forum_number_format(FORUM_MAX_POSTSIZE_BYTES));
					else if ($forum_config[\'p_message_all_caps\'] == \'0\' && utf8_strtoupper($message) == $message && !$forum_page[\'is_admmod\'])
						$error_poll[] = $lang_post[\'All caps message\'];
				}
				
				$poll_answers = (isset($_POST[\'poll_answer\']) && !empty($_POST[\'poll_answer\']) && is_array($_POST[\'poll_answer\'])) ? array_values( $_POST[\'poll_answer\']) : null;
				if ($poll_answers == null && !empty($_POST[\'poll_answer\']))
					$error_poll[] = $lang_common[\'Bad request\'];
				$days_poll = isset($_POST[\'allow_poll_days\']) && !empty($_POST[\'allow_poll_days\']) ? intval($_POST[\'allow_poll_days\']) : null;
				if ($days_poll != null && ($days_poll > 90 || $days_poll < 1))
					$error_poll[] = $lang_pun_poll[\'Days limit\'];
				$votes_poll = isset($_POST[\'allow_poll_votes\']) && !empty($_POST[\'allow_poll_votes\']) ? intval($_POST[\'allow_poll_votes\']) : null;
				if ($votes_poll != null && ($votes_poll > 500 || $votes_poll < 2))
					$error_poll[] = $lang_pun_poll[\'Votes count\'];
				if (isset($_POST[\'form_sent\']) && !empty($_POST[\'question_of_poll\']) && $days_poll != null && $votes_poll != null)
					$error_poll[] = $lang_pun_poll[\'Input error\'];
				$options_count = (!isset($_POST[\'poll_ans_count\']) || intval($_POST[\'poll_ans_count\']) < 2) ? 0 : intval($_POST[\'poll_ans_count\']);
				if ($options_count == 0)
					$error_poll[] = $lang_pun_poll[\'Min cnt options\'];
				if ($options_count > $forum_config[\'p_pun_poll_max_answers\'])
					$error_poll[] = sprintf($lang_pun_poll[\'Max cnt options\'], $forum_config[\'p_pun_poll_max_answers\']);
				if ((isset($_POST[\'poll_ans_count\'])) && ($_POST[\'poll_ans_count\'] > 2))
				{
					if ($_POST[\'poll_ans_count\'] > $forum_config[\'p_pun_poll_max_answers\'])
						$options_count = $forum_config[\'p_pun_poll_max_answers\'];
					else
						$options_count = $_POST[\'poll_ans_count\'];
				}
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'po_req_info_fieldset_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

//Show form for creation of poll
			include $ext_info[\'path\'].\'/functions.php\';
			if (($fid > 0 && empty($forum_user[\'is_guest\'])) && ($forum_user[\'g_poll_add\'] || $forum_user[\'g_id\'] == FORUM_ADMIN))
				form_of_poll( isset($_POST[\'question_of_poll\']) ? forum_htmlencode(forum_trim($_POST[\'question_of_poll\'])) : \'\', isset($poll_answers) ? $poll_answers : array() , $options_count, isset($days_poll) ? $days_poll : \'\', isset($votes_poll) ? $votes_poll : \'\');

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'vt_modify_topic_info' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_user[\'is_guest\'])
			{
				//Get info about poll
				$query_pun_poll = array(
					\'SELECT\'	=>	\'question, read_unvote_users, revote, created, days_count, votes_count\',
					\'FROM\'		=>	\'questions\',
					\'WHERE\'		=>	\'topic_id = \'.$id
				);
				$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);

				//Is there something?
				if ($forum_db->num_rows($result_pun_poll) > 0)
				{
					list($question, $read_unvote_users, $revote, $created, $days_count, $max_votes_count) = $forum_db->fetch_row($result_pun_poll);
					
					$revote = ($forum_config[\'p_pun_poll_enable_revote\']) ? $revote : 0;
					$read_unvote_users = ($forum_config[\'p_pun_poll_enable_read\']) ? $read_unvote_users : 0;
					
					//Check up for condition of end poll
					if ($days_count != 0 && time() > $created + $days_count * 86400)
						$end_voting = true;
					else if ($max_votes_count != 0)
					{
						//Get count of votes
						$query_pun_poll = array(
							\'SELECT\'	=>	\'COUNT(id)\',
							\'FROM\'		=>	\'voting\',
							\'WHERE\'		=>	\'topic_id=\'.$id
						);
						$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
						if ($forum_db->num_rows($result_pun_poll) > 0)
							list($vote_count) = $forum_db->fetch_row($result_pun_poll);

						if (isset($vote_count) && $vote_count >= $max_votes_count)
							$end_voting = true;
					}
					
					if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
						include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
					else
						include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
					//Does user want to vote?
					if (isset($_POST[\'vote\']))
					{
						if (isset($end_voting))
							message($lang_pun_poll[\'End of vote\']);

						$answer_id = isset($_POST[\'answer\']) ? intval($_POST[\'answer\']) : 0;
						if ($answer_id < 1)
							message($lang_common[\'Bad request\']);

						//Is there answer with this id?
						$query_pun_poll = array(
							\'SELECT\'	=>	\'1\',
							\'FROM\'		=>	\'answers\',
							\'WHERE\'		=>	\'topic_id = \'.$id.\' AND id = \'.$answer_id
						);
						$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
						if ($forum_db->num_rows($result_pun_poll) < 1)
							message($lang_common[\'Bad request\']);

						//Have user voted?
						$query_pun_poll = array(
							\'SELECT\'	=>	\'answer_id\',
							\'FROM\'		=>	\'voting\',
							\'WHERE\'		=>	\'topic_id = \'.$id.\' AND user_id = \'.$forum_user[\'id\']
						);
						$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
						if (!$revote && $forum_db->num_rows($result_pun_poll) > 0)
							message($lang_pun_poll[\'User vote error\']);

						//If user have voted we update table, if not - insert new record
						if ($revote && $forum_db->num_rows($result_pun_poll) > 0)
						{
							list($old_answer_id) = $forum_db->fetch_row($result_pun_poll);
	
							//Do we needed to update DB?
							if ($old_answer_id != $answer_id)
							{
								$query_pun_poll = array(
									\'UPDATE\'	=>	\'voting\',
									\'SET\'		=>	\'answer_id = \'.$answer_id,
									\'WHERE\'		=>	\'topic_id = \'.$id.\' AND user_id = \'.$forum_user[\'id\']
								);
								$forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);

								//Replace old answer id with new for correct output
								$old_answer_id = $answer_id;
							}
						}
						else
						{
							//Add new record
							$query_pun_poll = array(
								\'INSERT\'	=>	\'topic_id, user_id, answer_id\',
								\'INTO\'		=>	\'voting\',
								\'VALUES\'	=>	$id.\', \'.$forum_user[\'id\'].\', \'.$answer_id	
							);
							$forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);

							//Manually change votes count for correct results showing
							if (isset($vote_count))
								$vote_count++;
						}
						$is_voted_user = true;
					}
					else
					{
						//Determine user have voted or not
						$query_pun_poll = array(
							\'SELECT\'	=>	\'1\',
							\'FROM\'		=>	\'voting\',
							\'WHERE\'		=>	\'user_id = \'.$forum_user[\'id\'].\' AND topic_id = \'.$id
						);
						$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
						
						$is_voted_user = ($forum_db->num_rows($result_pun_poll) > 0) ? true : false;
					}
				}
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ed_form_submitted' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!empty($error_poll))
			{
				$count_err = count($error_poll);
				for($iter = 0; $iter < $count_err; $iter++)
					$errors[] = $error_poll[$iter];
				$error_poll = array();
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ed_main_fieldset_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_user[\'g_id\'] == FORUM_ADMIN && $can_edit_subject)
			{
				include $ext_info[\'path\'].\'/functions.php\';

				//Is there something?
				if ($poll)
				{

				?>
				<fieldset class="frm-group group<?php echo ++$forum_page[\'group_count\'] ?>">
					<div class="sf-set set1">
						<div class="sf-box checkbox">
							<span class="fld-input">
								<input id="fld<?php echo ++ $forum_page[\'fld_count\'] ?>" type="checkbox" value="1" name="reset_poll"/>
							</span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>">
								<span><?php echo $lang_pun_poll[\'Reset res\'] ?></span>
								<?php echo $lang_pun_poll[\'Reset res notice\'] ?>
							</label>
						</div>
					</div>
					<div class="sf-set set2">
						<div class="sf-box checkbox">
							<span class="fld-input">
								<input id="fld<?php echo ++ $forum_page[\'fld_count\'] ?>" type="checkbox" value="1" name="remove_poll"/>
							</span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>">
								<span><?php echo $lang_pun_poll[\'Remove v\'] ?></span>
								<?php echo $lang_pun_poll[\'Remove v notice\'] ?>
							</label>
						</div>
					</div>
				</fieldset>
				<?php
					$days_count_poll = 0;
					$votes_count_poll = 0;
					
					//block for days_count
					if (($days_poll != null) && ($votes_poll == null))
						$days_count_poll = $days_poll;
					else if (($days_poll == null) && ($votes_poll == null))
						$days_count_poll = $days_count;
					
					//block for votes_count
					if (($votes_poll != null) && ($days_poll == null))
						$votes_count_poll = $votes_poll;
					else if (($votes_poll == null) && ($days_poll == null))
						$votes_count_poll = $max_votes_count;
					
					form_of_poll(isset($_POST[\'question_of_poll\']) ? forum_htmlencode(forum_trim($_POST[\'question_of_poll\'])) : $question, $poll_answers, $options_count, (($days_count_poll != 0) && ($votes_count_poll == 0)) ? $days_count_poll : \'\', (($days_count_poll == 0) && ($votes_count_poll != 0)) ? $votes_count_poll : \'\');
				}
				else
					form_of_poll(isset($_POST[\'question_of_poll\']) ? forum_htmlencode(forum_trim($_POST[\'question_of_poll\'])) : \'\', (isset($poll_answers) && $poll_answers != null) ? $poll_answers : array(), (isset($options_count) && (!empty($_POST))) ? $options_count : 2, ((isset($days_poll) && (($days_poll != null)) && !(isset($votes_poll) && $votes_poll != null))) ? $days_poll : \'\', ((isset($votes_poll) && $votes_poll != null) && !(isset($days_poll) && (($days_poll != null)))) ? $votes_poll : \'\');
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ed_pre_post_edited' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($can_edit_subject && !$forum_user[\'is_guest\'])
		{
			//Is there something to edit?
			if ($poll)
			{
				$reset_poll = (isset($_POST[\'reset_poll\']) && $_POST[\'reset_poll\'] == \'1\') ? true : false;
				$remove_poll = (isset($_POST[\'remove_poll\']) && $_POST[\'remove_poll\'] == \'1\') ? true : false;

				//We need to reset poll
				if ($reset_poll || $remove_poll)
				{
					//Remove voting results
					$query_pun_poll = array(
						\'DELETE\'	=>	\'voting\',
						\'WHERE\'		=>	\'topic_id = \'.$cur_post[\'tid\']
					);
					$forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
					if ($remove_poll)
					{
						//Remove questions
						$query_pun_poll = array(
							\'DELETE\'	=>	\'questions\',
							\'WHERE\'		=>	\'topic_id = \'.$cur_post[\'tid\']
						);
						$forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);

						//Remove answers
						$query_pun_poll = array(
							\'DELETE\'	=>	\'answers\',
							\'WHERE\'		=>	\'topic_id = \'.$cur_post[\'tid\']
						);
						$forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
					}
				}
				else if ($forum_user[\'g_id\'] == FORUM_ADMIN)
				{
					//Get info about poll
					$query_pun_poll = array(
						\'SELECT\'	=>	\'question, read_unvote_users, revote, created, days_count, votes_count\',
						\'FROM\'		=>	\'questions\',
						\'WHERE\'		=>	\'topic_id = \'.$cur_post[\'tid\']
					);
					$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);

					if ($forum_db->num_rows($result_pun_poll) > 0)
					{
						list($question, $read_unvote_users, $revote, $created, $days_count, $max_votes_count) = $forum_db->fetch_row($result_pun_poll);
					}
					
					for ($ans_num = 0; $ans_num < count($poll_answers); $ans_num++)
					{
						 $ans = forum_trim($poll_answers[$ans_num]);
						 if (!empty($ans))
							$answers[] = $ans;
					}

					//Determine how many new 
					$query_pun_poll = array(
						\'SELECT\'	=>	\'id\',
						\'FROM\'		=>	\'answers\',
						\'WHERE\'		=>	\'topic_id = \'.$cur_post[\'tid\'],
						\'ORDER BY\'	=>	\'id ASC\'
					);

					$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
					$ans_ids = array();
					while (list($ans_id) = $forum_db->fetch_row($result_pun_poll))
						$ans_ids[] = $ans_id;

					for ($ans_num = 0; $ans_num < count($answers); $ans_num++)
					{
						//Old answer
						if (isset($ans_ids[$ans_num]))
						{
							$query_pun_poll = array(
								\'UPDATE\'	=>	\'answers\',
								\'SET\'		=>	\'answer = \\\'\'.$forum_db->escape($answers[$ans_num]).\'\\\'\',
								\'WHERE\'		=>	\'id = \'.$ans_ids[$ans_num]
							);

							$forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
						}
						else
						{
							//New answer
							$query_pun_poll = array(
								\'INSERT\'	=>	\'topic_id, answer\',
								\'INTO\'		=>	\'answers\',
								\'VALUES\'	=>	$cur_post[\'tid\'].\', \\\'\'.$forum_db->escape($answers[$ans_num]).\'\\\'\'
							);

							$forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
						}
					}

					//Remove answers
					if (count($ans_ids) > count($answers))
					{
						$ids = implode(\',\', array_slice($ans_ids, count($answers)));
						$query_pun_poll = array(
							\'DELETE\'	=>	\'answers\',
							\'WHERE\'		=>	\'id IN (\'.$ids .\')\'
						);
						$forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
	
						$query_pun_poll = array(
							\'DELETE\'	=>	\'voting\',
							\'WHERE\'		=>	\'answer_id IN (\'.$ids.\')\'
						);
						$forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
					}

					//Update question if needed
					$question_form = (isset($_POST[\'question_of_poll\'])) ? forum_trim($_POST[\'question_of_poll\']) : null;
					if ($question_form == null)
						message($lang_pun_poll[\'Empty question\']);

					$changes = array();
					if ($question != $question_form)
						$changes[] = \'question = \\\'\'.$forum_db->escape($question_form).\'\\\'\';
					$read_unvote_users_form = ($forum_config[\'p_pun_poll_enable_read\'] && isset($_POST[\'read_unvote_users\']) && $_POST[\'read_unvote_users\'] == 1) ? 1 : 0;
					$revote_form = ($forum_config[\'p_pun_poll_enable_revote\'] && isset($_POST[\'revouting\']) && ($_POST[\'revouting\'] == 1)) ? 1 : 0;
					if ($read_unvote_users != $read_unvote_users_form)
						$changes[] = \'read_unvote_users = \'.$read_unvote_users_form;
					$days_poll = ($days_poll == \'\') ? 0 : $days_poll;
					if ($days_poll != $days_count)
						$changes[] = \'days_count = \'.$days_poll;
					$votes_poll = ($votes_poll == \'\') ? 0 : $votes_poll;
					if ($votes_poll != $max_votes_count)
						$changes[] = \'votes_count = \'.$votes_poll;
					if ($revote_form != $revote)
						$changes[] = \'revote = \'.$revote_form;

					if (!empty($changes))
					{
						$query_pun_poll = array(
							\'UPDATE\'	=>	\'questions\',
							\'SET\'		=>	implode(\', \', $changes),
							\'WHERE\'		=>	\'topic_id = \'.$cur_post[\'tid\']
						);
						$forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);
					}
				}
			}
			else
			{
				$question = (isset($_POST[\'question_of_poll\'])) ? forum_trim($_POST[\'question_of_poll\']) : \'\';
				//Is there something to add?
				if (!empty($question))
				{
					//Validate of pull_answers
					$answers = array();
					if ($poll_answers != null)
					{
						for ($ans_num = 0; $ans_num < count($poll_answers); $ans_num++)
						{
							 $ans = forum_trim($poll_answers[$ans_num]);
							 if (!empty($ans))
								$answers[] = $ans;
						}
						if (!empty($answers))
							$answers = array_unique($answers);
					}
					if (!empty($answers) && count($answers) > 1 && strlen($question) >= 5)
					{
						//Can unvoted user read voting results?
						$read_unvote_users = ($forum_config[\'p_pun_poll_enable_read\'] && isset($_POST[\'read_unvote_users\']) && $_POST[\'read_unvote_users\'] == 1) ? 1 : 0;
						//Can user change opinion?
						$revote = ($forum_config[\'p_pun_poll_enable_revote\'] && isset($_POST[\'revouting\']) && $_POST[\'revouting\'] == 1) ? 1 : 0;
						
						if ($days_poll != null)
							$votes_poll = \'\\\'NULL\\\'\';
						else
							$days_poll = \'\\\'NULL\\\'\';

						$query_poll = array(
							\'INSERT\'	=>	\'topic_id, question, read_unvote_users, revote, created, days_count, votes_count\',
							\'INTO\'		=>	\'questions\',
							\'VALUES\'	=>	$cur_post[\'tid\'].\', \\\'\'.$forum_db->escape($question).\'\\\', \'.$read_unvote_users.\', \'.$revote.\', \'.time().\', \'.intval($days_poll).\', \'.intval($votes_poll)
						);
						$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);

						//Add answers to DB
						foreach ($answers as $ans)
						{
							$query_poll = array(
								\'INSERT\'	=>	\'topic_id, answer\',
								\'INTO\'		=>	\'answers\',
								\'VALUES\'	=>	$cur_post[\'tid\'].\', \\\'\'.$forum_db->escape($ans).\'\\\'\'
							);
							$forum_db->query_build($query_poll) or error(__FILE__, __LINE__);
						}
					}
				}
			}
		}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($can_edit_subject && $forum_user[\'g_pun_tags_allow\'])
			{
				//Parse the string
				if (isset($_POST[\'pun_tags\']))
					$new_tags = pun_tags_parse_string(utf8_trim($_POST[\'pun_tags\']));
				if (empty($new_tags))
				{
					if (isset($pun_tags[\'topics\'][$cur_post[\'tid\']]))
					{
						pun_tags_remove_topic_tags($cur_post[\'tid\']);
						$update_cache = TRUE;
					}
				}
				else
				{
					//Determine old tags
					$old_tags = array();
					if (!empty($pun_tags[\'topics\'][$cur_post[\'tid\']]))
					{
						foreach ($pun_tags[\'topics\'][$cur_post[\'tid\']] as $old_tagid)
							$old_tags[$old_tagid] = $pun_tags[\'index\'][$old_tagid];
					}
	
					//Tags for removing
					$remove_tags = array_diff($old_tags, $new_tags);
					if (!empty($remove_tags))
					{
						$pun_tags_query = array(
							\'DELETE\'	=>	\'topic_tags\',
							\'WHERE\'		=>	\'topic_id = \'.$cur_post[\'tid\'].\' AND tag_id IN (\'.implode(\',\', array_keys($remove_tags)).\')\'
						);
						$forum_db->query_build($pun_tags_query) or error(__FILE__, __LINE__);
						$update_cache = TRUE;
					}

					$search_arr = isset($pun_tags[\'index\']) ? $pun_tags[\'index\'] : array();
					foreach ($new_tags as $tag)
					{
						//Have we current tag?
						if (in_array($tag, $old_tags))
							continue;
						$tag_id = array_search($tag, $search_arr);
						if ($tag_id === FALSE)
							pun_tags_add_new($tag, $cur_post[\'tid\']);
						else
							pun_tags_add_existing_tag($tag_id, $cur_post[\'tid\']);
						$update_cache = TRUE;
					}
					if (!empty($update_cache))
					{
						pun_tags_remove_orphans();
						pun_tags_generate_cache();
					}
				}
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'hd_main_elements' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

//Is there something to show?
			if (FORUM_PAGE == \'viewtopic\' && isset($read_unvote_users) && !$forum_user[\'is_guest\'])
			{
				//If we don\'t get count of votes
				if (!isset($vote_count))
				{
					$query_pun_poll = array(
						\'SELECT\'	=>	\'COUNT(id)\',
						\'FROM\'		=>	\'voting\',
						\'WHERE\'		=>	\'topic_id=\'.$id
					);
					$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);

					if ($forum_db->num_rows($result_pun_poll) > 0)
						list($vote_count) = $forum_db->fetch_row($result_pun_poll);
				}
				//Showing of vote-form if users can revote or user don\'t vote
				if (!isset($end_voting) && (($is_voted_user && $revote) || !$is_voted_user))
				{
					$query_pun_poll = array(
						\'SELECT\'	=>	\'id, answer\',
						\'FROM\'		=>	\'answers\',
						\'WHERE\'		=>	\'topic_id = \'.$id,
						\'GROUP BY\'	=>	\'id\',
						\'ORDER BY\'	=>	\'id ASC\'
					);
					$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);

					if ($forum_db->num_rows($result_pun_poll) > 1)
					{
						$vote_form = \'\';
						$link = forum_link($forum_url[\'topic\'], $id);
						$vote_form = \'<div class="main-subhead"><h2 class="hn"><span><strong>\'.forum_htmlencode($question).\'?</strong></span></h2></div><div class="main-content main-frm"><form class="frm-form" action="\'.$link.\'" accept-charset="utf-8" method="post"><fieldset class="frm-group group1">\';
						$vote_form .= \'<div class="hidden"><input type="hidden" name="csrf_token" value="\'.generate_form_token($link).\'" /></div>\';
						$vote_form .= \'<fieldset class="mf-set set1"><legend><span>\'.$lang_pun_poll[\'Options\'].\'</span></legend><div class="mf-box">\';

						//Determine old answer of user
						if (!isset($old_answer_id))
						{
							$query_pun_poll = array(
								\'SELECT\'	=>	\'answer_id\',
								\'FROM\'		=>	\'voting\',
								\'WHERE\'		=>	\'topic_id = \'.$id.\' AND user_id = \'.$forum_user[\'id\'],
								\'ORDER BY\'	=>	\'answer_id ASC\'
							);
							$result_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);

							//If there is something?
							if ($forum_db->num_rows($result_poll) > 0)
								list($old_answer_id) = $forum_db->fetch_row($result_poll);
							unset($result_poll);
						}
						$num = 0;
						while ($answer = $forum_db->fetch_assoc($result_pun_poll)) 
						{
							$vote_form .= \'<div class="mf-item"><span class="fld-input">\';
							$vote_form .= \'<input id="fld\'.++$num.\'" type="radio"\'.((isset($old_answer_id) && $old_answer_id == $answer[\'id\']) ? \' checked="checked"\' : \'\').\' value="\'.$answer[\'id\'].\'" name="answer"/>\';
							$vote_form .= \'</span><label for="fld\'.$num.\'">\'.forum_htmlencode($answer[\'answer\']).\'</label></div>\';
						}
						$vote_form .= \'</div></fieldset></fieldset><div class="frm-buttons"><span class="submit">\';
						$vote_form .= \'<input type="submit" value="\'.$lang_pun_poll[\'But note\'].\'" name="vote"/>\';
						$vote_form .= \'</span></div></form>\';
					}
				}

				//Showing voting results if user have voted or unread user can see voting results
				if (isset($end_voting) || $is_voted_user || (!$is_voted_user && $read_unvote_users))
				{
					if (isset($vote_count) && $vote_count > 0)
					{
						$query_pun_poll = array(
							\'SELECT\'	=>	\'answer, COUNT(v.id)\',
							\'FROM\'		=>	\'answers as a\',
							\'JOINS\'		=>	array(
								array(
									\'LEFT JOIN\'	=>	\'voting AS v\',
									\'ON\'		=>	\'a.id=v.answer_id\'
								)
							),
							\'WHERE\'		=>	\'a.topic_id=\'.$id,
							\'GROUP BY\'	=>	\'a.id\',
							\'ORDER BY\'	=>	\'a.id\'
						);
						$result_pun_poll = $forum_db->query_build($query_pun_poll) or error(__FILE__, __LINE__);

						$num = 0;
						$vote_results = isset($vote_form) ? \'\' : \'<div class="main-subhead"><h2 class="hn"><span><strong>\'.forum_htmlencode($question).\'?</strong></span></h2></div><div class="main-content main-frm">\';
						$vote_results .= \'<div class="ct-group"><table cellspacing="0"><thead><th class="tc0" scope="col">&nbsp;</th><th class="tc1" scope="col">&nbsp;</th><th class="tc2" scope="col">&nbsp;</th></thead><tbody>\';
						while (list($answer, $count_v) = $forum_db->fetch_row($result_pun_poll))
						{
							$num++;
							$vote_results .= \'<tr class="\'.($num % 2 == 0 ? \'even\' : \'odd\').\'">\';
							$vote_results .= \'<td class="tc0">\'.forum_htmlencode($answer).\'</td>\';
							$vote_results .= \'<td class="tc1">\'.forum_number_format($count_v).\'</td>\';
							$vote_results .= \'<td class="tc2">\'.forum_number_format((float)$count_v/$vote_count * 100, 2).\'%</td></tr>\';
						}
						$num++;
						$vote_results .= \'<tr class="\'.($num % 2 == 0 ? \'even\' : \'odd\').\'"><td class="tc0" colspan="3" style="text-align: center;">\'.$lang_pun_poll[\'Users count\'].$vote_count.\'</td></tr>\';
						$vote_results .= \'</tbody></table></div>\';
					}
					else
						$vote_results = \'<div class="ct-box info-box"><p>\'.$lang_pun_poll[\'No votes\'].\'</p></div>\';
				}
				else
					$vote_results = \'<div class="ct-box info-box"><p>\'.$lang_pun_poll[\'Dis read vote\'].\'</p></div>\';

				if (!empty($main_elements[\'<!-- forum_main_pagepost_top -->\']))
					$tmp_pagepost = $main_elements[\'<!-- forum_main_pagepost_top -->\'];
				$main_elements[\'<!-- forum_main_pagepost_top -->\'] = \'<div class="main-head"><h2 class="hn">\'.$lang_pun_poll[\'Header note\'].\'</h2></div>\';
				$main_elements[\'<!-- forum_main_pagepost_top -->\'] .= isset($vote_form) ? $vote_form : \'\';
				$main_elements[\'<!-- forum_main_pagepost_top -->\'] .= $vote_results;
				$main_elements[\'<!-- forum_main_pagepost_top -->\'] .= \'</div>\';
				$main_elements[\'<!-- forum_main_pagepost_top -->\'] .= isset($tmp_pagepost) ? $tmp_pagepost : \'\';

				unset($tmp_pagepost, $vote_results, $vote_form, $vote_count, $num, $result_pun_poll, $query_pun_poll, $count_v, $question, $answer, $is_voted_user, $end_voting, $read_unvote_users);
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

//Output of search results
			if ($forum_config[\'o_pun_tags_show\'] == 1 && in_array(FORUM_PAGE, array(\'index\', \'viewforum\', \'viewtopic\', \'searchtopics\', \'searchposts\')))
			{
				$output_results = array();
				switch (FORUM_PAGE)
				{
					case \'index\':
						if (isset($pun_tags[\'forums\']))
						{
							foreach ($pun_tags[\'forums\'] as $forum_id => $tags_list)
							{
								//Can user read this forum?
								if (in_array($forum_id, $pun_tags_groups_perms[$forum_user[\'group_id\']]))
								{
									foreach ($tags_list as $tag_id => $tag_weight)
										if (!isset($output_results[$tag_id]))
											$output_results[$tag_id] = array(\'tag\' => $pun_tags[\'index\'][$tag_id], \'weight\' => $tag_weight);
										else
											$output_results[$tag_id][\'weight\'] += $tag_weight;
								}
							}
						}
						break;
					case \'viewforum\':
						if (isset($pun_tags[\'forums\'][$id]))
						{
							foreach ($pun_tags[\'forums\'][$id] as $tag_id => $tag_weight)
							{
								$output_results[$tag_id] = array(\'tag\' => $pun_tags[\'index\'][$tag_id], \'weight\' => $tag_weight);
								//Determine tag weight
								foreach ($pun_tags[\'forums\'] as $forum_id => $tags_list)
									if ($forum_id != $id && in_array($forum_id, $pun_tags_groups_perms[$forum_user[\'group_id\']]) && in_array($tag_id, array_keys($tags_list)))
										$output_results[$tag_id][\'weight\'] += $tags_list[$tag_id];
							}
						}
						break;
					case \'viewtopic\':
						if (isset($pun_tags[\'topics\'][$id]))
						{
							foreach ($pun_tags[\'topics\'][$id] as $tag_id)
							{
								$output_results[$tag_id] = array(\'tag\' => $pun_tags[\'index\'][$tag_id], \'weight\' => $pun_tags[\'forums\'][$cur_topic[\'forum_id\']][$tag_id]);
								//Determine tag weight
								foreach ($pun_tags[\'forums\'] as $forum_id => $tags_list)
									if ($forum_id != $cur_topic[\'forum_id\'] && in_array($forum_id, $pun_tags_groups_perms[$forum_user[\'group_id\']]) && in_array($tag_id, array_keys($tags_list)))
										$output_results[$tag_id][\'weight\'] += $tags_list[$tag_id];
							}
						}
						break;
					case \'searchtopics\':
					case \'searchposts\':
						//This string will be replaced after getting search results
						$main_elements[\'<!-- forum_crumbs_end -->\'] .= \'<div id="brd-pun_tags" class="gen-content"></div>\';
						break;
				}

				if (!empty($output_results))
				{
					$minfontsize = 100;
					$maxfontsize = 200;
					list($min_pop, $max_pop) = min_max_tags_weights($output_results);
					if ($max_pop - $min_pop == 0)
						$step = $maxfontsize - $minfontsize;
					else
						$step = ($maxfontsize - $minfontsize) / ($max_pop - $min_pop);

					uasort($output_results, \'compare_tags\');
					$output_results = array_tags_slice($output_results);
					$results = array();
					foreach ($output_results as $tag_id => $tag_info)
						$results[] = pun_tags_get_link(round(($tag_info[\'weight\'] - $min_pop) * $step + $minfontsize), $tag_id, $tag_info[\'weight\'], $tag_info[\'tag\']);
					$main_elements[\'<!-- forum_crumbs_end -->\'] .= \'<div id="brd-pun_tags" class="gen-content">\'.$lang_pun_tags[\'Title\'].implode($forum_config[\'o_pun_tags_separator\'], $results).\'</div>\';
					unset($minfontsize, $maxfontsize, $step, $results, $min_pop, $max_pop);
				}
				unset($output_results, $tags_weights);
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'aop_features_pre_header_load' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'agr_add_edit_group_user_permissions_fieldset_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				include_once $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				include_once $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';
			?>

				<fieldset class="mf-set set<?php echo ++$forum_page[\'item_count\'] ?>">
					<legend>
						<span><?php echo $lang_pun_poll[\'Permission\'] ?></span>
					</legend>
					<div class="mf-box">
						<div class="mf-item">
							<span class="fld-input">
								<input type="checkbox" id="fld<?php echo ++$forum_page[\'fld_count\'] ?>" name="poll_add" value="1"<?php if ($group[\'g_poll_add\'] == \'1\') echo \' checked="checked"\' ?>/>
							</span>
							<label for="fld<?php echo $forum_page[\'fld_count\'] ?>"><?php echo $lang_pun_poll[\'Poll add\'] ?></label>
						</div>
					</div>
				</fieldset>

			<?php

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  're_rewrite_rules' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$forum_rewrite_rules[\'/^tag[\\/_-]?([0-9]+)(\\.html?|\\/)?$/i\'] = \'search.php?action=tag&tag_id=$1\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'se_results_pre_header_load' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($action == \'tag\')
			{
				// Regenerate paging links
				$tag_id = isset($_GET[\'tag_id\']) ? intval($_GET[\'tag_id\']) : 0;
				if ($tag_id >= 1)
					$forum_page[\'page_post\'][\'paging\'] = \'<p class="paging"><span class="pages">\'.$lang_common[\'Pages\'].\'</span> \'.paginate($forum_page[\'num_pages\'], $forum_page[\'page\'], $forum_url[\'search_tag\'], $lang_common[\'Paging separator\'], $tag_id).\'</p>\';
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'mr_confirm_split_posts_form_submitted' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!empty($_POST[\'pun_tags\']) && $forum_user[\'g_pun_tags_allow\'])
				$new_tags = pun_tags_parse_string(utf8_trim($_POST[\'pun_tags\']));

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'fn_add_topic_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

global $new_tags, $pun_tags, $forum_user;
			// Add tags to DB
			if (!empty($new_tags) && $forum_user[\'g_pun_tags_allow\'])
			{
				$search_arr = isset($pun_tags[\'index\']) ? $pun_tags[\'index\'] : array();
				foreach ($new_tags as $pun_tag)
				{
					$tag_id = array_search($pun_tag, $search_arr);
					if ($tag_id !== FALSE)
						pun_tags_add_existing_tag($tag_id, $new_tid);
					else
						pun_tags_add_new($pun_tag, $new_tid);
				}
				pun_tags_generate_cache();
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'fn_delete_topic_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

// Remove topic tags
			pun_tags_remove_topic_tags($topic_id);
			pun_tags_remove_orphans();
			pun_tags_generate_cache();

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ca_fn_prune_qr_prune_subscriptions' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$query_tags = array(
				\'DELETE\'	=>	\'topic_tags\',
				\'WHERE\'		=>	\'topic_id IN(\'.$topic_ids.\')\'
			);
			$forum_db->query_build($query_tags) or error(__FILE__, __LINE__);

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'acg_del_cat_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

pun_tags_remove_orphans();
			pun_tags_generate_cache();

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'afo_del_forum_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

pun_tags_remove_orphans();
			pun_tags_generate_cache();
			require_once $ext_info[\'path\'].\'/functions.php\';
			pun_tags_generate_forum_perms_cache();

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'mr_confirm_move_topics_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

pun_tags_generate_cache();

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'mr_confirm_split_posts_pre_confirm_checkbox' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($fid)
			{
				$res_tags = array();
				if (isset($pun_tags[\'topics\'][$tid]))
				{
	
					foreach ($pun_tags[\'topics\'][$tid] as $tag_id)
						foreach ($pun_tags[\'index\'] as $tag)
							if ($tag[\'tag_id\'] == $tag_id)
								$res_tags[] = $tag[\'tag\'];
				}

				?>
				<div class="sf-box text">
						<label for="fld<?php echo ++$forum_page[\'fld_count\'] ?>"><span><?php echo $lang_pun_tags[\'Topic tags\']; ?></span><small><?php echo $lang_pun_tags[\'Enter tags\']; ?></small></label><br />
							<span class="fld-input"><input id="fld<?php echo $forum_page[\'fld_count\'] ?>" type="text" name="pun_tags" value="<?php if (!empty($res_tags)) echo implode(\', \', $res_tags); else echo \'\';  ?>" size="80" maxlength="100"/></span>
				</div>
			<?php

			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'se_post_results_fetched' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!empty($search_set))
			{
				//Array with tags id
				$tags = array();
				//Array with processed topics
				$processed_topics = array();
				foreach ($search_set as $res)
				{
					if (!isset($pun_tags[\'topics\'][$res[\'tid\']]) || in_array($res[\'tid\'], $processed_topics))
						continue;

					$processed_topics[] = $res[\'tid\'];
					$tags = array_merge($tags, array_diff($pun_tags[\'topics\'][$res[\'tid\']], $tags));
				}
				//Array with tags and weights
				$tags_results = array();
				if (!empty($tags))
				{
					//Calculation of tags weight
					foreach ($pun_tags_groups_perms[$forum_user[\'group_id\']] as $forum_id)
					{
						if (!isset($pun_tags[\'forums\'][$forum_id]))
							continue;
						//Calcullate common keys in arrays
						$tmp = array_intersect($tags, array_keys($pun_tags[\'forums\'][$forum_id]));
						foreach ($tmp as $cur_tag)
						{
							if (!isset($tags_results[$cur_tag]))
								$tags_results[$cur_tag] = array(\'tag\' => $pun_tags[\'index\'][$cur_tag], \'weight\' => $pun_tags[\'forums\'][$forum_id][$cur_tag]);
							else
								$tags_results[$cur_tag][\'weight\'] += $pun_tags[\'forums\'][$forum_id][$cur_tag];
						}
					}
					unset($tmp);
				}
				unset($tags);
				if (!empty($tags_results))
				{
					$minfontsize = 100;
					$maxfontsize = 200;
					list($min_pop, $max_pop) = min_max_tags_weights($tags_results);
					if ($max_pop - $min_pop == 0)
						$step = $maxfontsize - $minfontsize;
					else
						$step = ($maxfontsize - $minfontsize) / ($max_pop - $min_pop);

					uasort($tags_results, \'compare_tags\');
					$tags_results = array_tags_slice($tags_results);
					$ouput_results = array();
					foreach ($tags_results as $tag_id => $tag_info)
						$ouput_results[] = pun_tags_get_link(round(($tag_info[\'weight\'] - $min_pop) * $step + $minfontsize), $tag_id, $tag_info[\'weight\'], $tag_info[\'tag\']);
					unset($minfontsize, $maxfontsize, $step, $tags_results, $min_pop, $max_pop);
				}
				unset($tags_results);
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'sf_fn_generate_action_search_query_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($action == \'tag\')
			{
				$tag_id = isset($_GET[\'tag_id\']) ? intval($_GET[\'tag_id\']) : 0;
				if ($tag_id < 1)
					message($lang_common[\'Bad request\']);
				global $pun_tags;
				if (isset($pun_tags[\'topics\']))
				{
					foreach ($pun_tags[\'topics\'] as $topic_id => $tags)
						if (in_array($tag_id, $tags))
							$search_ids[] = $topic_id;
					if (empty($search_ids))
						message($lang_common[\'Bad request\']);
				}
				$query = array(
					\'SELECT\'	=> \'t.id AS tid, t.poster, t.subject, t.first_post_id, t.posted, t.last_post, t.last_post_id, t.last_poster, t.num_replies, t.closed, t.sticky, t.forum_id, f.forum_name\',
					\'FROM\'		=> \'topics AS t\',
					\'JOINS\'		=> array(
						array(
							\'INNER JOIN\'	=> \'forums AS f\',
							\'ON\'			=> \'f.id=t.forum_id\'
						),
						array(
							\'LEFT JOIN\'		=> \'forum_perms AS fp\',
							\'ON\'			=> \'(fp.forum_id=f.id AND fp.group_id=\'.$forum_user[\'g_id\'].\')\'
						)
					),
					\'WHERE\'		=> \'(fp.read_forum IS NULL OR fp.read_forum=1) AND t.id IN(\'.implode(\',\', $search_ids).\')\',
					\'ORDER BY\'	=> \'t.last_post DESC\'
				);
				// With "has posted" indication
				if (!$forum_user[\'is_guest\'] && $forum_config[\'o_show_dot\'] == \'1\')
				{
					$subquery = array(
						\'SELECT\'	=> \'COUNT(p.id)\',
						\'FROM\'		=> \'posts AS p\',
						\'WHERE\'		=> \'p.poster_id=\'.$forum_user[\'id\'].\' AND p.topic_id=t.id\'
					);

					$query[\'SELECT\'] .= \', (\'.$forum_db->query_build($subquery, true).\') AS has_posted\';
				}
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ft_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if ($forum_config[\'o_pun_tags_show\'] == 1)
			{
				if (!empty($ouput_results))
					$tpl_main = str_replace(\'<div id="brd-pun_tags" class="gen-content"></div>\', \'<div id="brd-pun_tags" class="gen-content">\'.$lang_pun_tags[\'Title\'].implode($forum_config[\'o_pun_tags_separator\'], $ouput_results).\'</div>\', $tpl_main);
				else
					$tpl_main = str_replace(\'<div id="brd-pun_tags" class="gen-content"></div>\', \'\', $tpl_main);
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'sf_fn_validate_actions_start' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$valid_actions[] = \'tag\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'afo_save_forum_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

require_once $ext_info[\'path\'].\'/functions.php\';
			pun_tags_generate_forum_perms_cache();

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'afo_revert_perms_form_submitted' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

require_once $ext_info[\'path\'].\'/functions.php\';
			pun_tags_generate_forum_perms_cache();

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'agr_add_edit_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

require_once $ext_info[\'path\'].\'/functions.php\';
			pun_tags_generate_forum_perms_cache();

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'agr_del_group_pre_redirect' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

require_once $ext_info[\'path\'].\'/functions.php\';
			pun_tags_generate_forum_perms_cache();

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'vt_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_quote\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_quote\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_quote\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_user[\'is_guest\'])
			{

			?>
			<form id="pun_quote_form" action="<?php echo forum_link(\'post.php\'); ?>" method="post">
				<div class="hidden">
					<input type="hidden" value="" id="post_msg" name="post_msg"/>
					<input type="hidden" value="<?php echo forum_link($forum_url[\'quote\'], array($id, $cur_post[\'id\'])) ?>" id="pun_quote_url" name="pun_quote_url" />
				</div>
			</form>
			<?php

			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'po_qr_get_quote' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_quote\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_quote\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_quote\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if(!$forum_user[\'is_guest\'] && isset($_POST[\'post_msg\']))
				$query[\'SELECT\'] = \'p.poster, \\\'\'.$forum_db->escape($_POST[\'post_msg\']).\'\\\'\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'vt_qr_get_posts' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_quote\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_quote\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_quote\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

$pun_quote_js_arrays = \'\';

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'vt_row_new_post_entry_data' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_quote\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_quote\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_quote\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!$forum_user[\'is_guest\'])
			{
				$pun_quote_js_arrays .= \'pun_quote_posts[\'.$cur_post[\'id\'].\'] = "\'.str_replace("\\n", \'\\n\', forum_htmlencode($cur_post[\'message\'])).\'";\';
				$pun_quote_js_arrays .= \' pun_quote_authors[\'.$cur_post[\'id\'].\'] = "\'.$cur_post[\'username\'].\'";\'."\\n";
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ft_about_pre_copyright' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_quote\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_quote\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_quote\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (FORUM_PAGE == \'viewtopic\' && !empty($pun_quote_js_arrays))
				echo \'<script type="text/javascript"><!--\'."\\n".\'var pun_quote_posts = new Array(\'.$forum_page[\'item_count\'].\');\'."\\n".\'var pun_quote_authors = new Array(\'.$forum_page[\'item_count\'].\');\'."\\n".$pun_quote_js_arrays.\'--></script>\'."\\n";

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'vt_row_pre_post_actions_merge' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_quote\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_quote\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_quote\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (file_exists($ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\'))
				require $ext_info[\'path\'].\'/lang/\'.$forum_user[\'language\'].\'/\'.$ext_info[\'id\'].\'.php\';
			else
				require $ext_info[\'path\'].\'/lang/English/\'.$ext_info[\'id\'].\'.php\';

			if (!$forum_user[\'is_guest\'])
			{
				$quote_link = forum_link($forum_url[\'quote\'], array($id, $cur_post[\'id\']));
				$forum_page[\'post_actions\'][\'reply\'] = \'<span class="edit-post first-item"><a href="\'.$quote_link.\'" onclick="Reply(\'.$cur_post[\'id\'].\', this); return false;">\'.$lang_pun_quote[\'Reply\'].\'<span>&#160;\'.$lang_topic[\'Post\'].\' \'.($forum_page[\'start_from\'] + $forum_page[\'item_count\']).\'</span></a></span>\';
				//If quick post is enabled generate Quick Quote link
				if ($forum_config[\'o_quickpost\'] == \'1\')
				{
					unset($forum_page[\'post_actions\'][\'quote\']);
					$forum_page[\'post_actions\'][\'quote\'] = \'<span class="edit-post first-item"><a href="\'.$quote_link.\'" onclick="QuickQuote(\'.$cur_post[\'id\'].\'); return false;">\'.$lang_pun_quote[\'Quote\'].\'<span>&#160;\'.$lang_topic[\'Post\'].\' \'.($forum_page[\'start_from\'] + $forum_page[\'item_count\']).\'</span></a></span>\';
				}
				unset($quote_link);
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
  'ft_about_end' => 
  array (
    0 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_repository\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_repository\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_repository\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!defined(\'PUN_EXTENSIONS_USED\') && !empty($pun_extensions_used))
{
	define(\'PUN_EXTENSIONS_USED\', 1);
	if (count($pun_extensions_used) == 1)
		echo \'<p style="clear: both; ">The \'.$pun_extensions_used[0].\' official extension is installed. Copyright &copy; 2003&ndash;2009 <a href="http://punbb.informer.com/">PunBB</a>.</p>\';
	else
		echo \'<p style="clear: both; ">Currently installed <span id="extensions-used" title="\'.implode(\', \', $pun_extensions_used).\'.">\'.count($pun_extensions_used).\' official extensions</span>. Copyright &copy; 2003&ndash;2009 <a href="http://punbb.informer.com/">PunBB</a>.</p>\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    1 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_antispam\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_antispam\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_antispam\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!defined(\'PUN_EXTENSIONS_USED\') && !empty($pun_extensions_used))
{
	define(\'PUN_EXTENSIONS_USED\', 1);
	if (count($pun_extensions_used) == 1)
		echo \'<p style="clear: both; ">The \'.$pun_extensions_used[0].\' official extension is installed. Copyright &copy; 2003&ndash;2009 <a href="http://punbb.informer.com/">PunBB</a>.</p>\';
	else
		echo \'<p style="clear: both; ">Currently installed <span id="extensions-used" title="\'.implode(\', \', $pun_extensions_used).\'.">\'.count($pun_extensions_used).\' official extensions</span>. Copyright &copy; 2003&ndash;2009 <a href="http://punbb.informer.com/">PunBB</a>.</p>\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    2 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_poll\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_poll\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_poll\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!defined(\'PUN_EXTENSIONS_USED\') && !empty($pun_extensions_used))
			{
				define(\'PUN_EXTENSIONS_USED\', 1);
				if (count($pun_extensions_used) == 1)
					echo \'<p style="clear: both; ">The \'.$pun_extensions_used[0].\' official extension is installed. Copyright &copy; 2003&ndash;2009 <a href="http://punbb.informer.com/">PunBB</a>.</p>\';
				else
					echo \'<p style="clear: both; ">Currently installed <span id="extensions-used" title="\'.implode(\', \', $pun_extensions_used).\'.">\'.count($pun_extensions_used).\' official extensions</span>. Copyright &copy; 2003&ndash;2009 <a href="http://punbb.informer.com/">PunBB</a>.</p>\';
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    3 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_tags\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_tags\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_tags\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!defined(\'PUN_EXTENSIONS_USED\') && !empty($pun_extensions_used))
			{
				define(\'PUN_EXTENSIONS_USED\', 1);
				if (count($pun_extensions_used) == 1)
					echo \'<p style="clear: both; ">The \'.$pun_extensions_used[0].\' official extension is installed. Copyright &copy; 2003&ndash;2009 <a href="http://punbb.informer.com/">PunBB</a>.</p>\';
				else
					echo \'<p style="clear: both; ">Currently installed <span id="extensions-used" title="\'.implode(\', \', $pun_extensions_used).\'.">\'.count($pun_extensions_used).\' official extensions</span>. Copyright &copy; 2003&ndash;2009 <a href="http://punbb.informer.com/">PunBB</a>.</p>\';
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    4 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_quote\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_quote\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_quote\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!defined(\'PUN_EXTENSIONS_USED\') && !empty($pun_extensions_used))
			{
				define(\'PUN_EXTENSIONS_USED\', 1);
				if (count($pun_extensions_used) == 1)
					echo \'<p style="clear: both; ">The \'.$pun_extensions_used[0].\' official extension is installed. Copyright &copy; 2003&ndash;2009 <a href="http://punbb.informer.com/">PunBB</a>.</p>\';
				else
					echo \'<p style="clear: both; ">Currently installed <span id="extensions-used" title="\'.implode(\', \', $pun_extensions_used).\'.">\'.count($pun_extensions_used).\' official extensions</span>. Copyright &copy; 2003&ndash;2009 <a href="http://punbb.informer.com/">PunBB</a>.</p>\';
			}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
    5 => '$ext_info_stack[] = array(
\'id\'				=> \'pun_attachment\',
\'path\'			=> FORUM_ROOT.\'extensions/pun_attachment\',
\'url\'			=> $GLOBALS[\'base_url\'].\'/extensions/pun_attachment\',
\'dependencies\'	=> array (
)
);
$ext_info = $ext_info_stack[count($ext_info_stack) - 1];

if (!defined(\'PUN_EXTENSIONS_USED\') && !empty($pun_extensions_used))
{
	define(\'PUN_EXTENSIONS_USED\', 1);
	echo \'<p id="extensions-used">Currently used extensions: \'.implode(\', \', $pun_extensions_used).\'. Copyright &copy; 2008 <a href="http://punbb.informer.com/">PunBB</a></p>\';
}

array_pop($ext_info_stack);
$ext_info = empty($ext_info_stack) ? array() : $ext_info_stack[count($ext_info_stack) - 1];
',
  ),
);

?>