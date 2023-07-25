<?php

namespace App\core;

class Controller
{
	protected $model;
	protected $view;
	protected $imageModel;
	protected $commentModel;
	protected $pageData = [];
	
	public function __construct()
	{
		$this->view = new View();
		$this->model = new Model();
	}

	public function index()
	{

	}

}
