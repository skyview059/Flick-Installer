<?php
defined('BASEPATH') OR exit('No direct script access allowed');
use Coderatio\SimpleBackup\SimpleBackup;
class Action extends MY_Controller {
    
    public function __construct()
    {
        parent::__construct();
        //$this->load->database();
    }

    public function bakup_files(){
        
        echo backupFile();
    }
    
    public function bakup_db(){        
        $this->load->database();
        $db_name = $this->db->database;
        $db_host = $this->db->hostname;
        $db_user = $this->db->username;
        $db_pass = $this->db->password;

        $bakup_path = _site_root . 'temp/backup/';
        $file_name  = 'backup_' . date('Y-m-d-h');
        
        $simpleBackup = SimpleBackup::setDatabase([$db_name, $db_user, $db_pass, $db_host])
          ->storeAfterExportTo($bakup_path, $file_name );
        echo $simpleBackup->getExportedName();
    }
    
    public function down_zip_n_unzip(){            
        $patch_src = $this->input->post('patch_src');
    
        $src_zip = $this->_donwloadZip( $patch_src );
        if( $src_zip == false ){
            $respond = 'File fail to donlwoad.';
            $msg = "<p class='alert alert-danger'>{$respond}</p>";
        } else {
            $respond = $this->_runUnzipper( $src_zip );
            $msg = "<p class='alert alert-success'>{$respond}</p>";
        }
        
        $this->session->set_flashdata('message', $msg );        
        redirect('upgrader?nocache=ok');
    }
    
    
    public function set_main(){            
        $src_file   = _site_root . 'index.php';
        $back_to    = _site_root . 'index-bak.php';

        if(file_exists( $back_to )){
            die( "Site allready at Maintenance Mode. <a href='". site_url('action/set_live') . ">  click to Undo </a>" );
        }

        rename($src_file, $back_to );


        $src_path   = _site_root . 'tools/_tpl/index-um.php.tpl';
        $dist_path  = _site_root . 'index.php';
        if(copy($src_path, $dist_path )){
            echo "Site Under maintance mode set done ";
        } else {
            echo "Setup Under maintance mode fail";
        }  
    }
    
    public function set_live(){            
        
        $bak_file = _site_root . 'index-bak.php';
        
        if(!file_exists( $bak_file )){
            die( "Site allready at Live Mode. <a href='". site_url('/') . "'> Back to Home </a>" );
        }
        
        unlink( _site_root . 'index.php' );    
        $restore_to = _site_root . 'index.php';
        rename($bak_file, $restore_to );
        echo "Website now live";
    }
    
}
