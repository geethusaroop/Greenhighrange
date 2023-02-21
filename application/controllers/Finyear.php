<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Finyear extends MY_Controller {
	public $table = 'tbl_finyear';
	public $page  = 'Finyear';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->load->model('General_model');
        $this->load->model('Finyear_model');
	}
	public function index()
	{
		$template['body'] = 'Finyear/list';
		$template['script'] = 'Finyear/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('fin_year', 'Year', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['body'] = 'Finyear/add';
			$template['script'] = 'Finyear/script';
			$this->load->view('template', $template);
		}
		else {
			$start_date = str_replace('/', '-', $this->input->post('start_date'));
			$start_date =  date("Y-m-d",strtotime($start_date));
			$end_date = str_replace('/', '-', $this->input->post('end_date'));
			$end_date =  date("Y-m-d",strtotime($end_date));
			$data = array(
						'fin_startdate' => $start_date,
						'fin_enddate' => $end_date,
						'fin_year' => $this->input->post('fin_year'),
						'finyear_status' => 1
						);
				$finyear_id = $this->input->post('finyear_id');
				if($finyear_id){
					 
                     $data['finyear_id'] = $finyear_id;
                     $result = $this->General_model->update($this->table,$data,'finyear_id',$finyear_id);
                     $response_text = 'FinancialYear  updated successfully';
                }
				else{
					 
					 $datas = array('finyear_status' => 0 );
                     $this->General_model->updatefin($this->table,$datas);
                     $result = $this->General_model->add($this->table,$data);
                     $response_text = 'FinancialYear added  successfully';
                }
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
				redirect('/Finyear/');
		}
	}
	public function get(){
		$this->load->model('Finyear_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Finyear_model->getFinyearTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function delete(){
        $finyear_id = $this->input->post('finyear_id');
        $updateData = array('finyear_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'finyear_id',$finyear_id);
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
		redirect('/Finyear/', 'refresh');
    }
	public function edit($finyear_id){
		$template['body'] = 'Finyear/add';
		$template['script'] = 'Finyear/script';
		$template['records'] = $this->General_model->get_row($this->table,'finyear_id',$finyear_id);
    	$this->load->view('template', $template);
	}
}