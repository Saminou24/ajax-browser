<?php

if (!defined('PUN_REPOSITORY_EXTENSIONS_LOADED')) define('PUN_REPOSITORY_EXTENSIONS_LOADED', 1);

$pun_repository_extensions = array (
  'pun_admin_add_user' => 
  array (
    'content' => '
	',
    'attributes' => 
    array (
      'engine' => '1.0',
    ),
    'id' => 'pun_admin_add_user',
    'title' => 'Admin add user',
    'version' => '1.1.1',
    'description' => 'Admin may add new user using the form in the bottom of User list.',
    'author' => 'PunBB Development Team',
    'minversion' => '1.3',
    'maxtestedon' => '1.3.2',
  ),
  'pun_admin_broadcast_email' => 
  array (
    'content' => '
	',
    'attributes' => 
    array (
      'engine' => '1.0',
    ),
    'id' => 'pun_admin_broadcast_email',
    'title' => 'Broadcast e-mail.',
    'version' => '0.2',
    'description' => 'Add posibility to send e-mail messages to groups of users.',
    'author' => 'PunBB Development Team',
    'minversion' => '1.3',
    'maxtestedon' => '1.3.4',
  ),
  'pun_admin_events' => 
  array (
    'content' => '
	',
    'attributes' => 
    array (
      'engine' => '1.0',
    ),
    'id' => 'pun_admin_events',
    'title' => 'Events registration',
    'version' => '0.8.2',
    'description' => 'Adds an gear to logging events and GUI for browsing logs.',
    'author' => 'PunBB Development Team',
    'minversion' => '1.3',
    'maxtestedon' => '1.3.4',
  ),
  'pun_admin_log' => 
  array (
    'content' => '
	',
    'attributes' => 
    array (
      'engine' => '1.0',
    ),
    'id' => 'pun_admin_log',
    'title' => 'Logging of events',
    'version' => '1.0',
    'description' => 'Logs a lot of forum\'s events.',
    'author' => 'PunBB Development Team',
    'minversion' => '1.3',
    'maxtestedon' => '1.3.4',
    'dependencies' => 
    array (
      'dependency' => 'pun_admin_events',
    ),
  ),
  'pun_admin_manage_extensions_improved' => 
  array (
    'content' => '
	',
    'attributes' => 
    array (
      'engine' => '1.0',
    ),
    'id' => 'pun_admin_manage_extensions_improved',
    'title' => 'Pun Admin Manage Extensions Improved',
    'version' => '1.4',
    'description' => 'This extension allows to choose several extensions to enable/disable/uninstall them',
    'author' => 'PunBB Development Team',
    'minversion' => '1.3',
    'maxtestedon' => '1.3.4',
    'note' => 
    array (
      0 => 
      array (
        'content' => 'If extension "pun_extension_reinstaller" was installed, it will be disabled.',
        'attributes' => 
        array (
          'type' => 'install',
          'timing' => 'pre',
        ),
      ),
    ),
  ),
  'pun_antispam' => 
  array (
    'content' => '
	',
    'attributes' => 
    array (
      'engine' => '1.0',
    ),
    'id' => 'pun_antispam',
    'title' => 'Antispam System',
    'version' => '1.3.2',
    'description' => 'Adds CAPTCHA to registration, login and guest posting forms. Puts restrictions on adding user signatures and website links.',
    'author' => 'PunBB Development Team',
    'minversion' => '1.3',
    'maxtestedon' => '1.3.4',
  ),
  'pun_attachment' => 
  array (
    'content' => '
	',
    'attributes' => 
    array (
      'engine' => '1.0',
    ),
    'id' => 'pun_attachment',
    'title' => 'Attachment',
    'version' => '1.0.2',
    'description' => 'Allows users to attach files to posts.',
    'author' => 'PunBB Development Team',
    'minversion' => '1.3',
    'maxtestedon' => '1.3.4',
    'note' => 
    array (
      1 => 
      array (
        'content' => 'WARNING: your web-server should have write access to FORUM_ROOT/extensions/pun_attachment/attachments/.',
        'attributes' => 
        array (
          'type' => 'install',
          'timing' => 'pre',
        ),
      ),
      2 => 
      array (
        'content' => 'WARNING: all users\' attachments will be removed during the uninstallation process. It is recommended that you disable the "pun_attachment" extension instead, or upgrade it without uninstalling.',
        'attributes' => 
        array (
          'type' => 'uninstall',
          'timing' => 'pre',
        ),
      ),
    ),
  ),
  'pun_bbcode' => 
  array (
    'content' => '
	',
    'attributes' => 
    array (
      'engine' => '1.0',
    ),
    'id' => 'pun_bbcode',
    'title' => 'BBCode buttons',
    'version' => '1.3.3',
    'description' => 'Pretty buttons for easy BBCode formatting.',
    'author' => 'PunBB Development Team',
    'minversion' => '1.3',
    'maxtestedon' => '1.3.4',
  ),
  'pun_karma' => 
  array (
    'content' => '
	',
    'attributes' => 
    array (
      'engine' => '1.0',
    ),
    'id' => 'pun_karma',
    'title' => 'Post karma',
    'version' => '1.1.1',
    'description' => 'Adds karma/reputation to posts.',
    'author' => 'PunBB Development Team',
    'minversion' => '1.3',
    'maxtestedon' => '1.3.4',
  ),
  'pun_pm' => 
  array (
    'content' => '
	',
    'attributes' => 
    array (
      'engine' => '1.0',
    ),
    'id' => 'pun_pm',
    'title' => 'Private Messaging',
    'version' => '1.2.7',
    'description' => 'Allows users to send private messages. This is the first simple version with minimum functions.',
    'author' => 'PunBB Development Team',
    'minversion' => '1.3',
    'maxtestedon' => '1.3.4',
    'note' => 
    array (
      3 => 
      array (
        'content' => 'WARNING! All users\' messages will be removed during the uninstall process. It is strongly recommended you to disable \'Private Messages\' extension instead or to upgrade it without uninstalling.',
        'attributes' => 
        array (
          'type' => 'uninstall',
          'timing' => 'pre',
        ),
      ),
    ),
  ),
  'pun_poll' => 
  array (
    'content' => '
	',
    'attributes' => 
    array (
      'engine' => '1.0',
    ),
    'id' => 'pun_poll',
    'title' => 'Pun poll',
    'version' => '1.1.5',
    'description' => 'Adds polls feature for topics.',
    'author' => 'PunBB Development team',
    'minversion' => '1.3',
    'maxtestedon' => '1.3.2',
  ),
  'pun_quote' => 
  array (
    'content' => '
	',
    'attributes' => 
    array (
      'engine' => '1.0',
    ),
    'id' => 'pun_quote',
    'title' => 'JS post quote',
    'version' => '2.2',
    'description' => 'Select the text you want to quote right in the topic view. Click "Quote" for multiple quotes in quick reply form.',
    'author' => 'PunBB Development Team',
    'minversion' => '1.3',
    'maxtestedon' => '1.3.2',
    'note' => 
    array (
      4 => 
      array (
        'content' => 'Tested in Internet Explorer 7, FireFox 3, Opera 9.63 and Google Chrome 1.0.',
        'attributes' => 
        array (
          'type' => 'install',
          'timing' => 'pre',
        ),
      ),
    ),
  ),
  'pun_repository' => 
  array (
    'content' => '
	',
    'attributes' => 
    array (
      'engine' => '1.0',
    ),
    'id' => 'pun_repository',
    'title' => 'PunBB Repository',
    'version' => '1.2.3',
    'description' => 'Feel free to download and install extensions from PunBB repository.',
    'author' => 'PunBB Development Team',
    'minversion' => '1.3dev',
    'maxtestedon' => '1.3.4',
    'note' => 
    array (
      5 => 
      array (
        'content' => 'Warning: web server should have write access to your extensions directory.',
        'attributes' => 
        array (
          'type' => 'install',
          'timing' => 'pre',
        ),
      ),
    ),
  ),
  'pun_tags' => 
  array (
    'content' => '
	',
    'attributes' => 
    array (
      'engine' => '1.0',
    ),
    'id' => 'pun_tags',
    'title' => 'Pun tags',
    'version' => '1.4',
    'description' => 'Topics are taggable now.',
    'author' => 'PunBB Development Team',
    'minversion' => '1.3',
    'maxtestedon' => '1.3.4',
  ),
);

$pun_repository_extensions_timestamp = 1255982956;

?>