<?php //-->

class Base_Controllers extends CI_Controller {
    protected $_meta        = array();
	protected $_head        = array();
    protected $_body        = array();
	protected $_foot		= array();
    protected $_title       = NULL;
    protected $_class       = NULL;
	protected $_root		= NULL;
    protected $_template    = NULL;
	protected $_message	 = array();
	
    public function __construct()
    {
        parent::__construct();
        $this->load->add_package_path(APPPATH.'../third_party/');
		$this->_root = dirname(__FILE__).'/../../../';
	}

    protected function _renderPage()
    {
	    $head = $this->load->view('_header', $this->_head, true);
        $body = $this->load->view($this->_template, $this->_body, true);
        $foot = $this->load->view('_footer', $this->_foot, true);
		
        return $this->load->view('_page', array(
            'head'  => $head,
            'body'  => $body,
            'foot'  => $foot,
            'class' => $this->_class,
            'title' => $this->_title));
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
