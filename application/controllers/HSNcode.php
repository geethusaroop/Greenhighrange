<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class HSNcode extends MY_Controller {
	public $table = 'tbl_hsncode';
	public $page  = 'HSNcode';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
		}
        $this->load->model('General_model');
		$this->load->model('HSNcode_model');
          // $this->load->model('Project_model');
	}
	public function index()
	{
		$template['body'] = 'HSNcode/list';
		$template['script'] = 'HSNcode/script';
		$this->load->view('template', $template);
	}
	public function get(){
		$this->load->model('HSNcode_model');
		// $prid= $this->session->userdata('prid');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';

    	$data = $this->HSNcode_model->getHSNcodeTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function add(){
		$this->form_validation->set_rules('hsncode', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['body'] = 'HSNcode/add';
			$template['script'] = 'HSNcode/script';
			 $prid =$this->session->userdata('prid');
			 $template['prid'] = $prid;
			// $template['project']=$this->Project_model->getproject($prid);

			$this->load->view('template', $template);
		}
		else {

			$data = array(
						// 'hsn_project_id_fk' => $this->session->userdata('prid'),
						'hsncode' => $this->input->post('hsncode'),
						'unique_hsncode' => $this->input->post('unique_hsncode'),
						'description' => $this->input->post('description'),
						'goods_service' => $this->input->post('goods_service'),
						'hsn_igst' => $this->input->post('hsn_igst'),
						'hsn_sgst' => $this->input->post('hsn_sgst'),
						'hsn_cgst' => $this->input->post('hsn_cgst'),
						'hsn_cess' => $this->input->post('hsn_cess'),
						'hsn_comcess' => $this->input->post('hsn_comcess'),
						'hsn_flood_cess' => $this->input->post('hsn_flood_cess'),
						'hsn_status' => 1
						);

			$hsn_id = $this->input->post('hsn_id');
			if($hsn_id){

				$data['hsn_id'] = $hsn_id;

				$result = $this->General_model->update($this->table,$data,'hsn_id',$hsn_id);


				$response_text = 'HSNcode details updated';
			}
			else{

				$result = $this->General_model->add($this->table,$data);

				$response_text = 'HSNcode details Added';
			}
			if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
	        redirect('/HSNcode/', 'refresh');
		}
	}
	public function edit($hsn_id){
		$template['body'] = 'HSNcode/add';
		$template['script'] = 'HSNcode/script';
		$prid =$this->session->userdata('prid');
		$template['prid'] = $prid;
		// $template['project']=$this->Project_model->getproject($prid);
		$template['records'] = $this->General_model->get_row($this->table,'hsn_id',$hsn_id);
    	$this->load->view('template', $template);
	}
	public function delete(){

        $hsn_id = $this->input->post('hsn_id');
        $updateData = array('hsn_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'hsn_id',$hsn_id);
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
        // redirect('/HSNcode/', 'refresh');
    }
}
