<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Model extends CI_Model {
	public $table = '';
	public $table_join = '';

}

// một ngôn ngữ
// Có gạch dưới trước những biến nên là biến có thuộc tính Protected
class Single_Model extends MY_Model{

	public $_relationships = array();
	public $_requested = array();    
	public $has_one = array();
	public $has_many = array();
	public $primary = 'id';
	public $_single_select = [];
	public $_single_where = ['is_deleted' => 0];
	public $_single_limit = NULL;
	public $_single_offset = NULL;
	public $_single_order_by = NULL;
	public $_single_order = NULL;
	public $_single_like = [];
	protected $response = NULL;

    public function with($request, $type_join = 'left')
    {
        $this->_set_relationships();
        if(!is_array($request)) $requests[0] = $request;
        foreach($requests as $request)
        {
            if (array_key_exists($request, $this->_relationships))
            {
                $this->_requested[$request] = $request;
            }        }
        foreach($this->_requested as $request)
        {
            if($this->_relationships[$request]['relation'] == 'has_one') $this->_has_one($request, $type_join);
            if($this->_relationships[$request]['relation'] == 'has_many') $this->_has_many($request, $type_join);

        }
        return $this;
    }
 
 	function insert($data) {
        $this->db->set($data)->insert($this->table);
        if ($this->db->affected_rows() == 1) {
            return $this->db->insert_id();
        }
        return false;
    }
    /**
     * private function _has_one($request)
     *
     * returns a joining of two tables depending on the $request relationship established in the constructor
     * @param $request
     * @return $this
     */
    private function _has_one($request, $type_join = 'left')
    {
        $relation = $this->_relationships[$request];
        $select = '';
        foreach ($relation['foreign_column'] as $key => $value) {
			$select .= $relation['foreign_table'] . '.' . $value . ' as '. $relation['foreign_table'] . '_' . $value . ',';
		}
		$this->db->select(rtrim($select,','));
        $this->db->join($relation['foreign_table'], $relation['foreign_table'].'.'.$relation['foreign_key'].' = '.$this->table.'.'.$relation['local_key'], $type_join);
        return TRUE;
    }
 
    /**
     * private function _has_one($request)
     *
     * returns a joining of two tables depending on the $request relationship established in the constructor
     * @param $request
     * @return $this
     */
    private function _has_many($request, $type_join = 'left')
    {
        $relation = $this->_relationships[$request];
        $select = '';
        foreach ($relation['foreign_column'] as $key => $value) {
        	$select .= 'GROUP_CONCAT('. $relation['foreign_table'] . '.' . $value . ' separator \' ||| \' )  as ' . $relation['foreign_table'] . '_' . $value . ',';
		}
		$this->db->select(rtrim($select,','));
        $this->db->join($relation['foreign_table'], $relation['foreign_table'].'.'.$relation['foreign_key'].' = '.$this->table.'.'.$relation['local_key'], $type_join);
        return TRUE;
    }

    /**
     * private function _set_relationships()
     *
     * Called by the public method with() it will set the relationships between the current model and other models
     */
    private function _set_relationships()
    {
        if(empty($this->_relationships))
        {
            $options = array('has_one','has_many');
            foreach($options as $option)
            {
                if(isset($this->{$option}) && !empty($this->{$option}))
                {
                    $this->load->helper('inflector');
                    foreach($this->{$option} as $key => $relation)
                    {
                        $foreign_model = (is_array($relation)) ? $relation['model'] : $relation;
                        $foreign_model_name = strtolower($foreign_model);
                        $this->load->model($foreign_model_name);
                        $foreign_table = $this->{$foreign_model_name}->table;
                        $foreign_column = (is_array($relation) && is_array($relation['foreign_column'])) ? $relation['foreign_column'] : [];
                        $foreign_key = (is_array($relation)) ? $relation['foreign_key'] : singular($this->table) . '_id';
                        $local_key = (is_array($relation) && isset($relation['local_key'])) ? $relation['local_key'] : $this->primary;
                        $this->_relationships[$key] = array('relation' => $option, 'relation_key' => $key, 'foreign_model' => $foreign_model_name, 'foreign_table' => $foreign_table, 'foreign_key' => $foreign_key, 'local_key' => $local_key, 'foreign_column' => $foreign_column);
                    }
                }
            }
        }
    }
	/**
	 * get all
	 *
	 * @param bool $join
	 * @param string $order_by
	 * @param int|string $limit, $offset
	 * @param string $keywords
	 *
	 * @return array
	 * @author quyen
	 */
	public function get_data(){
		// check select
		if (isset($this->_single_select) && !empty($this->_single_select))
		{
			$select = '';
			foreach ($this->_single_select as $key => $value)
			{
				$select .= $this->table . '.' . $value . ',';
			}
			$this->db->select(rtrim($select,','));
			$this->_single_select = [];
		}else{
			$this->db->select($this->table . '.*');
		}
		// check like
		if (isset($this->_single_like) && !empty($this->_single_like))
		{
			foreach ($this->_single_like as $key => $value)
			{
				$this->db->or_like($value['like'], $value['value'], $value['position']);
			}

			$this->_single_like = [];
		}
		// check where
		if(isset($this->_single_where) && !empty($this->_single_where)){
			if(!empty($this->_relationships) && !empty($this->_requested)){
				$where = [];
				foreach ($this->_single_where as $key => $value) {
					$key_where = $this->table.'.'.$key;
					if(strpos($key,$this->table_join) !== false){
						$key_where = $key;
					}
					$where[$key_where] = $value;
				}
				$where[$this->table_join.'.is_deleted'] = 0;
				$this->_single_where = $where;
			}
			$this->db->group_start();
			$this->db->where($this->_single_where);
			$this->db->group_end();
			$this->db->group_start();
			$this->db->or_where($this->_single_where);
			$this->db->group_end();
			$this->_single_where = [];
		}
		// check limit and offset
		if (isset($this->_single_limit) && isset($this->_single_offset))
		{
			$this->db->limit($this->_single_limit, $this->_single_offset);

			$this->_single_limit  = NULL;
			$this->_single_offset = NULL;
		}
		else if (isset($this->_single_limit))
		{
			$this->db->limit($this->_single_limit);

			$this->_single_limit  = NULL;
		}
		// check order_by
		if (isset($this->_single_order_by) && isset($this->_single_order))
		{
			$this->db->order_by($this->table.'.' . $this->_single_order_by, $this->_single_order);

			$this->_single_order    = NULL;
			$this->_single_order_by = NULL;
		}
		$this->_relationships = [];
		$this->response = $this->db->get($this->table);
		return $this;
	}

	/**
	 * set $where
	 * @param string|array $where
	 * @param string $value
	 * @return static
	 */
	public function where($where, $value = NULL){
		if(!is_array($where)){
			$where = [$where => $value];
		}
		$this->_single_where = array_merge($this->_single_where, $where);
		return $this;
	}


	/**
	 * set $where
	 * @param string|array $params tối đa 3 phần tử trong mảng
	 * @param bool $group
	 * @return static
	 * where_in ( )
	 */
	// protected function where($params, $group = FALSE)
 //    {
 //        if (count($params) == 1 && is_array($params[0]))
 //        {
 //            foreach ($params[0] as $field => $filter)
 //            {
 //                if (is_array($filter))
 //                {
 //                    $this->_database->where_in($field, $filter);
 //                }
 //                else
 //                {
 //                    if (is_int($field))
 //                    {
 //                        $this->_database->where($filter);
 //                    }
 //                    else
 //                    {
 //                        $this->_database->where($field, $filter);
 //                    }
 //                }
 //            }
 //        } 
 //        else if (count($params) == 1)
 //        {
 //            $this->_database->where($params[0]);
 //        }
 //    	else if(count($params) == 2)
	// 	{
 //            if (is_array($params[1]))
 //            {
 //                $this->_database->where_in($params[0], $params[1]);    
 //            }
 //            else
 //            {
 //                $this->_database->where($params[0], $params[1]);
 //            }
	// 	}
	// 	else if(count($params) == 3)
	// 	{
	// 		$this->_database->where($params[0], $params[1], $params[2]);
	// 	}
 //        else
 //        {
 //            if (is_array($params[1]))
 //            {
 //                $this->_database->where_in($params[0], $params[1]);    
 //            }
 //            else
 //            {
 //                $this->_database->where($params[0], $params[1]);
 //            }
 //        }
 //    }

	/**
	 * set $where
	 * @param string|array $where
	 * @param string $value
	 * @return static
	 */
	public function where_all($where, $value = NULL){
		if(!is_array($where)){
			$where = [$where => $value];
		}
		$this->_single_where = array_merge($this->_single_where, $where);
		return $this;
	}
	/**
	 * set $limit
	 * @param string|int $limit
	 * @return static
	 */
	public function limit($limit){
		$this->_single_limit = $limit;
		return $this;
	}
	/**
	 * set $offset
	 * @param string|int $offset
	 * @return static
	 */
	public function offset($offset){
		$this->_single_offset = $offset;
		return $this;
	}
	/**
	 * set $by, $order
	 * @param string $by, $order
	 * @return array|mixed
	 */
	public function order_by($by, $order='desc')
	{
		$this->_ion_order_by = $by;
		$this->_ion_order    = $order;
		return $this;
	}
	/**
	 * @return array|mixed
	 */
	public function row_array(){
		return $this->response->row_array();
	}
	/**
	 * @return array|mixed
	 */
	public function result_array(){
		return $this->response->result_array();
	}
	/**
	 * @return array|mixed
	 */
	public function num_rows(){
		return $this->response->num_rows();
	}
}
// đa ngôn ngữ
class Multi_Model extends MY_Model{

}