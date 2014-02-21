<?php //-->
class User_Model extends Base_Model {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	protected $_table			= 'user';
	protected $_key			  = 'user_id';
	
	/* Private Properties
	-------------------------------*/
	 /* Magic
    -------------------------------*/
	/* Get
	-------------------------------*/
	/* Magic
	-------------------------------*/
	/* Public Methods
	-------------------------------*/
	
	/*
	* Title: Get User details by Username and Password
	* Description: Retrieve data from user table with the filter username and password
	* Author : rewin
	* @param varchar
	* @param varchar
	* return array
	*/
	public function auth($username, $password) {
		$row = $this->db
			->select('*')
			->from($this->_table)
			->where('user_username', $username)
			->where('user_password', sha1(md5($password)))
			->get()
			->row_array();
			
		return !empty($row) ? $row : array();	
	}
	
	/* Private Methods
	-------------------------------*/
}