<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Receipthead extends MY_Controller {
	public $table = 'tbl_project_receipthead';
	public $table1 = 'tbl_ledger';
	public $page  = 'Receipthead';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->load->model('General_model');
		//$this->load->model('Student_model');
		$this->load->model('Receipthead_model');
	}
	public function index()
	{
		
		$template['body'] = 'Receipthead/list';
		$template['script'] = 'Receipthead/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('receipt_head', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			//$template['fin_year'] = $this->Student_model->get_finyear();
			$template['body'] = 'Receipthead/add';
			$template['script'] = 'Receipthead/script';
			$this->load->view('template', $template);
		}
		else {
			$receipt_id = $this->input->post('receipt_id');
			// $fin_year = $this->Student_model->get_finyear();
			// if(isset($fin_year->finyear_id)){$fyear = $fin_year->finyear_id;}else{$fyear =0;}
			
			$receipt_date = str_replace('/', '-', $this->input->post('receipt_date'));
			$receipt_date = date("Y-m-d",strtotime($receipt_date));
			
			$data = array(
						//'receiptId' =>$this->input->post('receiptId'),						
						//'fin_year' =>$fyear,
						'receipt_head' =>strtoupper($this->input->post('receipt_head')),
						'receipt_desc'=>$this->input->post('receipt_desc'),
						'receipt_status' => 1
						);
			$data1 = array(
						'ledger_head' =>strtoupper($this->input->post('receipt_head')),
						//'vouch_desc' =>strtoupper($this->input->post('vouch_desc')),
						'ledger_status' => 1
						);
						$result = $this->General_model->add($this->table1,$data1);
				if($receipt_id){
					 
                     $data['receipt_id'] = $receipt_id;
                     $result = $this->General_model->update($this->table,$data,'receipt_id',$receipt_id);
                     $response_text = 'Receipt Head  updated successfully';
                }
				else{
                     $result = $this->General_model->add($this->table,$data);
                     $response_text = 'Receipt Head added  successfully';
                }
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
				redirect('/Receipthead/');
		}
	}
	public function get(){
		
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$data = $this->Receipthead_model->getreceiptheadTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function edit($receipt_id){
		
		$template['body'] = 'Receipthead/add';
		$template['script'] = 'Receipthead/script';
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
	
	
	
	
}