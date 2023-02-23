<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BStock_report extends MY_Controller {
	public $table = 'tbl_sale';
	public $tbl_stock = 'tbl_stock';
	public $page  = 'BStock_report';
	public function __construct() {
		parent::__construct();
         if(! $this->is_logged_in()){
            redirect('/login');
        }
        $this->load->model('General_model');
		$this->load->model('BStock_report_model');
	}


	public function physicalStock()
	{	$bid =$this->session->userdata('branch_id_fk');
		$template['body'] = 'BStock_report/ps_list_print';
		$template['script'] = 'BStock_report/ps_script';
		$branch = ['branch_status'=> 1];
		$template['branch'] = $this->General_model->getall('tbl_branch',$branch);
		$template['product'] = $this->BStock_report_model->getitems_marmathews($bid);
		$template['records']=$this->BStock_report_model->getphysicalStock1($bid);
		//var_dump($template['records']);die;
		$this->load->view('template', $template);
	}

	public function physicalStock1()
	{
		$bid =$this->session->userdata('branch_id_fk');
		$product_name= $this->input->post('product_name');
		$product_id= $this->input->post('product_id');
		$cdate=$this->input->post('start_date');
		$edate=$this->input->post('end_date');
		$template['body'] = 'Stock_report/ps_list_print';
		$template['script'] = 'Stock_report/ps_script';
		$branch = ['branch_status'=> 1];
		$template['branch'] = $this->General_model->getall('tbl_branch',$branch);
		$template['records']=$this->BStock_report_model->getphysicalStock($product_name,$product_id,$cdate,$edate,$bid);
		$template['product'] = $this->BStock_report_model->getitems_marmathews($bid);
	    $template['cdate']=$cdate;
	    $template['edate']=$edate;
		$template['bid']=$bid;
		$template['product_name']=$product_name;
	    $template['product_id']=$product_id;
	    $this->load->view('template', $template);
	}

	
}