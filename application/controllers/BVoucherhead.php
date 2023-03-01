<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BVoucherhead extends MY_Controller {
	public $table = 'tbl_branch_vouchhead';
	public $page  = 'BVoucherhead';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->load->model('General_model');
		//$this->load->model('Student_model');
		$this->load->model('BVoucherhead_model');
	}
	public function index()
	{
		$template['body'] = 'BVoucherhead/list';
		$template['script'] = 'BVoucherhead/script';
		
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('vouch_head', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['body'] = 'BVoucherhead/add';
			$template['script'] = 'BVoucherhead/script';
			
			$this->load->view('template', $template);
		}
		else {
			$vouch_id = $this->input->post('vouch_id');
		
			$vouch_date = str_replace('/', '-', $this->input->post('vouch_date'));
			$vouch_date = date("Y-m-d",strtotime($vouch_date));
			
			$data = array(
						'vouch_branch_id_fk' =>$this->session->userdata('branch_id_fk'),	
						'vouch_head' =>strtoupper($this->input->post('vouch_head')),
						'vouch_desc' =>strtoupper($this->input->post('vouch_desc')),
						'vouch_status' => 1
						);
		
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
				redirect('/BVoucherhead/');
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
        
		$data = $this->BVoucherhead_model->getvouchTable($param,$branch_id_fk);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function edit($vouch_id){
		$template['body'] = 'BVoucherhead/add';
		$template['script'] = 'BVoucherhead/script';
		
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