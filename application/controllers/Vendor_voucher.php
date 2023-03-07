<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Vendor_voucher extends MY_Controller {
	public $table = 'tbl_vendor_voucher';
	public $tbl_daybuk = 'tbl_daybuk';
	public $tbl_ledgerbuk = 'tbl_ledgerbuk';
	public $page  = 'Voucher';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->load->model('General_model');
		$this->load->model('Vendor_model');
		$this->load->model('Voucher_model');
		$this->load->model('Vendor_voucher_model');
	}
	public function index()
	{
		$template['body'] = 'Vendor_voucher/list';
		$template['script'] = 'Vendor_voucher/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('vendor_id', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$branch_id_fk=$this->session->userdata('branch_id_fk');
			$template['vendor_names'] = $this->Vendor_voucher_model->view_by($branch_id_fk);
			$template['body'] = 'Vendor_voucher/add';
			$template['script'] = 'Vendor_voucher/script';
			 $prid =$this->session->userdata('prid');
			 $admno = $this->Vendor_voucher_model->get_admno($prid);
			if(isset($admno->voucher_id)){$adm=$admno->voucher_group+1;}else{$adm=1;}
			$template['adm'] = $adm;
			$this->load->view('template', $template);
		}
		else {
			$voucher_id = $this->input->post('voucher_id');
			
			$voucher_date = str_replace('/', '-', $this->input->post('voucher_date'));
			$voucher_date = date("Y-m-d",strtotime($voucher_date));
			$branch_id_fk=$this->session->userdata('branch_id_fk');
			$member_id_fk = $this->input->post('vendor_id');
			$data = array(
			           // 'finyear_id_fk' =>$fyear,
						'project_id_fk' =>$this->session->userdata('branch_id_fk'),	
						'vendor_id_fk' =>$this->input->post('vendor_id'),	
						'voucher_amount' =>$this->input->post('voucher_amount'),						
						'voucher_group' =>strtoupper($this->input->post('voucher_group')),
						'voucher_date' =>$voucher_date,	
						//'voucher_group' =>$type,	
						'narration' =>strtoupper($this->input->post('narration')),
						'voucher_status' => 1
						);
				if($voucher_id){
					 
                     $data['voucher_id'] = $voucher_id;
                     $result = $this->General_model->update($this->table,$data,'voucher_id',$voucher_id);

					 $datass = $this->General_model->get_row('tbl_vendor','vendor_id',$member_id_fk);
					 $updated_amount1 = $datass->vendor_oldbal + ($this->input->post('voucher_amount1'));
					 $updated_amount = $updated_amount1 - ($this->input->post('voucher_amount'));
					 $mdata=array('vendor_oldbal'=> $updated_amount);
					 $result = $this->General_model->update('tbl_vendor',$mdata,'vendor_id',$member_id_fk);


					 $datasup = $this->General_model->get_row('tbl_supp_acc','sup_id_fk',$member_id_fk);
					 $updated_amountup1 = $datasup->old_balance + ($this->input->post('voucher_amount1'));
					 $updated_amountup = $updated_amountup1 - ($this->input->post('voucher_amount'));
					 $mdataup=array('old_balance'=> $updated_amountup);
					 $result = $this->General_model->update('tbl_supp_acc',$mdataup,'sup_id_fk',$member_id_fk);

                     $response_text = 'Voucher updated successfully';
                }
				else{
				    $result =  $this->General_model->add($this->table,$data);
					
					$datass = $this->General_model->get_row('tbl_vendor','vendor_id',$member_id_fk);
					$updated_amount = $datass->vendor_oldbal - ($this->input->post('voucher_amount'));
					$mdata=array('vendor_oldbal'=> $updated_amount);
					$result = $this->General_model->update('tbl_vendor',$mdata,'vendor_id',$member_id_fk);


					$datasup = $this->General_model->get_row('tbl_supp_acc','sup_id_fk',$member_id_fk);
					$updated_amountup = $datasup->old_balance - ($this->input->post('voucher_amount'));
					$mdataup=array('old_balance'=> $updated_amountup);
					$result = $this->General_model->update('tbl_supp_acc',$mdataup,'sup_id_fk',$member_id_fk);
				  
                     
                     $response_text = 'Voucher added  successfully';
					 
                }
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
				redirect('/Vendor_voucher/');
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
		$data = $this->Vendor_voucher_model->getSupplierTable($param,$branch_id_fk);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function edit($voucher_id){
		$template['body'] = 'Vendor_voucher/add';
		$template['script'] = 'Vendor_voucher/script';
		$branch_id_fk=$this->session->userdata('branch_id_fk');
			$template['vendor_names'] = $this->Vendor_voucher_model->view_by($branch_id_fk);
		$template['records'] = $this->General_model->get_row($this->table,'voucher_id',$voucher_id);
    	$this->load->view('template', $template);
	}
	public function delete(){
		$branch_id_fk=$this->session->userdata('branch_id_fk');
        $voucher_id = $this->input->post('voucher_id');
		$member_id_fk = $this->input->post('vendor_id');

		$datass = $this->General_model->get_row('tbl_vendor','vendor_id',$member_id_fk);
		$updated_amount = $datass->vendor_oldbal + ($this->input->post('voucher_amount'));
		$mdata=array('vendor_oldbal'=> $updated_amount);
		$result = $this->General_model->update('tbl_vendor',$mdata,'vendor_id',$member_id_fk);


		$datasup = $this->General_model->get_row('tbl_supp_acc','sup_id_fk',$member_id_fk);
		$updated_amountup = $datasup->old_balance + ($this->input->post('voucher_amount'));
		$mdataup=array('old_balance'=> $updated_amountup);
		$result = $this->General_model->update('tbl_supp_acc',$mdataup,'sup_id_fk',$member_id_fk);
		
        $updateData = array('voucher_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'voucher_id',$voucher_id);
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