<?php namespace Library;

// Shortcut to whatever engine
class View  {

	public static function make($viewname, $engine = 'bronco') {
		switch(strtolower($engine)){
			case 'php':
				return \Library\ViewEngines\PhpViewEngine::make($viewname);
				break;
			case 'mustache':
				return \Library\ViewEngines\MustacheViewEngine::make($viewname);
				break;
			case 'bronco':
				return \Library\ViewEngines\BroncoViewEngine::make($viewname);
				break;
			default:
				return \Library\ViewEngines\BroncoViewEngine::make($viewname);
				break;
		}
	} 
}

?>