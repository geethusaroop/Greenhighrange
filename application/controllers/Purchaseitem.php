<?php
require 'vendor/autoload.php';
use Dompdf\Dompdf;
defined('BASEPATH') OR exit('No direct script access allowed');
class Purchaseitem extends MY_Controller {
	public $table = 'tbl_purchase';
	public $tbl_stock = 'tbl_stock_history';
	public $tbl_pstock = 'tbl_product';
	public $tbl_supp_acc = 'tbl_supp_acc';
	public $tbl_supp_acclog = 'tbl_supp_acclog';
	public $page  = 'Purchase';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
			redirect('/login');
		}
		$this->load->model('General_model');
		$this->load->model('Purchase_model');
		$this->load->model('Vendor_model');
		$this->load->model('Item_model');
		$this->load->model('Tax_model');
		$this->load->model('Product_model');
		$this->load->model('HSNcode_model');
	}
	public function index()
	{
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['product_names'] = $this->Item_model->view_by1($branch_id_fk);
		$template['product_unit'] = $this->Item_model->view_unit();
		$template['body'] = 'Purchaseitem/list';
		$template['script'] = 'Purchaseitem/script';
		$prid= $this->session->userdata('prid');
		$template['vendor_names'] = $this->Vendor_model->view_by($branch_id_fk);
		$this->load->view('template', $template);
	}
	public function purc($purchase_id)
	{
		$template['body'] = 'Purchaseview/edit';
		$template['script'] = 'Purchaseview/script';
		$prid= $this->session->userdata('prid');
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['vendor_names'] = $this->Vendor_model->view_by($branch_id_fk);
		$template['product_names'] = $this->Item_model->view_by1($branch_id_fk);
		$template['tax_names'] = $this->Tax_model->view_by();
		$template['records'] = $this->Purchase_model->get_data($purchase_id);
		$this->load->view('template', $template);
		//redirect('/Purchase/', 'refresh');
	}
	public function add(){
		$prid= $this->session->userdata('prid');
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['vendor_names'] = $this->Vendor_model->view_by($branch_id_fk);
		$template['product_names'] = $this->Item_model->view_by1($branch_id_fk);
		$template['product_unit'] = $this->Item_model->view_unit();
	//	$template['category'] = $this->Product_model->get__category();
	//	$template['category'] = $this->Product_model->get__category();
		$template['unit'] = $this->Product_model->get_unit();
		$template['hsncode']=$this->HSNcode_model->gethsncode();
		//$template['subcategories'] = $this->General_model->get_all('tbl_subcategories');
		$this->form_validation->set_rules('vendor_id', ' Vendor Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['body'] = 'Purchaseitem/add';
			$template['script'] = 'Purchaseitem/script';
			$this->load->view('template', $template);
		}
		else {
			// $sessid = $this->session->userdata['id'];
			// $shopid = $this->Purchase_model->get_shop($sessid);
			$finyear = $this->Purchase_model->get_fyear();
			if(isset($finyear[0]->fin_year)){$fin=$finyear[0]->fin_year;}else{$fin=0;}
			// if(isset($shopid[0]->shop_id_fk)){$shid=$shopid[0]->shop_id_fk;}else{$shid=0;}
			/*-------------Dynamic Contents-------------*/
			$temp =count($this->input->post('product_id_fk'));
			$product_id_fk = $this->input->post('product_id_fk');
			$purchase_quantity = $this->input->post('purchase_quantity');
			$purchase_unit=$this->input->post('purchase_unit');
			$mrp = $this->input->post('mrp');
			$r1 = $this->input->post('r1');
			$r2 = $this->input->post('r2');
			$r3 = $this->input->post('r3');
			$discount_price = $this->input->post('discount_price');
			//$tax_id_fk = $this->input->post('taxtype');
			$purchase_total_price = $this->input->post('tamount');
			$purchase_hsn = $this->input->post('purchase_hsn');
			$rate = $this->input->post('rate');
			$taxamount = $this->input->post('taxamount');
			$purchase_cgst = $this->input->post('cgst');
			$purchase_cgstamt = $this->input->post('cgstamt');
			$purchase_sgst = $this->input->post('sgst');
			$purchase_sgstamt = $this->input->post('sgstamt');
			$purchase_igst = $this->input->post('igst');
			$purchase_igstamt = $this->input->post('igstamt');
			$purchase_netamt = $this->input->post('netamt');
			$purchase_date = str_replace('/', '-', $this->input->post('purchase_date'));
			$purchase_date =  date("Y-m-d",strtotime($purchase_date));
			/*-------------Static Contents-------------*/
			$this->load->helper('string');
			$numb = '1';
			$auto = random_string('numeric',10);
			$auto_invoice = $numb.$auto;
			$invc_no = $this->input->post('purchase_invoice_number');
			$grand_total = $this->input->post('net_total');
			$vendor_id=$this->input->post('vendor_id');
			for($i=0;$i<$temp;$i++){
				$data = array(
					'product_id_fk' => $product_id_fk[$i],
					'purchase_hsn' => $purchase_hsn[$i],
					'finyear'=>$fin,
					'shop_id_fk'=>0,
					'login_id_fk'=>0,
					'vendor_id_fk' =>$vendor_id,
					'ref_number' =>$this->input->post('ref_number'),
					'invoice_number' => $invc_no,
					'auto_invoice' => $auto_invoice,
					'purchase_quantity' => $purchase_quantity[$i],
					'purchase_unit_fk' => $purchase_unit[$i],
					'purchase_price' => $rate[$i],
					'purchase_mrp' => $mrp[$i],
					'purchase_selling_price_r1' => $r1[$i],
					'purchase_selling_price_r2' => $r2[$i],
					'purchase_selling_price_r3' => $r3[$i],
					'discount_price' => $discount_price[$i],
					'total_price' => $purchase_total_price[$i],
					'taxamount' => $taxamount[$i],
					'purchase_cgst' => $purchase_cgst[$i],
					'purchase_cgstamt' => $purchase_cgstamt[$i],
					'purchase_sgst' => $purchase_sgst[$i],
					'purchase_sgstamt' => $purchase_sgstamt[$i],
					'purchase_igst' => $purchase_igst[$i],
					'purchase_igstamt' => $purchase_igstamt[$i],
					'purchase_netamt' => $purchase_netamt[$i],
					'purchase_mop' => $this->input->post('purchase_mop'),
					'purchase_taxmode' => $this->input->post('purchase_taxmode'),
					'pur_old_bal' => $this->input->post('old_bal'),
					'pur_paid_amt' => $this->input->post('paid_amt'),
					'pur_new_bal' => $this->input->post('net_balance'),
					'purchase_date' => $purchase_date,
					'stockstatus' => 0,
					//'tax_id_fk' =>$tax_id_fk[$i],
					'entry_date'=>date('Y-m-d'),
					'purchase_status' => 1
				);
				$tblstock = array(
					'current_stock' => $purchase_quantity[$i],
				);
				/* $acc_data = array(
					'sup_id_fk' =>$vendor_id,
					'voucher_type' =>'Purchase',
					'old_bal' =>$this->input->post('old_bal'),
					'credit' => $this->input->post('paid_amt'),
					'debit' => $purchase_total_price[$i],
					'new_bal' =>$this->input->post('net_balance'),
					'up_date' =>date('Y-m-d'),
					'slog_status' =>1
				);
				$this->General_model->add($this->tbl_supp_acclog,$acc_data); */
				$AccData = array(
					'old_balance' =>$this->input->post('net_balance'),
				);
				$this->General_model->update($this->tbl_supp_acc,$AccData,'sup_id_fk',$vendor_id);
				$result = $this->General_model->add($this->table,$data);

				$records = $this->Purchase_model->get_invc($auto_invoice);
				//$existance=$this->Purchase_model->get_stock_existance($product_id_fk[$i]);
				//if($existance){
					//$stock_item_type = 1;
					$current_stock=$this->Purchase_model->get_current_productstock($product_id_fk[$i]);
					$new_stock=intval($current_stock)+intval($purchase_quantity[$i]);
					$updateData = array('product_stock' =>$new_stock, 'product_updated_date'=>$purchase_date,'product_price_r1' => $r1[$i],'product_price_r2' => $r2[$i],'product_price_r3' => $r3[$i]);
					$data = $this->General_model->update('tbl_product',$updateData,'product_id',$product_id_fk[$i]);
				//}
				
					$insert_array=[
						'stock_product_id_fk'=>$product_id_fk[$i],
						'stock_total'=>$purchase_quantity[$i],
						'stock_vendor'=>$vendor_id,
						'stock_date'=>$purchase_date,
						'stock_status'=>1
					];
					$insertion_status=$this->General_model->add('tbl_stock_history',$insert_array);
				
			}
			$upData = array('stockstatus' =>1);
			$stk = $this->General_model->update($this->table,$upData,'auto_invoice',$auto_invoice);
			redirect('/Purchaseitem/invoice/'.$auto_invoice, 'refresh');
		}
	}
	public function fetchPrice() {
		if($this->input->post('product_id_fk')) {
			$fk = $this->input->post('product_id_fk');
			$data['price'] = $this->Purchase_model->fetchPrice($fk);
			echo json_encode($data);
		}
	}
	public function invoice($auto_invoice){
		$template['body'] = 'Purchase_Invoice/Invoice3';
		$template['script'] = 'Purchase_Invoice/script';
		$template['records'] = $this->Purchase_model->get_invc($auto_invoice);
		$this->load->view('template', $template);
	}
	public function get(){
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$sessid = $this->session->userdata['id'];
		//$shopid = $this->Purchase_model->get_shop($sessid);
		//if(isset($shopid[0]->shop_id_fk)){$shid=$shopid[0]->shop_id_fk;}else{$shid=0;}
		//$param['shop'] =$shid;
		$data = $this->Purchase_model->getPurchaseReport($param);
		$json_data = json_encode($data);
		echo $json_data;
	}
	public function invoice_check()
	{
		$inv_no = $this->input->post('inv_no');
		$vendor_id = $this->input->post('vendor_id');
		$result = $this->Purchase_model->invoice_check($inv_no,$vendor_id);
		$json_data = json_encode($result);
		echo $json_data;
	}
	public function delete($purchase_id){
		$updateData = array('purchase_status' => 0);
		$data = $this->General_model->update($this->table,$updateData,'purchase_id',$purchase_id);
		$response_text = 'Purchase Details deleted successfully';
		if($data){
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
		}
		else{
			$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
		}
		redirect('/Purchaseitem/', 'refresh');
	}
	public function edit(){
		// $sessid = $this->session->userdata['id'];
		// $shopid = $this->Purchase_model->get_shop($sessid);
		$finyear = $this->Purchase_model->get_fyear();
		if(isset($finyear[0]->fin_year)){$fin=$finyear[0]->fin_year;}else{$fin=0;}
		// if(isset($shopid[0]->shop_id_fk)){$shid=$shopid[0]->shop_id_fk;}else{$shid=0;}
		/*-------------Dynamic Contents-------------*/
		$temp =count($this->input->post('purchase_id'));
		$product_id_fk = $this->input->post('product_id_fk');
		$purchase_quantity = $this->input->post('purchase_quantity');
		$purchase_unit=$this->input->post('purchase_unit');
		$mrp = $this->input->post('mrp');
		$discount_price = $this->input->post('discount_price');
		$auto_invoice =  $this->input->post('auto_invoice');
		//$tax_id_fk = $this->input->post('taxtype');
		$purchase_total_price = $this->input->post('tamount');
		$purchase_hsn = $this->input->post('purchase_hsn');
		$rate = $this->input->post('rate');
		$taxamount = $this->input->post('taxamount');
		$purchase_cgst = $this->input->post('cgst');
		$purchase_cgstamt = $this->input->post('cgstamt');
		$purchase_sgst = $this->input->post('sgst');
		$purchase_sgstamt = $this->input->post('sgstamt');
		$purchase_igst = $this->input->post('igst');
		$purchase_igstamt = $this->input->post('igstamt');
		$purchase_netamt = $this->input->post('netamt');
		$purchase_date = str_replace('/', '-', $this->input->post('purchase_date'));
		$purchase_date =  date("Y-m-d",strtotime($purchase_date));
		/*-------------Static Contents-------------*/
		$invc_no = $this->input->post('invoice_number');
		$grand_total = $this->input->post('net_total');
		$vendor_id=$this->input->post('vendor_id');
		for($i=0;$i<$temp;$i++){
		$update_data = array(
			'product_id_fk' => $product_id_fk[$i],
			'purchase_hsn' => $purchase_hsn[$i],
			'finyear'=>$fin,
			'shop_id_fk'=>0,
			'login_id_fk'=>0,
			'vendor_id_fk' =>$vendor_id,
			'ref_number' =>$this->input->post('ref_number'),
			'purchase_quantity' => $purchase_quantity[$i],
			'purchase_unit_fk' => $purchase_unit[$i],
			'purchase_price' => $rate[$i],
			'purchase_mrp' => $mrp[$i],
			'discount_price' => $discount_price[$i],
			'total_price' => $purchase_total_price[$i],
			'taxamount' => $taxamount[$i],
			'purchase_cgst' => $purchase_cgst[$i],
			'purchase_cgstamt' => $purchase_cgstamt[$i],
			'purchase_sgst' => $purchase_sgst[$i],
			'purchase_sgstamt' => $purchase_sgstamt[$i],
			'purchase_igst' => $purchase_igst[$i],
			'purchase_igstamt' => $purchase_igstamt[$i],
			'purchase_netamt' => $purchase_netamt[$i],
			'purchase_mop' => $this->input->post('purchase_mop'),
			'purchase_taxmode' => $this->input->post('purchase_taxmode'),
			'pur_old_bal' => $this->input->post('old_bal'),
			'pur_paid_amt' => $this->input->post('paid_amt'),
			'pur_new_bal' => $this->input->post('net_balance'),
		);
		$acc_data = array(
			'sup_id_fk' =>$vendor_id,
			'voucher_type' =>'Purchase',
			'old_bal' =>$this->input->post('old_bal'),
			'credit' => $this->input->post('paid_amt'),
			'debit' => $purchase_total_price[$i],
			'new_bal' =>$this->input->post('net_balance'),
			'up_date' =>date('Y-m-d'),
			'slog_status' =>1
		);
		$this->General_model->add($this->tbl_supp_acclog,$acc_data);
		$AccData = array(
			'old_balance' =>$this->input->post('net_balance'),
		);
		$this->General_model->update($this->tbl_supp_acc,$AccData,'sup_id_fk',$vendor_id);

		///get record of ecisting quantity of each product
		$records = $this->Purchase_model->getQtyOfprroducteachPurchase($auto_invoice,$product_id_fk[$i]);
		$existance=$this->Purchase_model->get_stock_existance($product_id_fk[$i]);
		//var_dump($records, $purchase_quantity[$i]);
		if(floatval($records) < floatval($purchase_quantity[$i])){
			$new_stock_bal = $records - $purchase_quantity[$i];
			$new_stck_val = abs($new_stock_bal);
			if($existance){
				$stock_item_type = 1;
				$current_stock=$this->Purchase_model->get_current_productstock($product_id_fk[$i]);
				$new_stock=intval($current_stock) + intval($new_stck_val);
				$updateData = array('stock_item_current_stock' =>$new_stock, 'updated_at'=>date('Y-m-d H:i:s'));
				$data = $this->General_model->updat('tbl_stock',$updateData,'stock_item_fk_id',$product_id_fk[$i],'stock_item_type',1);
			}
			else{
				$insert_array=[
					'stock_item_fk_id'=>$product_id_fk[$i],
					'stock_item_current_stock'=>$new_stock_bal,
					'stock_item_type'=>1,
					'created_at'=>date('Y-m-d H:i:s')
				];
				$insertion_status=$this->General_model->add('tbl_stock',$insert_array);
			}
		}
		else
		{
			$new_stock_bal = $purchase_quantity[$i] - $records;
			$new_stck_val = abs($new_stock_bal);
			if($existance){
				$stock_item_type = 1;
				$current_stock=$this->Purchase_model->get_current_productstock($product_id_fk[$i]);
				$new_stock=intval($current_stock) - intval($new_stck_val);
				$updateData = array('stock_item_current_stock' =>$new_stock, 'updated_at'=>date('Y-m-d H:i:s'));
				$data = $this->General_model->updat('tbl_stock',$updateData,'stock_item_fk_id',$product_id_fk[$i],'stock_item_type',1);
			}
			else{
				$insert_array=[
					'stock_item_fk_id'=>$product_id_fk[$i],
					'stock_item_current_stock'=>$new_stock_bal,
					'stock_item_type'=>1,
					'created_at'=>date('Y-m-d H:i:s')
				];
				$insertion_status=$this->General_model->add('tbl_stock',$insert_array);
			}
		}
		$purchase_id = $this->input->post('purchase_id');
		if($purchase_id){
		$result = $this->General_model->update($this->table,$update_data,'purchase_id',$purchase_id[$i]);
		$var = $this->db->last_query();
		}
	}
		//////////////////////////////////////////////////////////////////////////////////////////////////
		if($result){
			$response_text = 'Purchase Details updated successfully';
		}
		else{
			$response_text = 'Purchase Details Cannot updated ';
		}
		if($result){
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
		}
		else{
			$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
		}
		redirect('/Purchaseitem/', 'refresh');
	}

	
	public function view($auto_invoice)
	{
		$template['body'] = 'Purchaseitem/view';
		$template['script'] = 'Purchaseitem/script';
		$template['records'] = $this->Purchase_model->get_row($auto_invoice);
		$this->load->view('template', $template);
	}
	public function gettax(){
		header('Content-Type: application/x-json; charset=utf-8');
		$result = $this->Purchase_model->gettax();
		echo json_encode($result);
	}
	public function getproductname(){
		$prid =$this->session->userdata('prid');
		header('Content-Type: application/x-json; charset=utf-8');
		$result = $this->Purchase_model->getproductname($prid);
		echo json_encode($result);
	}
	public function getproductname_purchase(){
		$prid =$this->session->userdata('prid');
		header('Content-Type: application/x-json; charset=utf-8');
		$result = $this->Purchase_model->getproductname_purchase($prid);
		echo json_encode($result);
	}
	public function getproductname1(){
		$prod_id = $this->input->post('p_id');
		$data['product'] = $this->Purchase_model->getproductname1($prod_id);
		echo json_encode($data);
	}
	public function tax_amount()
	{
		$tax_id = $this->input->post('value');
		$data = $this->Purchase_model->getAmount($tax_id);
		$json_data = json_encode($data);
		echo $json_data;
	}
	public function getprice()
	{
		$product_num = $this->input->post('product_num');
		$data = $this->Purchase_model->getprice($product_num);
		$json_data = json_encode($data);
		echo $json_data;
	}
	public function masterStock(){
		$auto_invoice = $this->input->post('auto_invoice');
		$records = $this->Purchase_model->get_invc($auto_invoice);
		//$count=$this->db->where(['auto_invoice'=>'auto_invoice'])->count_all_results("tbl_purchase");
		for($i=0; $i< count($records); $i++)
		{
			// ###################################################################
			$existance=$this->Purchase_model->get_stock_existance($records[$i]->product_id_fk);
			// echo "<pre>",print_r($records[$i]);
			if($existance){
				$stock_item_type = 1;
				// $stok[$i] = $this->Purchase_model->get_stk($records[$i]->product_id_fk,$stock_item_type);
				// $nwstk = $stok[$i]->stock_item_current_stock + $records[$i]->purchase_quantity;
				$current_stock=$this->Purchase_model->get_current_productstock($records[$i]->product_id_fk);
				$new_stock=intval($current_stock)+intval($records[$i]->purchase_quantity);
				$updateData = array('stock_item_current_stock' =>$new_stock, 'updated_at'=>date('Y-m-d H:i:s'));
				$data = $this->General_model->updat('tbl_stock',$updateData,'stock_item_fk_id',$records[$i]->product_id_fk,'stock_item_type',1);
			}
			else{
				$insert_array=[
					'stock_item_fk_id'=>$records[$i]->product_id_fk,
					'stock_item_current_stock'=>$records[$i]->purchase_quantity,
					'stock_item_type'=>1,
					'created_at'=>date('Y-m-d H:i:s')
				];
				$insertion_status=$this->General_model->add('tbl_stock',$insert_array);
			}
			// #######################################################################
			//$data = $this->General_model->update_stock($nwstk[$i],$records[$i]->product_id);
		}
		$upData = array('stockstatus' =>1);
		$stk = $this->General_model->update($this->table,$upData,'auto_invoice',$auto_invoice);
		if($stk) {
			$response['text'] = 'Updated successfully';
			$response['type'] = 'success';
		}
		else{
			$response['text'] = 'Something went wrong';
			$response['type'] = 'error';
		}
		$response['layout'] = 'topRight';
		$json_data = json_encode($response);
		echo $json_data;
	}
	public function get_gst()
	{
		$vendor_id = $this->input->post('vid');
		$records = $this->Purchase_model->get_gst($vendor_id);
		$data_json = json_encode($records);
		echo $data_json;
	}
	public function get_old_bal()
	{
		$sup_id = $this->input->post('vid');
		$records = $this->Purchase_model->get_old_bal($sup_id);
		$data_json = json_encode($records);
		echo $data_json;
	}
	public function get_view(){
		$prid= $this->session->userdata('prid');
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'100';
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$invoice_number = $this->input->post('invoice_number');
		$data = $this->Purchase_model->getPurchaseReport($param,$prid);
		$json_data = json_encode($data);
		echo $json_data;
	}
	public function get_invc_no()
	{
		$data = $this->Purchase_model->get_invc_no();
		$json_data = json_encode($data);
		echo $json_data;
	}
	public function gethsn()
	{
		$this->load->model('Purchase_model');
		$pid=$this->input->post('p_id');
		$data['product_num1'] =  $this->Purchase_model->listhsn($pid);
		$purchase_hsn1 = $data['product_num1'][0]['hsncode'] ;
		echo $purchase_hsn1 ;
	}
	public function getcgst()
	{
		$this->load->model('Purchase_model');
		$pid=$this->input->post('p_id');
		$data['product_num1'] =  $this->Purchase_model->listhsn($pid);
		$purchase_hsn1 = $data['product_num1'][0]['hsn_cgst'] ;
		echo $purchase_hsn1 ;
	}
	public function getsgst()
	{
		$this->load->model('Purchase_model');
		$pid=$this->input->post('p_id');
		$data['product_num1'] =  $this->Purchase_model->listhsn($pid);
		$purchase_hsn1 = $data['product_num1'][0]['hsn_sgst'] ;
		echo $purchase_hsn1 ;
	}
	public function getigst()
	{
		$this->load->model('Purchase_model');
		$pid=$this->input->post('p_id');
		$data['product_num1'] =  $this->Purchase_model->listhsn($pid);
		$purchase_hsn1 = $data['product_num1'][0]['hsn_igst'] ;
		echo $purchase_hsn1 ;
	}
	public function showRetunPurchase($auto_invoice)
	{
		$vendor_cond = ['vendorstatus'=>1];
		$template['vendor_names'] = $this->General_model->getall('tbl_vendor',$vendor_cond);
		$template['product_names'] = $this->Item_model->view_by();
		$template['product_unit'] = $this->Item_model->view_unit();
		$template['records'] = $this->Purchase_model->get_purchase_return_list($auto_invoice);
		$template['body'] = 'Purchaseitem/edit';
		$template['script'] = 'Purchaseitem/script2';
		$this->load->view('template', $template);
	}
	public function editReturnPurchase()
	{
		$purchase_id = $this->input->post('purchase_id');
		$product_id = $this->input->post('product_id_fk');
		$qty = $this->input->post('purchase_quantity');
		$rate = $this->input->post('rate');
		$discount = $this->input->post('discount_price');
		$total = $this->input->post('total_price');
		$return_qty = $this->input->post('return_quantity');
		$total_amt = [];
		$afterreturn = [];
		$newPurchaseprice = [];
		$newdiscountprice = [];
		$newPurchasePrice2 = [];
		$count = count($return_qty);
		for($i=0;$i<$count;$i++){
			$afterreturn[$i] = floatval($qty[$i]) - floatval($return_qty[$i]);
			$newPurchaseprice[$i] = $afterreturn[$i] * floatval($rate[$i]);
			$newdiscountprice[$i] = floatval($newPurchaseprice[$i]) * (floatval($discount[$i])/100);
			$newPurchasePrice3[$i] = $newPurchaseprice[$i] - $newdiscountprice[$i];
			$newPurchasePrice2[$i] = floatval($total[$i]) - floatval($newPurchasePrice3[$i]);
		}
		$sort = array_map(null,$return_qty,$newPurchasePrice3,$newPurchasePrice2,$purchase_id);
		foreach($sort as $sorts)
		{
			$item = array(
				'purchase_return' => $sorts[0],
				//'total_price' => $sorts[1],
				'purchase_return_amt' => $sorts[2],
				'purchase_return_date' => date('Y-m-d'),
			);
			$result2 = $this->General_model->update('tbl_purchase',$item,'purchase_id',$sorts[3]);
		}
		if($result2){
			$count = count($qty);
			for($a=0;$a<$count;$a++){

				//$getStckss = $this->General_model->get_row('tbl_stock','product_id',$product_id[$a]);
				$getStckss = $this->Purchase_model->getStock_of_item($product_id[$a]);
				if(!empty($getStckss)){
					$newStcksss = $getStckss->stock_item_current_stock - $return_qty[$a];
					$datas = [
						'stock_item_current_stock' => $newStcksss
					];
					// $result = $this->General_model->update('tbl_stock',$datas,'product_id',$product_id[$a]);
					$result = $this->General_model->updat('tbl_stock',$datas,'stock_item_fk_id',$product_id[$a],'stock_item_type',1);
				}
			}
			redirect('/Purchaseitem/');
		}
		redirect('/Purchaseitem/');
	}
	public function addVendor()
	{
		$vendor_name = $this->input->post('vendor_name');
		if(!empty($vendor_name)){
			$vendor_name = $this->input->post('vendor_name');
			$vendor_address = $this->input->post('vendor_address');
			$vendor_phone = $this->input->post('vendor_phone_number');
			$vendor_email = $this->input->post('vendor_email');
			$vendor_gst = $this->input->post('vendor_gst');
			$vendor_old_balance = $this->input->post('vendor_old_bal');
			$data = [
				'vendorname' => $vendor_name,
				'vendoraddress' => $vendor_address,
				'vendorphone' => $vendor_phone,
				'vendoremail' => $vendor_email,
				'vendor_oldbal' => $vendor_gst,
				'vendorgst' => $vendor_old_balance,
				'vendorstatus' => 1,
			];
			$result = $this->General_model->add('tbl_vendor',$data);
			if($result){
				redirect('Purchaseitem/add','refresh');
			}
		}

	}

	public function addItem()
	{
			$product_id = $this->input->post('product_id');
			$data = array(
				'product_type' => $this->input->post('product_type'),
				'product_sub_type' => $this->input->post('subcategory'),
				'product_code' => strtoupper($this->input->post('prod_code')),
				'product_name' => $this->input->post('product_name'),
				'product_unit' => $this->input->post('product_unit'),
				'product_hsn' => strtoupper($this->input->post('product_hsn')),
				'product_hsncode' => strtoupper($this->input->post('product_hsncode')),
				'product_open_stock' => $this->input->post('product_open_stock'),
				'min_stock' => $this->input->post('min_stock'),
				'product_stock' => $this->input->post('product_open_stock'),
				'product_des' => $this->input->post('product_des'),
				'product_created_date' => date('Y-m-d'),
				'product_updated_date' => date('Y-m-d'),
				'product_status' => 1
			);
				$result = $this->General_model->add('tbl_product', $data);
				$data = $this->db->last_query();
				$response_text = 'Product added  successfully';

			if ($result) {
				$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			} else {
				$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
			redirect('/Purchaseitem/add');
	}


	public function getHsnCode()
	{
		$hsn_code = $this->input->post('hsn_id');
		if($hsn_code){
			$data = $this->General_model->get_row('tbl_hsncode','hsn_id',$hsn_code);
			echo json_encode($data);
		}
	}

	public function getPurchaseReturnList()
	{
		$template['body'] = 'Purchaseitem/listReturn';
		$template['script'] = 'Purchaseitem/scriptReturn';
		$template['records'] = $this->General_model->get_all('tbl_purchase');
		$this->load->view('template', $template);
	}

	public function getReturnList(){
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		$sessid = $this->session->userdata['id'];
		$data = $this->Purchase_model->getPurchaseReturnList($param);
		$json_data = json_encode($data);
		echo $json_data;
	}
	

	public function editPurchase($auto_invoice)
	{
		$template['body'] = 'Purchaseitem/edit2';
		$template['script'] = 'Purchaseitem/script4';
		$cond=['vendorstatus'=>1];
		$template['vendor_names'] = $this->General_model->getall('tbl_vendor',$cond);
		$template['product_names'] = $this->Item_model->view_by();
		$template['product_unit'] = $this->Item_model->view_unit();
		$template['category'] = $this->Product_model->get__category();
		$template['category'] = $this->Product_model->get__category();
		$template['unit'] = $this->Product_model->get_unit();
		$template['hsncode']=$this->HSNcode_model->gethsncode();
		$template['subcategories'] = $this->General_model->get_all('tbl_subcategories');
		$template['records'] = $this->Purchase_model->get_row($auto_invoice);
		$this->load->view('template', $template);
	}

	public function Pdf_Purchase($auto_invoice)
	{
		// global $_dompdf_warnings;
		// $_dompdf_warnings = array();
		// global $_dompdf_show_warnings;
		// $_dompdf_show_warnings = true;
		$records = $this->Purchase_model->get_purchase_pdf($auto_invoice);
		// instantiate and use the dompdf class
		$dompdf = new Dompdf();
		$dompdf->loadHtml($records);
		// (Optional) Setup the paper size and orientation
		$dompdf->setPaper('A4', 'landscape');
		// Render the HTML as PDF
		$dompdf->render();
		// var_dump($_dompdf_warnings);
		// die();
		// Output the generated PDF to Browser
		$dompdf->stream("" . $auto_invoice . ".pdf");
	}
}
