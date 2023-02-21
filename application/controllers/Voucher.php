<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Voucher extends MY_Controller {
	public $table = 'tbl_project_voucher';
	public $tbl_daybuk = 'tbl_daybuk';
	public $tbl_ledgerbuk = 'tbl_ledgerbuk';
	public $page  = 'Voucher';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        $this->load->model('General_model');
		//$this->load->model('Student_model');
		$this->load->model('Voucher_model');
		$this->load->model('Voucherhead_model');
	}
	public function index(){
		$template['body'] = 'Voucher/list';
		$template['script'] = 'Voucher/script';
		
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('vouch_id', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['vouchnames'] = $this->Voucherhead_model->view_by1();
			$template['body'] = 'Voucher/add';
			$template['script'] = 'Voucher/script';
			
			 $prid =$this->session->userdata('prid');
			$this->load->view('template', $template);
		}
		else {
			$voucher_id = $this->input->post('voucher_id');
			// $fin_year = $this->Student_model->get_finyear();
			// if(isset($fin_year->finyear_id)){$fyear = $fin_year->finyear_id;}else{$fyear =0;}
			$voucher_date = str_replace('/', '-', $this->input->post('voucher_date'));
			$voucher_date = date("Y-m-d",strtotime($voucher_date));
			$data = array(
			           // 'finyear_id_fk' =>$fyear,
						//'project_id_fk' =>$this->session->userdata('prid'),
						'voucher_number' =>$this->input->post('voucher_number'),
						'vouch_id_fk' =>$this->input->post('vouch_id'),
						'voucher_amount' =>$this->input->post('voucher_amount'),
						'paid_to' =>strtoupper($this->input->post('paid_to')),
						'voucher_date' =>$voucher_date,
						'narration' =>strtoupper($this->input->post('narration')),
						'voucher_status' => 1
						);
				if($voucher_id){
                     $data['voucher_id'] = $voucher_id;
                     $result = $this->General_model->update($this->table,$data,'voucher_id',$voucher_id);
                     $response_text = 'Voucher updated successfully';
                }
				else{
				     $this->General_model->add($this->table,$data);
				    // $id = $this->db->insert_id();
                     $response_text = 'Voucher added  successfully';
                }
				if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
				redirect('/Voucher/');
		}
	}
	public function get(){
		  $prid =$this->session->userdata('prid');
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$data = $this->Voucher_model->getvoucherTable($param,$prid);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	public function edit($voucher_id){
		$template['body'] = 'Voucher/add';
		$template['script'] = 'Voucher/script';
		
		$template['vouchnames'] = $this->Voucherhead_model->view_by1();
		$template['records'] = $this->General_model->get_row($this->table,'voucher_id',$voucher_id);
    	$this->load->view('template', $template);
	}
	public function delete(){
        $voucher_id = $this->input->post('voucher_id');
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
	public function get_vouchhead()
	{
		 $vouch_id = $this->input->post('vouch_id');
		 $result = $this->Voucher_model->get_vouchhead($vouch_id);
		 $data_json = json_encode($result);
		 echo $data_json;
	}
public function receipt($voucher_id){
		$template['body'] = 'Voucher/receipt';
		$template['script'] = 'Voucher/script-receipt';
		
		$template['records'] = $this->Voucher_model->getvoucher($voucher_id);
		$this->load->view('template', $template);
	}
}
