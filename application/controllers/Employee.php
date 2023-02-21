<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Employee extends MY_Controller {
	public $table = 'tbl_employee';
	public $tbl_login = 'tbl_login';
	public $page  = 'Employee';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
		}
        $this->load->model('General_model');
		$this->load->model('Employee_model');
		//$this->load->model('Route_model');
        
	}
	public function index()
	{
		
		$template['body'] = 'Employee/list';
		$template['script'] = 'Employee/script';
		$template['emp_names'] = $this->Employee_model->view_by();
		$this->load->view('template', $template);
	}
	public function get(){
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
    	$data = $this->Employee_model->getEmployeeTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function add(){
		$this->form_validation->set_rules('emp_name', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			
			$template['body'] = 'Employee/add';
			$template['script'] = 'Employee/script';
			//$template['routenames'] = $this->Route_model->view_by();
			$this->load->view('template', $template);
		}
		else {
			$emp_id = $this->input->post('emp_id');
			if(!empty($_FILES['emp_img']['name'])){
                $config['upload_path'] = 'employee_image/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['emp_img']['name'];
                $pic = $_FILES['emp_img']['name'];
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('emp_img')){ 
                    $uploadData = $this->upload->data();
                    $emp_img = $uploadData['file_name']; 
                }else{
                    $emp_img = '';
                }
			}else{
					if($emp_id)
					{
						$emp_img = $this->input->post('emp_img1');
					}
					else{
						$emp_img ='Not uploaded';
					}
				 }
				 if(!empty($_FILES['emp_govt_img']['name'])){
					$config2['upload_path'] = 'employee_image/';
					$config2['allowed_types'] = 'jpg|jpeg|png|gif';
					$config2['file_name'] = $_FILES['emp_govt_img']['name'];
					$pic = $_FILES['emp_govt_img']['name'];
					//Load upload library and initialize configuration
					$this->load->library('upload',$config2);
					$this->upload->initialize($config2);
					if($this->upload->do_upload('emp_govt_img')){ 
						$uploadData2 = $this->upload->data();
						$govt_img = $uploadData2['file_name']; 
					}else{
						$govt_img = '';
					}
				}else{
						if($emp_id)
						{
							$govt_img = $this->input->post('emp_govt_img1');
						}
						else{
							$govt_img ='Not uploaded';
						}
					 }	 
			$emp_doj = str_replace('/', '-', $this->input->post('emp_doj'));
			$emp_doj =  date("Y-m-d",strtotime($emp_doj));
			$datas = array(
			            'emp_eid' => $this->input->post('emp_eid'),
						'emp_name' => $this->input->post('emp_name'),
						'emp_designation' => $this->input->post('emp_designation'),
						'emp_address' => $this->input->post('emp_address'),
						'emp_phone' => $this->input->post('emp_phone'),
						'emp_phone2' => $this->input->post('emp_phone2'),
						'emp_blood_grp' => $this->input->post('emp_blood_grp'),
						'emp_email' => $this->input->post('emp_email'),
						'emp_doj' => $emp_doj,
						'emp_img' => $emp_img,
						'emp_govt_id' => $govt_img,
						'emp_sal' => $this->input->post('emp_sal'),
						'emp_status' => 1,
						
						);
			$emp_id = $this->input->post('emp_id');
			if($emp_id){
				 
				$data['emp_id'] = $emp_id;
				$result = $this->General_model->update($this->table,$datas,'emp_id',$emp_id);
				$response_text = 'Employee details  updated';
			}
			else{
				$result = $this->General_model->add($this->table,$datas);
				$response_text = 'Employee details Added';
			}
			if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
	        redirect('/Employee/', 'refresh');
		}
	}
	public function edit($emp_id){
		
		$template['body'] = 'Employee/add';
		$template['script'] = 'Employee/script';
		$template['records'] = $this->General_model->get_row($this->table,'emp_id',$emp_id);
    	$this->load->view('template', $template);
	}
	public function delete(){
       
        $emp_id = $this->input->post('emp_id');
        $updateData = array('emp_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'emp_id',$emp_id);                       
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
		public function setPrivalage(){
		
		$data = array('emp_id_fk' => $this->input->post('emp_id'),
					  'password' => $this->input->post('password'),
					  'user_name' =>$this->input->post('username'),
					  'user_type' => $this->input->post('user_type'),
					  'login_status'=>1
					  );
		$prev = $this->General_model->get_row($this->tbl_login,'emp_id_fk',$this->input->post('emp_id')); 
		if($prev){
		$result = $this->General_model->update($this->tbl_login,$data,'emp_id_fk',$this->input->post('emp_id'));
		}
		else{ 
		$result = $this->General_model->add($this->tbl_login,$data); 
		}
		if($result) {
            $response['text'] = 'Success';
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