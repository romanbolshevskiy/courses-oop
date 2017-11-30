<?php
	class Router{

		private $routes;

		public function __construct( ){
			$routesPath = ROOT.'/config/routes.php';
			$this->routes = include($routesPath);
		}

		private function getURI() {
			//повертаєм  рядок запита
			if (!empty($_SERVER['REQUEST_URI'])) {
				return trim($_SERVER['REQUEST_URI'], '');
				//якшо ввести http://php-start/news/fxh/fdgh
				//то виведе news/fxh/fdgh
			}
		}

		public function run( ){
			// отримати рядок запита
			$uri = $this->getURI();
			// перевріити наявність такого запита в routes.php
			
			foreach ($this->routes as $routes => $path) {
				if(preg_match("~$routes~", $uri)) {
					//якшо співпадіння в юрл і uriPattern зібгаються
					//http://php-start/news/fxh/fdgh
					//echo $path; // news/index
					
					$internalRoute = preg_replace("~$routes~", $path, $uri);
					$segments = explode('/', $internalRoute); // http://courses-oop/
					//$segments = explode('/', $path); // http://courses-oop/courses/ => array(2) { [0]=> string(7) "content" [1]=> string(7) "courses" }
					//$controllerName = array_pop($segments).'Controller'; //indexController

					
					$controllerName = array_shift($segments) . 'Controller';
					//$controllerName = $segments[0].'Controller'; //newsController //shift видаляє перший елемент
					// якшо є товизначити контролер який буде виконувати дію
					$controllerName = ucfirst($controllerName);// першу букву великою робимо NewsController
					$actionName = 'action' . ucfirst(array_shift($segments));
					$params = $segments;
					//var_dump($params);
					//$actionName = 'action'.ucfirst($segments[1]); //actionIndex
					$controllerFile = ROOT . '/controllers/' .$controllerName. '.php';
					// підключити файл класа контролера
					if (file_exists($controllerFile)) {
						include_once($controllerFile);
					}
					// створити обєкт, викликати метод
					$controllerObject = new $controllerName;
					$result = call_user_func_array(array($controllerObject ,$actionName ), $params);
					//$result = $controllerObject->$actionName();

					// $params = [0=>view, 1=>12]
					if ($result != null) {
						break;
					}
				}
			}

		}
	}