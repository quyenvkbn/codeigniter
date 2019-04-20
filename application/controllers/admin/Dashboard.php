<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{


		$dates = '17/04/2019 - 04/05/2019';
        if($dates){
            $this->data['date'] = $dates;
            $date = explode(" - ", $dates);
            foreach ($date as $key => $value) {
                $date= explode("/",$value);
                $datetime[$key]=date('Y-m-d H:i:s', strtotime($date[1]."/".$date[0]."/".$date[2]));
                if($key == 1){
                    $datetime[$key]=date('Y-m-d 23:59:59', strtotime($date[1]."/".$date[0]."/".$date[2]));
                }
            }
        }
        $data = array(
        	'start' => strtotime($datetime[0]),
        	'end' => strtotime($datetime[1]),
        	'number_date' => ceil(((strtotime($datetime[1]) - strtotime($datetime[0])) + 1)/60/60/24),
        	'date' => ''
        );
        // echo "<pre>";
        // print_r($data);
        // echo "<pre>";
        for ($i=0; $i < $data['number_date']; $i++) { 
        	$data['date'] .= date('d/m/Y', strtotime("+{$i} days", $data['start'])).',';
        }
        $data['date'] = rtrim($data['date'],',');
        // echo "<pre>";
        // print_r($data);
        // echo "<pre>";

		$created_room = array(
			array(
				'id' => 1,
				'room_id' => 2,
				'name' => 'Quyền',
				'time_start' => '19/04/2019', 
				'time_end' => '22/04/2019', 
			),
			array(
				'id' => 2,
				'room_id' => 1,
				'name' => 'Quyền 1',
				'time_start' => '19/04/2019', 
				'time_end' => '21/04/2019', 
			),
			array(
				'id' => 3,
				'room_id' => 2,
				'name' => 'Quyền 2',
				'time_start' => '23/04/2019', 
				'time_end' => '24/04/2019', 
			),
			array(
				'id' => 4,
				'room_id' => 1,
				'name' => 'Quyền 3',
				'time_start' => '16/04/2019', 
				'time_end' => '17/04/2019', 
			),
			array(
				'id' => 5,
				'room_id' => 3,
				'name' => 'Quyền 4',
				'time_start' => '24/04/2019', 
				'time_end' => '27/04/2019', 
			),
			array(
				'id' => 6,
				'room_id' => 2,
				'name' => 'Quyền 5',
				'time_start' => '27/04/2019', 
				'time_end' => '03/05/2019', 
			),
			array(
				'id' => 7,
				'room_id' => 4,
				'name' => 'Quyền 6',
				'time_start' => '02/05/2019', 
				'time_end' => '11/05/2019', 
			),
			array(
				'id' => 8,
				'room_id' => 8,
				'name' => 'Quyền 7',
				'time_start' => '20/04/2019', 
				'time_end' => '22/04/2019', 
			),
			array(
				'id' => 9,
				'room_id' => 6,
				'name' => 'Quyền 8',
				'time_start' => '16/06/2019', 
				'time_end' => '20/06/2019', 
			),
			array(
				'id' => 10,
				'room_id' => 7,
				'name' => 'Quyền 9',
				'time_start' => '16/05/2019', 
				'time_end' => '20/05/2019', 
			),
			array(
				'id' => 11,
				'room_id' => 10,
				'name' => 'Quyền 10',
				'time_start' => '16/04/2019', 
				'time_end' => '20/04/2019', 
			),
			array(
				'id' => 12,
				'room_id' => 9,
				'name' => 'Quyền 11',
				'time_start' => '13/04/2019', 
				'time_end' => '21/04/2019', 
			),
			array(
				'id' => 13,
				'room_id' => 8,
				'name' => 'Quyền 12',
				'time_start' => '25/04/2019', 
				'time_end' => '27/04/2019', 
			),
			array(
				'id' => 14,
				'room_id' => 3,
				'name' => 'Quyền 13',
				'time_start' => '28/04/2019', 
				'time_end' => '30/04/2019', 
			),
			array(
				'id' => 15,
				'room_id' => 6,
				'name' => 'Quyền 14',
				'time_start' => '27/04/2019', 
				'time_end' => '30/04/2019', 
			),
			array(
				'id' => 16,
				'room_id' => 4,
				'name' => 'Quyền 15',
				'time_start' => '25/04/2019', 
				'time_end' => '26/04/2019', 
			),
			array(
				'id' => 17,
				'room_id' => 5,
				'name' => 'Quyền 16',
				'time_start' => '27/04/2019', 
				'time_end' => '29/04/2019', 
			),
			array(
				'id' => 18,
				'room_id' => 4,
				'name' => 'Quyền 17',
				'time_start' => '17/05/2019', 
				'time_end' => '20/05/2019', 
			),
			array(
				'id' => 19,
				'room_id' => 1,
				'name' => 'Quyền 18',
				'time_start' => '13/05/2019', 
				'time_end' => '17/05/2019', 
			),
			array(
				'id' => 20,
				'room_id' => 2,
				'name' => 'Quyền 19',
				'time_start' => '11/05/2019', 
				'time_end' => '12/05/2019', 
			)
		);

		$room = array(
			array(
				'id' => 1,
				'room' => 1,
				'description' => 'Đây là phòng số 1'
			),
			array(
				'id' => 2,
				'room' => 2,
				'description' => 'Đây là phòng số 2'
			),
			array(
				'id' => 3,
				'room' => 3,
				'description' => 'Đây là phòng số 3'
			),
			array(
				'id' => 4,
				'room' => 4,
				'description' => 'Đây là phòng số 4'
			),
			array(
				'id' => 5,
				'room' => 5,
				'description' => 'Đây là phòng số 5'
			),
			array(
				'id' => 6,
				'room' => 6,
				'description' => 'Đây là phòng số 6'
			),
			array(
				'id' => 7,
				'room' => 7,
				'description' => 'Đây là phòng số 7'
			),
			array(
				'id' => 8,
				'room' => 8,
				'description' => 'Đây là phòng số 8'
			),
			array(
				'id' => 9,
				'room' => 9,
				'description' => 'Đây là phòng số 9'
			),
			array(
				'id' => 10,
				'room' => 10,
				'description' => 'Đây là phòng số 10'
			),
		);
		foreach ($room as $key => $value) {
			foreach ($created_room as $k => $val) {
				// $val['']
				if($value['room'] == $val['room_id']){
					$room[$key]['sub'][] = $val;
					unset($created_room[$k]);
				}
			}
		}
		$this->data['room'] = $room;




		echo $this->security->get_csrf_token_name();
		echo $this->security->get_csrf_hash();
		$this->load->library('pagination');
		$this->data['page_links'] = $this->pagination->create_links();
		//bắt đầu lấy từ row thứ bao nhiêu
		$data['offset'] = (($this->uri->segment(4) ? $this->uri->segment(4) : 1) -1)*10; 
		// lấy 10 row mỗi trang
		$data['limit'] = 10; //đã được config 10 trong file pagination.php ở thư mục config/development
		/*=> cuối cùng tao câu truy vấn để lấy dữ liệu theo trang đã có giá trị phân đoạn ở trên để truy vấn
		ví dụ trang số 1 thì ở url phân đoạn thứ 4( $this->uri->segment(4) ) 
		1. Trên url phân đoạn thứ 4 nếu không có mặc định sẽ là trang 1 và trang 1 sẽ lấy 10 row bắt đầu từ 1, 
		2. Là trang 2 có 10 row và được lấy dữ liệu bắt đầu từ row thứ 11 và lấy 10 row*/

		$this->load->model('post_category_model');
		$this->load->model('post_model');
		// $this->post_category_model->where_group();
		// echo "<pre>";
		// print_r($this->post_category_model->with('post')->get_data()->result_array());
		// echo "<pre>";
		// echo "<pre>";
		// print_r($this->db->last_query());
		// echo "<pre>";
		// $this->load->model('post_model');
		// echo "<pre>";
		// print_r($this->post_model->with('post_category')->get_data()->result_array());
		// echo "<pre>";
		$this->render('admin/dashboard');
		// rất hay đáng để học cách truyên tham số khi -> là để trong  dấu này {}
		// $test = 'test1';
		// echo $this->{$test}();
		
	}
	// public function test1(){
	// 	return 1;
	// }

	// test upload image single
	public function upload_dashboard_single(){
		$image = $this->upload_image('dashboard','image','single');
		if($image !== false){
			echo $image;
		}else{
			echo 'false';
		}
	}
	// test upload image multi
	public function upload_dashboard_multi(){
		$image = $this->upload_image('dashboard','image','multi');
		if($image !== false){
			echo "<pre>";
			print_r($image);
			echo "<pre>";
		}else{
			echo 'false';
		}
	}
	// send mail
	public function send_mail_codeigniter(){
		// đã được config trong thư mục config/development/email
	     //Load email library
	    $this->load->library('email');
	    $this->email->set_newline("\r\n");// chưa rõ nguyên nhân
	    //Email content
	    $htmlContent = '<h1>Sending email via SMTP server</h1>';
	    $htmlContent .= '<p>This email has sent via SMTP server from CodeIgniter application.</p>';

	    $this->email->to('nguyenquyen18011996@gmail.com');
	    $this->email->from('sender@example.com','MyWebsite');
	    $this->email->subject('How to send email via SMTP server in CodeIgniter');
	    $this->email->message($htmlContent);

	    if(!$this->email->send()){
	        echo $this->email->print_debugger();
	    }
	}
	// create captcha
	function captcha(){
		$this->load->helper('captcha');
        $val = array(
            'img_path' => './assets/upload/captcha/',
            'img_url' => base_url('assets/upload/captcha'),
            'img_width' => '120',
            'img_height' => 35,
            'expiration' => 0,
            'word_length' => 6,
            'font_size' => 25,
            'img_id' => 'Imageid',
            'pool' => '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ',
            'colors' => array(
                'background' => array(235, 235, 235),
                'border' => array(51, 51, 51),
                'text' => array(255, 0, 0),
                'grid' => array(255, 255, 255)
            )
        );
        $captcha = 	create_captcha($val);
        echo "<pre>";
        print_r($captcha);
        echo "<pre>";
	}

}

/* End of file Dashboard.php */
/* Location: ./application/controllers/Dashboard.php */