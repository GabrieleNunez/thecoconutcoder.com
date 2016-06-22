<?php namespace Library;

use Library\Exceptions\UnknownException;
use Library\Exceptions\RouteException;

class Router {
	
	private static $routes = array('GET' => array(), 'POST' => array(), 'DELETE' => array(), 'PUT' => array());

	public static function LoadRoutes() {
		require_once(Application::file('routes'));
	}

	public static function Run($autoload_routes = true){
		
		if($autoload_routes)
			self::LoadRoutes();

		self::traverseRoutes();

	}
	
	// Route to location
	public static function route($method, $url, $callback) {
		$route = array();
		$parts = explode('/',$url);
		$level = &self::$routes[$method]; // start off our level at our base trunk. Because we are using references, there is no need for me to copy back over results
		
		reset($parts);
		while(($part = current($parts)) !== false) {
			$identifier = '';
			$is_wildcard = substr($part, 0, 1) == '@';
			$identifier = $is_wildcard ? '@' : $part;

			if(!isset($level[$identifier])) // define the level
				$level[$identifier] = array();
			
			$level = &$level[$identifier]; // descend into the new level
			$level['name'] = $is_wildcard ? substr($part,1) : 'static';
			next($parts);
		}

		$level['*'] = $callback;

	}

	public static function get($url,$callback){
		self::route('GET',$url,$callback);
	}

	public static function post($url,$callback){
		self::route('POST',$url,$callback);
	}

	public static function redirect($route, $target, $method='GET'){
		self::route($method,$route, function() use($target){
			header('Location: '.$target);
			exit;
		});
	}

	// Process the current request
	private static function traverseRoutes() {


		$method = $_SERVER['REQUEST_METHOD'];
		$requested = $_SERVER['REQUEST_URI'];
		$path = $requested; // set our path to our request
		$path = explode('?',$path)[0]; // check for a query string. At zero index
		$path = strlen($path) > 1 ? rtrim($path,'/') : $path; //strip the slash at the end of the string (if its there). rtrim will take care of this automatically
		$parts = explode('/',$path);
		$parameters = array(); // Start traversal process. These are the parameters that we will pass
		$level = &self::$routes[$method]; // same as when we are registering. Grab a reference to our trunk
		
		// traverse the tree and determine if we have a valid route
		reset($parts);
		while(($part = current($parts)) !== false) {

			if(isset($level[$part])) { // found, now we move down one more level
				$level = &$level[$part];
			} elseif(isset($level['@'])) { // didn't find a defined, but we have a wild card. Go down this level
				$level = &$level['@'];
				$parameters[$level['name']] = urldecode($part);
			} else {
				throw new RouteException($requested.' route not found');
			}

			next($parts);
		}

		// we have reached the final level. Extract the required information and dig in 
		$callback = $level['*'];
		if(is_callable($callback)) {
			$callback($parameters);
		} else {
			$callbackParts = explode('@', $callback);
			$class = 'App\Controllers\\'.$callbackParts[0];
			$function = $callbackParts[1];
			$controller = new $class();
			return $controller->{$function}($parameters);
		}

	}

}

?>