<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Purchase_Report extends MY_Controller {
	public $table = 'tbl_sale';
	public $page  = 'Purchasereport';
	public function __construct() {
		parent::__construct();
         if(! $this->is_logged_in()){
            redirect('/login');
        }
        $this->load->model('General_model');
		$this->load->model('Purchasereport_model');
        $this->load->model('Purchase_report_model');
	}
	/* public function suppilerPurchase()
	{
		$template['body'] = 'Purchase_report/supp_list';
		$template['script'] = 'Purchase_report/supp_script';
		//$template['product_num'] = $this->Purchase_report_model->get_productnum();
        $id = [
            'vendorstatus' => 1,
        ];
        $template['supplier'] = $this->General_model->getall('tbl_vendor',$id);
		$this->load->view('template', $template);
	} */

    public function suppilerPurchase()
	{$prid= $this->session->userdata('prid');
		$template['body'] = 'Purchase_report/supp_list';
		$template['script'] = 'Purchase_report/supp_script';
        $id = [
            'vendorstatus' => 1,
        ];
        $template['supplier'] = $this->General_model->getall('tbl_vendor',$id);
        $template['records']=$this->Purchase_report_model->getPurchaseReports();
		$this->load->view('template', $template);
	}

    public function suppilerPurchase1()
	{   
        $prid= $this->session->userdata('prid');
        $cdate=$this->input->post('start_date');
		$edate=$this->input->post('end_date');
		$vendor_id=$this->input->post('vendor_id');
		$template['body'] = 'Purchase_report/supp_list';
		$template['script'] = 'Purchase_report/supp_script';
        $id = [
            'vendorstatus' => 1,
        ];
        $template['supplier'] = $this->General_model->getall('tbl_vendor',$id);
        $template['records']=$this->Purchase_report_model->getPurchaseReports1($vendor_id,$cdate,$edate);
        $template['cdate']=$cdate;
		$template['edate']=$edate;
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
        
	//	$start_date =(isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';
     //   $end_date =(isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';
     $param['start_date'] =(isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';
     $param['end_date'] =(isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';
		$param['vendor_id'] = (isset($_REQUEST['vendor_id']))?$_REQUEST['vendor_id']:'';
		
        /* if($start_date){
            $start_date = str_replace('/', '-', $start_date);
            $param['start_date'] =  date("Y-m-d",strtotime($start_date));
        }
       
        if($end_date){
            $end_date = str_replace('/', '-', $end_date);
            $param['end_date'] =  date("Y-m-d",strtotime($end_date));
        } */
		
		$data = $this->Purchase_report_model->getPurchaseReport($param,$prid);
		$json_data = json_encode($data);
    	echo $json_data;
    }
#################################################################################################################################################
    //item wise purchase report

    public function itemPurchase()
	{
		$template['body'] = 'Purchase_report/item_list';
		$template['script'] = 'Purchase_report/item_script';
        $id = [
            'product_status' => 1,
        ];
       $prid =$this->session->userdata('prid');
       $template['product'] = $this->Purchase_report_model->getitems();
       $template['records']=$this->Purchase_report_model->getitemPurchaseReports();
		$this->load->view('template', $template);
	}

    public function itemPurchase1()
	{   
        $prid= $this->session->userdata('prid');
        $cdate=$this->input->post('start_date');
		$edate=$this->input->post('end_date');
		$product_id=$this->input->post('product_id');
		$template['body'] = 'Purchase_report/item_list';
		$template['script'] = 'Purchase_report/item_script';
        $id = [
            'product_status' => 1,
        ];
       $template['product'] = $this->Purchase_report_model->getitems();
        $template['records']=$this->Purchase_report_model->getitemPurchaseReports1($product_id,$cdate,$edate);
        $template['cdate']=$cdate;
		$template['edate']=$edate;
	    $template['product_id']=$product_id;
		$this->load->view('template', $template);
	}

	public function getitemPurchase(){
		$prid= $this->session->userdata('prid');
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['start_date'] =(isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';
        $param['end_date'] =(isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';
		$param['product_id'] = (isset($_REQUEST['product_id']))?$_REQUEST['product_id']:'';
		
       /*  if($start_date){
            $start_date = str_replace('/', '-', $start_date);
            $param['start_date'] =  date("Y-m-d",strtotime($start_date));
        }
       
        if($end_date){
            $end_date = str_replace('/', '-', $end_date);
            $param['end_date'] =  date("Y-m-d",strtotime($end_date));
        } */
		
		$data = $this->Purchase_report_model->getitemPurchaseReport($param,$prid);
		$json_data = json_encode($data);
    	echo $json_data;
    }
}