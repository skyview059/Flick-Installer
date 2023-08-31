<?php

/**
 * Description of Admin_controller
 *
 * @author Kanny
 */
class MY_Controller extends CI_Controller {

    public function __construct() {
       parent::__construct();       
    }
    
    protected function viewContent($view, $data = []) {
        $this->load->view('blocks/header');
        $this->load->view($view, $data);                         
        $this->load->view('blocks/footer');
    }
       
    protected function _donwloadZip( $src_link = '' ){ 
        if(empty($src_link)){ return false; }        
        $sfile      = pathinfo( $src_link );
        $src_name   = "{$sfile['filename']}.{$sfile['extension']}";
        $dist_path  = _site_root . $src_name;    
        if(copy($src_link, $dist_path)){
            return $dist_path;
        } else {
            return false;
        }
    }

    protected function _runUnzipper( $src_zip_file ){
    
        $zip 	= new ZipArchive();
        $open	= $zip->open( $src_zip_file );

        if ($open === true) {
            $zip->extractTo( _site_root );
            $zip->close();	
            @unlink( $src_zip_file );
            return 'File unzipped to  - ' . _site_root ;
        } else {
            return 'Unzip Error ' . _site_root;
        }
    }     
    
    protected function _import_db( $src_sql_file ){
        $this->load->database();
        $conn = new mysqli(
            $this->db->hostname, 
            $this->db->username, 
            $this->db->password, 
            $this->db->database
        );

        /* Check the connection */
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        if(!file_exists( $src_sql_file )){
            die( "<p class='fail'>DB File Not Exist </p>" );
        }
        
        /* Read the SQL file */ 
        $sql = file_get_contents( $src_sql_file );                

        /* Execute the SQL queries */
        if ($conn->multi_query($sql) === TRUE) {
            return "SQL file imported successfully";
        } else {
            return "Error importing SQL file: " . $conn->error;
        }        
        $conn->close();        
    }        
}
