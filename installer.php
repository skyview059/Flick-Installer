<?php 

echo '<p>Unzip Start --- </p>';

/* $src_url = 'https://github.com/skyview059/installer/archive/refs/tags/v1.0.zip'; */
$src_url = 'https://github.com/skyview059/installer/archive/refs/tags/v1.1.zip';


$dist_path = __DIR__ . '/installer.zip';
copy($src_url, $dist_path );


$zipPath   = $dist_path;
$uzPath    = __DIR__ . '/installer.php';

if(!file_exists( $zipPath )){
    die( "File not found! <br/> Src Path: {$zipPath} ");
}

$path   = __DIR__ . '/';
$zip 	= new ZipArchive();
$open	= $zip->open($zipPath);

if ($open === true) {
    $zip->extractTo($path);
    $zip->close();
}

echo '<p>File Unzipped</p>';
echo '<hr/>';

if(file_exists( $zipPath )){
    unlink( $zipPath );
}
if(file_exists( $uzPath )){
    unlink( $uzPath );
}

$move_src = $path . 'installer-1.0/tools';
$move_dis = $path . 'tools';
rename( $move_src, $move_dis );

$instller_url = $path . 'installer-1.0';
if (is_dir( $instller_url )) {
    @unlink( $instller_url .'/.gitignore' );
    rmdir( $instller_url );
}

$files = array_diff(scandir($path), array('.', '..'));

echo '<ul>';
foreach( $files as $file ){
    echo "<li>{$file}</li>";
}
echo '<ul>';


echo '<hr/>';
$url = "http".(!empty($_SERVER['HTTPS'])?"s":"");
$url .= "://".$_SERVER['SERVER_NAME'];
$url .= str_replace('installer.php', 'tools', $_SERVER['REQUEST_URI']);

header("Location:{$url}");
echo "<a href='{$url}'>Click here if installer UI not showing... :(</a>";