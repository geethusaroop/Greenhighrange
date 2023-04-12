<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class SH_report extends MY_Controller {
	public $table = 'tbl_incentive';
	public $table1 = 'tbl_daybook';
	public $page  = 'Ledger';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
		$this->load->model('Ledger_model');
		$this->load->model('General_model');
		$this->load->model('Member_model');
		$this->load->model('Vendor_voucher_model');
    }

	public function index()
	{
		$template['body'] = 'SH_report/list-report';
		$template['script'] = 'SH_report/script';
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['member_names'] = $this->Vendor_voucher_model->view_by_shareholder($branch_id_fk);
		$this->load->view('template', $template);
	}

	public function getledger_report()
	{
		$shareholder_id_fk=$this->input->post('shareholder_id_fk');
		$cdate=$this->input->post('cdate');
		$edate=$this->input->post('edate');
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['member_names'] = $this->Vendor_voucher_model->view_by_shareholder($branch_id_fk);
		$template['body'] = 'SH_report/list-report';
		$template['script'] = 'SH_report/script';
		// $template['gid']=$gid;
	    $template['cdate']=$cdate;
	    $template['edate']=$edate;
	    $template['vendor']=$shareholder_id_fk;
		$template['sale']=$this->Vendor_voucher_model->get_shareholder_sale_report($cdate,$edate,$shareholder_id_fk);
	    $this->load->view('template', $template);

	}


	public function preport()
	{
		$template['body'] = 'SH_report/list-purchase-report';
		$template['script'] = 'SH_report/script';
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['member_names'] = $this->Vendor_voucher_model->view_by_shareholder_vendor($branch_id_fk);
		$this->load->view('template', $template);
	}

	public function getpledger_report()
	{
		$shareholder_id_fk=$this->input->post('shareholder_id_fk');
		$cdate=$this->input->post('cdate');
		$edate=$this->input->post('edate');
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['member_names'] = $this->Vendor_voucher_model->view_by_shareholder_vendor($branch_id_fk);
		$template['body'] = 'SH_report/list-purchase-report';
		$template['script'] = 'SH_report/script';
		// $template['gid']=$gid;
	    $template['cdate']=$cdate;
	    $template['edate']=$edate;
	    $template['vendor']=$shareholder_id_fk;
		$template['sale']=$this->Vendor_voucher_model->get_shareholder_purchase_report($cdate,$edate,$shareholder_id_fk);
	    $this->load->view('template', $template);

	}


	public function view()
	{
		$template['body'] = 'SH_report/list';
		$template['script'] = 'SH_report/script';
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['member_names'] = $this->Vendor_voucher_model->view_by_shareholder($branch_id_fk);
		$this->load->view('template', $template);
	}

	public function getledger()
	{
		$shareholder_id_fk=$this->input->post('shareholder_id_fk');
		$cdate=$this->input->post('cdate');
		$edate=$this->input->post('edate');
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['member_names'] = $this->Vendor_voucher_model->view_by_shareholder($branch_id_fk);
		$template['body'] = 'SH_report/list';
		$template['script'] = 'SH_report/script';
		// $template['gid']=$gid;
	    $template['cdate']=$cdate;
	    $template['edate']=$edate;
	    $template['vendor']=$shareholder_id_fk;
		$template['sale']=$this->Vendor_voucher_model->get_shareholder_sale_report($cdate,$edate,$shareholder_id_fk);
		$template['incent']=$this->Vendor_voucher_model->get_shareholder_incent_report($cdate,$edate,$shareholder_id_fk);
		$template['count']= count($template['incent']);
	    $this->load->view('template', $template);

	}

	public function add()
	{
			$data=array(
				'incent_branch_id_fk'=>$this->session->userdata('branch_id_fk'),
				'incent_member_id_fk' =>$this->input->post('incent_member_id_fk'),
				'incent_date' =>$this->input->post('incent_date'),
				'incent_total_purchase_amt' =>$this->input->post('incent_total_purchase_amt'),
				'incent_percent' =>$this->input->post('incent_percent'),
				'incent_amount' =>$this->input->post('incent_amount'),
				'incent_from_date' =>$this->input->post('incent_from_date'),
				'incent_to_date' =>$this->input->post('incent_to_date'),
				'incent_status'=>1
			);
		   $result = $this->General_model->add($this->table,$data);

		   $response_text = 'Incentive Added  Successfully';
	   
	   if($result){
	   $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
	   }
	   else{
	   $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
	   }
	   redirect('/SH_report/list_view', 'refresh');
	}

	public function list_view()
	{
		$template['body'] = 'SH_report/list2';
		$template['script'] = 'SH_report/script2';
		$this->load->view('template', $template);
	}

	public function get(){
		$branch_id_fk =$this->session->userdata('branch_id_fk');
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$data = $this->Vendor_voucher_model->getIncentiveTable($param,$branch_id_fk);
    	$json_data = json_encode($data);
    	echo $json_data;
    }

}