<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main extends MY_Controller {
    
    function __construct()
    {        
        parent::__construct();        
        /* Do not load it here.  */
        /* $this->load->database(); */        
    }

    public function index()
    {        
        $this->viewContent('pages/index');
    }        
    
    public function installer(){
        $data = [
            'site_url' => rtrim( site_url(), '/tools' ) . '/',
            'install' => site_url('_zip_src/install_v314.zip'),
            'db_host' => $this->input->server('SERVER_NAME'),
            'db_name' => 'fo_rnd_install',
            'db_user' => 'root',
            'db_pass' => '',
        ];
        $this->viewContent('pages/installer', $data);
    }
    
    public function upgrader()
    {
        $data['lic_info'] = getLicenseData();
        $this->viewContent('pages/upgrader', $data );
    }
    
    public function import_data()
    {
        $this->load->database();   
        $data['db_name'] = $this->db->database;        
        $data['site_env'] = ENVIRONMENT;        
        $this->viewContent('pages/import_data', $data );
    }
    
    public function sync_db(){
        $this->load->database();        
        
        if($this->db->database == ''){            
            $msg = 'CRM is not Install System First';
            $this->session->set_flashdata('message', "<p class=\"alert alert-success\">{$msg}</p>") ;
            redirect('/');
        }
        
        $db_name = "Tables_in_{$this->db->database}";        
        $sql_str = "SHOW TABLES WHERE `{$db_name}` LIKE '_tmp_%'";   
        
        
        $tables = $this->db->query( $sql_str )->result();        
        
        $data['tables']  = [];
        $data['db']      = $this->db->database;
        foreach($tables as $table ){
            $data['tables'][] = $table->$db_name;
        }
        
        $this->viewContent('pages/sync_db', $data );        
    } 
    
    public function import_tmp(){                       
        $src_sql_file = FCPATH . '/db/v314.sql';
        $this->_import_db($src_sql_file);
        
        $this->session->set_flashdata('message', '<p class="alert alert-success">Tmp Table Imported</p>') ;
        sleep(1);
        redirect('sync-db?new=ok');
    } 
        
    public function delete_tmp(){
        $this->load->dbforge();
        $this->load->database();   
        $tmp_tbls   = $this->db->list_tables();        
        $msg        = '';
        foreach($tmp_tbls as $tbl ){            
            if(strpos($tbl,'_tmp_')  !== false ){
                $msg .= "Table {$tbl} Deleted <br/>";
                $this->dbforge->drop_table($tbl, TRUE);
            }
        }
       
        $this->session->set_flashdata('message', $msg ) ;
        redirect('sync-db');        
    }        
    
    public function run_sql_str(){  
        
        $sql = $this->input->post('sql_str');
        if(empty($sql)){
            die( "Nothing to do here" );
        }
        
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
        
        /* Execute the SQL queries */ 
        if ($conn->multi_query($sql) === TRUE) {
            http_response_code( 200 ) ;
            echo '<p class="alert alert-success">SQL file imported successfully</p>';
        } else {
            http_response_code( 400 ) ;
            echo "Error importing SQL file: " . $conn->error;
        }        
    }  
    
    public function utf8mb4_gci(){
        $this->load->database();   
        
        
//        $line = 'SELECT CONCAT("ALTER TABLE `", TABLE_SCHEMA, "`.`", TABLE_NAME,"` COLLATE utf8mb4_general_ci;") AS AlterQuery' . "\r\n";
        $line = 'SELECT CONCAT("ALTER TABLE `", TABLE_SCHEMA, "`.`", TABLE_NAME,"` CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;") AS AlterQuery' . "\r\n";
        $line .= 'FROM INFORMATION_SCHEMA.TABLES' . "\r\n";
        $line .= "WHERE TABLE_SCHEMA='{$this->db->database}'" . "\r\n";
        $line .= 'AND TABLE_TYPE="BASE TABLE" AND TABLE_COLLATION != "utf8mb4_general_ci"';
        
        $data['quries'] = $this->db->query($line)->result();
        
        $tbl_collat = 'SELECT `TABLE_NAME`, `TABLE_COLLATION` ';
        $tbl_collat .= 'FROM INFORMATION_SCHEMA.TABLES' . "\r\n";
        $tbl_collat .= "WHERE TABLE_SCHEMA='{$this->db->database}' AND TABLE_COLLATION != 'utf8mb4_general_ci'" . "\r\n";
        
        $data['tbl_collat'] = $this->db->query( $tbl_collat )->result();
        
        $this->viewContent('pages/utf8mb4_gci', $data );
    }
    
    public function notfound(){
        $this->viewContent('pages/index');
    }
}
