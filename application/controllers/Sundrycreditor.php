<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Sundrycreditor extends MY_Controller {
	public $table = 'tbl_purchase';
	public $page  = 'Sundrycreditor';
	public function __construct() {
		parent::__construct();
         if(! $this->is_logged_in()){
            redirect('/login');
        }
        $this->load->model('General_model');
		$this->load->model('Purchasereport_model');
		$this->load->model('Bankdeposit_model');
	}
	public function index()
	{
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['body'] = 'Sundrycreditor/list';
		$template['script'] = 'Sundrycreditor/script';
		$template['records']=$this->Purchasereport_model->getsundrycreditors($branch_id_fk);
		$this->load->view('template', $template);
	}

	public function debtors()
	{
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['body'] = 'Sundrycreditor/list-debtor';
		$template['script'] = 'Sundrycreditor/script-debtor';
		$template['records']=$this->Purchasereport_model->getsundrydebtors($branch_id_fk);
		$this->load->view('template', $template);
	}

	public function bdebtors()
	{
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['body'] = 'Sundrycreditor/list-bdebtor';
		$template['script'] = 'Sundrycreditor/script-debtor';
		$template['member'] = $this->Bankdeposit_model->view_by();
		$template['records']=$this->Purchasereport_model->getsundrybdebtors($branch_id_fk);
		$this->load->view('template', $template);
	}


	public function add_opening_balance()
	{
		$bmb_member_id_fk=$this->input->post('bmb_member_id_fk');
		$cdate=$this->input->post('bmb_opening_date');
		$closing_amt=$this->input->post('bmb_opening_balance');
		$updateData = array('bmb_opening_date'=>$cdate,
		'bmb_opening_balance'=>$closing_amt,
		);
		$result = $this->General_model->update('tbl_branch_member_balance',$updateData,'bmb_member_id_fk',$bmb_member_id_fk);
		$response_text = 'Opening Balance Added  successfully';
		if($result){
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
			$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
		redirect('/Sundrycreditor/bdebtors/', 'refresh');
	}


}