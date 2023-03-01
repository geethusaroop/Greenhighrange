<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BLedger extends MY_Controller {
	public $table = 'tbl_ledgerbuk';
	public $table1 = 'tbl_daybook';
	public $page  = 'Ledger';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
		$this->load->model('BLedger_model');
		$this->load->model('General_model');
		$this->load->model('Member_model');
		$this->load->model('Vendor_voucher_model');
    }
	public function index()
	{
		
		$template['body'] = 'BLedger/list';
		$template['script'] = 'BLedger/script';
		
		$gid =$this->session->userdata('gid');
		$this->load->view('template', $template);
	}
	public function getledger()
	{
		$gid =$this->session->userdata('prid');
		$head=$this->input->post('ledgerbuk_head');
		$branch_id_fk =$this->session->userdata('branch_id_fk');
		$at_date=$this->input->post('cdate');
		$cdate=date('Y-m-01',strtotime($at_date));
		$edate=date('Y-m-t',strtotime($at_date));
		$template['body'] = 'BLedger/list';
		$template['script'] = 'BLedger/script';
		$template['gid']=$branch_id_fk;
	    $template['cdate']=$cdate;
	    $template['edate']=$edate;
	    $template['head']=$head;
	    
	        $template['voucher']=$this->BLedger_model->getpvoucher($cdate,$edate,$branch_id_fk);
	         $template['receipt']=$this->BLedger_model->getpreceipt($cdate,$edate,$branch_id_fk);

	         $template['purc']=$this->BLedger_model->getpurchase($cdate,$edate,$branch_id_fk);
	         $template['sale']=$this->BLedger_model->getsaleincome($cdate,$edate,$branch_id_fk);

	          
	    $this->load->view('template', $template);

	}




	public function report()
	{
		$template['body'] = 'BLedger/list-report';
		$template['script'] = 'BLedger/script';
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['vendor_names'] = $this->Vendor_voucher_model->view_by($branch_id_fk);
		$this->load->view('template', $template);
	}

	public function getledger_report()
	{
		$gid =0;
		$vendor_id=$this->input->post('vendor_id_fk');
		$cdate=$this->input->post('cdate');
		$edate=$this->input->post('edate');
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['vendor_names'] = $this->Vendor_voucher_model->view_by($branch_id_fk);
		$template['body'] = 'BLedger/list-report';
		$template['script'] = 'BLedger/script';
		$template['gid']=$gid;
	    $template['cdate']=$cdate;
	    $template['edate']=$edate;
	    $template['vendor']=$vendor_id;
		$template['cbal']=$this->BLedger_model->opening_ledger($gid,$cdate,$vendor_id,$branch_id_fk);
		//var_dump($template['cbal']);
		$template['cbal1']=$this->BLedger_model->opening_ledger1($gid,$cdate,$vendor_id,$branch_id_fk);
		$template['cbal2']=$this->BLedger_model->opening_ledger2($gid,$cdate,$vendor_id,$branch_id_fk);
		$template['purc1']=$this->BLedger_model->getpurchase_ledger($gid,$cdate,$edate,$vendor_id,$branch_id_fk);
		$template['purc2']=$this->BLedger_model->getpurchase_ledger_pay($gid,$cdate,$edate,$vendor_id,$branch_id_fk);
		$template['purchase_return1']=$this->BLedger_model->getpurchasereturn_pay($gid,$cdate,$edate,$vendor_id,$branch_id_fk);
		//var_dump($template['purc1']);die;
	    $this->load->view('template', $template);

	}

	public function add_opening_balance()
	{
		$vendor_id=$this->input->post('vendor_id');
		$cdate=$this->input->post('cdate_bal');
		$closing_amt=$this->input->post('closing_amt');
		$updateData = array('open_date'=>$cdate,
		'opening_balance'=>$closing_amt,
		);
		$result = $this->General_model->update('tbl_vendor',$updateData,'vendor_id',$vendor_id);
		$response_text = 'Opening Balance Added  successfully';
		if($result){
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			}
			else{
			$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
		redirect('/BLedger/report/', 'refresh');
	}



	public function get_sum()
	{$gid =$this->session->userdata('gid');
		$data = $this->BLedger_model->get_sum($gid);
		$json_data = json_encode($data);
		echo $json_data;
	}
	public function get_sum_()
	{$gid =$this->session->userdata('gid');
		//$date = str_replace('/', '-', $this->input->post('date'));
		$date = str_replace('/', '-', $this->input->post('start_date'));
		$date =  date("Y-m-d",strtotime($date));
		$data = $this->BLedger_model->get_sum_($date,$gid);
		$json_data = json_encode($data);
		echo $json_data;
	}
		public function get_opening()
	{$gid =$this->session->userdata('gid');
		//$date = str_replace('/', '-', $this->input->post('date'));
		$date = str_replace('/', '-', $this->input->post('start_date'));
		$date =  date("Y-m-d",strtotime($date));
		$data = $this->BLedger_model->get_opening($date,$gid);
		//$data1 = $this->BLedger_model->get_closing1($date);
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
		
			
			
			 $data = $this->BLedger_model->getDaybookTable($param,$gid);
			 
			 /*else
			 {
			     $data = $this->BLedger_model->getDaybookTable($param);
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