<?php namespace App;

use Library\Scrub;
use App\Models\Framework;
use App\Models\Software;
use App\Models\Language;

class Resume {
	
	public $frameworks = array();
	public $softwares = array();
	public $languages = array();

	public $phone = '203-999-7014';
	public $name = 'Gabriele M. Nunez';
	public $email = 'gabrielenunez@thecoconutcoder.com';

	public function __construct(){
		$this->frameworks = Framework::select('name')->orderBy('name','asc')->get(true);
		$this->softwares = Software::select('name')->orderBy('name','asc')->get(true);
		$this->languages = Language::select('name')->orderBy('name','asc')->get(true);
	}

	public function toArray() {
		$resume = array(

			'name' => $this->name,
			'phone' => $this->phone,
			'email' => $this->email,
			'frameworks' => $this->frameworks,
			'softwares' => $this->softwares,
			'languages' => $this->languages,

		);
		return Scrub::htmlClean($resume);
	}

}
?>