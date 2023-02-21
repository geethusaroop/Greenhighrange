<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Routsale extends MY_Controller
{
	public $table = 'tbl_routsale';
	public $table2 = 'tbl_product';
	public $page  = 'Routsale';
	public function __construct()
	{
		parent::__construct();
		if (!$this->is_logged_in()) {
			redirect('/login');
		}
		$this->load->model('General_model');
		$this->load->model('Routsale_model');
		$this->load->model('HSNcode_model');
		$this->load->model('Purchase_model');
		$this->load->model('Item_model');
		$this->load->model('Sale_model');
	}
	public function index()
	{
		
		$template['body'] = 'Routsale/list';
		$template['script'] = 'Routsale/script2';
		$this->load->view('template', $template);
	}


	public function add()
	{
		$this->form_validation->set_rules('routsale_driver', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			
			$template['body'] = 'Routsale/add';
			$template['script'] = 'Routsale/script';
			$template['unit'] = $this->Routsale_model->get_unit();
			$template['hsncode']=$this->HSNcode_model->gethsncode();
			$template['product_names'] = $this->Item_model->view();
			$this->load->view('template', $template);
		} else {
			//$routsale_id = $this->input->post('routsale_id');
			$routsale_product_id_fk=$this->input->post('product_name');
			$routsale_stock=$this->input->post('product_stock');
			 $temp =count($this->input->post('product_name'));
			for($i=0;$i<$temp;$i++){
				$data = array(
					'routsale_date' => $this->input->post('routsale_date'),
					'routsale_driver' => $this->input->post('routsale_driver'),
					'routsale_vehicle_no' => $this->input->post('routsale_vehicle_no'),
					'routsale_from' => $this->input->post('routsale_from'),
					'routsale_to' => $this->input->post('routsale_to'),
					'routsale_product_id_fk' => $routsale_product_id_fk[$i],
					 'routsale_stock' => $routsale_stock[$i],
					'routsale_status' => 1,
				);
			//	var_dump($data);die;
			
				$stok=$this->Purchase_model->get_current_productstock($routsale_product_id_fk[$i]);
            	$nwstk = $stok - $routsale_stock[$i];
				$updateData = array('product_stock' =>$nwstk);
				$datas = $this->General_model->update('tbl_product',$updateData,'product_id',$routsale_product_id_fk[$i]);
				$result = $this->General_model->add($this->table, $data);
				$response_text = 'Rootsale Stock added  successfully';
		   }

			if ($result) {
				$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			} else {
				$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
			redirect('/Routsale/', 'refresh');
		}
	}
	public function get()
	{
		$this->load->model('Routsale_model');
		$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
		$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
		$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
		$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
		$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';
		$param['item_name'] = (isset($_REQUEST['item_name'])) ? $_REQUEST['item_name'] : '';
		$data = $this->Routsale_model->getClassinfoTable($param);
		$json_data = json_encode($data);
		echo $json_data;
	}
	public function delete()
	{
		$routsale_id = $this->input->post('routsale_id');
		$updateData = array('product_status' => 0);
		$data = $this->General_model->update($this->table, $updateData, 'routsale_id', $routsale_id);
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
		redirect('/Routsale/', 'refresh');
	}
	public function edit($routsale_id)
	{
		$template['body'] = 'Routsale/add';
		$template['script'] = 'Routsale/script';
		$template['unit'] = $this->Routsale_model->get_unit();
		$template['hsncode']=$this->HSNcode_model->gethsncode();
		$template['product_names'] = $this->Item_model->view();
		$template['records'] = $this->General_model->get_row($this->table, 'routsale_id', $routsale_id);
		$this->load->view('template', $template);
	}

	public function getpstock()
    {
    $id = $this->input->post('id');
    $data = $this->Routsale_model->getpstock($id);
    $json_data = json_encode($data);
    echo $json_data;
    }

	public function getProductDetails1()
	{
		$prod1 = [];
		$pid = $this->input->post('pid');
		$data =  $this->Sale_model->get_row_barcode1($pid);
		
		$prod1['prod_cod'] = $data->product_code;
		$prod1['product_stock'] = $data->product_stock;
		echo json_encode($prod1);
	}
	
}
