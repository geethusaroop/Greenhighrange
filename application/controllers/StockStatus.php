<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class StockStatus extends MY_Controller {
	public function __construct() {
		parent::__construct();
		$this->load->model('General_model');
		$this->load->model('Stockstatus_model');
	}
	public function index(){
		$template['body'] = 'StockStatus/list';
		$template['script'] = 'StockStatus/script';
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
    	$data = $this->Stockstatus_model->getStock($param,$branch_id_fk);
    	$json_data = json_encode($data);
    	echo $json_data;
	}

	//Purchase History
	public function purchase($product_id){
		$template['body'] = 'StockStatus/list-purchase';
		$template['script'] = 'StockStatus/script-purchase';
		$template['product_id'] =$product_id;
		$template['records']= $this->Stockstatus_model->getPurchaseReports($product_id);
		$template['record'] = $this->General_model->get_row('tbl_product', 'product_id', $product_id);
		$this->load->view('template', $template);
	}


	public function sale($product_id){
		$template['body'] = 'StockStatus/list-sale';
		$template['script'] = 'StockStatus/script-purchase';
		$template['product_id'] =$product_id;
		$template['records']= $this->Stockstatus_model->itemSaleRportLists($product_id);
		$template['record'] = $this->General_model->get_row('tbl_product', 'product_id', $product_id);
		$this->load->view('template', $template);
	}

	public function production($product_id){
		$template['body'] = 'StockStatus/list-product';
		$template['script'] = 'StockStatus/script-purchase';
		$template['product_id'] =$product_id;
		$template['records']= $this->Stockstatus_model->getstocktransfer($product_id);
		$template['record'] = $this->General_model->get_row('tbl_product', 'product_id', $product_id);
		$this->load->view('template', $template);
	}


	public function branchstock($product_id){
		$template['body'] = 'StockStatus/list-bstock';
		$template['script'] = 'StockStatus/script-purchase';
		$template['product_id'] =$product_id;
		$template['records']= $this->Stockstatus_model->getbranchtransfer($product_id);
		$template['record'] = $this->General_model->get_row('tbl_product', 'product_id', $product_id);
		$this->load->view('template', $template);
	}


	public function damage($product_id){
		$template['body'] = 'StockStatus/list-damage';
		$template['script'] = 'StockStatus/script-purchase';
		$template['product_id'] =$product_id;
		$template['records']= $this->Stockstatus_model->getdamage($product_id);
		$template['record'] = $this->General_model->get_row('tbl_product', 'product_id', $product_id);
		$this->load->view('template', $template);
	}

}
