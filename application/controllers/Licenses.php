<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Licenses extends MY_Controller {
	public $table = 'tbl_licenses';
	public $page  = 'Customer';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
			redirect('/login');
		}
		$this->load->model('General_model');
	}
	public function index(){
		$template['body'] = 'Licenses/list';
		$template['script'] = 'Licenses/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('lic_name', 'License Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			
			$template['body'] = 'Licenses/add';
			$template['script'] = 'Licenses/script';
			$this->load->view('template', $template);
		}
		else {
			$lic_id = $this->input->post('lic_id');
			$license_upload = $_FILES['lic_file']['name'];
			$file_name = rand(1000,100000000).'.pdf';
			if($license_upload != NULL){
				$config['upload_path']          = 'upload/license';
				$config['allowed_types']        = 'pdf|csv|jpg|png|svg';
				$config['file_name']			=	$file_name;
				$this->load->library('upload', $config);
				if(!$this->upload->do_upload('lic_file'))
				{
					$error = array('error' => $this->upload->display_errors());
				}
				else
				{
					$data = array('upload_data' => $this->upload->data());
				}
			}
			else
			{
				if($lic_id){
					$file_name = $this->input->post('lic_file1');
				}
				else
				{
					$file_name = "";
				}
				
			}
			$datas = array(
				'license_name' => $this->input->post('lic_name'),
				'license_number' => $this->input->post('lic_number'),
				'license_reminder' => $this->input->post('lic_reminder'),
				'license_expirery_date' => $this->input->post('lic_expiery'),
				'license_upload' => $file_name,
				'license_status' => 1
			);
			$lic_id = $this->input->post('lic_id');
			if($lic_id){
				$data['cust_id'] = $lic_id;
				$result = $this->General_model->update($this->table,$datas,'license_id',$lic_id);
				$response_text = 'License details  updated';
			}
			else{
				$result = $this->General_model->add($this->table,$datas);
				$response_text = 'License details Added';
			}
			if($result){
				$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
				$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
			redirect('/Licenses/', 'refresh');
		}
	}
	public function edit($license_id){
		
		$template['body'] = 'Licenses/add';
		$template['script'] = 'Licenses/script';
		$template['records'] = $this->General_model->get_row($this->table,'license_id',$license_id);
		$this->load->view('template', $template);
	}
	public function delete(){
		$license_id = $this->input->post('license_id');
		$updateData = array('license_status' => 0);
		$data = $this->General_model->update($this->table,$updateData,'license_id',$license_id);
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
		// redirect('/Customer/', 'refresh');
	}
	public function print($license_id)
	{
		
		$template['body'] = 'Licenses/pdf';
		$template['script'] = 'Licenses/script';
		$template['pdf'] = $this->General_model->get_row($this->table,'license_id',$license_id);
		$this->load->view('template', $template);
	}
}
