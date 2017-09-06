<?php
function admin_tool_heartbeat_get_hosts_from_textareadata($data) {
    if (!$data) {
      return array();
    }
    return explode("\n", str_replace("\r", '', $data));
}

function admin_tool_heartbeat_in_allowed_ip_ranges($ip) {
  global $DB, $CFG;
  require_once(__DIR__ . '/vendor/IpUtils.php');
  if (is_null($DB)) {
    if (!defined('ABORT_AFTER_CONFIG_CANCEL')) {
      define('ABORT_AFTER_CONFIG_CANCEL', true);
      require($CFG->dirroot . '/lib/setup.php');
    }
    require_once($CFG->libdir . '/moodlelib.php');
  }
  $ips = admin_tool_heartbeat_get_hosts_from_textareadata(get_config('tool_heartbeat', 'allowedipranges') );
  return Symfony\Component\HttpFoundation\IpUtils::checkIp($ip, $ips);
}
