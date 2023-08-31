<?php

defined('BASEPATH') OR exit('No direct script access allowed');

date_default_timezone_set('UTC');
error_reporting(0);
const BASE_URL     = '%base_url%';
const BACKEND_PATH = 'fadmin/';

function BackendURL($url = ''): string
{
    return BASE_URL . BACKEND_PATH . $url;
}
$config['base_url']     = BASE_URL;

$config['index_page']   = '';
$config['uri_protocol']	= 'REQUEST_URI';
$config['url_suffix']   = '';
$config['language']	= 'english';
$config['charset']      = 'UTF-8';
$config['enable_hooks']         = FALSE;
$config['subclass_prefix']      = 'MY_';
$config['composer_autoload']    = 'vendor/autoload.php';
$config['permitted_uri_chars']  = 'a-z 0-9~%.:_\-=';

$config['allow_get_array']      = true;
$config['enable_query_strings'] = false;
$config['controller_trigger']   = 'c';
$config['function_trigger']     = 'm';
$config['directory_trigger']    = 'd';

$config['log_threshold']        = 0; // 1,2,3,4
$config['log_path']             = APPPATH . '/logs/';
$config['log_file_extension']   = '.log';
$config['log_file_permissions'] = 0644;
$config['log_date_format']      = 'Y-m-d H:i:s';
$config['error_views_path']     = '';
$config['cache_path']           = APPPATH . '/cache/';
$config['cache_query_string']   = false;
$config['encryption_key']       = '';

$config['sess_driver']             = 'files';
$config['sess_cookie_name']        = 'ci_session_';
$config['sess_expiration']         = 7200;
$config['sess_save_path']          = dirname(APPPATH) . '/temp/sessions/';
$config['sess_match_ip']           = false;
$config['sess_time_to_update']     = 7200; //60*60*24*7;
$config['sess_regenerate_destroy'] = false;

$config['cookie_prefix']   = 'fcrm_';
$config['cookie_domain']   = ''; // 'localhost';
$config['cookie_path']     = '/';
$config['cookie_secure']   = false;
$config['cookie_httponly'] = false;

$config['standardize_newlines'] = false;

$config['global_xss_filtering'] = true;

$config['csrf_protection']   = false;
$config['csrf_token_name']   = '_token';
$config['csrf_cookie_name']  = 'csrf_cookie_name';
$config['csrf_expire']       = 60 * 60; // 1 hour
$config['csrf_regenerate']   = true;
$config['csrf_exclude_uris'] = [];

$config['compress_output']    = false;
$config['time_reference']     = 'local';
$config['rewrite_short_tags'] = false;
$config['proxy_ips']          = '';

$config['modules_locacheions'] = [
    APPPATH . 'modules/' => '../modules/',
];