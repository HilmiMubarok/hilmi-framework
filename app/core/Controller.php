<?php

class Controller
{
	
	public static function view($file, $data = [])
	{
		require_once '../app/views/' .$file. '.php';
	}
	
}