<?php
class Route {

	protected static $config = false;
	
	protected static $parametersStack = false;
	protected static $controller = false;

	public function __construct() {

	}

	public function run(){
		date_default_timezone_set('UTC');
		
		self::$config = new Config();
		self::$parametersStack = self::renderParameters();
		
		$route = self::parseRoute();

		// build controller
			$controller = $route['controller'].'Controller';
			if(class_exists($controller)){
				self::$controller = new $controller();
				// and call it's action
				if(method_exists($controller, $route['action'])){
					$action = $route['action'];
					self::$controller->$action($route['parameters']);
					unset($action);
				}else{
					self::$controller->error('404');
				}
			}else{
				self::$controller = new indexController();
				self::$controller->error('404');
			}

	}

	private function renderParameters(){
		$parametersStack['get'] = $_GET;
		unset($_GET);
		$parametersStack['post'] = $_POST;
		unset($_POST);
		$parametersStack['cookie'] = $_COOKIE;
		unset($_COOKIE);
		return $parametersStack;
	}

	protected function localVar($name){
		return self::$parametersStack[$name];
	}

	protected function setCookie($name, $newVal){
		setcookie($name, $newVal, time() + 7*24*60*60, '/');
		self::$parametersStack['cookie'][$name] = $newVal;
		return true;
	}

	protected function rmCookie($name){
		setcookie($name, '', -1, '/');
		unset(self::$parametersStack['cookie'][$name]);
		return true;
	}

	protected function recvParams(){
		$r = json_decode(file_get_contents("php://input"), true);
		$r = array_merge(is_array($r) ? $r : array(), self::$parametersStack['post']);
		return $r;
	}

	private function parseRoute(){
		$routeString = self::localVar('get');
		
		// seting up default route
			if( isset($routeString['a']) && $routeString['a']=='index.php' ){
				$defaultPath = self::$config->getConfIni( array($_SERVER['SERVER_NAME'], 'general', 'defaultPath') );
				if(is_string($defaultPath)){
					$routeString['a'] = $defaultPath;
				}else{
					$routeString['a'] = self::$config->getConfIni( array('main', 'general', 'defaultPath') );
				}
			}

		reset($routeString);
		$routeStringKey = key($routeString);
		$routeString = $routeString[$routeStringKey];
		unset(self::$parametersStack['get'][$routeStringKey]);
		$routeString = preg_replace('/\.php$/mi', '', $routeString);		
		$routeString = explode('/', $routeString, 3);
		$routeString['controller'] = 'index';
		$routeString['action'] = 'index';
		$routeString['parameters'] = '';
		if(count($routeString)>0){
			$routeString['controller'] = isset($routeString[0]) && strlen($routeString[0])>0 ? $routeString[0] : 'index';
			$routeString['action'] = isset($routeString[1]) && strlen($routeString[1])>0 ? $routeString[1] : 'index';
			$routeString['parameters'] = isset($routeString[2]) ? $routeString[2] : '';
			if(isset($routeString[0])){ unset($routeString[0]); }
			if(isset($routeString[1])){ unset($routeString[1]); }
			if(isset($routeString[2])){ unset($routeString[2]); }
		}
		return $routeString;
	}

}
