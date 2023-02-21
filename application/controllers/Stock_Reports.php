<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Stock_Reports extends MY_Controller {
	public $table = 'tbl_sale';
	public $tbl_stock = 'tbl_stock';
	public $page  = 'Salereport';
	public function __construct() {
		parent::__construct();
         if(! $this->is_logged_in()){
            redirect('/login');
        }
        $this->load->model('General_model');
		$this->load->model('Stock_report_model');
	}


	public function saleWisestock()
	{	$prid =$this->session->userdata('prid');
		$template['body'] = 'Stock_report/sws_list_print';
		$template['script'] = 'Stock_report/sws_script';
		$id= [
			'vendorstatus' => 1,
		];
		$template['supplier'] = $this->General_model->getall('tbl_vendor',$id);
		$template['records']=$this->Stock_report_model->getsaleWisestock1();
		$this->load->view('template', $template);
	}

	public function saleWisestock1()
	{
		$prid =$this->session->userdata('prid');
		$cdate=$this->input->post('start_date');
		$vendor_id=$this->input->post('vendor_id');
		$id= [
			'vendorstatus' => 1,
		];
		$template['supplier'] = $this->General_model->getall('tbl_vendor',$id);
		$template['body'] = 'Stock_report/sws_list_print';
		$template['script'] = 'Stock_report/sws_script';
		$template['records']=$this->Stock_report_model->getsaleWisestock($vendor_id,$cdate);
	    $template['cdate']=$cdate;
	    $template['vendor_id']=$vendor_id;
	    $this->load->view('template', $template);
	}


	public function physicalStock()
	{
		$template['body'] = 'Stock_report/ps_list_print';
		$template['script'] = 'Stock_report/ps_script';
		$prid =$this->session->userdata('prid');
		$template['product'] = $this->Stock_report_model->getitems_marmathews();
		$template['records']=$this->Stock_report_model->getphysicalStock1();
		$this->load->view('template', $template);
	}

	public function physicalStock1()
	{
		$prid =$this->session->userdata('prid');
		$product_name= $this->input->post('product_name');
		$product_id= $this->input->post('product_id');
		$cdate=$this->input->post('start_date');
		$edate=$this->input->post('end_date');
		$template['body'] = 'Stock_report/ps_list_print';
		$template['script'] = 'Stock_report/ps_script';
		$template['records']=$this->Stock_report_model->getphysicalStock($product_name,$product_id,$cdate,$edate);
		$template['product'] = $this->Stock_report_model->getitems_marmathews();
	    $template['cdate']=$cdate;
	    $template['edate']=$edate;
		$template['product_name']=$product_name;
	    $template['product_id']=$product_id;
	    $this->load->view('template', $template);
	}

	
}