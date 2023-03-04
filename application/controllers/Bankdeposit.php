<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Bankdeposit extends MY_Controller {
	public $table = 'tbl_bank_deposit';
	public $page  = 'Bankdeposit';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->load->model('General_model');
		$this->load->model('Vendor_model');
		$this->load->model('Voucher_model');
		$this->load->model('Bank_model');
		$this->load->model('Bankdeposit_model');
	}
	public function index()
	{
		$template['body'] = 'Bankdeposit/list';
		$template['script'] = 'Bankdeposit/script';
		$branch_id_fk =$this->session->userdata('branch_id_fk');
		$template['bank'] = $this->Bank_model->view_by($branch_id_fk);
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('bd_bank_id_fk', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['body'] = 'Bankdeposit/add';
			$template['script'] = 'Bankdeposit/script';
			$branch_id_fk =$this->session->userdata('branch_id_fk');
			$template['bank'] = $this->Bank_model->view_by($branch_id_fk);
			$template['member'] = $this->Bankdeposit_model->view_by();
			$this->load->view('template', $template);
		}
		else {
			$bd_id = $this->input->post('bd_id');
			$bd_bank_id_fk=$this->input->post('bd_bank_id_fk');
			$branch_id_fk =$this->session->userdata('branch_id_fk');
			$bd_amount1=$this->input->post('bd_amount1');
			$bd_amount=$this->input->post('bd_amount');
			$data = array(
						'branch_id_fk' =>$this->session->userdata('branch_id_fk'),	
						'bd_bank_id_fk' =>$this->input->post('bd_bank_id_fk'),	
						'bd_type' =>2,						
						'bd_amount' =>$this->input->post('bd_amount'),
						'bd_date' =>$this->input->post('bd_date'),
						'bd_remark' =>$this->input->post('bd_remark'),
						'bd_status' => 1
						);
				if($bd_id){
					 
                     $data['bd_id'] = $bd_id;
                     $result = $this->General_model->update($this->table,$data,'bd_id',$bd_id);

					/*  $bdeposit = $this->Bankdeposit_model->get_deposit($bd_bank_id_fk,$branch_id_fk);
					$updated_deposit1= intval($bdeposit->bank_opening_balance) - intval($bd_amount1);
					$updated_deposit= $updated_deposit1 + intval($bd_amount);
					$deposit_array = ['bank_opening_balance' => $updated_deposit];
					$result = $this->General_model->update('tbl_bank',$deposit_array,'bank_id',$bd_bank_id_fk); */

                     $response_text = 'Bankdeposit Details updated successfully';
                }
				else{
				    $result =  $this->General_model->add($this->table,$data);

					/* $bdeposit = $this->Bankdeposit_model->get_deposit($bd_bank_id_fk,$branch_id_fk);
					$updated_deposit= intval($bdeposit->bank_opening_balance) + intval($bd_amount);
					$deposit_array = ['bank_opening_balance' => $updated_deposit];
					$result = $this->General_model->update('tbl_bank',$deposit_array,'bank_id',$bd_bank_id_fk); */
                     $response_text = 'Bankdeposit Details added  successfully';
					 
                }
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
				redirect('/Bankdeposit/');
		}
	}


	public function get(){
		$branch_id_fk =$this->session->userdata('branch_id_fk');
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$param['bank'] = (isset($_REQUEST['bank']))?$_REQUEST['bank']:'';
		$data = $this->Bankdeposit_model->getSupplierTable($param,$branch_id_fk);
    	$json_data = json_encode($data);
    	echo $json_data;
    }


	public function edit($bd_id){
		$template['body'] = 'Bankdeposit/add';
		$template['script'] = 'Bankdeposit/script';
		$branch_id_fk =$this->session->userdata('branch_id_fk');
		$template['bank'] = $this->Bank_model->view_by($branch_id_fk);
		$template['member'] = $this->Bankdeposit_model->view_by($branch_id_fk);
		$template['records'] = $this->General_model->get_row($this->table,'bd_id',$bd_id);
    	$this->load->view('template', $template);
	}


	public function delete(){
        $bd_id = $this->input->post('bd_id');
        $updateData = array('bd_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'bd_id',$bd_id);
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
	
	
	
}