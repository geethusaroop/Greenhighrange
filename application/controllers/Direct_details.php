<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Direct_details extends MY_Controller {
	public $table = 'tbl_direct_details';
	public $page  = 'Direct_details';
	public function __construct() {
		parent::__construct();
        /*if(! $this->is_logged_in()){
          redirect('/login');
        }*/
        $this->load->model('General_model');
        $this->load->model('Ddetails_model');
	}
	public function index()
	{
		
		$template['body'] = 'Direct_details/list';
		$template['script'] = 'Direct_details/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('name', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			
			$template['body'] = 'Direct_details/add';
			$template['script'] = 'Direct_details/script';
			$this->load->view('template', $template);
		}
		else {
			$d_details_id = $this->input->post('d_details_id');
			if (!empty($_FILES['photo']['name'])) {
                $config['upload_path'] = 'upload/director';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|video|mp4';
                $config['file_name'] = $_FILES['photo']['name'];
                $pic = $_FILES['photo']['name'];
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('photo')) {
                    $uploadData = $this->upload->data();
                    $photo = $uploadData['file_name'];
                } else {
                    $photo = '';
                }
            } else {
                if ($d_details_id) {
                    $photo = $this->input->post('photo1');
                } else {
                    $photo = 'Not uploaded';
                }
            }

			if (!empty($_FILES['signature']['name'])) {
                $config['upload_path'] = 'upload/director';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|video|mp4';
                $config['file_name'] = $_FILES['signature']['name'];
                $pic = $_FILES['signature']['name'];
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                if ($this->upload->do_upload('signature')) {
                    $uploadData = $this->upload->data();
                    $signature = $uploadData['file_name'];
                } else {
                    $signature = '';
                }
            } else {
                if ($d_details_id) {
                    $signature = $this->input->post('signature1');
                } else {
                    $signature = 'Not uploaded';
                }
            }
			$data = array(
						'd_details_name' => strtoupper($this->input->post('name')),
						'd_details_designation' => strtoupper($this->input->post('d_details_designation')),
						'd_details_address' => $this->input->post('address'),
						'd_details_email' => $this->input->post('email'),
						'd_details_pan' => $this->input->post('pan'),
						'd_details_aadhaar' => $this->input->post('aadhar'),
						'd_details_din' => $this->input->post('din'),
						'd_details_phone' => $this->input->post('phone'),
						'd_details_father_name' => $this->input->post('father'),
						'd_details_dob' => $this->input->post('dob'),
						'd_details_photo' => $photo,
						'd_details_signature' => $signature,
						'd_details_status' => 1
						);
				if($d_details_id){
                     $data['d_details_id'] = $d_details_id;
                     $result = $this->General_model->update($this->table,$data,'d_details_id',$d_details_id);
                     $response_text = 'Direct Details updated successfully';
                }
				else{
                     $result = $this->General_model->add($this->table,$data);
                     $response_text = 'Direct Details added  successfully';
                }
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
	        redirect('/Direct_details/', 'refresh');
		}
	}
	public function get(){
		$this->load->model('Branch_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
    	$data = $this->Ddetails_model->getDirectDetailsInfo($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function delete(){
        $d_details_id = $this->input->post('d_details_id');
        $updateData = array('d_details_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'d_details_id',$d_details_id);
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
	public function edit($d_details_id){
		
		$template['body'] = 'Direct_details/add';
		$template['script'] = 'Direct_details/script';
		$template['records'] = $this->General_model->get_row($this->table,'d_details_id',$d_details_id);
    	$this->load->view('template', $template);
	}
}
