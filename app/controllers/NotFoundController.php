<?php

/**
 * 
 */
class NotFoundController extends Controller
{
	
	public function index()
	{
		$this->view('templates/not_found');
	}
}