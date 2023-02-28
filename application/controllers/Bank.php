<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bank extends MY_Controller {
	public $table = 'tbl_bank';
	public $page  = 'Bank';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->load->model('General_model');
		$this->load->model('Vendor_model');
		$this->load->model('Voucher_model');
		$this->load->model('Bank_model');
	}
	public function index()
	{
		$template['body'] = 'Bank/list';
		$template['script'] = 'Bank/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('bank_name', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['body'] = 'Bank/add';
			$template['script'] = 'Bank/script';
			$this->load->view('template', $template);
		}
		else {
			$bank_id = $this->input->post('bank_id');
			$data = array(
						'bank_name' =>$this->input->post('bank_name'),	
						'bank_address' =>$this->input->post('bank_address'),						
						'bank_branch' =>$this->input->post('bank_branch'),	
						'bank_accno' =>$this->input->post('bank_accno'),
						'bank_ifsc' =>$this->input->post('bank_ifsc'),
						'bank_status' => 1
						);
				if($bank_id){
					 
                     $data['bank_id'] = $bank_id;
                     $result = $this->General_model->update($this->table,$data,'bank_id',$bank_id);
                     $response_text = 'Bank Details updated successfully';
                }
				else{
				    $result =  $this->General_model->add($this->table,$data);
                     $response_text = 'Bank Details added  successfully';
					 
                }
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
				redirect('/Bank/');
		}
	}


	public function get(){
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$data = $this->Bank_model->getSupplierTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }


	public function edit($bank_id){
		$template['body'] = 'Bank/add';
		$template['script'] = 'Bank/script';
		$template['records'] = $this->General_model->get_row($this->table,'bank_id',$bank_id);
    	$this->load->view('template', $template);
	}


	public function delete(){
        $bank_id = $this->input->post('bank_id');
        $updateData = array('bank_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'bank_id',$bank_id);
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