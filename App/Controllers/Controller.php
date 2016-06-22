<?php namespace App\Controllers;

use Library\View;

//A base Controller class. Light and sweet
class Controller{

	protected $errors = array(); // all variables that result in SQL errors. Soft errors belong in in response['errors']
	protected $json = array('success' => true, 'response' => array());
	protected $templates = array(//'header ' => 'templates/header', 
								 'content' => false);
								 //'footer' => 'templates/footer');
                                 
	protected $linked_templates = array('/frontend/header.php', '/frontend/footer.php', '/frontend/nav.php', '/frontend/social.php');
                                    
	protected $variables = array('title' => 'Page Title Here', 
								 'maintab' => 'some',
								 'lqImages' => array(),
								 'hqImages' => array(),
								 'copyright' => 'Copyright &copy;'); // template variables
	
	private $responseErrors = array(
		'400' => 'HTTP/1.0 400 Bad Request',
		'401' => 'HTTP/1.0 401 Unauthorized',
		'403' => 'HTTP/1.0 403 Forbidden',
		'404' => 'HTTP/1.0 404 Not Found',
		'500' => 'HTTP/1.0 500 Internal Server Error'
	);
	
	public function redirect($url, $delay = 0) {
		if($delay > 0) {
			header('refresh:'.$delay.'; url='.$url);
		}
		else {
			header('Location: '.$url);
			exit;
		}
	}
	
	protected function badRequest() { // Use this when you can't make sense of a request - like asking to see a user profile but not sending a user id
		header($this->responseErrors['400']);
		$this->renderError('400');
	}

	protected function unauthorized() { // Use this when the user is a guest or their login token is expired
		header($this->responseErrors['401']);
		$this->renderError('401');
	}

	protected function forbidden() { // Use this when the user is authenticated properly but they're not allowed to view this particular resource or data object
		header($this->responseErrors['403']);
		$this->renderError('403');
	}

	protected function notFound() { // Use this when we can't find the requested resource or when we want the user to think it doesn't exist
		header($this->responseErrors['404']);
		$this->renderError('404');
	}

	protected function internalError() { // Use this when the application itself throws an error that we can't recover from and we just need to bail
		header($this->responseErrors['500']);
		$this->renderError('500');
	}
	
	public function contentView($path){
		$this->templates['content'] = $path;
	}
	
	// store a variable
	public function variable($name, $value = null){
		
		if(is_array($name)) // where we simply passed an array of variables with keys ?
			$this->variables = array_merge($this->variables, $name);
		elseif($value !== null)  
			$this->variables[$name] = $value;
		else
			return $this->variables[$name];

	}
	
	// store an error about what occurred during the controller logic process
	public function error($name,$value = null){

		if(is_array($name))
			$this->errors += $name;
		else
			$this->errors[$name] = $value;
	}

	// render our view as a template and pass in our defined variables
	public function renderTemplate(){
		
		$this->variables['errors'] = $this->errors;
		$this->variables['copyright'] =  'Copyright &copy; '.date('Y');
		foreach($this->templates as $type => $template){
			if($template !== false)
                $links = array_merge($this->linked_templates);
				echo View::make($template)->with($this->variables)->link($links);
		}
	}

	// render our view as raw json using our variables and errors as data
	public function renderJson(){
		header('Content-type: application/json');
		header('Cache-Control: no-cache, must-revalidate');
		$this->json['response'] = $this->variables; // place our template varables
		$this->json['errors'] = $this->errors; // place the errors
		echo json_encode($this->json, JSON_FORCE_OBJECT);
		exit;
	}
	
	// render some kind of header error
	public function renderError($error) { 
		
		$status = str_replace('HTTP/1.0', $this->responseErrors[$error]);
		$this->variables = array('status' => $error, 'message' => $status);
		$this->errors = array();
		if(Request::isAjax()) {
			$this->renderJson();
		} else {
			$this->variables = array('status' => $error, 'message' => $status);
			echo View::make('errors/error.php')->with($this->variables);
			exit;
		}
	}
}
?>