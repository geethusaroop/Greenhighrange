<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Member extends MY_Controller {
	public $table = 'tbl_member';
	public $page  = 'Member';
	public function __construct() {
		parent::__construct();
        $this->load->model('General_model');
        $this->load->model('Member_model');
		$this->load->model('Shareholder_model');
	}
	public function index()
	{
		
		$template['body'] = 'Member/list';
		$template['script'] = 'Member/script';
		$this->load->view('template', $template);
	}
	public function fetch_district()
	 {
	    $state = $this->input->post('state',TRUE);
        $data = $this->Member_model->fetch_district($state)->result();
        echo json_encode($data);
	 }
	 public function fetch_panchayath()
	 {
	    $district= $this->input->post('district',TRUE);
        $data = $this->Member_model->fetch_panchayath($district)->result();
        echo json_encode($data);
	 }
	public function add(){
		$this->form_validation->set_rules('member_name', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['states'] = $this->Member_model->get_state_lists();
			$template['districts'] = $this->Member_model->get_district_lists();
			
			//var_dump($template['districts']);die;
			$template['body'] = 'Member/add';
			$template['script'] = 'Member/script';
			$template['state'] = $this->Member_model->get_state();
			//$this->load->view('template', $template);
			//$branch_id_fk=$this->session->userdata('branch_id_fk');
			$admno = $this->Shareholder_model->get_admno2();
			if(isset($admno->member_id)){$adm=$admno->member_id+1;}else{$adm='1';}
			$template['adm'] = "M00".$adm;	
			$this->load->view('template', $template);
		}
		else {
			$member_id = $this->input->post('member_id');
			if(!empty($_FILES['member_img']['name'])){
                $config['upload_path'] = 'uploads/';
                $config['allowed_types'] = 'jpg|jpeg|png|gif';
                $config['file_name'] = $_FILES['member_img']['name'];
                $pic = $_FILES['member_img']['name'];
                //Load upload library and initialize configuration
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if($this->upload->do_upload('member_img')){
                    $uploadData = $this->upload->data();
                    $member_img = $uploadData['file_name'];
                }else{
                    $member_img = '';
                }
			}else{
					if($member_id)
					{
						$member_img = $this->input->post('member_img1');
					}
					else{
						$member_img ='Not uploaded';
					}
				 }
			$data = array(
						'member_branch_id_fk'=>$this->session->userdata('branch_id_fk'),
						'member_mid' => $this->input->post('member_mid'),
						'member_name' => $this->input->post('member_name'),
						'member_gst' => $this->input->post('member_gst'),
						//'member_gender' => $this->input->post('member_gender'),
						//'member_dob' => $this->input->post('member_dob'),
						'member_type' => $this->input->post('member_type'),
						'member_email' => $this->input->post('member_email'),
						'member_pnumber' => $this->input->post('member_pnumber'),
						'member_address' => $this->input->post('member_address'),
						//'member_panchayath' => $this->input->post('member_panchayath'),
						//'member_district' => $this->input->post('member_district'),
						//'member_state' => $this->input->post('member_state'),
						'm_created_at' => $this->input->post('member_exitdate'),
						'member_img' => $member_img,
						'member_status' => 1
						);
				
				$member_id = $this->input->post('member_id');
				if($member_id){
					$member_id = $this->input->post('member_id');
                     $data['member_id'] = $member_id;
                     $result = $this->General_model->update($this->table,$data,'member_id',$member_id);
                     $response_text = 'Member updated successfully';
                }
				else{
                     $result = $this->General_model->add($this->table,$data);
                     $response_text = 'Member added  successfully';
			}
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
				redirect('/Member/', 'refresh');
		}
	}
	public function get(){
		$this->load->model('Member_model');
		$branch_id_fk=$this->session->userdata('branch_id_fk');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        $param['memberid'] = (isset($_REQUEST['memberid']))?$_REQUEST['memberid']:'';
		//print_r($memberid);
		//exit();
    	$data = $this->Member_model->getClassinfoTable($param,$branch_id_fk);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function delete(){
        $member_id = $this->input->post('member_id');
        $updateData = array('member_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'member_id',$member_id);
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
		redirect('/Member/', 'refresh');
    }
	public function edit($member_id){
		
		$template['body'] = 'Member/add';
		$template['script'] = 'Member/script';
		$template['state'] = $this->Member_model->get_state();
		$template['district'] = $this->Member_model->get_district();
		$template['panchayath'] = $this->Member_model->get_panchayath();
		$template['records'] = $this->General_model->get_row($this->table,'member_id',$member_id);
    	$this->load->view('template', $template);
	}

    public function view()
	{
		
		$pid =$this->session->userdata('mem_id');
		$template['body'] = 'Member/view';
		$template['script'] = 'Member/script-view';
		$this->load->view('template', $template);
	}
	public function getview(){
		$pid =$this->session->userdata('mem_id');
		$this->load->model('Member_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        $param['memberid'] = (isset($_REQUEST['memberid']))?$_REQUEST['memberid']:'';
		//print_r($memberid);
		//exit();
    	$data = $this->Member_model->getClassinfoTable1($param,$pid);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function addDistrictName()
	{
		$this->form_validation->set_rules('dist_name', 'Name', 'required');
		if ($this->form_validation->run() == TRUE) {
		$data = array(
			'district_state_id_fk' => $this->input->post('dist_state'),
			'district_name' => $this->input->post('dist_name'),
			'district_number' => $this->input->post('dist_phone'),
			'district_incharge' => $this->input->post('dist_incharge'),
			'district_status' => 1,
			'district_created_at' => date('Y-m-d h:i:s'),
			'district_updated_at' => date('Y-m-d h:i:s'),
		);
		$result = $this->General_model->add('tbl_district',$data);
		if($result){
			$response_text = 'District added successfully';
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
			$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
			redirect('Member/add','refresh');
		}
		else
		{
			redirect('Member/add','refresh');
		}
	}
	public function addPanchayatName()
	{
		$this->form_validation->set_rules('panch_name', 'Name', 'required');
		if ($this->form_validation->run() == TRUE) {
		$data = array(
			'panchayath_district' => $this->input->post('panch_dist'),
			'panchayath_name' => $this->input->post('panch_name'),
			'panchayath_address' => $this->input->post('panch_address'),
			'panchayath_number' => $this->input->post('panch_number'),
			'panchayath_incharge' => $this->input->post('panch_incharge'),
			'panchayath_status' => 1,
			'panchayath_created_at' => date('Y-m-d h:i:s'),
			'panchayath_updated_at' => date('Y-m-d h:i:s'),
		);
		$result = $this->General_model->add('tbl_panchayath',$data);
		if($result){
			$response_text = 'Panchayat added successfully';
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
			$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
			redirect('Member/add','refresh');
		}
		else
		{
			redirect('Member/add','refresh');
		}
	}
	
}
