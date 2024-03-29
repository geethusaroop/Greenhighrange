<?php
ob_start();
require 'vendor/autoload.php';

use Dompdf\Dompdf;
//use Netflie\WhatsAppCloudApi\WhatsAppCloudApi;

//require 'vendor/netflie/whatsapp-cloud-api/src/WhatsAppCloudApi.php';

defined('BASEPATH') or exit('No direct script access allowed');
class Sale extends MY_Controller
{
	public $table = 'tbl_sale';
	public $tbl_stock = 'tbl_product';
	public $tbl_customer = 'tbl_customer';
	public $tbl_daybuk = 'tbl_daybuk';
	public $tbl_ledgerbuk = 'tbl_ledgerbuk';
	public $page  = 'Sale';
	public function __construct()
	{
		parent::__construct();
		if (!$this->is_logged_in()) {
			redirect('/login');
		}
		$this->load->model('General_model');
		$this->load->model('Sale_model');
		$this->load->model('Purchase_model');
		//	$this->load->model('Customer_model');
		$this->load->model('Dashboard_model');
	}
	public function index()
	{

		$template['body'] = 'Sale/list';
		$template['script'] = 'Sale/script';
		$this->load->view('template', $template);
	}
	public function add()
	{

		$template['tax_names'] = $this->Sale_model->view_by();
		$this->form_validation->set_rules('customer_name', 'Customer Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$admno = $this->Sale_model->get_admno();
			if (isset($admno->sale_id)) {
				$adm = $admno->invoice + 1;
			} else {
				$adm = 1;
			}
			$template['adm'] = $adm;
			$template['body'] = 'Sale/add';
			$template['script'] = 'Sale/script2';
			$this->load->view('template', $template);
		} else {
			$sessid = $this->session->userdata['id'];
			//	$shopid = $this->Sale_model->get_shop($sessid);
			$finyear = $this->Purchase_model->get_fyear();
			if (isset($finyear[0]->fin_year)) {
				$fin = $finyear[0]->fin_year;
			} else {
				$fin = 0;
			}
			//if(isset($shopid[0]->shop_id_fk)){$shid=$shopid[0]->shop_id_fk;}else{$shid=0;}
			/*-------------Dynamic Contents-------------*/
			$temp = count($this->input->post('product_id_fk'));
			$product_id_fk = $this->input->post('product_id_fk');
			$product_branch_id_fk = $this->input->post('prod_branch_id');
			$hsn = $this->input->post('hsn');
			$sale_quantity = $this->input->post('sale_quantity');
			$sale_price = $this->input->post('rate');
			$discount_price = $this->input->post('discount_price');
			$tax_id_fk = $this->input->post('taxtype');
			$sale_total_price = $this->input->post('net_total'); //totalmat +oldbal
			$sale_date = str_replace('/', '-', $this->input->post('sale_date'));
			$sale_date =  date("Y-m-d", strtotime($sale_date));
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
			/* $old_balance = $this->input->post('old_bal');
			if(empty($old_balance)){
				$old_balance = 0;
				$new_old_balance = $paid_amt - $old_balance;
			}
			else
			{
				$old_balance = $this->input->post('old_bal');
				$new_old_balance = $old_balance - $paid_amt;
				if($new_old_balance > 0){
					$new_old_balance = $old_balance - $paid_amt;
				}
				else
				{
					$new_old_balance = 0;
				}
			} */
			/*-------------Static Contents-------------*/
			$this->load->helper('string');
			$invoice_no = random_string('alnum', 10);
			$grand_total = $this->input->post('net_total');
			$shop_id = $this->session->userdata('shop_id');
			for ($i = 0; $i < $temp; $i++) {
				//	$stok = $this->Sale_model->get_stk($product_id_fk[$i]);
				//	$nwstk = $stok[0]->production_quantity - $sale_quantity[$i];
				$mem_type = $this->input->post('member_type');
				if ($mem_type == 1 || $mem_type == 2  || $mem_type == 3) {
					$member_id_fk = $this->input->post('custname');
				} else if ($mem_type == 4) {
					$data_mem =
						array(
							'member_name' => $this->input->post('customer_name'),
							'member_type' => $this->input->post('member_type'),
							'member_pnumber' => $this->input->post('customer_phone'),
							'member_address' => $this->input->post('customer_address'),
							'member_status' => 1
						);
					$this->General_model->add('tbl_member', $data_mem);
					$member_id_fk = $this->db->insert_id();
				}

				$data = array(
					'product_id_fk' => $product_id_fk[$i],
					'finyear' => $fin,
					//'customer_name' =>$this->input->post('customer_name'),
					'member_type_fk' => $this->input->post('member_type'),
					'member_id_fk' => $member_id_fk,
					//'customer_phone' => $this->input->post('customer_phone'),
					//'customer_email' => $this->input->post('customer_email'),
					//'customer_address' => $this->input->post('customer_address'),
					'customer_gst' => $this->input->post('customer_gst'),
					'sale_mop' => $this->input->post('purchase_mop'),
					'sale_taxmode' => "GST",
					'invoice_number' => $invc_no,
					'invoice' =>  $this->input->post('invoice'),
					'auto_invoice' => $invoice_no,
					//'customer_paid_amt' =>$paid_amt,
					//'customer_old_bal'=>$new_old_balance,
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
					'sale_paid_amount' => $this->input->post('pamount'), //Received AMount
					'sale_date' => $sale_date,
					'sale_branch_id_fk' => $this->session->userdata('branch_id_fk'),
					'sale_status' => 1
				);

				$this->General_model->add($this->table, $data);
				$branches_id = $this->session->userdata('branch_id_fk');
				$stok = $this->Purchase_model->get_current_productstock($product_branch_id_fk[$i], $branches_id);
				$nwstk = $stok - $sale_quantity[$i];
				$uData = array(
					'product_stock' => $nwstk,
					'product_updated_date' => date('Y-m-d'),
				);

				// $result = $this->General_model->update($this->tbl_stock,$uData,'product_id',$product_id_fk[$i]);
				$result = $this->General_model->updat($this->tbl_stock, $uData, 'product_id', $product_branch_id_fk[$i], 'branch_id_fk', $branches_id);
				$datass = $this->General_model->get_row('tbl_member', 'member_id', $member_id_fk);
				$updated_amount = $datass->member_sale_balance + ($this->input->post('total_amt'));
				$mdata = array('member_sale_balance' => $updated_amount);
				$result = $this->General_model->update('tbl_member', $mdata, 'member_id', $member_id_fk);
			}
			redirect('/Sale/invoice/' . $invoice_no, 'refresh');
		}
	}
	public function invoice($invoice_no)
	{
		$template['body'] = 'Sale_Invoice/Invoice2';
		$template['script'] = 'Sale_Invoice/script';

		$template['records'] = $this->Sale_model->get_invc($invoice_no);
		$this->load->view('template', $template);
	}
	public function invoiceview($invoice_no)
	{
		$template['body'] = 'Sale_Invoice/Invoice2';
		$template['script'] = 'Sale_Invoice/script';

		$template['records'] = $this->Sale_model->get_invoice($invoice_no);
		//var_dump($template['records']);die;
		//echo "<pre>"; print_r($template['records']);
		$this->load->view('template', $template);
	}
	public function get()
	{
		$branch_id_fk = $this->session->userdata('branch_id_fk');
		$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
		$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
		$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
		$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
		$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';
		$param['product_num'] = (isset($_REQUEST['product_num'])) ? $_REQUEST['product_num'] : '';
		/* 		$start_date =(isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';
        $end_date =(isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';
		if($start_date){
            $start_date = str_replace('/', '-', $start_date);
            $param['start_date'] =  date("Y-m-d",strtotime($start_date));
        }
        if($end_date){
            $end_date = str_replace('/', '-', $end_date);
            $param['end_date'] =  date("Y-m-d",strtotime($end_date));
        } */
		$param['start_date'] = (isset($_REQUEST['start_date'])) ? $_REQUEST['start_date'] : '';
		$param['end_date'] = (isset($_REQUEST['end_date'])) ? $_REQUEST['end_date'] : '';
		// $sessid = $this->session->userdata['id'];
		//$shopid = $this->Sale_model->get_shop($sessid);
		//if(isset($shopid[0]->shop_id_fk)){$shid=$shopid[0]->shop_id_fk;}else{$shid=0;}
		//$param['shop'] =$shid;
		$data = $this->Sale_model->getSaleReport($param, $branch_id_fk);
		$json_data = json_encode($data);
		echo $json_data;
	}
	/* public function delete(){
        $product_id = $this->input->post('product_id');
        $updateData = array('product_status' => 0);
        $data = $this->General_model->update($this->table,$updateData,'product_id',$product_id);
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
		redirect('/Sale/', 'refresh');
    } */

	public function delete()
	{
		$invoice_number = $this->input->post('invoice_id');
		$records = $this->Sale_model->get_invc($invoice_number);
		for ($i = 0; $i < count($records); $i++) {
			$stok = $this->Sale_model->get_prodstk($records[$i]->product_id);
			//var_dump($stok);die;
			$nwstk = $stok[0]->product_stock + $records[$i]->sale_quantity;

			$updateData = array('product_stock' => $nwstk);

			$datas = $this->General_model->update('tbl_product', $updateData, 'product_id', $records[$i]->product_id);
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
		//redirect('/Sale/', 'refresh');
	}

	public function edit($product_id)
	{
		$template['body'] = 'Sale/add';
		$template['script'] = 'Sale/script';
		$template['category_names'] = $this->Category_model->view_by();
		$template['records'] = $this->General_model->get_row($this->table, 'product_id', $product_id);
		$this->load->view('template', $template);
	}
	function getproductnum()
	{
		header('Content-Type: application/x-json; charset=utf-8');
		$result = $this->Sale_model->getproductnum();
		echo json_encode($result);
	}
	public function getproductname()
	{
		header('Content-Type: application/x-json; charset=utf-8');
		$result = $this->Sale_model->getproductnames();
		echo json_encode($result);
	}
	public function getprice()
	{
		$product_id_fk = $this->input->post('product_id_fk');
		$data = $this->Sale_model->getprice($product_id_fk);
		$json_data = json_encode($data);
		echo $json_data;
	}
	// function get_price(){
	// //header('Content-Type: application/x-json; charset=utf-8');
	// $product_id = $this->input->post('product_num');
	// print_r($product_id);
	// exit();
	// $result = $this->Sale_model->get_price($product_id);
	// echo json_encode($result);
	//    }
	public function get_price()
	{
		//header('Content-Type: application/x-json; charset=utf-8');
		$product_id = $this->input->post('p_id');
		//print_r($product_id);
		//exit();
		$result = $this->Sale_model->get_price($product_id);
		echo json_encode($result);
	}
	function gettax()
	{
		header('Content-Type: application/x-json; charset=utf-8');
		$result = $this->Sale_model->gettax();
		echo json_encode($result);
	}
	public function get_purchasedetails()
	{
		$product_num = $this->input->post('product_num');
		//$product_size = $this->input->post('product_size');
		//$data = $this->Sale_model->get_purchasedetails($product_num,$product_size);
		$data = $this->Sale_model->get_purchasedetails2($product_num);
		$data_json = json_encode($data);
		echo $data_json;
	}
	public function getstock()
	{
		$product_id = $this->input->post('product_id');
		$shop_id = $this->input->post('shop_id');
		$stok = $this->Sale_model->get_stok($product_id, $shop_id);
		//if(isset($stok[0]->production_quantity)){$mas=$stok[0]->production_quantity;}else{$mas=0;};
		if (isset($stok[0]->item_quantity)) {
			$mas = $stok[0]->item_quantity;
		} else {
			$mas = 0;
		};
		$json_data = json_encode($mas);
		echo $json_data;
	}
	public function getproduct()
	{
		header('Content-Type: application/x-json; charset=utf-8');
		$product_cmpny = $this->input->post('product_cmpny');
		$product_size = $this->input->post('product_size');
		$data = $this->Sale_model->getproduct($product_cmpny, $product_size);
		$data_json = json_encode($data);
		echo $data_json;
	}
	public function getproductcompany()
	{
		header('Content-Type: application/x-json; charset=utf-8');
		$product_size = $this->input->post('product_size');
		$data = $this->Sale_model->getproductcompany($product_size);
		$data_json = json_encode($data);
		echo $data_json;
	}
	public function getproductname1()
	{
		$prod_id = $this->input->post('p_id');
		$data['product'] = $this->Sale_model->getproductname1($prod_id);
		echo json_encode($data);
	}
	// function get_memberaddress(){
	// 	$id = $this->input->post('member_id');
	// 	$data = $this->Sale_model->get_memberaddress($id);
	// 	echo json_encode($data);
	// }
	function get_memberaddress()
	{
		$id = $this->input->post('id');
		//$data = $this->Sale_model->get_memberaddress($id);
		//echo json_encode($data);
		$records = $this->Sale_model->get_memberaddress($id);
		$data_json = json_encode($records);
		echo $data_json;
	}
	function get_phone()
	{
		$id = $this->input->post('id');
		//$data = $this->Sale_model->get_memberaddress($id);
		//echo json_encode($data);
		$records = $this->Sale_model->get_phone($id);
		$data_json = json_encode($records);
		echo $data_json;
	}
	public function getOldBalance()
	{
		$id = $this->input->post('id');
		$data = $this->Sale_model->getOldBalanceDetails($id);
		echo json_encode($data);
	}
	public function getMemberList()
	{
		$mem_id = $_POST['mem_id'];
		$data = $this->Sale_model->getMemberlists($mem_id);
		echo json_encode($data);
	}

	public function get_table()
	{
		$table = 'tbl_production_itemlist';
		$result = $this->Sale_model->get_table($table);
		echo "<pre>";
		print_r($result);
		die;
	}


	public function getproduct_names()
	{
		$branch_id_fk = $this->session->userdata('branch_id_fk');
		$id = ($this->input->get('phrase')) ? $this->input->get('phrase') : '';
		$data =  $this->Sale_model->getproduct_names($id, $branch_id_fk);
		echo json_encode($data);
	}

	public function getProductDetails1()
	{
		$prod1 = [];
		$branches_id = $this->session->userdata('branch_id_fk');
		$p_name = $this->input->post('p_name');
		$data['product_name1'] =  $this->Sale_model->get_row_barcode($p_name);
		$data['product_name2'] =  $this->Sale_model->get_row_barcode_branch($p_name, $branches_id);
		$prod1['hsncode'] = $data['product_name1']->product_hsncode;
		$prod1['igst'] = $data['product_name1']->hsn_igst;
		$prod1['cgst'] = $data['product_name1']->hsn_cgst;
		$prod1['sgst'] = $data['product_name1']->hsn_sgst;
		$prod1['prod_cod'] = $data['product_name1']->product_code;
		$prod1['prod_id'] = $data['product_name1']->product_id;
		$prod1['prod_id_branch'] = 0;
		$prod1['stock'] = $data['product_name1']->product_stock;
		/* $prod1['prod_id_branch'] = $data['product_name2']->product_id;
		$prod1['stock'] = $data['product_name2']->product_stock; */
		echo json_encode($prod1);
	}


	public function getProductDetails2()
	{
		$prod1 = [];
		$pid = $this->input->post('product_num');
		$ptype = $this->input->post('rate_type');
		$data['product_name1'] =  $this->Sale_model->get_row_rate($pid);
		if ($ptype == 1) {
			$prod1['rate'] = $data['product_name1']->product_price_r1;
		} else if ($ptype == 2) {
			$prod1['rate'] = $data['product_name1']->product_price_r2;
		} else if ($ptype == 3) {
			$prod1['rate'] = $data['product_name1']->product_price_r3;
		}

		echo json_encode($prod1);
	}

	public function Pdf_Sale($auto_invoice)
	{
		$records = $this->Sale_model->get_sale_pdf($auto_invoice);
		// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$dompdf->loadHtml($records);
		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'landscape');
		// Render the HTML as PDF
		$dompdf->render();
		// Output the generated PDF to Browser
		$dompdf->stream("" . $auto_invoice . ".pdf");
	}

	public function get_old_bal()
	{
		$mem_id = $this->input->post('vid');
		$records = $this->Sale_model->get_old_bal($mem_id);
		$data_json = json_encode($records);
		echo $data_json;
	}

	public function SaleReturn()
	{
		$template['body'] = 'SaleReturn/list';
		$template['script'] = 'SaleReturn/script';
		$prid = $this->session->userdata('prid');
		$id = [
			'vendorstatus' => 1
		];
		$template['vendor_names'] = $this->General_model->getall('tbl_vendor', $id);
		$this->load->view('template', $template);
	}

	public function getSaleReturn()
	{
		$branch_id_fk = $this->session->userdata('branch_id_fk');
		$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
		$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
		$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
		$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
		$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';
		$param['invoice_number'] = (isset($_REQUEST['invoice_number'])) ? $_REQUEST['invoice_number'] : '';
		$param['start_date'] = (isset($_REQUEST['start_date'])) ? $_REQUEST['start_date'] : '';
		$param['end_date'] = (isset($_REQUEST['end_date'])) ? $_REQUEST['end_date'] : '';
		/* $sDate = (isset($_REQUEST['startDate'])) ? $_REQUEST['startDate'] : '';
		$eDate = (isset($_REQUEST['endDate'])) ? $_REQUEST['endDate'] : '';
		if($sDate){
            $start_date = str_replace('/', '-', $sDate);
            $param['startDate'] =  date("Y-m-d",strtotime($start_date));
        }
       
        if($eDate){
            $end_date = str_replace('/', '-', $eDate);
            $param['endDate'] =  date("Y-m-d",strtotime($end_date));
		}	 */
		//$sessid = $this->session->userdata['id'];

		$data = $this->Sale_model->getSaleReturnReport($param, $branch_id_fk);
		$json_data = json_encode($data);
		echo $json_data;
	}

	public function editedSaleRet($auto_invoice)
	{
		$template['body'] = 'SaleReturn/edit';
		$template['script'] = 'SaleReturn/script2';
		$id = ['member_status' => 1];
		$template['member_names'] = $this->General_model->getall('tbl_member', $id);
		$template['records'] = $this->Sale_model->getEditData($auto_invoice);
		$this->load->view('template', $template);
	}

	public function editReturnSale2()
	{
		$return_qty = $this->input->post('return_qty');
		$return_price = $this->input->post('return_price');
		$return_date = $this->input->post('return_date');
		$sale_idss = $this->input->post('sale_idss');
		$product_id_fk = $this->input->post('product_id_fk');
		$temp = count($sale_idss);
		for ($i = 0; $i < $temp; $i++) {
			$data = array(
				'return_qty' => $return_qty[$i],
				'return_price' => $return_price[$i],
				'return_date' => $return_date,
			);
			if (isset($sale_idss[$i])) {
				$this->General_model->update('tbl_sale', $data, 'sale_id', $sale_idss[$i]);
				$stok[$i] = $this->Sale_model->get_stoks($product_id_fk[$i]);
				$nwstk = $stok[$i][0]->product_stock + $return_qty[$i];
				$uData = array(
					'product_stock' => $nwstk,
				);
				$result = $this->General_model->update('tbl_product', $uData, 'product_id', $product_id_fk[$i]);
			}
		}
		redirect('/Sale/SaleReturn/', 'refresh');
	}


	public function addmsg()
	{
		$template['body'] = 'Sale/sendmsg';
		$template['script'] = 'Sale/scriptmsg';
		$id = ['member_status' => 1];
		$template['member_names'] = $this->General_model->getall('tbl_member', $id);
		$this->load->view('template', $template);
	}


	public function sendmsg()
	{
		$msg_date = $this->input->post('msg_date');
		$msg_phone = $this->input->post('msg_phone');

		if(!empty($_FILES['msg_document']['name']))
		{
				$config['upload_path'] = 'upload/message/';
				$config['allowed_types'] = 'xlsx|csv|doc|txt|pdf';
				$config['file_name'] = $_FILES['msg_document']['name'];
				$pic = $_FILES['msg_document']['name'];
				//Load upload library and initialize configuration
				$this->load->library('upload',$config);
				$this->upload->initialize($config);
				if($this->upload->do_upload('msg_document'))
				{
					$uploadData = $this->upload->data();
					$msg_document = $uploadData['file_name'];
				}
				else
				{
						$msg_document = '';
				}
			}
		else{
				
					$msg_document ='Not uploaded';
				
			 }

			 $data = array(
				'msg_date' => $msg_date,
				'msg_phone' => $msg_phone,
				'msg_document' => $msg_document,
				'msg_status'=>1
			);
		

		$result=$this->General_model->add('tbl_message', $data);
		$insert_id=$this->db->insert_id();
		if($result)
		{
			$records=$this->General_model->get_row('tbl_message','msg_id',$insert_id);

			//var_dump($records);die;

			$ultramsg_token="f7p9sb85pdgd6uik"; // Ultramsg.com token
			$instance_id="instance40271"; // Ultramsg.com instance id
			$client = new UltraMsg\WhatsAppApi($ultramsg_token,$instance_id);
	
			$to=$msg_phone; 
			$filename="Sale Invoice - ".date('d/m/Y',strtotime($msg_date)); 
			
			$document=  base_url().'upload/message/'.$msg_document;
			//var_dump($document);die;
			//echo $document;die;
			$api=$client->sendDocumentMessage($to,$filename,$document);	
			//$body="This is a Test Message From Wahylab Solutions"; 
			//$api=$client->sendChatMessage($to,$body);
			//print_r($api);

			$response_text = 'Message Send  successfully';

			if($result){
	            $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
				}
				else{
	            $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
				}

			redirect('/Sale/addmsg/', 'refresh');
		}

	
	}

	public function getmsg()
	{
		$branch_id_fk = $this->session->userdata('branch_id_fk');
		$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
		$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
		$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
		$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
		$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';
		$data = $this->Sale_model->getmessage($param, $branch_id_fk);
		$json_data = json_encode($data);
		echo $json_data;
	}

	
}
