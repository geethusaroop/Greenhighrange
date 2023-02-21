<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Advancepayments extends MY_Controller {
	public $table = 'tbl_advancepayment';
	public $page  = 'Advancepayments';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        $this->load->model('General_model');
        $this->load->model('Advancepayments_model');
		//$this->load->model('Department_model');
		$this->load->model('Employee_model');
	}
	public function index()
	{
		
		$template['body'] = 'Advancepayments/list';
		$template['script'] = 'Advancepayments/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('emp_id', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			
			$template['body'] = 'Advancepayments/add';
			$template['script'] = 'Advancepayments/script';
			//$template['department_names'] = $this->Department_model->view_by();
			$template['emp_names'] = $this->Employee_model->view_by();
			$this->load->view('template', $template);
		}
		else {
			$adv_date = str_replace('/', '-', $this->input->post('adv_date'));
			$adv_date = date("Y-m-d",strtotime($adv_date));
			$data = array(
						'adv_date' =>$adv_date,
						'emp_id_fk' => $this->input->post('emp_id'),
						'adv_amount' => $this->input->post('adv_amt'),
						'remaining_amount' => $this->input->post('total_sal'),
						'adv_status' => 1
						);
				$adv_id = $this->input->post('adv_id');
				if($adv_id){

                     $data['adv_id'] = $adv_id;
                     $result = $this->General_model->update($this->table,$data,'adv_id',$adv_id);
                     $response_text = 'Advancepayments  updated successfully';
                }
				else{
                     $result = $this->General_model->add($this->table,$data);
                     $response_text = 'Advancepayments added  successfully';
                }
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
	        redirect('/Advancepayments/', 'refresh');
		}
	}
	public function get(){
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';

    	$data = $this->Advancepayments_model->getCategoryTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	function get_values()
	{
		$emp_id = $this->input->post('emp_id');
		$result = $this->Payroll_model->get_values($emp_id);
		$json_data = json_encode($result);
    	echo $json_data;
	}
	public function delete(){
        $adv_id = $this->input->post('adv_id');
        $updateData = array('adv_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'adv_id',$adv_id);
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
	public function edit($adv_id){
		
		$template['body'] = 'Advancepayments/add';
		$template['script'] = 'Advancepayments/script';
		//$template['department_names'] = $this->Department_model->view_by();
		$template['emp_names'] = $this->Employee_model->view_by();
		$template['records'] = $this->General_model->get_row($this->table,'adv_id',$adv_id);
    	$this->load->view('template', $template);
	}
}
