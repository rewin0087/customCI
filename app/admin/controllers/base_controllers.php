<?php //-->

class Base_Controllers extends CI_Controller {
    protected $_meta        = array();
	protected $_head		= array();
    protected $_body        = array();
    protected $_title       = NULL;
    protected $_class       = NULL;
    protected $_template    = NULL;
	protected $_message	 = array();
	protected $_root		= NULL;
    protected $_fields	  = array();
	protected $_error	   = 'We have Encountered an error while saving the data. Please Try again';
	
    public function __construct() {
        parent::__construct();
        $this->load->add_package_path(APPPATH.'../third_party/');
		$this->_root = dirname(__FILE__).'/../../../';
		
    }
	
    protected function _renderPage()
    {
        $head = $this->_view('_header', $this->_head, true);
        $body = $this->_view($this->_template, $this->_body, true);
        $foot = $this->_view('_footer', array(), true);

        return $this->_view('_page', array(
            'head'  => $head,
            'body'  => $body,
            'foot'  => $foot,
            'class' => $this->_class,
            'title' => $this->_title), false);
    }
	
	/* Title: Class name
	* Description: setting a Class name on _page instead of $this->_class = ???
	* Author: rewin & jhime
	* @param: varchar
	* @return: object
	*/
	protected function _setClass($class) {
		$this->_class = $class;
		
		return $this;
	}
	
	/* Title: Title 
	* Description: setting a Title on _page instead of $this->_title = ???
	* Author: rewin & jhime
	* @param: varchar
	* @return: object
	*/
	protected function _setTitle($title) {
		$this->_title = $title;
		
		return $this;
	}
	
	/* Title: Template
	* Description: setting a Template instead of $this->_template = ???
	* Author: rewin & jhime
	* @param: varchar
	* @return: object
	*/
	protected function _setTemplate($template) {
		$this->_template = $template;
		
		return $this;
	}
	
	/* Title: Body Content
	* Description: setting a Body content instead of $this->_body = ???
	* Author: rewin & jhime
	* @param: varchar
	* @param: varchar | array | object | int | double
	* @return: object
	*/
	protected function _setBody($index, $value) {
		$this->_body[$index] = $value;
		
		return $this;
	}
	
	/* Title: header Content
	* Description: setting a Header content instead of $this->_head = ???
	* Author: rewin & jhime
	* @param: varchar
	* @param: varchar | array | object | int | double
	* @return: object
	*/
	protected function _setHeader($index, $value) {
		$this->_head[$index] = $value;
		
		return $this;
	}
	
	/* Title: footer Content
	* Description: setting a footer content instead of $this->_head = ???
	* Author: rewin & jhime
	* @param: varchar
	* @param: varchar | array | object | int | double
	* @return: object
	*/
	protected function _setFooter($index, $value) {
		$this->_foot[$index] = $value;
		
		return $this;
	}
	
	/*
	* Title: Upload Script
	* Description: upload a file on upload folder
	* @param varchar
	* @return bool
	*/
	protected function _upload($file) {
		$path = $this->_root.'upload';
		$max = 4000 * 1024;
		$fileExtension = pathinfo($file['name']);
		$name = basename($file['name']);
		$extension = $fileExtension['extension'];
		$temp = $file['tmp_name'];
		$file = $path.'/'.url_title($name).'.'.strtolower($extension);

		// move files to new directory
		move_uploaded_file($temp, $file);
		
		// check file if now move to new directory
		if(file_exists($file)) {
			return true;	
		} else {
			return false;
		}	 
	}
	
	/* Title: Model
	* Description: Load a specifice model. Instead of always using $this->load->model
	* Author: rewin & jhime
	* @param: varchar
	* @return: object
	*/
	protected function _model($model_name) {
		$this->load->model($model_name.'_model', $model_name);
		
		return $this->$model_name;
	}
	
	/* Title: View
	* Description: Load a specifice view. Instead of always using $this->load->view
	* Author: rewin & jhime
	* @param: varchar
	* @param: array
	* @param: boolean
	* @return: string
	*/
	protected function _view($view_name, $data = array(), $default = true) {
		return $this->load->view($view_name, $data, $default);
	}

	/* Title: Pagination
	* Description: Set the pagination function
	* Author: jhime
	* @return: int
	* @return: int
	* @return: int
	*/
	protected function _pagination($totalResult, $range, $page) {		
		// pagination
		$this->load->library('pagination');
		// set configuration for pagination
		$config['base_url'] = current_url().'/?';
		$config['total_rows'] = $totalResult;
		$config['per_page'] = $range;
		$config['page_query_string'] = TRUE;
		// initialize pagination object
		$this->pagination->initialize($config);
		// store created pagination
		$pagination = $this->pagination->create_links();

		return $pagination;
	}
}
