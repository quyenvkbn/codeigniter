<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Post_model extends Single_Model {


	public function __construct()
	{
		parent::__construct();
		$this->table = 'post';
		$this->table_join = 'post_category';
		$this->_single_select = ['title','id']; // column lấy ra

		$this->has_one['post_category'] = [
			'model' => 'post_category_model',
			'foreign_key' => 'id',
			'local_key' => 'category_id',
			'foreign_column' => ['title','description'] // column lấy ra từ bảng join
		];


	}

}

/* End of file auth_model.php */
/* Location: ./application/models/auth_model.php */