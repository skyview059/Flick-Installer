<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CRM_Installer extends MY_Controller {
    
    public function __construct()
    {
        parent::__construct();
        /* No need here */
        /* $this->load->database(); */
    }
    
       
    public function test_db_conn(){
        
        $hostname = $this->input->post('db_host');
        $database = $this->input->post('db_name');
        $db_user  = $this->input->post('db_user');
        $db_pass  = $this->input->post('db_pass');


        try {            
            mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);                
            $mysqli = new mysqli($hostname, $db_user, $db_pass, $database);

            if ($mysqli->ping()) {
                // echo "Our connection is ok!\n";

                echo ("<p class='ok'>Connection is okay with db <strong> {$database} </strong><br />");

            } else {
                throw new Exception("Error: " . $mysqli->error);
            }                
            $mysqli->close();

        } catch (mysqli_sql_exception $e) {            
            echo "Failed to connect to MySQL: " . $e->getMessage();

        } catch (Exception $e) {            
            echo "An error occurred: " . $e->getMessage();
        }

    }        
    
    public function index(){
        
        $src_file = $this->input->post('src_file');
                        
        $path_to_zip_file = $this->_downloadZip( $src_file );
                
        if($path_to_zip_file == false ){
            die('Fail to download');
        }
        
        $this->_runUnzip( $path_to_zip_file );                
        $this->_saveDBConfig();
        $this->_saveSiteConfig();
        
        /* SQL file path */ 
        $sqlFile = _site_root . 'DB/install-default.sql';                        
        if(!file_exists($sqlFile)){
            die('DB File not found!');
        }
        $this->__import_db( $sqlFile );
                                
        redirect( site_url('../') );
    }   

    public function __import_db( $file ){

        $hostname = $this->input->post('db_host');
        $database = $this->input->post('db_name');
        $db_user  = $this->input->post('db_user');
        $db_pass  = $this->input->post('db_pass');


        $conn = new mysqli($hostname, $db_user, $db_pass, $database);

        /* Check the connection */ 
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = file_get_contents($file);
        if(empty($sql)){
            die( "Nothing to do here" );
        }

        /* Execute the SQL queries */ 
        if ($conn->multi_query($sql) === TRUE) {
            http_response_code( 200 ) ;
            echo '<p class="alert alert-success">SQL file imported successfully</p>';
        } else {
            http_response_code( 400 ) ;
            echo "Error importing SQL file: " . $conn->error;
        }
    }
            
    private function _downloadZip( $src_link = '' ){ 
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

    protected function _runUnzip( $path_to_zip_file ){    
        $zip 	= new ZipArchive();
        $open	= $zip->open( $path_to_zip_file );

        if ($open === true) {
            $zip->extractTo( _site_root );
            $zip->close();	
            return 'File unzipped to  - ' . _site_root ;
        } else {
            return 'Unzip Error ' . _site_root;
        }
    }
        
    private function _saveDBConfig(){    
        $options = [
            '%db_host%' => $_POST['db_host'],
            '%db_user%' => $_POST['db_user'],
            '%db_name%' => $_POST['db_name'],
            '%db_pass%' => $_POST['db_pass']
        ];
        $search         = array_keys($options);    
        $replace        = array_values($options);

        $tpl_database   = _tpl_path . 'database.php.tpl';
        $db_file        = file_get_contents( $tpl_database );    
        $update         = str_replace($search, $replace, $db_file);    

        /* DB Path */
        file_put_contents( _db_file, $update );
        if(file_exists( _db_file )){
            return '<p class="ok">Database File Saved</p>';
        } else {
            return '<p class="ok">Database Connection Fail to Save</p>';
        }    
    }

    private function _saveSiteConfig(){
        $site_url       = $_POST['site_url'];
        $tpl_config     = _tpl_path . 'config.php.tpl';
        $config_str     = file_get_contents( $tpl_config );
        $search         = ['%base_url%','%cookie_prefix%','%cookie_domain%'];
        $sub_domain     = str_replace('https://', '', $site_url );
        $replace        = [ $site_url, 'fo_', rtrim($sub_domain, '/') ];

        $save_config_file  = str_replace( $search, $replace, $config_str );

        file_put_contents( _config_file, $save_config_file );
        if(file_exists( _config_file )){        
            return '<p class="ok">Config Saved Done</p>';
        } else {
            return '<p class="ok">Config Fail to Save</p>';
        }
    }
}
