<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Company extends MY_Controller {
	public $table = 'tbl_company_info';
	public $page  = 'Company';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->load->model('General_model');
        $this->load->model('Company_model');
	}
	public function index()
	{
		$info_id=1;
		$template['records'] = $this->General_model->get_row($this->table,'info_id',$info_id);
		$template['body'] = 'Company/list';
		$template['script'] = 'Company/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('name', 'name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['body'] = 'Company/add';
			$template['script'] = 'Company/script';
			$this->load->view('template', $template);
		}
		else {
			$info_id = $this->input->post('info_id');
			if(!empty($_FILES['logo']['name'])){
                $config['upload_path'] = 'Companylogo/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif|video|mp4';
                $config['file_name'] = $_FILES['logo']['name'];
                $pic = $_FILES['logo']['name'];
				
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('logo')){ 
                    $uploadData = $this->upload->data();
                    $logo = $uploadData['file_name']; 
                }else{
                    $logo = '';
                }
				
            }else{
					if($info_id)
					{
						$logo = $this->input->post('logo');
					}
					else{
						$logo ='Not uploaded';
					}
				 }
			$data = array(
			            'info_name'=> strtoupper($this->input->post('name')),
						'info_address' => $this->input->post('address'),
						'info_mobile1' => $this->input->post('fphone'),
						'info_mobile2'=>$this->input->post('sphone'),
						'info_email1'=> $this->input->post('femail'),
						'info_email2' => $this->input->post('semail'),
						'info_website' => $this->input->post('webiste'),
						'info_gstin' => strtoupper($this->input->post('gstin')),
						'info_date'=>date('Y-m-d'),
						'info_logo'=>$logo,
						'info_cin' => $this->input->post('info_cin'),
						'info_roc' => $this->input->post('info_roc'),
						'info_category' => $this->input->post('info_category'),
						'info_subcategory' => $this->input->post('info_subcategory'),
						'info_class_company' => $this->input->post('info_class_company'),
						'info_start_date' => $this->input->post('info_start_date'),
						'info_reg_no' => $this->input->post('info_reg_no'),
						'info_activity' => $this->input->post('info_activity'),
						'info_age_company' => $this->input->post('info_age_company'),
						'info_tot_members' => $this->input->post('info_tot_members'),
						'info_status' => 1
						);
				
				if($info_id){
					 
                     $data['info_id'] = $info_id;
                     $result = $this->General_model->update($this->table,$data,'info_id',$info_id);
                     $response_text = 'Resort Information  updated successfully';
                }
				else{
                     $result = $this->General_model->add($this->table,$data);
                     $response_text = 'Resort Information added  successfully';
                }
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
				redirect('/Company/');
		}
	}
	public function get(){
		$this->load->model('Company_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Company_model->getCompanyTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function delete(){
        $info_id = $this->input->post('info_id');
        $updateData = array('info_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'info_id',$info_id);
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
		redirect('/Company/', 'refresh');
    }
	public function edit($info_id){
		$template['body'] = 'Company/add';
		$template['script'] = 'Company/script';
		$template['records'] = $this->General_model->get_row($this->table,'info_id',$info_id);
    	$this->load->view('template', $template);
	}
public function ChangePassword()
	{
		$id = $this->session->userdata['id'];
		$template['body'] = 'Changepassword/index';
		$template['script'] = 'Changepassword/script';
		$template['records'] = $this->General_model->get_row('admin_login','id',$id);
		$this->load->view('template', $template);
	}
	public function resetPassword()
	{
		$id = $this->input->post('id');
		$data = array(
					'user_name' => $this->input->post('username'),
					'admin_password' => $this->input->post('password'));
		$res = $this->General_model->update('admin_login',$data,'id',$id);
		if ($res) 
		{
			$response_text='Password has been changed.';
		}
		else
		{
			$response_text='Something went wrong !!!';
		}
		$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
		redirect('dashboard');	
 	}
}