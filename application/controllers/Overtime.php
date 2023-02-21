<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Overtime extends MY_Controller {
	public $table = 'tbl_overtime';
	public $page  = 'Overtime';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->load->model('General_model');
        $this->load->model('Overtime_model');
		$this->load->model('Employee_model');
	}
	public function index()
	{
		
		$template['body'] = 'Overtime/list';
		$template['script'] = 'Overtime/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('emp_id', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			
			$template['body'] = 'Overtime/add';
			$template['script'] = 'Overtime/script';
			$template['emp_names'] = $this->Employee_model->view_by();
			$this->load->view('template', $template);
		}
		else {
			$overtym_date = str_replace('/', '-', $this->input->post('overtym_date'));
			$overtym_date = date("Y-m-d",strtotime($overtym_date));
			
			$data = array(
						'emp_id_fk' => $this->input->post('emp_id'),
						'total_amount' => $this->input->post('overtym_amt'),
						'overtym_hrs' => $this->input->post('overtym_hrs'),
						'overtym_date' => $overtym_date,
						'overtym_status' => 1
						);
				$overtym_id = $this->input->post('overtym_id');
				if($overtym_id){
					 
                     $data['overtym_id'] = $overtym_id;
                     $result = $this->General_model->update($this->table,$data,'overtym_id',$overtym_id);
                     $response_text = 'Overtime  updated successfully';
                }
				else{
                     $result = $this->General_model->add($this->table,$data);
                     $response_text = 'Overtime added  successfully';
                }
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
	        redirect('/Overtime/', 'refresh');
		}
	}
	public function get(){
		$this->load->model('Overtime_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Overtime_model->getOvertimeTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function delete(){
        $overtym_id = $this->input->post('overtym_id');
        $updateData = array('overtym_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'overtym_id',$overtym_id);
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
	public function edit($overtym_id){
		
		$template['body'] = 'Overtime/add';
		$template['script'] = 'Overtime/script';
		$template['emp_names'] = $this->Employee_model->view_by();
		$template['records'] = $this->General_model->get_row($this->table,'overtym_id',$overtym_id);
    	$this->load->view('template', $template);
	}
}