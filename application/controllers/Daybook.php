<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Daybook extends MY_Controller
{
	public $table1 = 'tbl_daybuk';
	public $table = 'tbl_daybook';
	public $page  = 'Daybook';
	public function __construct()
	{
		parent::__construct();
		if (!$this->is_logged_in()) {
			redirect('/login');
		}
		$this->load->model('Daybook_model');
		$this->load->model('General_model');
		$this->load->model('Member_model');
	}
	public function index()
	{
		//$gid =$this->session->userdata('gid');
		
		$template['body'] = 'Daybook/list';
		$template['script'] = 'Daybook/script';
		//$sdate=date('Y-m-d');
		$sdate = date('Y-m-d');
		//$prid =$this->session->userdata('prid');
		$template['opening'] = $this->Daybook_model->popening();
		//$template['sum']=$this->Daybook_model->get_sum($gid);
		$template['voucher'] = $this->Daybook_model->getpvoucher($sdate);
		$template['receipt'] = $this->Daybook_model->getpreceipt($sdate);
		$template['purc'] = $this->Daybook_model->getpurchase($sdate);
		$template['saleincome'] = $this->Daybook_model->getsaleincome($sdate);
		$template['payroll'] = $this->Daybook_model->getpayroll($sdate);
		$template['advance'] = $this->Daybook_model->getadvance($sdate);
		$template['venodr_voucher'] = $this->Daybook_model->getVendorVoucher($sdate);
		$template['bdeposit'] = $this->Daybook_model->getbdeposit($sdate);
		$template['share_deposit'] = $this->Daybook_model->getsharedeposit($sdate);
		$template['fund'] = $this->Daybook_model->getfund($sdate);
		$template['sdate'] = $sdate;
		$this->load->view('template', $template);
	}
	public function getdaybook()
	{
		//$prid =$this->session->userdata('prid');
		
		$template['body'] = 'Daybook/list';
		$template['script'] = 'Daybook/script';
		//$date = str_replace('/', '-', $this->input->post('daybuk_date'));
		//$sdate =  date("Y-m-d",strtotime($date));
		$sdate =  date("Y-m-d", strtotime($this->input->post('daybuk_date')));
		$template['opening'] = $this->Daybook_model->get_popening($sdate);
		$template['voucher'] = $this->Daybook_model->getpvoucher($sdate);
		$template['receipt'] = $this->Daybook_model->getpreceipt($sdate);
		$template['purc'] = $this->Daybook_model->getpurchase($sdate);
		$template['venodr_voucher'] = $this->Daybook_model->getVendorVoucher($sdate);
		$template['saleincome'] = $this->Daybook_model->getsaleincome($sdate);
		$template['payroll'] = $this->Daybook_model->getpayroll($sdate);
		$template['advance'] = $this->Daybook_model->getadvance($sdate);
		$template['bdeposit'] = $this->Daybook_model->getbdeposit($sdate);
		$template['share_deposit'] = $this->Daybook_model->getsharedeposit($sdate);
		$template['fund'] = $this->Daybook_model->getfund($sdate);
		$template['sdate'] = $sdate;
		$pay=$this->Daybook_model->getpayroll($sdate);
		$template['count']=count($pay);
		$this->load->view('template', $template);
	}
	public function get_sum()
	{
		$gid = $this->session->userdata('gid');
		$data = $this->Daybook_model->get_sum($gid);
		$json_data = json_encode($data);
		echo $json_data;
	}
	public function get_sum_()
	{
		$gid = $this->session->userdata('gid');
		//$date = str_replace('/', '-', $this->input->post('date'));
		$date = str_replace('/', '-', $this->input->post('daybuk_date'));
		$date =  date("Y-m-d", strtotime($date));
		$data = $this->Daybook_model->get_sum_($date, $gid);
		$json_data = json_encode($data);
		echo $json_data;
	}
	public function get_opening()
	{
		$gid = $this->session->userdata('gid');
		//$date = str_replace('/', '-', $this->input->post('date'));
		$date = str_replace('/', '-', $this->input->post('daybuk_date'));
		$date =  date("Y-m-d", strtotime($date));
		$data = $this->Daybook_model->get_opening($date, $gid);
		//$data1 = $this->Daybook_model->get_closing1($date);
		// print_r($data);
		// exit();
		$json_data = json_encode($data);
		echo $json_data;
	}
	/*public function get(){
	$gid =$this->session->userdata('gid');
	$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
	//$date =(isset($_REQUEST['date']))?$_REQUEST['date']:'';
	$date =(isset($_REQUEST['daybuk_date']))?$_REQUEST['daybuk_date']:'';
	if($date){
	$date = str_replace('/', '-', $date);
	$param['date'] =  date("Y-m-d",strtotime($date));
	$data = $this->Daybook_model->getDaybookTable($param,$gid);
}
else
{
$data = $this->Daybook_model->getDaybookTable($param,$gid);
}
$json_data = json_encode($data);
echo $json_data;
}*/
	public function updates()
	{
		$profit = $this->input->post('profit_amt');
		$stat = $this->input->post('stat');
		$date = str_replace('/', '-', $this->input->post('cdate'));
		//$date =  date("Y-m-d",strtotime($date));
		$date =  date("Y-m-d", strtotime($this->input->post('cdate')));
		$prid = $this->session->userdata('prid');
		$result = $this->Daybook_model->pclosebalance($date);
		if ($result) {
			$datas = $this->Daybook_model->pupdate_daybook($date, $profit, $stat);
		} else {
			//if($Outs!=0){
			$updateData = array(
				'date' => $date,
				'closing_amt' => $profit,
				'credit_status' => $stat,
				'daybook_status' => 2
			);
			$data = $this->General_model->add($this->table, $updateData);
			/*}
		else{
		$updateData = array('date'=>$date,
		'closing_amount'=>$Outs1,
		'daybuk_group'=>$gid,
		'status'=>2 );
		$data = $this->General_model->add($this->table,$updateData);
	}*/
		}
		/*if($data) {
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
echo $data_json;*/
		/*if($data)
{
?>
<script language="javascript" type="text/javascript">
window.onload = function()
{
alert("Saved successfully");
window.location.href='/GDaybook/';
}
</script>
<?php
}*/
		//redirect('/GDaybook/', 'refresh');
	}
	public function view()
	{
		
		$template['body'] = 'GDaybook/view';
		$template['script'] = 'GDaybook/script';
		$this->load->view('template', $template);
	}
	public function get_daybook()
	{
		$daybuk_date = str_replace('/', '-', $this->input->post('daybuk_date'));
		$daybuk_date = date("Y-m-d", strtotime($daybuk_date));
		$template['opening'] = $this->Daybook_model->opening_d($daybuk_date);
		$template['body'] = 'GDaybook/view';
		$template['script'] = 'GDaybook/script';
		$this->load->view('template', $template);
	}
}
