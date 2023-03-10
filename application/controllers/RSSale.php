<?php
ob_start();
require 'vendor/autoload.php';
use Dompdf\Dompdf;
defined('BASEPATH') OR exit('No direct script access allowed');
class RSSale extends MY_Controller {
	public $table = 'tbl_sale';
	public $table1 = 'tbl_routsale';
	public $tbl_stock = 'tbl_product';
	public $page  = 'RSSale';
	public function __construct() {
		parent::__construct();
         if(! $this->is_logged_in()){
            redirect('/login');
        }
        $this->load->model('General_model');
		$this->load->model('RSSale_model');
		$this->load->model('Purchase_model');
		$this->load->model('Dashboard_model');
	}
	public function index()
	{
		
		$template['body'] = 'RSSale/list';
		$template['script'] = 'RSSale/script';
		$this->load->view('template',$template);
	}


	public function admin_view()
	{
		
		$template['body'] = 'RSSale/list-admin-view';
		$template['script'] = 'RSSale/script-admin-view';
		$this->load->view('template',$template);
	}


	public function view()
	{
		
		$template['body'] = 'RSSale/list-view';
		$template['script'] = 'RSSale/script-view';
		$this->load->view('template',$template);
		
	}

	public function getview(){
		$date=date('Y-m-d');
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$param['product_num'] = (isset($_REQUEST['product_num']))?$_REQUEST['product_num']:'';
		$data = $this->RSSale_model->getSaleReport1($param,$date);
		$json_data = json_encode($data);
    	echo $json_data;
    }

	public function add(){
	   
		$template['tax_names'] = $this->RSSale_model->view_by();
		$this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$admno = $this->RSSale_model->get_admno();
			if(isset($admno->sale_id)){$adm=$admno->invoice+1;}else{$adm=1;}
			$template['adm'] = $adm;
			$template['body'] = 'RSSale/add';
			$template['script'] = 'RSSale/script2';
			$this->load->view('template', $template);
		}
		else {
			$sessid = $this->session->userdata['id'];
		//	$shopid = $this->RSSale_model->get_shop($sessid);
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
				$rsstok=$this->RSSale_model->get_current_productstock($product_id_fk[$i]);
				$rsnwstk = $rsstok + $sale_quantity[$i];
				$rsData = array(
					'routsale_sale_count' =>$rsnwstk,
					);
				$result = $this->General_model->update($this->table1,$rsData,'routsale_product_id_fk',$product_id_fk[$i]);

				####################################################################################################

				$mdata=array('member_sale_balance'=> $this->input->post('total_amt'));
				$result = $this->General_model->update('tbl_member',$mdata,'member_id',$member_id_fk);
				####################################################################################################
				
				}
	       redirect('/RSSale/invoice/'.$invoice_no, 'refresh');
		}
	}
	#########################################################################################################
	public function invoice($invoice_no)
	{
		$template['body'] = 'RSSale_Invoice/Invoice2';
		$template['script'] = 'RSSale_Invoice/script';
		
		$template['records'] = $this->RSSale_model->get_invc($invoice_no);
		$this->load->view('template', $template);
	}
	public function invoiceview($invoice_no)
	{
		$template['body'] = 'RSSale_Invoice/Invoice2';
		$template['script'] = 'RSSale_Invoice/script';
		
		$template['records'] = $this->RSSale_model->get_invoice($invoice_no);
		//var_dump($template['records']);die;
		//echo "<pre>"; print_r($template['records']);
		$this->load->view('template', $template);
	}
	#########################################################################################################
	public function get(){
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$param['product_num'] = (isset($_REQUEST['product_num']))?$_REQUEST['product_num']:'';
		$param['sdate'] =(isset($_REQUEST['sdate']))?$_REQUEST['sdate']:'';
       /*  $end_date =(isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';
		if($start_date){
            $start_date = str_replace('/', '-', $start_date);
            $param['start_date'] =  date("Y-m-d",strtotime($start_date));
        }
        if($end_date){
            $end_date = str_replace('/', '-', $end_date);
            $param['end_date'] =  date("Y-m-d",strtotime($end_date));
        } */
    
		$data = $this->RSSale_model->getSaleReport($param);
		$json_data = json_encode($data);
    	echo $json_data;
    }
	#########################################################################################################
	public function delete()
	{
		$invoice_number = $this->input->post('invoice_id');
		$records = $this->RSSale_model->get_invc($invoice_number);
		for($i=0; $i< count($records); $i++)
		{
			$stok = $this->RSSale_model->get_prodstk($records[$i]->product_id);
			//var_dump($stok);die;
            $nwstk = $stok[0]->product_stock + $records[$i]->sale_quantity;
            
			$updateData = array('product_stock' =>$nwstk);	
			
			$datas = $this->General_model->update('tbl_product',$updateData,'product_id',$records[$i]->product_id);
		}
		$updateDatas = array('sale_status' => 0);
		$data = $this->General_model->update($this->table, $updateDatas, 'auto_invoice', $invoice_number);
		if ($data) {
			$response['text'] = 'Deleted successfully';
			$response['type'] = 'success';
		} else {
			$response['text'] = 'Something went wrong';
			$response['type'] = 'error';
		}
		$response['layout'] = 'topRight';
		$data_json = json_encode($response);
		echo $data_json;
		//redirect('/RSSale/', 'refresh');
	}
#########################################################################################################
	public function edit($product_id){
		$template['body'] = 'RSSale/add';
		$template['script'] = 'RSSale/script';
		$template['category_names'] = $this->Category_model->view_by();
		$template['records'] = $this->General_model->get_row($this->table,'product_id',$product_id);
    	$this->load->view('template', $template);
	}
	function getproductnum(){
	header('Content-Type: application/x-json; charset=utf-8');
	$result = $this->RSSale_model->getproductnum();
	echo json_encode($result);
    }
    public function getproductname(){
	header('Content-Type: application/x-json; charset=utf-8');
	$result = $this->RSSale_model->getproductnames();
	echo json_encode($result);
    }
    public function getprice()
	{
	$product_id_fk = $this->input->post('product_id_fk');
	$data = $this->RSSale_model->getprice($product_id_fk);
	$json_data = json_encode($data);
	echo $json_data;
	}
	
	 public function get_price(){
	//header('Content-Type: application/x-json; charset=utf-8');
	$product_id = $this->input->post('p_id');
	//print_r($product_id);
	//exit();
	$result = $this->RSSale_model->get_price($product_id);
	echo json_encode($result);
    }
	function gettax(){
	header('Content-Type: application/x-json; charset=utf-8');
	$result = $this->RSSale_model->gettax();
	echo json_encode($result);
    }
	public function get_purchasedetails(){
	    $product_num = $this->input->post('product_num');
		//$product_size = $this->input->post('product_size');
		//$data = $this->RSSale_model->get_purchasedetails($product_num,$product_size);
		$data = $this->RSSale_model->get_purchasedetails2($product_num);
		$data_json = json_encode($data);
    	echo $data_json;
	}
	public function getstock(){
		$product_id =$this->input->post('product_id');
		$shop_id = $this->input->post('shop_id');
		$stok = $this->RSSale_model->get_stok($product_id,$shop_id);
		//if(isset($stok[0]->production_quantity)){$mas=$stok[0]->production_quantity;}else{$mas=0;};
		if(isset($stok[0]->item_quantity)){$mas=$stok[0]->item_quantity;}else{$mas=0;};
		$json_data = json_encode($mas);
		echo $json_data;
	}
	public function getproduct()
	{
		header('Content-Type: application/x-json; charset=utf-8');
		$product_cmpny = $this->input->post('product_cmpny');
		$product_size = $this->input->post('product_size');
		$data = $this->RSSale_model->getproduct($product_cmpny,$product_size);
		$data_json = json_encode($data);
		echo $data_json;
    }
	public function getproductcompany()
	{
		header('Content-Type: application/x-json; charset=utf-8');
		$product_size = $this->input->post('product_size');
		$data = $this->RSSale_model->getproductcompany($product_size);
		$data_json = json_encode($data);
		echo $data_json;
	}
	 public function getproductname1(){
    $prod_id = $this->input->post('p_id');
	$data['product'] = $this->RSSale_model->getproductname1($prod_id);
	echo json_encode($data);
    }
	// function get_memberaddress(){
	// 	$id = $this->input->post('member_id');
	// 	$data = $this->RSSale_model->get_memberaddress($id);
	// 	echo json_encode($data);
	// }
	function get_memberaddress(){
		$id = $this->input->post('id');
		//$data = $this->RSSale_model->get_memberaddress($id);
		//echo json_encode($data);
		$records = $this->RSSale_model->get_memberaddress($id);
		$data_json = json_encode($records);
        echo $data_json;
	}
	function get_phone(){
		$id = $this->input->post('id');
		//$data = $this->RSSale_model->get_memberaddress($id);
		//echo json_encode($data);
		$records = $this->RSSale_model->get_phone($id);
		$data_json = json_encode($records);
        echo $data_json;
	}
	public function getOldBalance()
	{
		$id = $this->input->post('id');
		$data = $this->RSSale_model->getOldBalanceDetails($id);
		echo json_encode($data);
	}
	public function getMemberList()
	{
		$mem_id = $_POST['mem_id'];
		$data = $this->RSSale_model->getMemberlists($mem_id);
		echo json_encode($data);
	}

	public function get_table(){
		$table='tbl_production_itemlist';
		$result=$this->RSSale_model->get_table($table);
		echo "<pre>"; print_r($result); die;
	}


	public function getproduct_names()
	{
		$id = ($this->input->get('phrase'))?$this->input->get('phrase'):'';
		$data =  $this->RSSale_model->getproduct_names($id);
		echo json_encode($data);
	}

	public function getProductDetails1()
	{
		$prod1 = [];
		$p_name = $this->input->post('p_name');
		$data['product_name1'] =  $this->RSSale_model->get_row_barcode($p_name);
		$prod1['hsncode'] = $data['product_name1']->product_hsncode;
		$prod1['igst'] = $data['product_name1']->hsn_igst;
		$prod1['cgst'] = $data['product_name1']->hsn_cgst;
		$prod1['sgst'] = $data['product_name1']->hsn_sgst;
		$prod1['prod_cod'] = $data['product_name1']->product_code;
		$prod1['prod_id'] = $data['product_name1']->product_id;
		$prod1['stock'] = $data['product_name1']->product_stock;
		echo json_encode($prod1);
	}

	public function getProductDetails2()
	{
		$prod1 = [];
		$pid = $this->input->post('product_num');
		$ptype = $this->input->post('rate_type');
		$data['product_name1'] =  $this->RSSale_model->get_row_rate($pid);
		if($ptype==1)
		{
			$prod1['rate'] = $data['product_name1']->product_price_r1;
		}
		else if($ptype==2)
		{
			$prod1['rate'] = $data['product_name1']->product_price_r2;
		}
		else if($ptype==3)
		{
			$prod1['rate'] = $data['product_name1']->product_price_r3;
		}

		echo json_encode($prod1);
	}

	public function Pdf_Sale($auto_invoice)
	{
		$records = $this->RSSale_model->get_sale_pdf($auto_invoice);
		// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$dompdf->loadHtml($records);
		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'landscape');
		// Render the HTML as PDF
		$dompdf->render();
		// Output the generated PDF to Browser
		$dompdf->stream("".$auto_invoice.".pdf");
	}

	public function get_old_bal()
	{
		$mem_id = $this->input->post('vid');
		$records = $this->RSSale_model->get_old_bal($mem_id);
		$data_json = json_encode($records);
		echo $data_json;
	}


}
