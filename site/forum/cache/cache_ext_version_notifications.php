<?php

if (!defined('FORUM_EXT_VERSIONS_LOADED')) define('FORUM_EXT_VERSIONS_LOADED', 1);

$forum_ext_repos = array (
  'http://punbb.informer.com/extensions' => 
  array (
    'timestamp' => '1255959299',
    'extension_versions' => 
    array (
      'pun_antispam' => '1.3.2',
      'pun_attachment' => '1.0.2',
      'pun_admin_broadcast_email' => '0.2',
      'pun_quote' => '2.2',
      'pun_poll' => '1.1.5',
      'pun_tags' => '1.4',
      'pun_repository' => '1.2.3',
    ),
  ),
);

 $forum_ext_last_versions = array (
  'pun_antispam' => 
  array (
    'version' => '1.3.2',
    'repo_url' => 'http://punbb.informer.com/extensions',
    'changes' => 'Changed the logic of processing the "minimum post" parameter for displaying signatures and website links (now they are being hidden instead of being deleted).',
  ),
  'pun_attachment' => 
  array (
    'version' => '1.0.2',
    'repo_url' => 'http://punbb.informer.com/extensions',
    'changes' => 'Fixed error with editing group permissions of Guest group.',
  ),
  'pun_admin_broadcast_email' => 
  array (
    'version' => '0.2',
    'repo_url' => 'http://punbb.informer.com/extensions',
    'changes' => 'Emails are now sent in parts.',
  ),
  'pun_quote' => 
  array (
    'version' => '2.2',
    'repo_url' => 'http://punbb.informer.com/extensions',
    'changes' => 'Quoted text is added to the current cursor position now.',
  ),
  'pun_poll' => 
  array (
    'version' => '1.1.5',
    'repo_url' => 'http://punbb.informer.com/extensions',
    'changes' => 'Fixed the appearance of error notices after editing posts.',
  ),
  'pun_tags' => 
  array (
    'version' => '1.4',
    'repo_url' => 'http://punbb.informer.com/extensions',
    'changes' => 'Added page where an administrator could see all tags and edit them.',
  ),
  'pun_repository' => 
  array (
    'version' => '1.2.3',
    'repo_url' => 'http://punbb.informer.com/extensions',
    'changes' => 'the mechanism of extension updating was improved.',
  ),
);

$forum_ext_versions_update_cache = 1255982955;

?>