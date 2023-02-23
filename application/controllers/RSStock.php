<?php
defined('BASEPATH') or exit('No direct script access allowed');
class RSStock extends MY_Controller
{
	public $table = 'tbl_routsale';
	public $table2 = 'tbl_product';
	public $page  = 'RSStock';
	public function __construct()
	{
		parent::__construct();
		if (!$this->is_logged_in()) {
			redirect('/login');
		}
		$this->load->model('General_model');
		$this->load->model('Routsale_model');
		$this->load->model('HSNcode_model');
		$this->load->model('Purchase_model');
		$this->load->model('Item_model');
		$this->load->model('Sale_model');
	}
	public function index()
	{
		
		$template['body'] = 'RSStock/list';
		$template['script'] = 'RSStock/script2';
		$this->load->view('template', $template);
	}


	public function get()
	{
		$date=date('Y-m-d');
		$this->load->model('Routsale_model');
		$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
		$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
		$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
		$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
		$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';
		$param['item_name'] = (isset($_REQUEST['item_name'])) ? $_REQUEST['item_name'] : '';
		$data = $this->Routsale_model->getClassinfoTable1($param,$date);
		$json_data = json_encode($data);
		echo $json_data;
	}
	
	
}
