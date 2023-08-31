<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['default_controller'] = 'main';

$route['installer'] = 'main/installer';
$route['upgrader'] = 'main/upgrader';
$route['sync-db'] = 'main/sync_db';


$route['404_override'] = 'main/notfound';
$route['translate_uri_dashes'] = false;