<?php
defined('BASEPATH') or exit('No direct script access allowed');
class ProductTransfer extends MY_Controller
{
	public $table = 'tbl_production_unit';
	public $table2 = 'tbl_product';
	public $page  = 'ProductTransfer';
	public function __construct()
	{
		parent::__construct();
		if (!$this->is_logged_in()) {
			redirect('/login');
		}
		$this->load->model('General_model');
		$this->load->model('ProductTransfer_model');
		$this->load->model('HSNcode_model');
		$this->load->model('Purchase_model');
		$this->load->model('Item_model');
		$this->load->model('Sale_model');
	}
	public function index()
	{
		
		$template['body'] = 'ProductTransfer/list';
		$template['script'] = 'ProductTransfer/script2';
		$this->load->view('template', $template);
	}


	public function add()
	{
		$this->form_validation->set_rules('punit_date', 'Date', 'required');
		if ($this->form_validation->run() == FALSE) {
			$branch_id_fk=$this->session->userdata('branch_id_fk');
			$template['body'] = 'ProductTransfer/add';
			$template['script'] = 'ProductTransfer/script';
			$template['unit'] = $this->ProductTransfer_model->get_unit();
			$template['hsncode']=$this->HSNcode_model->gethsncode();
			$template['product_names'] = $this->Item_model->view_by($branch_id_fk);
			$admno = $this->ProductTransfer_model->get_admno($branch_id_fk);
			if(isset($admno->punit_id)){$adm=$admno->batch_no+1;}else{$adm=1;}
			$template['adm'] = $adm;
			$this->load->view('template', $template);
		} else {
			$punit_id = $this->input->post('punit_id');
			$temp =count($this->input->post('punit_product_id_fk'));
			$product_id_fk=$this->input->post('punit_product_id_fk');
			$punit_qty=$this->input->post('punit_qty');
			$punit_bal=$this->input->post('punit_bal');
			$punit_unit = $this->input->post('punit_unit');
			$punit_qty = $this->input->post('punit_qty');
			$punit_stock = $this->input->post('punit_stock');
			$punit_stock_unit = $this->input->post('punit_stock_unit');
			for($i=0;$i<$temp;$i++){
				$data = array(
					'punit_batch_no'=>$this->input->post('punit_batch_no'),
					'batch_no'=>$this->input->post('batch_no'),
					'punit_product_id_fk' => $product_id_fk[$i],
					'punit_unit' => $punit_unit[$i],
					'punit_qty' => $punit_qty[$i],
					'punit_stock' => $punit_stock[$i],
					'punit_stock_unit' => $punit_stock_unit[$i],
					'punit_bal_stock' => $punit_bal[$i],
					'punit_type' => $this->input->post('punit_type'),
					'punit_date' => $this->input->post('punit_date'),
					'punit_branch_id_fk'=>$this->session->userdata('branch_id_fk'),
					'punit_status' => 1,
					);
					$result = $this->General_model->add($this->table, $data);
					$updateData = array('product_stock' =>$punit_bal[$i],'product_updated_date' => $this->input->post('punit_date'));
					$datas = $this->General_model->update('tbl_product',$updateData,'product_id',$product_id_fk[$i]);
					$response_text = 'Product added  successfully';
		   }
			if ($result) {
				$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			} else {
				$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
			redirect('/ProductTransfer/', 'refresh');
		}
	}
	public function get()
	{
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$this->load->model('ProductTransfer_model');
		$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
		$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
		$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
		$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
		$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';
		$param['item_name'] = (isset($_REQUEST['item_name'])) ? $_REQUEST['item_name'] : '';
		$data = $this->ProductTransfer_model->getClassinfoTable($param,$branch_id_fk);
		$json_data = json_encode($data);
		echo $json_data;
	}
	public function delete()
	{
		$punit_id = $this->input->post('punit_id');
		$updateData = array('product_status' => 0);
		$data = $this->General_model->update($this->table, $updateData, 'punit_id', $punit_id);
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
		redirect('/ProductTransfer/', 'refresh');
	}

	public function get_invc()
	{
		$invc_no = $this->input->post('punit_batch_no');
		$data = $this->ProductTransfer_model->get_invc($invc_no);
		echo json_encode($data);
	}

	public function deleteall()
	{
		$punit_batch_no = $this->input->post('punit_batch_no');
		$records = $this->ProductTransfer_model->get_invc($punit_batch_no);
		for($i=0; $i< count($records); $i++)
		{
			$stok = $this->Sale_model->get_prodstk($records[$i]->product_id);
			//var_dump($stok);die;
            $nwstk = $stok[0]->product_stock + $records[$i]->punit_qty;
            
			$updateData = array('product_stock' =>$nwstk);	
			
			$datas = $this->General_model->update('tbl_product',$updateData,'product_id',$records[$i]->product_id);
		}
		$updateDatas = array('punit_status' => 0);
		$data = $this->General_model->update($this->table, $updateDatas, 'punit_batch_no', $punit_batch_no);
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
	public function edit($punit_id)
	{
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['body'] = 'ProductTransfer/add';
		$template['script'] = 'ProductTransfer/script';
		$template['unit'] = $this->ProductTransfer_model->get_unit();
		$template['hsncode']=$this->HSNcode_model->gethsncode();
		$template['product_names'] = $this->Item_model->view_by($branch_id_fk);
		$template['records'] = $this->General_model->get_row($this->table, 'punit_id', $punit_id);
		$this->load->view('template', $template);
	}

	/* public function getpstock()
    {
    $id = $this->input->post('id');
    $data = $this->ProductTransfer_model->getpstock($id);
    $json_data = json_encode($data);
    echo $json_data;
    } */

	public function getpstock()
	{
		$prod1 = [];
		$id = $this->input->post('pid');
		$data =  $this->ProductTransfer_model->getpstock($id);
		
		$prod1['product_stock'] = $data->product_stock;
		$prod1['unit_name'] = $data->unit_name;
		echo json_encode($prod1);
	}
	
}
