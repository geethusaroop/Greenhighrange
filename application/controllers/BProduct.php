<?php
defined('BASEPATH') or exit('No direct script access allowed');
class BProduct extends MY_Controller
{
	public $table = 'tbl_product';
	public $table2 = 'tbl_product_category';
	public $page  = 'BProduct';
	public function __construct()
	{
		parent::__construct();
		if (!$this->is_logged_in()) {
			redirect('/login');
		}
		$this->load->model('General_model');
		$this->load->model('Product_model');
		  $this->load->model('HSNcode_model');
		  $this->load->model('Item_model');
		  $this->load->model('Branch_transfer_model');
	}
	public function index()
	{
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['body'] = 'BProduct/list';
		$template['script'] = 'BProduct/script';
		$this->load->view('template', $template);
	}
	public function gethsncode()
    {
    $id = $this->input->post('id');
    $data = $this->Product_model->gethsncode($id);
    $json_data = json_encode($data);
    echo $json_data;
    }
	public function add()
	{
		$this->form_validation->set_rules('product_name', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			
			$template['body'] = 'BProduct/add';
			$template['script'] = 'BProduct/script';
			$template['unit'] = $this->Product_model->get_unit();
			$template['hsncode']=$this->HSNcode_model->gethsncode();
			$this->load->view('template', $template);
		} else {
			$product_id = $this->input->post('product_id');
			$branch_id_fk=$this->session->userdata('branch_id_fk');
			$product_price_r1=$this->input->post('product_price_r1');
			$product_price_r2=$this->input->post('product_price_r2');
			$product_price_r3=$this->input->post('product_price_r3');
			$data = array(
				'branch_id_fk'=>$branch_id_fk,
				'product_code' => strtoupper($this->input->post('prod_code')),
				'product_name' => $this->input->post('product_name'),
				'product_unit' => $this->input->post('product_unit'),
				'product_hsn' => strtoupper($this->input->post('product_hsn')),
				'product_hsncode' => strtoupper($this->input->post('product_hsncode')),
				//'product_open_stock' => $this->input->post('product_open_stock'),
				//'min_stock' => $this->input->post('min_stock'),
				//'product_stock' => $this->input->post('product_open_stock'),
				'product_des' => $this->input->post('product_des'),
				'product_created_date' => date('Y-m-d'),
				'product_updated_date' => date('Y-m-d'),
				'product_price_r1' => $product_price_r1,
				'product_price_r2' => $product_price_r2,
				'product_price_r3' => $product_price_r3,
				'product_status' => 1,
				'product_category' => 1
			);
			$product_id = $this->input->post('product_id');
			if ($product_id) {
				$data['product_id'] = $product_id;
				$result = $this->General_model->update($this->table, $data, 'product_id', $product_id);
				$response_text = 'BProduct updated successfully';
			} else {
				$result = $this->General_model->add($this->table, $data);
				$response_text = 'BProduct added  successfully';
			}
			if ($result) {
				$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			} else {
				$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
			redirect('/BProduct/', 'refresh');
		}
	}
	public function get()
	{
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$this->load->model('Product_model');
		$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
		$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
		$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
		$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
		$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';
		$param['item_name'] = (isset($_REQUEST['item_name'])) ? $_REQUEST['item_name'] : '';
		$data = $this->Product_model->getClassinfoTable($param,$branch_id_fk);
		$json_data = json_encode($data);
		echo $json_data;
	}
	public function delete()
	{
		$product_id = $this->input->post('product_id');
		$updateData = array('product_status' => 0);
		$data = $this->General_model->update($this->table, $updateData, 'product_id', $product_id);
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
		redirect('/BProduct/', 'refresh');
	}
	public function edit($product_id)
	{
		$template['body'] = 'BProduct/add';
		$template['script'] = 'BProduct/script';
		$template['unit'] = $this->Product_model->get_unit();
		$template['hsncode']=$this->HSNcode_model->gethsncode();
		$template['records'] = $this->General_model->get_row($this->table, 'product_id', $product_id);
		$this->load->view('template', $template);
	}

	public function viewreturn()
	{
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['body'] = 'BProduct/list-return';
		$template['script'] = 'BProduct/script-return';
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['product'] = $this->Item_model->view_by($branch_id_fk);
		$this->load->view('template', $template);
	}

	public function get_return()
	{
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$this->load->model('Product_model');
		$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
		$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
		$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
		$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
		$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';
		$param['item_name'] = (isset($_REQUEST['item_name'])) ? $_REQUEST['item_name'] : '';
		$data = $this->Product_model->getBranchreturninfoTable($param,$branch_id_fk);
		$json_data = json_encode($data);
		echo $json_data;
	}

	public function add_return()
	{
		$this->form_validation->set_rules('return_date', 'Date', 'required');
		if ($this->form_validation->run() == FALSE) {
			
			$template['body'] = 'BProduct/add-return';
			$template['script'] = 'BProduct/script-return';
			$branch_id_fk=$this->session->userdata('branch_id_fk');
			$template['product'] = $this->Item_model->view_by($branch_id_fk);
			$this->load->view('template', $template);
		} 
		else {
			$branch_id_fk=$this->session->userdata('branch_id_fk');
			$bproduct_id_fk=$this->input->post('bproduct_id_fk');
			$product_id_fk=$this->input->post('prod_name');
			$bt_stk=$this->input->post('return_stock');
			$bt_stk1=$this->input->post('return_stock1');
			$data = array(
				'return_branch_id_fk'=>$branch_id_fk,
				'return_product_id_fk' => $this->input->post('prod_name'),
				'return_bproduct_id_fk' => $this->input->post('bproduct_id_fk'),
				'return_stock' => $this->input->post('return_stock'),
				'return_date' => $this->input->post('return_date'),
				'return_status' => 1,
			);
			$return_id = $this->input->post('return_id');
			if ($return_id) {
				$data['return_id'] = $return_id;
				$result = $this->General_model->update('tbl_branch_return', $data, 'return_id', $return_id);

				#########Master product update##################
				$datass_up = $this->General_model->get_row('tbl_product','product_id',$bproduct_id_fk);
				$updated_stk_up1 = intval($datass_up->product_stock) - intval($bt_stk1);
				$updated_stk_up = $updated_stk_up1 + intval($bt_stk);
				$stk_array_up = ['product_stock' => $updated_stk_up];
				$result = $this->General_model->update('tbl_product',$stk_array_up,'product_id',$bproduct_id_fk);

				#########Branch product update##################
				$data_return_up = $this->General_model->get_row('tbl_product','product_id',$product_id_fk);
				$updated_return_stk_up1 = intval($data_return_up->product_stock) + intval($bt_stk1);
				$updated_return_stk_up = $updated_return_stk_up1 - intval($bt_stk);
				$stk_return_up = ['product_stock' => $updated_return_stk_up];
				$result = $this->General_model->update('tbl_product',$stk_return_up,'product_id',$product_id_fk);

				$response_text = 'Stock Return updated successfully';
			} 
			else {

				$result = $this->General_model->add('tbl_branch_return', $data);


				#########Master product update##################
				$datass = $this->General_model->get_row('tbl_product','product_id',$bproduct_id_fk);
				$updated_stk = intval($datass->product_stock) + intval($bt_stk);
				$stk_array = ['product_stock' => $updated_stk];
				$results = $this->General_model->update('tbl_product',$stk_array,'product_id',$bproduct_id_fk);
				//var_dump($results);die;

				#########Branch product update##################
				$data_return = $this->General_model->get_row('tbl_product','product_id',$product_id_fk);
				$updated_return_stk = intval($data_return->product_stock) - intval($bt_stk);
				$stk_return = ['product_stock' => $updated_return_stk];
				$result2 = $this->General_model->update('tbl_product',$stk_return,'product_id',$product_id_fk);

				$response_text = 'Stock Return  added  successfully';
			}
			if ($result) {
				$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			} else {
				$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
			redirect('/BProduct/viewreturn', 'refresh');
		}
	}

	public function getAvailStock()
	{
		$prod1 = [];
		$pid = $this->input->post('prod_id');
        $data = $this->Branch_transfer_model->getpstock($pid);
		$prod1['product_stock'] = $data->product_stock;
        $prod1['bproduct_id_fk'] = $data->bproduct_id_fk;
		echo json_encode($prod1);
	}

	public function edit_return($return_id)
	{
		$template['body'] = 'BProduct/add-return';
			$template['script'] = 'BProduct/script-return';
			$branch_id_fk=$this->session->userdata('branch_id_fk');
			$template['product'] = $this->Item_model->view_by($branch_id_fk);
		$template['records'] = $this->General_model->get_row('tbl_branch_return', 'return_id', $return_id);
		$this->load->view('template', $template);
	}

	public function delete_return(){
        $return_id = $this->input->post('return_id');
		$product_id_fk = $this->input->post('return_product_id_fk');
		$bproduct_id_fk = $this->input->post('return_bproduct_id_fk');
		$bt_stk = $this->input->post('return_stock');

		#########Master product update##################
		$datass = $this->General_model->get_row('tbl_product','product_id',$bproduct_id_fk);
		$updated_stk = intval($datass->product_stock) - intval($bt_stk);
		$stk_array = ['product_stock' => $updated_stk];
		$results = $this->General_model->update('tbl_product',$stk_array,'product_id',$bproduct_id_fk);
		//var_dump($results);die;

		#########Branch product update##################
		$data_return = $this->General_model->get_row('tbl_product','product_id',$product_id_fk);
		$updated_return_stk = intval($data_return->product_stock) + intval($bt_stk);
		$stk_return = ['product_stock' => $updated_return_stk];
		$result2 = $this->General_model->update('tbl_product',$stk_return,'product_id',$product_id_fk);

        $updateData = array('return_status' => 0);
        $data = $this->General_model->update('tbl_branch_return',$updateData,'return_id',$return_id);
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
	
}
