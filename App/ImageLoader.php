<?php namespace App;

use Library\Application;

class ImageLoader {

	private $currentLevel;
	public $images;

	public function __construct($level = 1){
		$this->currentLevel = $level;
		$this->images = array();
		$galleryDir = 'images/Gallery/Level'.$level.'/';
		$dir = Application::folder('public').$galleryDir;
		$handle = opendir($dir);
		while(($file = readdir($handle)) !== false){
			$path = $dir.$file;
			if(is_file($path) && exif_imagetype($path)){
				$this->images[] = '/'.$galleryDir.$file;
			}
		}
		closedir($handle);
	}

	public static function GetLowQuality($prepare = false){
		$loader = new ImageLoader(1);
		$images = $loader->images;
		if($prepare){
			$total = count($images);
			for($i = 0; $i < $total; $i++){
				$images[$i] = $images[$i];
			}
		}
		return $images;
	}

	public static function GetHighQuality($prepare = false){
		$loader = new ImageLoader(3);
		$images = $loader->images;
		if($prepare){
			$total = count($images);
			for($i = 0; $i < $total; $i++){
				$images[$i] = $images[$i];
			}
		}
		return $images;
	}
}
?>