<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Fund extends MY_Controller {
	public $table = 'tbl_fund';
	public $page  = 'Fund';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->load->model('General_model');
		$this->load->model('Vendor_model');
		$this->load->model('Voucher_model');
		$this->load->model('Fund_model');
	}
	public function index()
	{
		$template['body'] = 'Fund/list';
		$template['script'] = 'Fund/script';
		$template['ftype'] = $this->Fund_model->view_by1();
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('ftype_id_fk', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$branch_id_fk=$this->session->userdata('branch_id_fk');
			$template['ftype'] = $this->Fund_model->view_by();
			$template['body'] = 'Fund/add';
			$template['script'] = 'Fund/script';
			$this->load->view('template', $template);
		}
		else {
			$fund_id = $this->input->post('fund_id');
			$fund_date = $this->input->post('fund_date');
			$fund_year = date("Y",strtotime($fund_date));
			$data = array(
						'fund_branch_id_fk' =>$this->session->userdata('branch_id_fk'),	
						'ftype_id_fk' =>$this->input->post('ftype_id_fk'),	
						'fund_amount' =>$this->input->post('fund_amount'),						
						'fund_year' =>$fund_year,	
						'fund_date' =>$fund_date,
						'fund_des' =>strtoupper($this->input->post('fund_des')),
						'fund_status' => 1
						);
				if($fund_id){
					 
                     $data['fund_id'] = $fund_id;
                     $result = $this->General_model->update($this->table,$data,'fund_id',$fund_id);
                     $response_text = 'Fund Details updated successfully';
                }
				else{
				    $result =  $this->General_model->add($this->table,$data);
                     $response_text = 'Fund Details added  successfully';
					 
                }
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
				redirect('/Fund/');
		}
	}


	public function get(){
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
         $param['cat_type'] = (isset($_REQUEST['cat_type']))?$_REQUEST['cat_type']:'';
		$data = $this->Fund_model->getSupplierTable($param,$branch_id_fk);
    	$json_data = json_encode($data);
    	echo $json_data;
    }


	public function edit($fund_id){
		$template['body'] = 'Fund/add';
		$template['script'] = 'Fund/script';
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['ftype'] = $this->Fund_model->view_by();
		$template['records'] = $this->General_model->get_row($this->table,'fund_id',$fund_id);
    	$this->load->view('template', $template);
	}


	public function delete(){
        $fund_id = $this->input->post('fund_id');
        $updateData = array('fund_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'fund_id',$fund_id);
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