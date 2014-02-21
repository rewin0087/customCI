<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M extends Base_Controllers {
	/* Constants
	-------------------------------*/
	/* Public Properties
	-------------------------------*/
	/* Protected Properties
	-------------------------------*/
	/* Private Properties
	-------------------------------*/
	protected $_meta        = array();
    protected $_body        = array();
    protected $_title       = '';
    protected $_class       = '';
    protected $_template    = '';
	
	 /* Magic
    -------------------------------*/
	/* Get
	-------------------------------*/
	/* Magic
	-------------------------------*/
	/* Public Methods
	-------------------------------*/

	public function index()
	{
			header("Status: 404 Not Found");
			echo 'We cannot find your image!.';
	}
	
	public function src() {
		$upload = $this->_root.'upload';
		$image 	= $this->uri->segment(3);
		$path 	= $upload.'/'.$image;
		
		if(!$image) {
			header("Status: 404 Not Found");
			echo 'We cannot find your image!.';
			exit;
		}
		
		if(file_exists($path)) {
			$this->load->library('eden');
			
			$file	= eden('file', $path);
			$image	= eden('image', $path, $file->getExtension());
			
			//display image
			header("Content-type: ".$file->getMime());
			echo (string) $image;
			exit;
		} else {
			header("Status: 404 Not Found");
			echo 'We cannot find your image!.';
			exit;
		}
		
	}
	
	/* Protected Methods
	-------------------------------*/
	
}
