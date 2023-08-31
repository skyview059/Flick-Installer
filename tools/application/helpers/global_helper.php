<?php

function getLiveSiteVersion(){    
    $_lic_path  = dirname( FCPATH ) . '/fm_license.txt';
    if(!file_exists($_lic_path)){
        return "<p>New Site No Script Installed</p>";
    }
    $_lic_str   = file_get_contents( $_lic_path );    
    $_json_str  = base64_decode( $_lic_str );
    $_lic_array = json_decode($_json_str, true );
    return "<p>Live Site Script Version v:{$_lic_array['Version']}</p>";
}

function getLicenseData(){
    $_lic_path  = dirname( FCPATH ) . '/fm_license.txt';
    
    if(!file_exists($_lic_path)){
        return $_lic_path. ' is missing.';
    }    
    
    $_lic_str   = file_get_contents( $_lic_path );    
    $_json_str  = base64_decode( $_lic_str );
    $_lic_array = json_decode($_json_str, true );
    
    $tbl = "<legend> &nbsp;Current Version: {$_lic_array['Version']}</legend>";
    $tbl .= '<table class="table">';
    foreach( $_lic_array as $key => $value ){
        $tbl .= '<tr>';
        $tbl .= '<td>'. $key .'</td>';
        $tbl .= '<td>'. $value .'</td>';
        $tbl .= '</tr>';
    }
    $tbl .= '</table>';
    return $tbl;
}

function pp($data){
    echo '<pre>';
    print_r( $data );
    echo '</pre>';
}

function backupFile(){
            
    $bakup_path = _site_root . 'temp/backup/';    
    if (!file_exists( $bakup_path )) {
        mkdir( $bakup_path , 0777, true);
    }
   
    $folderName = date('Y-m-d-H-m-i');

    /* Initialize archive object */ 
    $zip = new ZipArchive();
    $zip->open("{$bakup_path}{$folderName}.zip", ZipArchive::CREATE | ZipArchive::OVERWRITE);

    /* Create recursive directory iterator */ 
    __addToZip($zip, _site_root . 'application' );
    
    if (file_exists( _site_root . 'layouts' )) {
        __addToZip($zip, _site_root . 'layouts' );
    }
    $zip->close();
        
    return site_url( "../temp/backup/{$folderName}.zip" );
}

function __addToZip( $zip_obj, $path_to_dir ){
    $folder = basename( $path_to_dir );
    

    $files_in_dir   = new RecursiveIteratorIterator(
        new RecursiveDirectoryIterator( $path_to_dir ),
        RecursiveIteratorIterator::LEAVES_ONLY
    );

    foreach ($files_in_dir as $name => $file){
        if (!$file->isDir()){            
            $filePath     = $file->getRealPath();
            $relativePath = "{$folder}/" . substr($filePath, strlen( $path_to_dir ) + 1);
            $zip_obj->addFile($filePath, $relativePath);
        }
    }
}
