<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Voucherhead extends MY_Controller {
	public $table = 'tbl_project_vouchhead';
	public $table1 = 'tbl_ledger';
	public $page  = 'Voucherhead';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->load->model('General_model');
		//$this->load->model('Student_model');
		$this->load->model('Voucherhead_model');
	}
	public function index()
	{
		$template['body'] = 'Voucherhead/list';
		$template['script'] = 'Voucherhead/script';
		
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('vouch_head', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			//$template['fin_year'] = $this->Student_model->get_finyear();
			$template['body'] = 'Voucherhead/add';
			$template['script'] = 'Voucherhead/script';
			
			$this->load->view('template', $template);
		}
		else {
			$vouch_id = $this->input->post('vouch_id');
			// $fin_year = $this->Student_model->get_finyear();
			// if(isset($fin_year->finyear_id)){$fyear = $fin_year->finyear_id;}else{$fyear =0;}
			
			$vouch_date = str_replace('/', '-', $this->input->post('vouch_date'));
			$vouch_date = date("Y-m-d",strtotime($vouch_date));
			
			$data = array(
						'vouch_head' =>strtoupper($this->input->post('vouch_head')),
						'vouch_desc' =>strtoupper($this->input->post('vouch_desc')),
						'vouch_status' => 1
						);
			$data1 = array(
						'ledger_head' =>strtoupper($this->input->post('vouch_head')),
						//'vouch_desc' =>strtoupper($this->input->post('vouch_desc')),
						'ledger_status' => 1
						);
						$result = $this->General_model->add($this->table1,$data1);
				if($vouch_id){
					 
                     $data['vouch_id'] = $vouch_id;
                     $result = $this->General_model->update($this->table,$data,'vouch_id',$vouch_id);
                     $response_text = 'Voucher Head  updated successfully';
                }
				else{
                     $result = $this->General_model->add($this->table,$data);
                     $response_text = 'Voucher Head added  successfully';
                }
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
				redirect('/Voucherhead/');
		}
	}
	public function get(){
		
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$data = $this->Voucherhead_model->getvouchTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function edit($vouch_id){
		$template['body'] = 'Voucherhead/add';
		$template['script'] = 'Voucherhead/script';
		
		$template['records'] = $this->General_model->get_row($this->table,'vouch_id',$vouch_id);
    	$this->load->view('template', $template);
	}
	public function delete(){
        $vouch_id = $this->input->post('vouch_id');
        $updateData = array('vouch_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'vouch_id',$vouch_id);
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