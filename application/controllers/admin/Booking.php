<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking extends Admin_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('booking_model');
	}

	public function index(){
		// $disable = $this->booking_model->get_all_booking();
		// foreach ($disable as $key => $value) {
		// 	$disable[$key]['date'] = array_map(function($n){return Date('d/m/Y',$n);},json_decode($value['date']));
		// }
		// echo "<pre>";
		// print_r($disable);
		// echo "<pre>";
	}


  // test đặt phòng tại admin đặt phòng cần show ra ngoài front-end cho người dùng đặt
  // Khi đặt lịch xong nhân viên cần call xác nhận nếu ok thì xác nhận lịch được đặt thành công.
  // Một lịch đặt thành công sẽ có thể huy được
  // Một khách hàng trả phòng thì cần xác nhận hoàn thành
  // Vậy khi show ra các ngày không được đặt đối với khách hàng đã được nhân viên gọi điện xác nhận
	public function create()
	{

    // show các ngày đã được đặt lịch
		$disable = $this->booking_model->get_all_booking();
    $date_room = 1;
    $date_full = array();
		foreach ($disable as $key => $value) {
      if($date_room == 1){
        $date_full = array_merge($date_full,json_decode($value['date']));
      }
		}
    $this->data['date_full'] = str_replace('\/', '/', json_encode($date_full));


		$this->load->helper('form');
		if($this->input->post()){
			// if(empty($this->input->post('product_id'))){
   //      		return $this->return_api(HTTP_NOT_FOUND,$this->lang->line('booking_errors'));
   //      	}
   //      	if(empty($this->input->post('title')) || empty($this->input->post('email')) || empty($this->input->post('first_name')) || empty($this->input->post('last_name')) || empty($this->input->post('phone')) || empty($this->input->post('time')) || empty($this->input->post('country')) || empty($this->input->post('adults')) || empty($this->input->post('children')) || empty($this->input->post('infants'))){
   //              $reponse = array(
   //                  'csrf_hash' => $this->security->get_csrf_hash()
   //              );
   //  			return $this->return_api(HTTP_SUCCESS,$this->lang->line('booking_require'),$reponse,false);
   //      	}
    		// if(trim($this->input->post('email')) != trim($this->input->post('email_confirm'))){
      //           $reponse = array(
      //               'csrf_hash' => $this->security->get_csrf_hash()
      //           );
    		// 	return $this->return_api(HTTP_SUCCESS,$this->lang->line('create_errors_email'),$reponse,false);
    		// }
    		$date= explode(",",$this->input->post('date'));
    		foreach ($date as $key => $value) {
                $date= explode("/",$value);
                $datetime[$key]=strtotime($date[2]."/".$date[1]."/".$date[0]);
    		}
    		if(isset($datetime)){
    			sort($datetime);
    			$datetime = array_map(function($n){return Date('d/m/Y',$n);},$datetime);
    		}else{
    			show_404();
    		}
    		$data = array(
    			'room_id' => 1,
    			// 'start_date' => reset($datetime),
    			// 'end_date' => end($datetime),
    			'date' => json_encode($datetime),
    		);
    		$insert = $this->booking_model->insert($data);
    		if($insert){
    			$this->session->set_flashdata('message_success', 'Thêm mới thành công!');
          redirect('admin/booking/create', 'refresh');
    		}else{
          $this->session->set_flashdata('message_success', 'Thêm mới thất bại!');
          redirect('admin/booking/create', 'refresh');
    		}
    		// foreach ($datetime as $key => $value) {
    		// 	$datetime[$key] = date('d/m/Y', $value);
    		// }
    		// echo "<pre>";
    		// print_r($datetime);
    		// echo "<pre>";
		}
		$this->render('admin/booking/created');
	}

}

/* End of file Boooking.php */
/* Location: ./application/controllers/Boooking.php */