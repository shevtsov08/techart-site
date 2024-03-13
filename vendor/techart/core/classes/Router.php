<?php 

namespace techart;

class Router 
{
	protected  $routes = [];
	protected  $uri;
	protected  $method;

	public function __construct()
	{
		$this->uri = trim(parse_url($_SERVER['REQUEST_URI'])['path'], '/');
		$this->method = $_SERVER['REQUEST_METHOD'];
	}
	
	public function match()
	{
		$matches = false;

		foreach($this->routes as $route) 
		{
			
			if(($route['uri'] === $this->uri) && ($route['method'] === strtoupper($this->method))) { 
		
				$file = CONTROLLERS . "/{$route['controller']}";
				$matches = true;
				
				if(file_exists($file)) { 
					require $file;
				} else { 
					abort();
				}
			}
		}
		if(!$matches) { 
			abort();
		}
	}

	public function add($uri, $controller, $method)
	{
		$this->routes[] = [
			'uri' => $uri,
			'controller' => $controller,
			'method' => $method,
		];
	}

	public function get($uri, $controller)
	{
		$this->add($uri, $controller, 'GET');
	}
}