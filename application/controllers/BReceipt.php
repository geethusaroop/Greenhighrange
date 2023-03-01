<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BReceipt extends MY_Controller {
	public $table = 'tbl_branch_receipt';
	public $page  = 'BReceipt';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->load->model('General_model');
		$this->load->model('BReceipt_model');
		$this->load->model('BReceipthead_model');
	}
	public function index()
	{
		
		$template['body'] = 'BReceipt/list';
		$template['script'] = 'BReceipt/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('receipt_id', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$branch_id_fk=$this->session->userdata('branch_id_fk');
			$template['receiptnames'] = $this->BReceipthead_model->view_by1($branch_id_fk);
			$template['body'] = 'BReceipt/add';
			$template['script'] = 'BReceipt/script';
			$this->load->view('template', $template);
		}
		else {
			$receipt_id = $this->input->post('rece_id');
			// $fin_year = $this->Student_model->get_finyear();
			// if(isset($fin_year->finyear_id)){$fyear = $fin_year->finyear_id;}else{$fyear =0;}
			
			$created_date = str_replace('/', '-', $this->input->post('created_date'));
			$created_date = date("Y-m-d",strtotime($created_date));
			 
			$data = array(
			           // 'finyear_id_fk' =>$fyear,	
						'branch_id_fk' =>$this->session->userdata('branch_id_fk'),	
						'receipt_id_fk' =>$this->input->post('receipt_id'),	
						'receipt_number' =>$this->input->post('receipt_number'),
						'rept_date' =>$created_date,
						'receipt_amount' =>$this->input->post('receipt_amount'),						
						'paid_to' =>strtoupper($this->input->post('paid_to')),
						'narration' =>strtoupper($this->input->post('narration')),
						'receipt_status' => 1
						);
			//print_r($data);exit;
						
				if($receipt_id){
					 
                     $data['receipt_id'] = $receipt_id;
                     $result = $this->General_model->update($this->table,$data,'receipt_id',$receipt_id);
                     $response_text = 'BReceipt updated successfully';
                }
				else{
				    $result = $this->General_model->add($this->table,$data);
					
					$response_text = 'BReceipt added  successfully';
                }
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
				redirect('/BReceipt/');
		}
	}
	public function get(){
		$branch_id_fk =$this->session->userdata('branch_id_fk');
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$data = $this->BReceipt_model->getreceiptTable($param,$branch_id_fk);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function edit($receipt_id){
		
		$template['body'] = 'BReceipt/add';
		$template['script'] = 'BReceipt/script';
		$branch_id_fk=$this->session->userdata('branch_id_fk');
			$template['receiptnames'] = $this->BReceipthead_model->view_by1($branch_id_fk);
		$template['records'] = $this->General_model->get_row($this->table,'receipt_id',$receipt_id);
    	$this->load->view('template', $template);
	}
	public function delete(){
        $receipt_id = $this->input->post('receipt_id');
        $updateData = array('receipt_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'receipt_id',$receipt_id);
        if($data) {
            $response['text'] = 'Deleted successfully';
            $response['type'] = 'success';
        }
        else{
            $response['text'] = 'Something went wrong';
            $response['type'] = 'error';
        }
        $response['layout'] = 'topRight';
        $data_json = json_encode($response);
        echo $data_json;
    }
	public function get_receipthead()
	{
		 $receipt_id = $this->input->post('receipt_id');
		 $result = $this->BReceipt_model->get_receipthead($receipt_id);
		 $data_json = json_encode($result);
		 echo $data_json;
	}
	public function treceipt($receipt_id){
		
		$template['body'] = 'BReceipt/breceipt';
		$template['script'] = 'BReceipt/script-breceipt';
		$template['records'] = $this->BReceipt_model->getreceipt($receipt_id);
		$this->load->view('template', $template);
	}
	
	
	
}