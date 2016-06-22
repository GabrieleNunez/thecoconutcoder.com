<?php
require_once('../Library/Application.php');
Library\Application::Initialize(false);

if(php_sapi_name() != 'cli'){
	exit;
}

$sql = Library\Database::connection();
$dir = Library\Application::folder('migration');
$arguments = array_slice($argv,1, count($argv));

if(count($arguments)){
	switch($arguments[0]){
		case 'migrate':
			runMigration();
			break;
		case 'backup-structure':
			runBackup(true);
			break;
		default:
			runMigration();
			break;
	}
} else{
	runMigration();
}

function runMigration(){
	$migrated = array();
	if(file_exists('migration_log')){
		$handle = fopen('migration_log','r');
		while(($line = fgets($handle)) !== false){
			$line = str_replace(PHP_EOL, '',$line);
			$length = strlen(trim($line));
			if($length > 0){
				$migrated[] = $line;
			}
		}
		fclose($handle);
	}

	$files = array();
	$handle = opendir($dir);
	while(($file = readdir($handle)) !== false){
		$path = $dir.$file;
		$ext = pathinfo($path,PATHINFO_EXTENSION);
		if(is_file($path) && $ext == '.php'){
			$files[] = $path;
		}
	}
	closedir($handle);

	foreach($files as $file){
		if(!in_array($file,$migrated)){
			echo $file;
			exit;
			$migration = new $file();
		}	
	}


	$handle = fopen('migration_log','w+');
	flock($handle,LOCK_EX);
	foreach($migrated as $migration){
		fwrite($handle,$migration.PHP_EOL);
	}
	flock($handle,LOCK_UN);
	fclose($handle);
}

function runBackup($structureOnly = false){
	echo 'TODO implement backups';
}

?>