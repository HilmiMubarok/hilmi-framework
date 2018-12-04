<?php

class App
{

	protected $controller = 'HomeController';
	protected $notfound   = 'NotFoundController';
	protected $method     = 'index';
	protected $params     = [];
	protected $base       = BASEURL;
	
	function __construct()
	{
		$url = $this->parseURL();
		$fileController = $url[0]. 'Controller';
		// Controller
		if (file_exists('../app/controllers/'. $fileController .'.php')) {
			$this->controller = $fileController;
			unset($url[0]);
		} elseif ($url[0] == "") {
			$this->controller = $this->controller;
		} else {			
			$this->controller = $this->notfound;
		}
		require_once '../app/controllers/'. $this->controller. '.php';
		$this->controller = new $this->controller;

		// Method
		if (isset($url[1])) {
			if (method_exists($this->controller, $url[1])) {
				$this->method = $url[1];
				unset($url[1]);
			} else {
				$this->method = 'error';
			}
		}

		// Params
		if (!empty($url)) {
			$this->params = array_values($url);
		}

		// Run controller+method+params(jika ada)
		call_user_func_array([$this->controller, $this->method], $this->params); 
	}

	public function parseURL()
	{
		if (isset($_GET['url'])) {
			$url = rtrim($_GET['url'], '/');
			$url = filter_var($url, FILTER_SANITIZE_URL);
			$url = explode('/', $url);
			return $url;
		}
	}

	public static function redirect($url, $time = '0')
	{
		if(!headers_sent()) {
			header('Location: '.$url);
			exit;
	    } else {
			echo '<meta http-equiv="refresh" content="0;url='.$url.'" />';
			exit;
	    }
	}

	public static function base($url)
	{
		return BASEURL.$url;
	}
}