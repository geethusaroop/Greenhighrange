<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bankdeposit extends MY_Controller {
	public $table = 'tbl_bank_deposit';
	public $page  = 'Bankdeposit';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->load->model('General_model');
		$this->load->model('Vendor_model');
		$this->load->model('Voucher_model');
		$this->load->model('Bank_model');
		$this->load->model('Bankdeposit_model');
	}
	public function index()
	{
		$template['body'] = 'Bankdeposit/list';
		$template['script'] = 'Bankdeposit/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('bd_bank_id_fk', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['body'] = 'Bankdeposit/add';
			$template['script'] = 'Bankdeposit/script';
			$template['bank'] = $this->Bank_model->view_by();
			$template['member'] = $this->Bankdeposit_model->view_by();
			$this->load->view('template', $template);
		}
		else {
			$bd_id = $this->input->post('bd_id');
			$data = array(
						'bd_bank_id_fk' =>$this->input->post('bd_bank_id_fk'),	
						'bd_type' =>$this->input->post('bd_type'),						
						'bd_member_id_fk' =>$this->input->post('bd_member_id_fk'),	
						'bd_amount' =>$this->input->post('bd_amount'),
						'bd_date' =>$this->input->post('bd_date'),
						'bd_remark' =>$this->input->post('bd_remark'),
						'bd_status' => 1
						);
				if($bd_id){
					 
                     $data['bd_id'] = $bd_id;
                     $result = $this->General_model->update($this->table,$data,'bd_id',$bd_id);
                     $response_text = 'Bankdeposit Details updated successfully';
                }
				else{
				    $result =  $this->General_model->add($this->table,$data);
                     $response_text = 'Bankdeposit Details added  successfully';
					 
                }
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
				redirect('/Bankdeposit/');
		}
	}


	public function get(){
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$data = $this->Bankdeposit_model->getSupplierTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }


	public function edit($bd_id){
		$template['body'] = 'Bankdeposit/add';
		$template['script'] = 'Bankdeposit/script';
		$template['bank'] = $this->Bank_model->view_by();
			$template['member'] = $this->Bankdeposit_model->view_by();
		$template['records'] = $this->General_model->get_row($this->table,'bd_id',$bd_id);
    	$this->load->view('template', $template);
	}


	public function delete(){
        $bd_id = $this->input->post('bd_id');
        $updateData = array('bd_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'bd_id',$bd_id);
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