<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BCustomer_receipt extends MY_Controller {
	public $table = 'tbl_customer_receipt';
	public $page  = 'BCustomer_receipt';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->load->model('General_model');
		$this->load->model('Vendor_model');
		$this->load->model('BCustomer_receipt_model');
		$this->load->model('Bankdeposit_model');
	}
	public function index()
	{
		$template['body'] = 'BCustomer_receipt/list';
		$template['script'] = 'BCustomer_receipt/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('member_id_fk', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$branch_id_fk=$this->session->userdata('branch_id_fk');
			$template['member'] = $this->Bankdeposit_model->view_by();
			$template['body'] = 'BCustomer_receipt/add';
			$template['script'] = 'BCustomer_receipt/script';
			 $prid =$this->session->userdata('prid');
			 $admno = $this->BCustomer_receipt_model->get_admno($branch_id_fk);
			if(isset($admno->receipt_id)){$adm=$admno->receipt_group+1;}else{$adm=1;}
			$template['adm'] = $adm;
			$this->load->view('template', $template);
		}
		else {
			$receipt_id = $this->input->post('receipt_id');
			$branch_id_fk=$this->session->userdata('branch_id_fk');
			$member_id_fk=$this->input->post('member_id_fk');
			$receipt_amount1=$this->input->post('receipt_amount1');
			$receipt_date = str_replace('/', '-', $this->input->post('receipt_date'));
			$receipt_date = date("Y-m-d",strtotime($receipt_date));
		
			$data = array(
			           // 'finyear_id_fk' =>$fyear,
						'receipt_branch_id_fk' =>$this->session->userdata('branch_id_fk'),	
						'receipt_member_id_fk' =>$this->input->post('member_id_fk'),	
						'receipt_amount' =>$this->input->post('receipt_amount'),						
						'receipt_group' =>strtoupper($this->input->post('receipt_group')),
						'receipt_date' =>$receipt_date,	
						'narration' =>strtoupper($this->input->post('narration')),
						'receipt_status' => 1
						);
				if($receipt_id){
					 
                     $data['receipt_id'] = $receipt_id;
                     $result = $this->General_model->update($this->table,$data,'receipt_id',$receipt_id);
                     $response_text = 'BCustomer_receipt updated successfully';

						//$datass = $this->General_model->get_row('tbl_branch_member_balance','bmb_member_id_fk',$member_id_fk);
						$datass = $this->General_model->get_row_member_exist($member_id_fk,$branch_id_fk);
						$updated_amount1 = $datass->bmb_sale_balance + ($this->input->post('receipt_amount1'));
						$updated_amount = $updated_amount1 - ($this->input->post('receipt_amount'));
						$mdata=array('bmb_sale_balance'=> $updated_amount);
						$result = $this->General_model->update('tbl_branch_member_balance',$mdata,'bmb_member_id_fk',$member_id_fk);
					

                }
				else{
				    $result =  $this->General_model->add($this->table,$data);
				
				 
						$datass = $this->General_model->get_row_member_exist($member_id_fk,$branch_id_fk);
						$updated_amount = $datass->bmb_sale_balance - ($this->input->post('receipt_amount'));
						$mdata=array('bmb_sale_balance'=> $updated_amount);
						$result = $this->General_model->update('tbl_branch_member_balance',$mdata,'bmb_member_id_fk',$member_id_fk);
					                     
                     $response_text = 'BCustomer_receipt added  successfully';
					 
                }
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
				redirect('/BCustomer_receipt/');
		}
	}
	public function get(){
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
         $param['cat_type'] = (isset($_REQUEST['cat_type']))?$_REQUEST['cat_type']:'';
		$data = $this->BCustomer_receipt_model->getSupplierTable($param,$branch_id_fk);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function edit($receipt_id){
		$template['body'] = 'BCustomer_receipt/add';
		$template['script'] = 'BCustomer_receipt/script';
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['member'] = $this->Bankdeposit_model->view_by();
		$template['records'] = $this->General_model->get_row($this->table,'receipt_id',$receipt_id);
    	$this->load->view('template', $template);
	}
	public function delete(){
        $receipt_id = $this->input->post('receipt_id');
		$member_id_fk = $this->input->post('receipt_member_id_fk');
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		
						$datass = $this->General_model->get_row_member_exist($member_id_fk,$branch_id_fk);
						$updated_amount = $datass->bmb_sale_balance + ($this->input->post('receipt_amount'));
						$mdata=array('bmb_sale_balance'=> $updated_amount);
						$result = $this->General_model->update('tbl_branch_member_balance',$mdata,'bmb_member_id_fk',$member_id_fk);
					


        $updateData = array('receipt_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'receipt_id',$receipt_id);
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


	
	public function receipt($receipt_id){
		$template['body'] = 'BCustomer_receipt/receipt';
		$template['script'] = 'BCustomer_receipt/script-receipt';
		$template['records'] = $this->Customer_receipt_model->getreceipt($receipt_id);
		$this->load->view('template', $template);
	}
	
	
	
}