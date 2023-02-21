<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Payroll extends MY_Controller {
	public $table = 'tbl_payroll';
//	public $tbl_daybuk = 'tbl_daybuk';
	//public $tbl_ledgerbuk = 'tbl_ledgerbuk';
	public $page  = 'Payroll';
	public function __construct() {
		parent::__construct();
         if(! $this->is_logged_in()){
            redirect('/login');
        }
        
        $this->load->model('General_model');
		$this->load->model('Payroll_model');
		$this->load->model('Employee_model');
	}
	public function index()
	{
		
		$template['body'] = 'Payroll/list';
		$template['script'] = 'Payroll/script';
		$this->load->view('template', $template);
	}
	public function add(){
		$this->form_validation->set_rules('emp_id', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			
			$template['body'] = 'Payroll/add';
			$template['script'] = 'Payroll/script';
			//$template['staffnames'] = $this->Employee_model->view_by();
			$template['staffnames'] = $this->Employee_model->emp_names();
			$this->load->view('template', $template);
		}
		else {
			$salarydate = str_replace('/', '-', $this->input->post('payroll_salarydate'));
			$salarydate = date("Y-m-d",strtotime($salarydate));
		
			$data = array(
						'emp_id_fk'=> $this->input->post('emp_id'),
						'sal_month'=> $this->input->post('payroll_salmonth'),
						'payroll_basicsalary'=> $this->input->post('basic_sal'),
						'payroll_epf'=> $this->input->post('epf_sal'),
						//'payroll_hra'=> $this->input->post('payroll_hra'),
						//'payroll_esi'=> $this->input->post('payroll_esi'),
						'payroll_leaveded'=> $this->input->post('leave_ded'),
						'payroll_salary'=> $this->input->post('total_sal'),
						'payroll_salarydate'=> $salarydate,
						'overtime_pay'=> $this->input->post('overtime'),
						'advance_pay'=> $this->input->post('advance'),
						'payroll_total_salary'=> $this->input->post('total_sal'),
						'payroll_status'=> 1
						);
			// $Udata  = array(
			// 			'date'=> date("Y-m-d"),
			// 			'ledger_name'=> 'Salary Payment',
			// 			'credit'=> 0,
			// 			'debit'=> $this->input->post('total_sal'),
			// 			'status'=> 1
			// 			);
			// 			$this->General_model->add($this->tbl_daybuk,$Udata);
			// $Udata1  = array(
			// 			'date'=> date("Y-m-d"),
			// 			'ledgerbuk_head'=> 'Salary Payment',
			// 			'credit'=> 0,
			// 			'debit'=> $this->input->post('total_sal'),
			// 			'ledgerbuk_status'=> 1
			// 			);
			// 			$this->General_model->add($this->tbl_ledgerbuk,$Udata1);	
			//print_r($data);exit;					
						$payroll_id = $this->input->post('payroll_id');
						if($payroll_id)
						{
							$result = $this->General_model->update($this->table,$data,'payroll_id',$payroll_id);
							$response_text = 'Payroll Details updated successfully';
						}
						else
						{
							$result = $this->General_model->add($this->table,$data);
							$response_text = 'Payroll Details added successfully';
						}
                 
				if($data){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
			redirect('/Payroll/', 'refresh');
		}
	}
		public function edit($payroll_id){
		
		$template['staffnames'] = $this->Employee_model->emp_names();
		$template['records'] = $this->General_model->get_row($this->table,'payroll_id',$payroll_id);
		$template['body'] = 'Payroll/add';
		$template['script'] = 'Payroll/script';
		//$template['staffnames'] = $this->Employee_model->view_by();
		
    	$this->load->view('template', $template);
	}
	public function get(){
		
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        $param['month'] = (isset($_REQUEST['month']))?$_REQUEST['month']:'';
        
		$data = $this->Payroll_model->getPayrollReport($param);
		$json_data = json_encode($data);
    	echo $json_data;
    }
	public function payslip($payroll_id){
		
		$template['body'] = 'Payroll/payslip';
		$template['script'] = 'Payroll/script';
		$template['records'] = $this->Payroll_model->get_data($payroll_id);
		$this->load->view('template', $template);
	}
	function get_values()
	{
		$emp_id = $this->input->post('emp_id');
		$result = $this->Payroll_model->get_values($emp_id);
		$json_data = json_encode($result);
    	echo $json_data;
	}
	function get_leaves()
	{
		$emp_id = $this->input->post('emp_id');
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$result = $this->Payroll_model->get_leaves($emp_id,$month,$year);
		$half_leave = $this->Payroll_model->get_Halfleaves($emp_id,$month,$year);
		$sick_leave = $this->Payroll_model->get_Sickleaves($emp_id,$month,$year);
		$total = ($half_leave[0]->total_days/2)+$result[0]->total_days+$sick_leave[0]->total_days;
		$result[0]->total_days = $total;
		$json_data = json_encode($result);
    	echo $json_data;
	}
	public function leav_details()
	{
		$staff_id = $this->input->post('staff_id');
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$result = $this->Payroll_model->leav_details($staff_id,$month,$year);
		$json_data = json_encode($result);
    	echo $json_data;
	}
	public function get_overtime()
	{
		$staff_id = $this->input->post('emp_id');
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$result = $this->Payroll_model->get_overtime($staff_id,$month,$year);
		$json_data = json_encode($result);
    	echo $json_data;
	}
	public function get_advance()
	{
		$staff_id = $this->input->post('emp_id');
		$month = $this->input->post('month');
		$year = $this->input->post('year');
		$result = $this->Payroll_model->get_advance($staff_id,$month,$year);
		$json_data = json_encode($result);
    	echo $json_data;
	}
		public function delete(){
       
        $payroll_id = $this->input->post('payroll_id');
        $updateData = array('payroll_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'payroll_id',$payroll_id);                       
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
        // redirect('/Customer/', 'refresh');
    }
}
?>