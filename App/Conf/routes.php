<?php namespace App;

use Library\Router;
use Library\ErrorHandler;

Router::get('/','SiteController@homeGet');
Router::get('/resume','SiteController@resumeGet');
Router::get('/graphics','SiteController@graphicsGet');
Router::get('/software','SiteController@softwareGet');

//Setup 404 event handler
ErrorHandler::Hook(array('Exception','UnknownException','BaseException'),function($exception){
	if(ErrorHandler::isDebug()){
		echo '500 Internal Error';
		\Library\Printout::write($exception);
		exit;
	} else{
		echo '500 Internal Error';
		exit;
	}
});

ErrorHandler::Hook(array('RouteException'), function($exception) {
	if(ErrorHandler::isDebug()){
		echo '404 Not Found';
		\Library\Printout::write($exception);
		exit;
	} else {
		echo '404 Not found';
		exit;
	}
});

?>