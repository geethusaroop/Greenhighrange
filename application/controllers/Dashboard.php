<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends MY_Controller {
	public $table = 'sale_details';
	public $table1 = 'product_details';
	public $page  = 'Dashboard';
	public $stock_table  = 'stock_details';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
		  
		$this->load->helper('url');
		$this->load->helper('file');
		$this->load->helper('download');
		$this->load->library('zip');
        }
        
        $this->load->model('General_model');
        $this->load->model('Dashboard_model');
        $this->load->model('fetch_data');
	}
	public function index()
	{
		$template['fin_year'] = $this->fetch_data->fin_year();
		$template['body'] = 'Dashboard/list';
		$template['script'] = 'Dashboard/script';
		
		$this->load->view('template', $template);
	}
	public function get(){
		$this->load->model('Dashboard_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$param['product_name'] =(isset($_REQUEST['product_name']))?$_REQUEST['product_name']:'';
    	$data = $this->Dashboard_model->getoldstock($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function database_backup()
	{
		$this->load->dbutil();
		$db_format=array('format'=>'zip','filename'=>'wh_erp.sql');
		$backup= $this->dbutil->backup($db_format);
		$dbname='backup-on-'.date('Y-m-d').'.zip';
		$save='assets/db_backup/'.$dbname;
		write_file($save,$backup);
		force_download($dbname,$backup);
	}
	

	public function getLicenses()
	{
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$result = $this->Dashboard_model->getLicensesDetails($param);
		echo json_encode($result);
	}

}