<?php

class HomeController extends Controller
{
	
	public function index()
	{
		echo "Home";
	}

	public function error()
	{
		self::view('templates/not_found');
	}
}