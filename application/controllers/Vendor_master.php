<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vendor_master extends MY_Controller {
	public $table = 'tbl_vendor';
	public $tbl_account = 'tbl_supp_acc';
	//public $tbl_accountlog = 'tbl_supp_acclog';
	public $page  = 'Vendor_master';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
		}
        $this->load->model('General_model');
		$this->load->model('Vendor_model');
	}
	public function index()
	{
		
		$template['body'] = 'Vendor_master/list';
		$template['script'] = 'Vendor_master/script';
		
		$this->load->view('template', $template);
	}
	public function get(){
		$this->load->model('Vendor_model');
		$branch_id_fk=$this->session->userdata('branch_id_fk');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
    	$data = $this->Vendor_model->getVendorTable($param,$branch_id_fk);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function add(){
		$this->form_validation->set_rules('vendorname', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['body'] = 'Vendor_master/add';
			$template['script'] = 'Vendor_master/script';
			
			$template['state']=$this->Vendor_model->getstate();
			$this->load->view('template', $template);
		}
		else {
			$data = array(
						'vendor_branch_id_fk'=>$this->session->userdata('branch_id_fk'),
						'vendorname' => $this->input->post('vendorname'),
						'vendoraddress' => $this->input->post('vendoraddress'),
						'vendorphone' => $this->input->post('vendorphone'),
						'vendoremail' => $this->input->post('vendoremail'),
						'vendorgst' => $this->input->post('vendorgst'),
						'vendorstate' => $this->input->post('vendorstate'),
						'vendor_statetype' => $this->input->post('vendor_statetype'),
						'vendor_gsttype' => $this->input->post('vendor_gsttype'),
						//'vendor_oldbal' => $this->input->post('vendor_oldbal'),
						'vendorstatus' => 1
						);
			$vendor_id = $this->input->post('vendor_id');
			if($vendor_id){
				$data['vendor_id'] = $vendor_id;
				
				$AccData = array(
								'old_balance'=>0
								);
				$this->General_model->update($this->tbl_account,$AccData,'sup_id_fk',$vendor_id);
				//$this->General_model->update($this->tbl_accountlog,$supdata,'sup_id_fk',$vendor_id);
				$result = $this->General_model->update($this->table,$data,'vendor_id',$vendor_id);
				$response_text = 'Vendor details updated';
			}
			else{
				$result = $this->General_model->add($this->table,$data);
				$insert_id = $this->db->insert_id();
							
				$AccData = array(
								'sup_id_fk' => $insert_id,
								'old_balance'=>0,
								'sacc_status' =>1
								);
				$this->General_model->add($this->tbl_account,$AccData);
			//	$result = $this->General_model->add($this->tbl_accountlog,$supdata);
				$response_text = 'Vendor details Added';
			}
			if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
	        redirect('/Vendor_master/', 'refresh');
		}
	}
	public function edit($vendor_id){
		$template['body'] = 'Vendor_master/add';
		$template['script'] = 'Vendor_master/script';
		
		$template['state']=$this->Vendor_model->getstate();
		$template['records'] = $this->General_model->get_row($this->table,'vendor_id',$vendor_id);
    	$this->load->view('template', $template);
	}
	public function delete(){
        $vendor_id = $this->input->post('vendor_id');
        $updateData = array('vendorstatus' => 0);
        $data = $this->General_model->update($this->table,$updateData,'vendor_id',$vendor_id);
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
        // redirect('/Vendor/', 'refresh');
		}
	public function getVendorRelateditems(){
		$vendor_id=$this->input->post('vendor_id');
		$result=$this->Vendor_model->get_vendor_related_items($vendor_id);
		if(!empty($result)){
			echo json_encode($result);
		}
		else{
			$result=0;
			echo json_encode($result);
		}
	}

	public function getItemBasedVendors(){
		$item_id=$_POST['item_id'];
		$result=$this->Vendor_model->get_item_based_vendors($item_id);
		echo json_encode($result);
	}


}
