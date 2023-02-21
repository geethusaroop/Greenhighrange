<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Purchasereport extends MY_Controller {

	public $table = 'tbl_sale';

	public $page  = 'Purchasereport';

	public function __construct() {

		parent::__construct();

         if(! $this->is_logged_in()){

            redirect('/login');

        }

        $this->load->model('General_model');

		$this->load->model('Purchasereport_model');

	}

	public function index()

	{
		$prid= $this->session->userdata('prid');
		$template['body'] = 'Purchasereport/list';

		$template['script'] = 'Purchasereport/script';

		$template['product_num'] = $this->Purchasereport_model->get_productnum();
		$template['records']=$this->Purchasereport_model->getPurchaseReports();
		$this->load->view('template', $template);

	}

	public function getPurchaseReports()
	{
		$prid =$this->session->userdata('prid');
		$cdate=$this->input->post('start_date');
		$edate=$this->input->post('end_date');
		$vendor_id=$this->input->post('vendor_id');
		$invno=$this->input->post('purchase_invoice_no');
		$id= [
			'vendorstatus' => 1,
		];
		$template['supplier'] = $this->General_model->getall('tbl_vendor',$id);
		$template['body'] = 'Purchasereport/list';
		$template['script'] = 'Purchasereport/script';
		$template['records']=$this->Purchasereport_model->getPurchaseReports1($vendor_id,$cdate,$edate,$invno);
	    $template['cdate']=$cdate;
		$template['edate']=$edate;
		$template['invoice_no']=$invno;
	    $template['vendor_id']=$vendor_id;
	    $this->load->view('template', $template);
	}

	public function get(){

		$prid= $this->session->userdata('prid');

		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';

        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 

        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';

        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';

        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';

        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';

        

		$param['start_date']  =(isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';

		$param['end_date'] =(isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';

		$param['invoice_no'] = (isset($_REQUEST['invoice_no']))?$_REQUEST['invoice_no']:'';

		$param['product_num1'] = (isset($_REQUEST['product_num1']))?$_REQUEST['product_num1']:'';

		$data = $this->Purchasereport_model->getPurchaseReport($param,$prid);

		$json_data = json_encode($data);

    	echo $json_data;

    }

}