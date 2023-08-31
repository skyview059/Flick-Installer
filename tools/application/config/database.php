<?php
defined('BASEPATH') OR exit('No direct script access allowed');


/* Extra Codes - */
$active_group = 'default';
$query_builder = TRUE;
$db['default'] = array(
    'dsn'      => '',
    'hostname' => 'localhost',
    'username' => '',
    'password' => '',
    'database' => '',
    'dbdriver' => 'mysqli',
    'dbprefix' => '',
    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),
    'cache_on' => FALSE,
    'cachedir' => '',
    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',
    'swap_pre' => '',
    'encrypt'  => FALSE,
    'compress' => FALSE,
    'stricton' => FALSE,
    'failover' => array(),
    'save_queries' => TRUE
);

if(file_exists( _db_file )){   
    require_once( _db_file );
    $src_db = $db['default'];    
    $db['default']['hostname'] = $src_db['hostname'];
    $db['default']['username'] = $src_db['username'];
    $db['default']['password'] = $src_db['password'];
    $db['default']['database'] = $src_db['database'];
}