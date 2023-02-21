<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Productionitem extends MY_Controller
{
	public $table = 'tbl_product';
	public $table1 = 'tbl_production_unit';
	public $table2 = 'tbl_production_stock_history';
	public $page  = 'Product';
	public function __construct()
	{
		parent::__construct();
		if (!$this->is_logged_in()) {
			redirect('/login');
		}
		$this->load->model('General_model');
		$this->load->model('Productionitem_model');
		  $this->load->model('HSNcode_model');
		  $this->load->model('Item_model');
		
	}
	public function index()
	{
		
		$template['body'] = 'Productionitem/list';
		$template['script'] = 'Productionitem/script2';
		$this->load->view('template', $template);
	}

	public function view()
	{
		$template['body'] = 'Productionitem/list-view';
		$template['script'] = 'Productionitem/script-view';
		$this->load->view('template', $template);
	}

	public function transfer($punit_id,$product_id)
	{
		
		$template['body'] = 'Productionitem/add';
		$template['script'] = 'Productionitem/script';
		$template['product'] = $this->Item_model->view_by();
		$template['product_names'] = $this->Item_model->view_by1();
		$template['unit'] = $this->Productionitem_model->get_unit();
		$template['records'] = $this->General_model->get_row_ptransfer($punit_id);
		//$template['record'] = $this->General_model->get_row($this->table, 'product_id', $product_id);
		$this->load->view('template', $template);
	}

	public function gethsncode()
    {
    $id = $this->input->post('id');
    $data = $this->Productionitem_model->gethsncode($id);
    $json_data = json_encode($data);
    echo $json_data;
    }
	public function add()
	{
		/* $this->form_validation->set_rules('product_name', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			
			$template['body'] = 'Productionitem/add';
			$template['script'] = 'Productionitem/script';
			$template['product_names'] = $this->Item_model->view_by1();
			$template['unit'] = $this->Productionitem_model->get_unit();
			$template['hsncode']=$this->HSNcode_model->gethsncode();
			$this->load->view('template', $template);
		} else { */
			$punit_id= $this->input->post('punit_id');
			$product_id= $this->input->post('product_name');
			$temp =count($this->input->post('product_name'));
				$product_code = $this->input->post('prod_code');
				$product_unit = $this->input->post('product_unit');
				$product_stock = $this->input->post('product_stock');
				$product_des = $this->input->post('product_des');
				$product_created_date = $this->input->post('pstock_date');
				$punit_type = $this->input->post('punit_type');
				$product_price_r1=$this->input->post('product_price_r1');
				$product_price_r2=$this->input->post('product_price_r2');
				$product_price_r3=$this->input->post('product_price_r3');

			$data1 = array(
				'punit_weight' => strtoupper($this->input->post('punit_weight')),
				'punit_weight_unit' => strtoupper($this->input->post('punit_weight_unit')),
				'punit_waste' => strtoupper($this->input->post('punit_waste')),
				'punit_waste_unit' => strtoupper($this->input->post('punit_waste_unit')),
				'punit_process_date' => strtoupper($this->input->post('pstock_date')),
				'punit_proceed_status'=>1
			);
			//var_dump($data1);
			for($i=0;$i<$temp;$i++){
					$data = array(
						'product_code' => $product_code[$i],
						'product_unit' => $product_unit[$i],
						'product_stock' => $product_stock[$i],
						'product_price_r1' => $product_price_r1[$i],
						'product_price_r2' => $product_price_r2[$i],
						'product_price_r3' => $product_price_r3[$i],
						'product_des' => $product_des[$i],
						'product_created_date' => $this->input->post('pstock_date'),
						'product_status' => 1,
					);
				//	var_dump($data);

					$insert_array=[
						'pstock_product_id_fk'=>$product_id[$i],
						'pstock_total'=>$product_stock[$i],
						'pstock_unit'=>$product_unit[$i],
						'pstock_r1' => $product_price_r1[$i],
						'pstock_r2' => $product_price_r2[$i],
						'pstock_r3' => $product_price_r3[$i],
						'pstock_type'=>$this->input->post('punit_type'),
						'pstock_date'=>$this->input->post('pstock_date'),
						'pstock_punit_id_fk'=>$this->input->post('punit_id'),
						'pstock_status'=>1
					];

					//var_dump($insert_array);die;

					$result = $this->General_model->update($this->table, $data, 'product_id', $product_id[$i]);
				
					$insertion_status=$this->General_model->add('tbl_production_stock_history',$insert_array);
			}
			/* if ($pstock_id) {
				$result = $this->General_model->update('tbl_production_stock_history', $data, 'pstock_id', $pstock_id);
				$result = $this->General_model->update($this->table, $data, 'product_id', $product_id);
				$response_text = 'Product updated successfully';
			} else { */
				$result1 = $this->General_model->update($this->table1, $data1, 'punit_id', $punit_id);
			

				$response_text = 'Product added  successfully';
		//	}
			if ($result) {
				$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			} else {
				$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
			redirect('/Productionitem/view', 'refresh');
		//}
	}
	public function get()
	{
		$this->load->model('Productionitem_model');
		$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
		$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
		$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
		$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
		$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';
		$param['item_name'] = (isset($_REQUEST['item_name'])) ? $_REQUEST['item_name'] : '';
		$data = $this->Productionitem_model->getClassinfoTable($param);
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
		$template['body'] = 'Productionitem/add';
		$template['script'] = 'Productionitem/script';
		$template['product_names'] = $this->Item_model->view_by1();
		$template['unit'] = $this->Productionitem_model->get_unit();
		$template['hsncode']=$this->HSNcode_model->gethsncode();
		$template['records'] = $this->General_model->get_row($this->table, 'product_id', $product_id);
		$this->load->view('template', $template);
	}
	
}
