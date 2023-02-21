<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Salereport extends MY_Controller {

	public $table = 'tbl_sale';

	public $tbl_stock = 'tbl_stock';

	public $page  = 'Salereport';

	public function __construct() {

		parent::__construct();

         if(! $this->is_logged_in()){

            redirect('/login');

        }

        $this->load->model('General_model');

		$this->load->model('Salereport_model');

	}

	public function index()
	{
		$template['body'] = 'Salereport/list';

		$template['script'] = 'Salereport/script';
		$prid =$this->session->userdata('prid');
		$template['records']=$this->Salereport_model->getSaleReports($prid);
		$this->load->view('template', $template);
	}

	public function getSaleReport()
	{
		$template['body'] = 'Salereport/list';
		$template['script'] = 'Salereport/script';
		$prid =$this->session->userdata('prid');
		$cdate=$this->input->post('start_date');
		$edate=$this->input->post('end_date');
		$invno=$this->input->post('purchase_invoice_no');
		$template['records']=$this->Salereport_model->getSaleReports1($cdate,$edate,$prid,$invno);
		$template['cdate']=$cdate;
		$template['edate']=$edate;
		$template['invoice_no']=$invno;
		$this->load->view('template', $template);
	}


	public function get(){

		 $prid =$this->session->userdata('prid');

		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';

        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 

        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';

        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';

        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';

        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';

        

		$param['start_date'] =(isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';

		$param['end_date'] =(isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';

		$param['invoice_no'] = (isset($_REQUEST['invoice_no']))?$_REQUEST['invoice_no']:'';

		$param['product_num1'] = (isset($_REQUEST['product_num1']))?$_REQUEST['product_num1']:'';

		

        /* if($start_date){

            $start_date = str_replace('/', '-', $start_date);

            $param['start_date'] =  date("Y-m-d",strtotime($start_date));

        }

       

        if($end_date){

            $end_date = str_replace('/', '-', $end_date);

            $param['end_date'] =  date("Y-m-d",strtotime($end_date));

        } */

		

		$sessid = $this->session->userdata['id'];

		$shopid = $this->Salereport_model->get_shop($sessid);

		if(isset($shopid[0]->shop_id_fk)){$shid=$shopid[0]->shop_id_fk;}else{$shid=0;}

		$param['shop'] =$shid;

		

		$data = $this->Salereport_model->getSaleReport($param,$prid);

		$json_data = json_encode($data);

    	echo $json_data;

    }

}