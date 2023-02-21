<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Product extends MY_Controller
{
	public $table = 'tbl_product';
	public $table2 = 'tbl_product_category';
	public $page  = 'Product';
	public function __construct()
	{
		parent::__construct();
		if (!$this->is_logged_in()) {
			redirect('/login');
		}
		$this->load->model('General_model');
		$this->load->model('Product_model');
		  $this->load->model('HSNcode_model');
	}
	public function index()
	{
		
		$template['body'] = 'Product/list';
		$template['script'] = 'Product/script';
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
			
			$template['body'] = 'Product/add';
			$template['script'] = 'Product/script';
			$template['unit'] = $this->Product_model->get_unit();
			$template['hsncode']=$this->HSNcode_model->gethsncode();
			$this->load->view('template', $template);
		} else {
			$product_id = $this->input->post('product_id');
			$branch_id_fk=$this->session->userdata('branch_id_fk');
			$data = array(
				'branch_id_fk'=>$branch_id_fk,
				//'product_type' => $this->input->post('product_type'),
			//	'product_sub_type' => $this->input->post('subcategory'),
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
				'product_status' => 1,
				'product_category' => 1
			);
			$product_id = $this->input->post('product_id');
			if ($product_id) {
				$data['product_id'] = $product_id;
				$result = $this->General_model->update($this->table, $data, 'product_id', $product_id);
				$response_text = 'Product updated successfully';
			} else {
				$result = $this->General_model->add($this->table, $data);
				$response_text = 'Product added  successfully';
			}
			if ($result) {
				$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			} else {
				$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
			redirect('/Product/', 'refresh');
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
		redirect('/Product/', 'refresh');
	}
	public function edit($product_id)
	{
		$template['body'] = 'Product/add';
		$template['script'] = 'Product/script';
		$template['unit'] = $this->Product_model->get_unit();
		$template['hsncode']=$this->HSNcode_model->gethsncode();
		$template['records'] = $this->General_model->get_row($this->table, 'product_id', $product_id);
		$this->load->view('template', $template);
	}
	public function itemCategory()
	{
		
		$template['body'] = 'ProductCategory/list';
		$template['script'] = 'ProductCategory/script';
		$this->load->view('template', $template);
	}
	public function getItemCategory()
	{
		$this->load->model('Product_model');
		$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
		$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
		$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
		$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
		$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';
		$param['item_name'] = (isset($_REQUEST['item_name'])) ? $_REQUEST['item_name'] : '';
		$data = $this->Product_model->getCategoryInfoTable($param);
		$json_data = json_encode($data);
		echo $json_data;
	}
	public function addCategory()
	{
		$this->form_validation->set_rules('cat_name', ' Category Name', 'required');
		$this->form_validation->set_rules('cat_code', ' Category Code', 'required');
		if ($this->form_validation->run() == FALSE) {
			
			$template['body'] = 'ProductCategory/add';
			$template['script'] = 'ProductCategory/script';
			$template['unit'] = $this->Product_model->get_unit();
			$this->load->view('template', $template);
		} else {
			$prod_cat_id = $this->input->post('prod_cat_id');
			$data = array(
				'prod_cat_name' => $this->input->post('cat_name'),
				'prod_cat_code' => strtoupper($this->input->post('cat_code')),
			);
			if ($prod_cat_id) {
				$data['prod_cat_id'] = $prod_cat_id;
				$result = $this->General_model->update($this->table2, $data, 'prod_cat_id', $prod_cat_id);
				$response_text = 'Product Category updated successfully';
			} else {
				$result = $this->General_model->add($this->table2, $data);
				$response_text = 'Product Category added  successfully';
			}
			if ($result) {
				$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			} else {
				$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
			redirect('/Product/itemCategory', 'refresh');
		}
	}
	public function editCategory($prod_cat_id)
	{
		
		$template['body'] = 'ProductCategory/add';
		$template['script'] = 'ProductCategory/script';
		$template['records'] = $this->General_model->get_row($this->table2, 'prod_cat_id', $prod_cat_id);
		$this->load->view('template', $template);
	}
	public function deleteCategory()
	{
		$prod_cat_id = $this->input->post('prod_cat_id');
		$updateData = array('prod_cat_status' => 0);
		$data = $this->General_model->update($this->table2, $updateData, 'prod_cat_id', $prod_cat_id);
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
		redirect('/Product/itemCategory', 'refresh');
	}

	

	public function getSubCategories(){
		$result=$this->Product_model->get_subcategories();
		return $result;
	}
}
