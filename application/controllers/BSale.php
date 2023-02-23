<?php
ob_start();
require 'vendor/autoload.php';
use Dompdf\Dompdf;
defined('BASEPATH') OR exit('No direct script access allowed');
class BSale extends MY_Controller {
	public $table = 'tbl_sale';
	public $tbl_stock = 'tbl_product';
	public $page  = 'BSale';
	public function __construct() {
		parent::__construct();
         if(! $this->is_logged_in()){
            redirect('/login');
        }
        $this->load->model('General_model');
		$this->load->model('BSale_model');
		$this->load->model('Purchase_model');
	//	$this->load->model('Customer_model');
		$this->load->model('Dashboard_model');
	}
	public function index()
	{
		$branch = ['branch_status'=> 1];
		$template['branch'] = $this->General_model->getall('tbl_branch',$branch);
		$template['body'] = 'BSale/list';
		$template['script'] = 'BSale/script';
		$this->load->view('template',$template);
	}
	
	public function get(){
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$param['product_num'] = (isset($_REQUEST['product_num']))?$_REQUEST['product_num']:'';
		$param['branch'] = (isset($_REQUEST['branch']))?$_REQUEST['branch']:'';
		$param['start_date'] =(isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';
        $param['end_date'] =(isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';
		$data = $this->BSale_model->getSaleReport($param);
		$json_data = json_encode($data);
    	echo $json_data;
    }
	
}
