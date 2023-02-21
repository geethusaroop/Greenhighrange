<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Emp_attendence extends MY_Controller {
	public $table = 'tbl_empattendance';
	public $tbl_empabsent ='tbl_empabsent';
	public $tbl_sickleave ='tbl_sickleave';
	public $tbl_halfleave ='tbl_halfleave';
	public $page  = 'Emp_attendence';
	public function __construct() {
		parent::__construct();
         if(! $this->is_logged_in()){
            redirect('/login');
        }
        
        $this->load->model('General_model');
		$this->load->model('Emp_attendence_model');
		$this->load->model('Employee_model');
	}
	public function index()
	{
		
		$template['body'] = 'Emp_attendence/list';
		$template['script'] = 'Emp_attendence/script';
		$this->load->view('template', $template);
	}
	public function get(){
		
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$data = $this->Emp_attendence_model->getServiceCallReport($param);
		$json_data = json_encode($data);
    	echo $json_data;
    }
	public function get_att()
	{
		$date1 = str_replace('/', '-', $this->input->post('date'));
		$date2 = date("Y-m-d",strtotime($date1));
		
		$template['records'] = $this->Emp_attendence_model->get_att($date2);
		$template['body'] = 'Emp_attendence/view';
		$template['script'] = 'Emp_attendence/script';
		$this->load->view('template', $template);
		
	}
	public function absent_reg()
	{
		$emp_id = $this->input->post('emp_id');
		$at_date = str_replace('/', '-', $this->input->post('att_date'));
		$attt_date = date("Y-m-d",strtotime($at_date));
		$data = array(
						'absent_date'=> $attt_date,
						'emp_id_fk'=> $emp_id,
						'absent_status'=> 1
						);
		$result = $this->General_model->add($this->tbl_empabsent,$data);
		$response_text = 'Absent Registered successfully';
		if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
	
        echo json_encode($result);
	}
	public function attend_reg()
	{
		$emp_id = $this->input->post('emp_id');
		$session = $this->input->post('session');
		$at_date = str_replace('/', '-', $this->input->post('att_date'));
		$attt_date = date("Y-m-d",strtotime($at_date));
		$data = array(
						'att_date'=> $attt_date,
						'emp_id_fk'=> $emp_id,
						'att_status'=> 1
						);
		$result = $this->General_model->add($this->table,$data);
		$response_text = 'Attendance Registered successfully';
		if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
	
        echo json_encode($result);
	}
	public function sickleave_reg()
	{
		$emp_id = $this->input->post('emp_id');
		$session = $this->input->post('session');
		$at_date = str_replace('/', '-', $this->input->post('att_date'));
		$attt_date = date("Y-m-d",strtotime($at_date));
		$data = array(
						'sick_date'=> $attt_date,
						'emp_id_fk'=> $emp_id,
						'sick_status'=> 1
						);
		$result = $this->General_model->add($this->tbl_sickleave,$data);
		$response_text = 'Leave marked successfully';
		if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
	
        echo json_encode($result);
	}
	public function halfleave_reg()
	{
		$emp_id = $this->input->post('emp_id');
		$session = $this->input->post('session');
		$at_date = str_replace('/', '-', $this->input->post('att_date'));
		$attt_date = date("Y-m-d",strtotime($at_date));
		$data = array(
						'half_date'=> $attt_date,
						'emp_id_fk'=> $emp_id,
						'half_status'=> 1
						);
		$result = $this->General_model->add($this->tbl_halfleave,$data);
		$response_text = 'Leave ttendance Registered successfully';
		if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}
	
        echo json_encode($result);
	}
}
?>