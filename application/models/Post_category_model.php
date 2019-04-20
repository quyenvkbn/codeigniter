<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post_category_model extends Single_Model {


	public function __construct()
	{
		parent::__construct();
		$this->table = 'post_category';
		$this->table_join = 'post';


		$this->has_many['post'] = [
			'model' => 'post_model',
			'foreign_key' => 'category_id',
			'local_key' => 'id',
			'foreign_column' => ['title','description'] // column lấy ra từ bảng join
		];
	}
	public function __destruct(){
		echo 1;
	}

}

/* End of file auth_model.php */
/* Location: ./application/models/auth_model.php */