<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Shareholder extends MY_Controller {
	public $table = 'tbl_member';
	public $table1 = 'tbl_fund';
	public $page  = 'Shareholder';
	public function __construct() {
		parent::__construct();
		$this->load->library('excel');
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
						'member_sale_balance'=>$this->input->post('member_sale_balance'),
						// 'member_img' => $member_img,
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
		if(isset($_FILES["import_excel"]["name"])){
		$path = $_FILES["import_excel"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			foreach($object->getWorksheetIterator() as $worksheet)
			{
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				for($row=3; $row<=$highestRow; $row++)
				{
					if(!empty($worksheet->getCellByColumnAndRow(0, $row)->getValue())){
					
					$shareholder_id = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
					$shareholder_name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();			
					$shareholder_gender = $worksheet->getCellByColumnAndRow(2, $row)->getValue();	
					//gender_value
					if($shareholder_gender == "Male"){
						$share_gender = 1;
					}
					else if($shareholder_gender == "Female"){
						$share_gender = 2;
					}	
					$shareholder_dob = $worksheet->getCellByColumnAndRow(3, $row)->getValue();		
					$dob_con = \PHPExcel_Style_NumberFormat::toFormattedString($shareholder_dob, 'YYYY-MM-DD');
					$shareholder_address = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$shareholder_email = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$shareholder_phone = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					$shareholder_state = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
					//search if(State exist)
					@$state_exist_id  = $this->Shareholder_model->get_excel_import_state($shareholder_state);
					if($state_exist_id){
						$state_id_no = $state_exist_id;
					}
					else
					{
						if(!empty($shareholder_state)){
						$state_data = [
							'state_name'=>$shareholder_state,
							'state_number'=>0,
							'state_incharge'=>'ree',
							'state_status'=>1
						];
						$result = $this->General_model->add('tbl_state',$state_data);
						@$state_exist_id  = $this->Shareholder_model->get_excel_import_state($shareholder_state);
						$state_id_no = $state_exist_id;
					}
					else
					{
						$state_id_no = 1;
					}
					}
					//endstate
					$shareholder_district = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
					//district_exist_id
					@$district_exist_id  = $this->Shareholder_model->get_excel_import_district($shareholder_district);
					if($district_exist_id){
						$district_id_no = $district_exist_id;
					}
					else
					{
						if(!empty($shareholder_district)){
						$district_data = [
							'district_state_id_fk'=>$state_id_no,
							'district_name'=>$shareholder_district,
							'district_number'=>123,
							'district_incharge'=>'test',
							'district_status'=>1
						];
						$result = $this->General_model->add('tbl_district',$district_data);
						@$district_exist_id  = $this->Shareholder_model->get_excel_import_district($shareholder_district);
						$district_id_no = $district_exist_id;
					}
					else
					{
						$district_id_no = 1;
					}
					}
					//enddistrict
					$shareholder_panchayat = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
					//search if(panchayat exist)
					@$panchayat_exist_id  = $this->Shareholder_model->get_excel_import_panchayat($shareholder_panchayat);
					if($panchayat_exist_id){
						$panchayat_id_no = $panchayat_exist_id;
					}
					else
					{
						if(!empty($shareholder_panchayat)){
						$panchayat_data = [
							'panchayath_district'=>$district_id_no,
							'panchayath_name'=>$shareholder_panchayat,
							'panchayath_address'=>123,
							'panchayath_incharge'=>'test',
							'panchayath_status'=>1,
							'panchayath_created_at'=>date('Y-m-d h:i:sa'),
							'panchayath_updated_at'=>date('Y-m-d h:i:sa')
						];
						$result = $this->General_model->add('tbl_panchayath',$panchayat_data);
						@$panchayat_exist_id  = $this->Shareholder_model->get_excel_import_panchayat($shareholder_panchayat);
						$panchayat_id_no = $panchayat_exist_id;
					}
					else
					{
						$panchayat_id_no = 1;
					}
					}

					$shareholder_area_shed = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
					$shareholder_capacity = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
					$shareholder_join_date = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
					$shareholder_aadhar_no = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
					$shareholder_pan_no = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
					$shareholder_no_of_share_held = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
					$shareholder_nominee = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
					$shareholder_father_husband = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
					$shareholder_serail_no = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
					$shareholder_block = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
					$shareholder_ledger_folio = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
					
					$data = array(
						'member_mid' => $shareholder_id,
						'member_name' => $shareholder_name,
						'member_gender' => $share_gender,
						'member_dob' => $dob_con,
						'member_type' => 1,
						'member_email' => $shareholder_email,
						'member_pnumber' => $shareholder_phone,
						'member_address' => $shareholder_address,
						'member_panchayath' => $panchayat_id_no,
						'member_district' =>$district_id_no,
						'member_state' => $state_id_no,
						'area_of_shed' => $shareholder_area_shed,
						'area_capacity' => $shareholder_capacity,
						'created_at' => date('Y-m-d'),
                        'member_share_aahar' => $shareholder_aadhar_no,
                        'member_share_pan' => $shareholder_pan_no,
                        'member_share_no_shares' => $shareholder_no_of_share_held,
                        'member_share_nominee' => $shareholder_nominee,
                        'member_share_father_husband' => $shareholder_father_husband,
                        'member_share_serial_number' => $shareholder_serail_no,
                        'member_block_number' => $shareholder_block,
						'member_share_ledger_folio' => $shareholder_ledger_folio,
						'member_status' => 1
					);
					$result = $this->General_model->add_returnID('tbl_member',$data);
				}
				else
				{
					break;
				}
				}
			}
			if($result){	
				$response_text = 'Shareholder added successfully';
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
			$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
			redirect('Shareholder','refresh');
		}
	}

}
