<?php
defined('BASEPATH') or exit('No direct script access allowed');
class BStock extends MY_Controller
{
	public $table = 'tbl_product';
	public $table2 = 'tbl_product_category';
	public $page  = 'BStock';
	public function __construct()
	{
		parent::__construct();
		if (!$this->is_logged_in()) {
			redirect('/login');
		}
		$this->load->model('General_model');
		$this->load->model('BStock_model');
		  $this->load->model('HSNcode_model');
	}
	public function index()
	{
		$template['body'] = 'BStock/list';
		$template['script'] = 'BStock/script';
		$branch = ['branch_status'=> 1];
		$template['branch'] = $this->General_model->getall('tbl_branch',$branch);
		$this->load->view('template', $template);
	}
	
	public function get()
	{
		$this->load->model('BStock_model');
		$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
		$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
		$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
		$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
		$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';
		$param['branch'] = (isset($_REQUEST['branch'])) ? $_REQUEST['branch'] : '';
		$data = $this->BStock_model->getClassinfoTable($param);
		$json_data = json_encode($data);
		echo $json_data;
	}
	
}
