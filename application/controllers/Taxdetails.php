<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Taxdetails extends MY_Controller {
	public $table = 'tbl_taxdetails';
	public $page  = 'Taxdetails';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
		}
        
        $this->load->model('General_model');
		$this->load->model('Tax_model');
        
	}
	public function index()
	{
		$template['body'] = 'Tax/list';
		$template['script'] = 'Tax/script';
		$this->load->view('template', $template);
	}
	public function get(){
		
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Tax_model->getTaxTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function add(){
		$this->form_validation->set_rules('taxname', 'Tax Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['body'] = 'Tax/add';
			$template['script'] = 'Tax/script';
			$this->load->view('template', $template);
		}
		else {
			$tax_id = $this->input->post('tax_id');
			
			$data = array(
						'taxname'=> $this->input->post('taxname'),
						'taxamount' => $this->input->post('taxamount'),
						'taxdetails' => $this->input->post('taxdetails'),
						'tax_status' => 1
						);
			if($tax_id){
				 
				 $data['tax_id'] = $tax_id;
				 $result = $this->General_model->update($this->table,$data,'tax_id',$tax_id);
				 $response_text = 'Tax Details updated';
			}
			else{
				$result = $this->General_model->add($this->table,$data);
				$response_text = 'Tax Details Added';
			}
			if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
	        redirect('/Taxdetails/', 'refresh');
		}
	}
	public function edit($tax_id){
		$template['body'] = 'Tax/add';
		$template['script'] = 'Tax/script';
		$template['records'] = $this->General_model->get_row($this->table,'tax_id',$tax_id);
    	$this->load->view('template', $template);
	}
	public function delete(){
       
        $tax_id = $this->input->post('tax_id');
        $updateData = array('tax_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'tax_id',$tax_id);                       
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
        // redirect('/Taxdetails/', 'refresh');
    }
}