<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Homepage extends Public_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->render('homepage');
	}

}

/* End of file Homepage.php */
/* Location: ./application/controllers/Homepage.php */