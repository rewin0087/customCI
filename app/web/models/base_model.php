<?php //-->

class Base_Model extends CI_Model {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_table   	 = NULL;
	protected $_key 	   = NULL;
	protected $_data	  = array();
	protected $_filters   = array();
	protected $_join	  = array();
	protected $_column    = array();
	protected $_orderBy   = array();
	protected $_condition = array();
	
	/* Private Properties
	-------------------------------*/
	 /* Magic
    -------------------------------*/
	/* Get
	-------------------------------*/
	/* Magic
	-------------------------------*/
	
	public function __construct()
	{
		parent::__construct();
	}
	
	/* Public Methods
	-------------------------------*/
	/*
	* Title: Return Root Path
	* Description: Return Upload Path
	* Author : rewin
	* @param string
	* return array
	*/
	public function path($dir = NULL) {
		$root	 = dirname(__FILE__).'/../../../';
		$folders = glob('*', GLOB_ONLYDIR);
		$path 	 = array();
		
		foreach($folders as $folder) {
			$path[$folder] = $root.$folder; 
		}
		
		if($dir) {
			return $path[$dir];
		} else {
			return $path;	
		}
	}
	
	/*
	* Title: Save data to database
	* Description: Store new data into database base on table name and table fields with data
	* Author : rewin
	* return object
	*/
	public function save() {
		$this->db
			->insert($this->_table, $this->_data);
		
		return $this->db->insert_id();
	}
	
	/*
	* Title: Save data to database
	* Description: Store new data into database base on table name and table fields with data
	* Author : rewin
	* return object
	*/
	public function remove($id = NULL) {
		if($id) {
			$this->_filters = array($this->_table.'_id' => $id);
		}
		$this->db
			->delete($this->_table, $this->_filters);
			
		return $id;
	}
	
	/*
	* Title: Update data to database
	* Description: Store new data into database base on table name and table fields with data
	* Author : rewin
	* return object
	*/
	public function update($id = NULL, $condition = array()) {
		$query = $this->db;
		
		if($id) {
			$query->where($this->_key, $id);
		} elseif(!empty($condition)) {
			foreach($condition as $i => $value) {
				$query->where($i, $value);
			}
		} else {
			return false;
		}

		$query->update($this->_table, $this->_data);
		return $this->get($id);
	}
	
	/*
	* Title: Set Filters
	* Description: Set Filters for next proccess maybe update or something
	* Author : rewin
	* return object
	*/
	public function filters($array) {
		$this->_filters = $array;
		
		return $this;
	}
	
	/*
	* Title: Set Table name
	* Description: Set Table name
	* Author : rewin
	* @param string
	* return array
	*/
	public function setTable($table) {
		$this->_table = $table;
		
		return $this;
	}
	
	/*
	* Title: Set Fields with value
	* Description: Set Fields with value
	* Author : rewin
	* @param string
	* @param string
	* return object
	*/
	public function set($index, $value) {
		$this->_data[$index] = $value;
		
		return $this;
	}
	
	/*
	* Title: Get Data from specific table id = set| null
	* Description: Return data if id is set return specific if not return all
	* Author : rewin
	* @param bigint
	* return array
	*/
	public function get($id = NULL) {	
		if(isset($id)) {
			$query = $this->db
				->select('*')
				->from($this->_table);

			if(!empty($this->_join)) {
				foreach($this->_join as $i => $value) {
					$query->join($i, $value);
				}
			}
			
			if(!empty($this->_condition)) {
				foreach($this->_condition as $i => $value) {
					$query->where($i, $value);
				}
			}

			$rows = $query->where($this->_key, $id)
				->get()
				->row_array();
				
			return !empty($rows) ? $rows : array();
		} else {
			$rows = $this->db
				->get($this->_table)
				->result_array();
				
			return !empty($rows[0]) ? $rows : array();
		}
	}
	
	/*
	* Title: Search 
	* Description: Search to table according to fields
	* Author: rewin
	* return array
	*/
	public function search($keyword, $start, $range) {
		$rows = array();
		
		$this->db->start_cache();

		$object = $this->db
			->select('*')
			->from($this->_table);

		if(!empty($this->_join)) {
			foreach($this->_join as $i => $value) {
				$object->join($i, $value);
			}
		}

		if(!empty($this->_condition)) {
			foreach($this->_condition as $i => $value) {
				$object->where($i, $value);
			}
		}

		foreach($this->_filters as $field) {
			$object->or_like($field, $keyword);
		}
		
		$this->db->stop_cache();
		$rows['total'] 	= $object->count_all_results();
		$rows['data'] 	= $object->limit($range,$start)
				->get()
				->result_array();
		
		$this->db->flush_cache();	
		return !empty($rows) ? $rows : array();
	}
	
	/*
	* Title: Get All Data 
	* Description: Get All data
	* Author : rewin
	* @param varchar
	* return array
	*/
	public function returnAll($pagination = 0, $start = NULL, $range = NULL) {
		$rows = array();
		$this->db->start_cache();
			$query = $this->db;
		
		if(!empty($this->_orderBy)) {
			foreach($this->_orderBy as $i => $value) {
				$query->order_by($i, $value);
			}
		}

			if(!empty($this->_column)) {
				$query->select($this->_column);
			} else {
				$query->select('*');
			}
			
			$query->from($this->_table);

		if(!empty($this->_join)) {
			foreach($this->_join as $i => $value) {
				$query->join($i, $value);
			}
		}

		if(!empty($this->_condition)) {
			foreach($this->_condition as $i => $value) {
				$query->where($i, $value);
			}
		}
		
		if($pagination) {
			$this->db->stop_cache();
			$rows['total'] = $query->count_all_results();
			$rows['data'] = $query
				->limit($range, $start)
				->get()
				->result_array();					
		} else {
			$this->db->stop_cache();
			$rows = $query
				->get()
				->result_array();
		}
		
		$this->db->flush_cache();
			
		return !empty($rows) ? $rows : array();	
	}

	/*
	* Title: Join Table 
	* Description: Set Join Tables
	* Author : jhime
	* return array
	*/
	public function joinTables($tables = array()) {
		if(empty($tables)) {
			return $this;
		}

		$this->_join = $tables;
		return $this;
	}
	
	/*
	* Title: Column Table 
	* Description: Column of the Table
	* Author : jhime
	* return array
	*/
	public function columns($columns = array()) {
		if(empty($columns)) {
			return $this;
		}
		
		$column = implode(',', $columns);

		$this->_column = $column;

		return $this;
	}
	
	/*
	* Title: Order by 
	* Description: Return All query in order
	* return array
	*/
	public function orderBy($title = array()) {
		if(empty($title)) {
			return $this;
		}
		
		$this->_orderBy = $title;
		return $this;
	}
	
	/*
	* Title: Where
	* Description: with where
	* return array
	*/
	public function where($condition = array()) {
		if(empty($condition)) {
			return $this;
		}
		
		$this->_condition = $condition;
		return $this;
	}
	
	/*
	* Title: Return All Filters 
	* Description: Return All Filters Especially used on getting the columns or Filters that used on remove or any proccess that use filter property
	* return array
	*/
	public function getFilters() {
		return $this->_filters;
	}
	
	/*
	* Title: Get Current Table Culumns
	* Description: Get All Table Fields title
	* return array
	*/
	public function getColumns() {
		$fields = $this->db->query('Describe '.$this->_table)->result_array();
	
		foreach($fields as $field){
			$this->_filters[] = $field['Field'];
		}
		
		return $this;
	}
}