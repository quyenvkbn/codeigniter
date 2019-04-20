<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Booking_model extends Single_Model {

	public $table = 'bookings';

	public function __construct()
	{
		parent::__construct();
		
	}
	public function get_all_booking(){
		return $this->db->get($this->table)->result_array();
	}

}

/* End of file Booking_model.php */
/* Location: ./application/models/Booking_model.php */