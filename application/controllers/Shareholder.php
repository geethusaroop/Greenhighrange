<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Shareholder extends MY_Controller {
	public $table = 'tbl_member';
	public $table1 = 'tbl_fund';
	public $page  = 'Shareholder';
	public function __construct() {
		parent::__construct();
	//	$this->load->library('excel');
	$this->load->helper(array('url','html','form'));
        $this->load->model('General_model');
        $this->load->model('Shareholder_model');
	}
	public function index()
	{
		
		$mem_type = ['member_type'=>1];
		$template['member_id']=$this->General_model->getall($this->table,$mem_type);
		$template['body'] = 'Shareholder/list';
		$template['script'] = 'Shareholder/script';
		$this->load->view('template', $template);
	}
	public function fetch_district()
	 {
	    $state = $this->input->post('state',TRUE);
        $data = $this->Shareholder_model->fetch_district($state)->result();
        echo json_encode($data);
	 }
	 public function fetch_panchayath()
	 {
	    $district= $this->input->post('district',TRUE);
        $data = $this->Shareholder_model->fetch_panchayath($district)->result();
        echo json_encode($data);
	 }
	public function add(){
		$this->form_validation->set_rules('member_name', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['states'] = $this->Shareholder_model->get_state_lists();
			$template['districts'] = $this->Shareholder_model->get_district_lists();
			
			$template['body'] = 'Shareholder/add';
			$template['script'] = 'Shareholder/script';
			$template['state'] = $this->Shareholder_model->get_state();
			//$branch_id_fk=$this->session->userdata('branch_id_fk');
			$admno = $this->Shareholder_model->get_admno2();
			if(isset($admno->member_id)){$adm=$admno->member_id+1;}else{$adm='1';}
			$template['adm'] = "SH00".$adm;	
			$this->load->view('template', $template);
		}
		else {
			// if(!empty($_FILES['member_img']['name'])){
            //     $config['upload_path'] = 'uploads/';
            //     $config['allowed_types'] = 'jpg|jpeg|png|gif';
            //     $config['file_name'] = $_FILES['member_img']['name'];
            //     $pic = $_FILES['member_img']['name'];
            //     //Load upload library and initialize configuration
            //     $this->load->library('upload',$config);
            //     $this->upload->initialize($config);
            //     if($this->upload->do_upload('member_img')){
            //         $uploadData = $this->upload->data();
            //         $member_img = $uploadData['file_name'];
            //     }else{
            //         $member_img = '';
            //     }
			// }else{
			// 		if($member_id)
			// 		{
			// 			$member_img = $this->input->post('member_img1');
			// 		}
			// 		else{
			// 			$member_img ='Not uploaded';
			// 		}
			// 	 }
			$data = array(
						'member_mid' => $this->input->post('member_mid'),
						'member_name' => $this->input->post('member_name'),
						'member_gender' => $this->input->post('member_gender'),
						'member_dob' => $this->input->post('member_dob'),
						'member_type' => 1,
						'member_email' => $this->input->post('member_email'),
						'member_pnumber' => $this->input->post('member_pnumber'),
						'member_wnumber' => $this->input->post('member_wnumber'),
						'member_address' => $this->input->post('member_address'),
						'm_created_at' => $this->input->post('member_exitdate'),
                        'member_share_aahar' => $this->input->post('share_aadhar'),
                        'member_share_pan' => $this->input->post('share_pan'),
                        'member_share_no_shares' => $this->input->post('share_shares'),
						'member_bank' => $this->input->post('member_bank'),
						'member_branch' => $this->input->post('member_branch'),
						'member_account' => $this->input->post('member_account'),
						'member_ifsc' => $this->input->post('member_ifsc'),
						'member_bank_id' => $this->input->post('member_bank_id'),
						'member_branch_id_fk'=>$this->session->userdata('branch_id_fk'),
						'member_old_balance'=>$this->input->post('member_sale_balance'),
						'member_status' => 1
						);
		
						$fund_year = date("Y",strtotime($this->input->post('member_exitdate')));
						$data_shares = array(
							'ftype_id_fk' =>1,
							'fund_date' => $this->input->post('member_exitdate'),
							'fund_member_id_fk' => $this->input->post('member_id'),
							'fund_amount'=>$this->input->post('share_shares'),
							'fund_year' =>$fund_year,	
							'fund_status' => 1
							);

				$member_id = $this->input->post('member_id');
				if($member_id){
				
					$member_id = $this->input->post('member_id');
                     $data['member_id'] = $member_id;
                     $result = $this->General_model->update($this->table,$data,'member_id',$member_id);
					 $results = $this->General_model->update($this->table1,$data_shares,'fund_member_id_fk',$member_id);
                     $response_text = 'Shareholder updated successfully';
                }
				else{
                     $result = $this->General_model->add($this->table,$data);
					 $insert_id=$this->db->insert_id();

					 $data_share = array(
						'ftype_id_fk' =>1,
						'fund_date' => $this->input->post('member_exitdate'),
						'fund_member_id_fk' => $insert_id,
						'fund_year' =>$fund_year,	
						'fund_amount'=>$this->input->post('share_shares'),
						'fund_status' => 1
						);
						//var_dump($data_share);die;
					 $results = $this->General_model->add($this->table1,$data_share);

                     $response_text = 'Shareholder added  successfully';
			}
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
	        redirect('/Shareholder/', 'refresh');
		}
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
		redirect('/Shareholder/', 'refresh');
    }
	public function edit($member_id){
		
		$template['body'] = 'Shareholder/add';
		$template['script'] = 'Shareholder/script';
		$template['state'] = $this->Shareholder_model->get_state();
		$template['district'] = $this->Shareholder_model->get_district();
		$template['panchayath'] = $this->Shareholder_model->get_panchayath();
		$template['records'] = $this->General_model->get_row($this->table,'member_id',$member_id);
    	$this->load->view('template', $template);
	}

	public function get_shareholders(){
		$this->load->model('Shareholder_model');
		$branch_id_fk=$this->session->userdata('branch_id_fk');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        $param['memberid'] = (isset($_REQUEST['memberid']))?$_REQUEST['memberid']:'';
    	$data = $this->Shareholder_model->getshareholdersClassinfoTable($param,$branch_id_fk);
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
			redirect('Shareholder/add','refresh');
		}
		else
		{
			redirect('Shareholder/add','refresh');
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
			redirect('Shareholder/add','refresh');
		}
		else
		{
			redirect('Shareholder/add','refresh');
		}
	}

	public function addExcelShareholder()
	{
			$template['states'] = $this->Shareholder_model->get_state_lists();
			$template['districts'] = $this->Shareholder_model->get_district_lists();
			
			$template['body'] = 'Shareholder/excel';
			$template['script'] = 'Shareholder/script';
			$template['state'] = $this->Shareholder_model->get_state();
			$this->load->view('template', $template);

	}

	public function insert_Excel_Sharholder()
	{
		$path = 'excel/';
		require_once APPPATH . "/libraries/PHPExcel.php";
		$config['upload_path'] = $path;
		$config['allowed_types'] = 'xlsx|xls|csv';
		$config['remove_spaces'] = TRUE;
		$this->load->library('upload', $config);
		$this->upload->initialize($config);            
		if (!$this->upload->do_upload('uploadFile')) {
			$error = array('error' => $this->upload->display_errors());
		} else {
			$data = array('upload_data' => $this->upload->data());
		}
		if(empty($error)){
		  if (!empty($data['upload_data']['file_name'])) {
			$import_xls_file = $data['upload_data']['file_name'];
		} else {
			$import_xls_file = 0;
		}
		$inputFileName = $path . $import_xls_file;
		 
		try {
			$inputFileType = PHPExcel_IOFactory::identify($inputFileName);
			$objReader = PHPExcel_IOFactory::createReader($inputFileType);
			$objPHPExcel = $objReader->load($inputFileName);
			$allDataInSheet = $objPHPExcel->getActiveSheet()->toArray(null, true, true, true);
			$count = count($allDataInSheet);
			$flag = true;

  for($i=2;$i<=$count;$i++){
		
	
			 if($allDataInSheet[$i]['A']!="")
			 {

				$date = str_replace('/', '-', $allDataInSheet[$i]['I']);
				$newDate = date("Y-m-d", strtotime($date));

				$ddate = str_replace('/', '-', $allDataInSheet[$i]['D']);
				$dob = date("Y-m-d", strtotime($ddate));

				if($allDataInSheet[$i]['M']!="")
				{
					$member_bank=$allDataInSheet[$i]['M'];
				}
				else
				{
					$member_bank="none";
				}

				if($allDataInSheet[$i]['L']!="")
				{
					$share=$allDataInSheet[$i]['L'];
				}
				else
				{
					$share=0;
				}

				if($allDataInSheet[$i]['R']!="")
				{
					$old_bal=$allDataInSheet[$i]['R'];
				}
				else
				{
					$old_bal=0;
				}
			  
				$inserdata[$i]['member_mid'] = $allDataInSheet[$i]['A'];
				$inserdata[$i]['member_name'] = $allDataInSheet[$i]['B'];
				$inserdata[$i]['member_gender'] = $allDataInSheet[$i]['C'];
				$inserdata[$i]['member_dob'] = $dob;
				$inserdata[$i]['member_address'] = $allDataInSheet[$i]['E'];
				$inserdata[$i]['member_email'] = $allDataInSheet[$i]['F'];
				$inserdata[$i]['member_pnumber'] = $allDataInSheet[$i]['G'];
				$inserdata[$i]['member_wnumber'] = $allDataInSheet[$i]['H'];
				$inserdata[$i]['m_created_at'] = $newDate;
				$inserdata[$i]['member_share_aahar'] = $allDataInSheet[$i]['J'];
				$inserdata[$i]['member_share_pan'] = $allDataInSheet[$i]['K'];
				$inserdata[$i]['member_share_no_shares'] = $share;
				$inserdata[$i]['member_bank'] = $member_bank;
				$inserdata[$i]['member_branch'] = $allDataInSheet[$i]['N'];
				$inserdata[$i]['member_account'] = $allDataInSheet[$i]['O'];
				$inserdata[$i]['member_ifsc'] = $allDataInSheet[$i]['P'];
				$inserdata[$i]['member_bank_id'] = $allDataInSheet[$i]['Q'];
				$inserdata[$i]['member_old_balance'] = $old_bal;
				$inserdata[$i]['member_status'] = 1;
				$inserdata[$i]['member_type'] = 1;
				$result = $this->General_model->add($this->table,$inserdata[$i]);
				$last_insert_id = $this->db->insert_id();

				  $sdate = str_replace('/', '-', $allDataInSheet[$i]['I']);
				  $fund_year = date("Y", strtotime($sdate));

				$inserdatas[$i]['fund_date'] = $newDate;
				$inserdatas[$i]['fund_member_id_fk'] = $last_insert_id;
				$inserdatas[$i]['fund_year'] = $fund_year;
				$inserdatas[$i]['fund_amount'] = $share;
				$inserdatas[$i]['ftype_id_fk'] =1;
				$inserdatas[$i]['fund_status'] =1;

				 $results = $this->General_model->add($this->table1,$inserdatas[$i]);

			}
			
			
			} 
		  
			 $response_text = 'Share Holder Added successfully';

			 if($result){

	  $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
		  }
		  else{
				$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
		  } 

			 } catch (Exception $e) {
		   die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME)
				   . '": ' .$e->getMessage());
		}
	  }else{
		  echo $error['error'];
		 }


		redirect('Shareholder/', 'refresh');

	}
}
