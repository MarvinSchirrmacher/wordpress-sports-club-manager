<?php
require_once SCM_PLUGIN_DIR . '/admin/singleton.php';
require_once SCM_PLUGIN_DIR . '/admin/settings.php';
require_once SCM_PLUGIN_DIR . '/admin/management.php';
require_once SCM_PLUGIN_DIR . '/admin/sponsor.php';
require_once SCM_PLUGIN_DIR . '/admin/team.php';

$settings = SportsClubManagerSettings::getInstance();
$sponsor_management = SponsorManagement::getInstance();
$team_management = TeamManagement::getInstance();
?>