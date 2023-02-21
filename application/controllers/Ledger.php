<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Ledger extends MY_Controller {
	public $table = 'tbl_ledgerbuk';
	public $table1 = 'tbl_daybook';
	public $page  = 'Ledger';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
		$this->load->model('Ledger_model');
		$this->load->model('General_model');
		$this->load->model('Member_model');
    }
	public function index()
	{
		
		$template['body'] = 'Ledger/list';
		$template['script'] = 'Ledger/script';
		//$template['opening'] = $this->Ledger_model->opening();
		// print_r($template['opening']);
		// exit();
		$gid =$this->session->userdata('gid');
		//$template['ledger']=$this->Ledger_model->gethead($gid);
		$this->load->view('template', $template);
	}
	public function getledger()
	{
		$gid =$this->session->userdata('prid');
		$head=$this->input->post('ledgerbuk_head');
		//$at_date = str_replace('/', '-', $this->input->post('start_date'));
		//$cdate=date('Y-m-d',strtotime($at_date));

		//$eat_date = str_replace('/', '-', $this->input->post('end_date'));
		//$edate=date('Y-m-d',strtotime($eat_date));
		//$template['ledger']=$this->Ledger_model->gethead($gid);
		//$template['groups'] = $this->Greport_model->getgroups();
		//$template['data']=$this->Ledger_model->getledger($gid,$cdate,$edate,$head);
		$at_date=$this->input->post('cdate');
		$cdate=date('Y-m-01',strtotime($at_date));
		$edate=date('Y-m-t',strtotime($at_date));
		$template['body'] = 'Ledger/list';
		$template['script'] = 'Ledger/script';
		$template['gid']=$gid;
	    $template['cdate']=$cdate;
	    $template['edate']=$edate;
	    $template['head']=$head;
	    
	        $template['voucher']=$this->Ledger_model->getpvoucher($cdate,$edate);
	         $template['receipt']=$this->Ledger_model->getpreceipt($cdate,$edate);

	         $template['purc']=$this->Ledger_model->getpurchase($cdate,$edate);
	         $template['sale']=$this->Ledger_model->getsaleincome($cdate,$edate);

	            $template['payroll']=$this->Ledger_model->getpayroll($cdate,$edate);
	             $template['advance']=$this->Ledger_model->getadvance($cdate,$edate);
	         
	    $this->load->view('template', $template);

	}
	public function get_sum()
	{$gid =$this->session->userdata('gid');
		$data = $this->Ledger_model->get_sum($gid);
		$json_data = json_encode($data);
		echo $json_data;
	}
	public function get_sum_()
	{$gid =$this->session->userdata('gid');
		//$date = str_replace('/', '-', $this->input->post('date'));
		$date = str_replace('/', '-', $this->input->post('start_date'));
		$date =  date("Y-m-d",strtotime($date));
		$data = $this->Ledger_model->get_sum_($date,$gid);
		$json_data = json_encode($data);
		echo $json_data;
	}
		public function get_opening()
	{$gid =$this->session->userdata('gid');
		//$date = str_replace('/', '-', $this->input->post('date'));
		$date = str_replace('/', '-', $this->input->post('start_date'));
		$date =  date("Y-m-d",strtotime($date));
		$data = $this->Ledger_model->get_opening($date,$gid);
		//$data1 = $this->Ledger_model->get_closing1($date);
		// print_r($data);
		// exit();
		$json_data = json_encode($data);
		echo $json_data;
		
	}
	public function get(){
		$gid =$this->session->userdata('gid');
		 $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		 $param['ledgerbuk_head'] = (isset($_REQUEST['ledgerbuk_head']))?$_REQUEST['ledgerbuk_head']:'';
		 $start_date =(isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';
		 $end_date =(isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';
		
		// if($start_date){
  //           $start_date = str_replace('/', '-', $start_date);
  //           $param['start_date'] =  date("Y-m-d",strtotime($start_date));
  //       }
       
        // if($end_date){
        //     $end_date = str_replace('/', '-', $end_date);
        //     $param['end_date'] =  date("Y-m-d",strtotime($end_date));
        // }
		
			
			
			 $data = $this->Ledger_model->getDaybookTable($param,$gid);
			 
			 /*else
			 {
			     $data = $this->Ledger_model->getDaybookTable($param);
			 }
			 */
		 
		 $json_data = json_encode($data);
		 echo $json_data;
    }
	public function update(){
		
        $Outs = $this->input->post('Outs');
		// print_r($Outs);
		// exit();
		$date = date("Y-m-d");
		// print_r($date);
		// exit();
        $updateData = array('date'=>$date,
							'closing_amount'=>$Outs,
							'ledgerbuk_status'=>1 );
        $data = $this->General_model->add($this->table,$updateData);
        if($data) {
            $response_text = 'Saved successfully';
            $response['type'] = 'success';
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				
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