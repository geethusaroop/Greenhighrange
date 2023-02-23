<?php
ob_start();
require 'vendor/autoload.php';
use Dompdf\Dompdf;
defined('BASEPATH') OR exit('No direct script access allowed');
class RSreturn extends MY_Controller {
	public $table = 'tbl_sale';
	public $table1 = 'tbl_routsale';
	public $tbl_stock = 'tbl_product';
	public $page  = 'RSreturn';
	public function __construct() {
		parent::__construct();
         if(! $this->is_logged_in()){
            redirect('/login');
        }
        $this->load->model('General_model');
		$this->load->model('Routsale_model');
		$this->load->model('Purchase_model');
	//	$this->load->model('Customer_model');
		$this->load->model('Dashboard_model');
	}
	public function index()
	{
		
		$template['body'] = 'RSreturn/list';
		$template['script'] = 'RSreturn/script';
		$this->load->view('template',$template);
	}

	public function get(){
		$date=date('Y-m-d');
		$this->load->model('Routsale_model');
		$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
		$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
		$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
		$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
		$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';
		$param['item_name'] = (isset($_REQUEST['item_name'])) ? $_REQUEST['item_name'] : '';
		$data = $this->Routsale_model->getClassinfoTableretun($param,$date);
		$json_data = json_encode($data);
		echo $json_data;
    }

    public function addreturn_view()
	{
		
		$template['body'] = 'RSreturn/add';
		$template['script'] = 'RSreturn/script';
        $template['records']=$this->Routsale_model->return_stock($date);
		$this->load->view('template',$template);
	}

	public function add(){
	   
		$template['tax_names'] = $this->RSreturn_model->view_by();
		$this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$admno = $this->RSreturn_model->get_admno();
			if(isset($admno->sale_id)){$adm=$admno->invoice+1;}else{$adm=1;}
			$template['adm'] = $adm;
			$template['body'] = 'RSreturn/add';
			$template['script'] = 'RSreturn/script2';
			$this->load->view('template', $template);
		}
		else {
			$sessid = $this->session->userdata['id'];
		//	$shopid = $this->RSreturn_model->get_shop($sessid);
		$finyear = $this->Purchase_model->get_fyear();
		if(isset($finyear[0]->fin_year)){$fin=$finyear[0]->fin_year;}else{$fin=0;}
			//if(isset($shopid[0]->shop_id_fk)){$shid=$shopid[0]->shop_id_fk;}else{$shid=0;}
			/*-------------Dynamic Contents-------------*/
			$temp =count($this->input->post('product_id_fk'));
			$product_id_fk = $this->input->post('product_id_fk');
			$hsn = $this->input->post('hsn');
			$sale_quantity = $this->input->post('sale_quantity');
			$sale_price = $this->input->post('rate');
			$discount_price = $this->input->post('discount_price');
			$tax_id_fk = $this->input->post('taxtype');
			$sale_total_price = $this->input->post('net_total');//totalmat +oldbal
			$sale_date = str_replace('/', '-', $this->input->post('sale_date'));
			$sale_date =  date("Y-m-d",strtotime($sale_date));
			$invc_no = $this->input->post('invoice_no');
			$paid_amt = $this->input->post('paid_amt');
			$taxamount = $this->input->post('taxamount');
			$sale_cgst = $this->input->post('cgst');
			$sale_cgstamt = $this->input->post('cgstamt');
			$sale_sgst = $this->input->post('sgst');
			$sale_sgstamt = $this->input->post('sgstamt');
			$sale_igst = $this->input->post('igst');
			$sale_igstamt = $this->input->post('igstamt');
			$sale_netamt = $this->input->post('netamt');
			/*-------------Static Contents-------------*/
			$this->load->helper('string');
			$invoice_no = random_string('alnum',10);
			$grand_total = $this->input->post('net_total');
			$shop_id=$this->session->userdata('shop_id');
			 for($i=0;$i<$temp;$i++){
			$mem_type=$this->input->post('member_type');
			if($mem_type==1 || $mem_type==2  || $mem_type==3)
			{
				$member_id_fk=$this->input->post('custname');
			}
			else if($mem_type==4)
			{
				$data_mem=
					array(
					'member_name' =>$this->input->post('customer_name'),
					'member_type' =>$this->input->post('member_type'),
					'member_pnumber' => $this->input->post('customer_phone'),
					'member_address' => $this->input->post('customer_address'),
					'member_status' => 1
					);
					$this->General_model->add('tbl_member',$data_mem);
					$member_id_fk=$this->db->insert_id();
			}

				$data = array(
						'product_id_fk' => $product_id_fk[$i],
						'finyear'=>$fin,
						'member_type_fk' =>$this->input->post('member_type'),
						'member_id_fk' =>$member_id_fk,
						'customer_gst' => $this->input->post('customer_gst'),
						'sale_mop' => $this->input->post('purchase_mop'),
						'sale_taxmode' => "GST",
						'invoice_number' => $invc_no,
						'invoice' =>  $this->input->post('invoice'),
						'auto_invoice' => $invoice_no,
						'sale_hsn' => $hsn[$i],
						'sale_quantity' => $sale_quantity[$i],
						'sale_price' => $sale_price[$i],
						'discount_price' => $discount_price[$i],
						'total_price' => $sale_total_price,
						'taxamount' => $taxamount[$i],
						'sale_cgst' => $sale_cgst[$i],
						 'sale_cgstamt' => $sale_cgstamt[$i],
						 'sale_sgst' => $sale_sgst[$i],
						 'sale_sgstamt' => $sale_sgstamt[$i],
						 'sale_igst' => $sale_igst[$i],
						 'sale_igstamt' => $sale_igstamt[$i],
						 'sale_netamt' => $sale_netamt[$i],
						 'sale_discount' => $this->input->post('discount_prices'),
						 'sale_shareholder_discount' => $this->input->post('sale_shareholder_discount'),
						 'sale_old_balance' => $this->input->post('sale_old_balance'),
						 'sale_new_balance' => $this->input->post('total_amt'),
						 'sale_paid_amount' => $this->input->post('pamount'),//Received AMount
						'sale_date' => $sale_date,
						'sale_branch_id_fk'=>$this->session->userdata('branch_id_fk'),
						'sale_status' => 1,
						'routsale_status' => 1
							);
				//add to sale
				$this->General_model->add($this->table,$data);

				####################################################################################################
				$rsstok=$this->RSreturn_model->get_current_productstock($product_id_fk[$i]);
				$rsnwstk = $rsstok + $sale_quantity[$i];
				$rsData = array(
					'routsale_sale_count' =>$rsnwstk,
					);
				$result = $this->General_model->update($this->table1,$rsData,'routsale_product_id_fk',$product_id_fk[$i]);

				####################################################################################################

				}
	       redirect('/RSreturn/', 'refresh');
		}
	}


}
