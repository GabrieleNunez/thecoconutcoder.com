<?php namespace App\Controllers;

use Exception;

use App\Resume;
use App\ImageLoader;
use App\Models\Project;

class SiteController extends Controller{

	public function __construct(){
		
		$this->variable(array(
			'title' => 'The Coconut Coder',
			'lqImages' => ImageLoader::GetLowQuality(true),
			'hqImages' => ImageLoader::GetHighQuality(true),
		));

	}

	public function homeGet($in){
        
		$this->contentView('/frontend/home.html');
		$this->renderTemplate();
	
	}

	public function resumeGet($in){
		
		$resume = new Resume();
		$this->variable(array('maintab' => 'resume', 'resume' => $resume->toArray()));
		$this->contentView('/frontend/resume.html');
		$this->renderTemplate();
		
	}

	public function graphicsGet($in) {

		$this->variable('maintab','graphics');
		$this->contentView('/frontend/graphics.html');
		
		$this->renderTemplate();
		
	}

	public function softwareGet($in) {
		
		$projects = Project::all(true);
		
		$this->variable(array('maintab' => 'software', 'softwares' => $projects));
		$this->contentView('/frontend/software.html');


		$this->renderTemplate();
		
	}
}
?>