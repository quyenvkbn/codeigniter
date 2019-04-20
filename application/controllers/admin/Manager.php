<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Manager extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->render('admin/manager');
	}

}

/* End of file Manager.php */
/* Location: ./application/controllers/Manager.php */