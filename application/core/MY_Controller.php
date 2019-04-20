<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Controller extends CI_Controller {

	public $data = [];

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
	}
	public function render($view_file = '', $type_view){
		//Tác dụng của (tham số TRUE trong this->load->view) là cho phép gán view vào 1 biến khi đưa ra ngoài có thể echo biến đó để hiển thị view.
		$this->data['view_file'] = $this->load->view($view_file,$this->data,TRUE); 
		return $this->load->view('templates/'.$type_view.'_master',$this->data);
	}
	/**
	 * upload_image
	 *
	 * @param string $upload_path
	 * @param string $file_name
	 * @param string $type (single|multi)
	 *
	 * @return array|bool
	 */
	public function upload_image($upload_path = '', $file_name = '', $type = 'single')
    {
    	if( !empty($upload_path) && ($type == 'single' || $type == 'multi') && !empty($_FILES[$file_name])){

			$config = $this->config_image($upload_path);
	        $this->load->library('upload', $config); //nếu không sử dụng tự động load upload thì sử dụng cái này để config.
	        // $this->upload->initialize($config); //chỉ sử dụng để config khi tự động load library upload
	    	if($type == 'single'){
	    		$image = '';
				if ($this->upload->do_upload($file_name))
		        {
		        	$image = $this->upload->data()['file_name'];
		        }
		        return $image;
	    	}else{
	    		$files = $_FILES[$file_name];
	    		$count = count($files);
	    		$image_list = array();
	    		for ($i=0; $i < $count; $i++) { 
	    			if(!empty($files['name'][$i])){
		    			$_FILES['multi_images']['name']= $files['name'][$i];
			            $_FILES['multi_images']['type']= $files['type'][$i];
			            $_FILES['multi_images']['tmp_name']= $files['tmp_name'][$i];
			            $_FILES['multi_images']['error']= $files['error'][$i];
			            $_FILES['multi_images']['size']= $files['size'][$i];
			            if ($this->upload->do_upload('multi_images')) {
			                $image_list[] = $this->upload->data()['file_name'];
			            }else{
			                $image_list[] = '';
			            }
	    			}
	    		}
	    		return $image_list;
	    	}
	        
    	}
    	return false;
    }
    public function config_image($upload_path = '', $max_width = '', $max_height = '', $max_size = 1200, $allowed_types = 'gif|jpg|png|jpeg'){
        $config['upload_path']          = './assets/upload/' . $upload_path;
        $config['allowed_types']        = $allowed_types;
        $config['max_size']             = $max_size;
        $config['max_width']            = $max_width;
        $config['max_height']           = $max_height;
        $config['encrypt_name']           = TRUE; // tiến hành thay đổi tên file
        return $config;
    }

}

class Admin_Controller extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('ion_auth');
		if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('admin/auth/login', 'refresh');
		}
		else if (!$this->ion_auth->in_group([1,2])) // remove this elseif if you want to enable this for non-admins
		{
			// redirect them to the home page because they must be an administrator to view this
			show_error('You must be an administrator to view this page.');
		}
		else if (empty($this->ion_auth->user($this->session->userdata('user_id'))->row()->active))
		{
			$this->ion_auth->logout();
			$this->ion_auth->set_error('login_unsuccessful_not_active');
			$this->session->set_flashdata('message', $this->ion_auth->errors());
			redirect('admin/auth/login', 'refresh');
		}
	}

	public function index()
	{
		
	}

	public function render($view_file = '', $type_view = 'admin'){
		parent::render($view_file, $type_view);
	}

}
class Auth_Controller extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
	}
	public function render($view_file = '', $type_view = 'auth'){
		parent::render($view_file, $type_view);
	}

}
class Public_Controller extends MY_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		
	}

	public function render($view_file = '', $type_view = 'public'){
		parent::render($view_file, $type_view);
	}

}

/* End of file MY_Controller.php */
/* Location: ./application/controllers/MY_Controller.php */
/* End of file MY_Controller.php */
/* Location: ./application/controllers/MY_Controller.php */

