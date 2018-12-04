<?php

class AboutController extends Controller
{
	public function index()
	{
		$data['title'] = "About";

		self::view('templates/header', $data);
		self::view('about/index', $data);
		self::view('templates/footer');
	}

	public function me()
	{
		$data['title'] = "About";

		self::view('templates/header', $data);
		self::view('about/index', $data);
		self::view('templates/footer');
		// App::redirect(App::base('about'));
	}

	public function error()
	{
		echo "404";
	}
}