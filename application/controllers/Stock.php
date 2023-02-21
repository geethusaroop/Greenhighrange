<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stock extends MY_Controller {
	public $table = '';
	public $page  = 'Drivers';
	public function __construct() {
		parent::__construct();
		$this->load->model('General_model');
		$this->load->model('Stock_model');
	}
	public function index(){
		$template['body'] = 'Stock/list';
		$template['script'] = 'Stock/script';
		$this->load->view('template', $template);
	}
	public function getStockDetails(){
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
    	$data = $this->Stock_model->getstock($param,$branch_id_fk);
		//echo $data;
    	$json_data = json_encode($data);
    	echo $json_data;
	}
}
