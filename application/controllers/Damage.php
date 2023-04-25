<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Damage extends MY_Controller
{
	public $table = 'tbl_damage';
	public $table2 = 'tbl_product';
	public $page  = 'Damage';
	public function __construct()
	{
		parent::__construct();
		if (!$this->is_logged_in()) {
			redirect('/login');
		}
		$this->load->model('General_model');
		$this->load->model('Damage_model');
		$this->load->model('HSNcode_model');
		$this->load->model('Purchase_model');
		$this->load->model('Item_model');
		$this->load->model('Sale_model');
	}
	public function index()
	{
		
		$template['body'] = 'Damage/list';
		$template['script'] = 'Damage/script2';
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['product_names'] = $this->Item_model->view($branch_id_fk);
		$this->load->view('template', $template);
	}


	public function add()
	{
		$this->form_validation->set_rules('damage_date', 'Date', 'required');
		if ($this->form_validation->run() == FALSE) {
			$branch_id_fk=$this->session->userdata('branch_id_fk');
			$template['body'] = 'Damage/add';
			$template['script'] = 'Damage/script';
			$template['unit'] = $this->Damage_model->get_unit();
			$template['hsncode']=$this->HSNcode_model->gethsncode();
			$template['product_names'] = $this->Item_model->view($branch_id_fk);
			$this->load->view('template', $template);
		} else {
			$damage_id = $this->input->post('damage_id');
			$temp =count($this->input->post('damage_item_id_fk'));
			$product_id_fk=$this->input->post('damage_item_id_fk');
			$damage_count=$this->input->post('damage_count');
			$damage_unit=$this->input->post('damage_unit');
			$current_stock=$this->input->post('current_stock');
			$current_stock_unit=$this->input->post('current_stock_unit');
		//	$damage_remark=$this->input->post('damage_remark');
			$damage_date = $this->input->post('damage_date');
			$damage_bal = $this->input->post('damage_bal');
			for($i=0;$i<$temp;$i++){
				$data = array(
					'damage_item_id_fk' => $product_id_fk[$i],
					'damage_count' => $damage_count[$i],
					'damage_unit' => $damage_unit[$i],
					'current_stock' => $current_stock[$i],
					'current_stock_unit' => $current_stock_unit[$i],
					//'damage_remark' => $damage_remark[$i],
					'damage_date' => $this->input->post('damage_date'),
					'damage_status' => 1,
					);
					$result = $this->General_model->add($this->table, $data);
					//var_dump($result);die;
					$updateData = array('product_stock' =>$damage_bal[$i],'product_updated_date' => $this->input->post('damage_date'));
					$datas = $this->General_model->update('tbl_product',$updateData,'product_id',$product_id_fk[$i]);
					$response_text = 'Damaged Product added  successfully';
		   }
			if ($result) {
				$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
			} else {
				$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
			}
			redirect('/Damage/', 'refresh');
		}
	}
	public function get()
	{
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$this->load->model('Damage_model');
		$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
		$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
		$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
		$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
		$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';
		$param['product_id_fk'] = (isset($_REQUEST['product_id_fk'])) ? $_REQUEST['product_id_fk'] : '';
		$data = $this->Damage_model->getClassinfoTable($param,$branch_id_fk);
		$json_data = json_encode($data);
		echo $json_data;
	}

	
	public function deleteall()
	{
		$damage_id = $this->input->post('damage_id');
		//$records = $this->Damage_model->get_invc($damage_id);
		$records=$this->General_model->get_row($this->table, 'damage_id', $damage_id);
			//	var_dump($records);die;
		
		$stok = $this->Damage_model->get_prodstk($records->damage_item_id_fk);
			//var_dump($stok);die;
            $nwstk = $stok->product_stock + $records->damage_count;
            
			$updateData = array('product_stock' =>$nwstk);	
			
		$datas = $this->General_model->update('tbl_product',$updateData,'product_id',$records->damage_item_id_fk);
		$updateDatas = array('damage_status' => 0);
		$data = $this->General_model->update($this->table, $updateDatas, 'damage_id', $damage_id);
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
	
	public function edit($damage_id,$damage_item_id_fk)
	{
		$branch_id_fk=$this->session->userdata('branch_id_fk');
		$template['body'] = 'Damage/edit';
		$template['script'] = 'Damage/script2';
		$template['unit'] = $this->Damage_model->get_unit();
		$template['hsncode']=$this->HSNcode_model->gethsncode();
		$template['product_names'] = $this->Item_model->view($branch_id_fk);
		$template['records'] = $this->General_model->get_row($this->table, 'damage_id', $damage_id);
		$template['record'] = $this->General_model->get_row($this->table2, 'product_id', $damage_item_id_fk);
		$this->load->view('template', $template);
	}

	public function edit_damage()
	{
		$damage_id = $this->input->post('damage_id');
		$damage_count_old=$this->input->post('damage_count_old');
		$product_id_fk=$this->input->post('damage_item_id_fk');
		$damage_count=$this->input->post('damage_count');
		$damage_unit=$this->input->post('damage_unit');
		$current_stock=$this->input->post('current_stock');
		$bal=$current_stock+$damage_count_old;
	
		$damage_bal=$bal-$damage_count;

		//echo $bal;

	//	echo $damage_bal;
	//	die;

		$data = array(
			'damage_count' => $damage_count,
			'damage_date' => date('Y-m-d'),
			'damage_status' => 1,
			);
			$result =$this->General_model->update($this->table,$data,'damage_id',$damage_id);
			$updateData = array('product_stock' =>$damage_bal,'product_updated_date' => date('Y-m-d'));
			$datas = $this->General_model->update('tbl_product',$updateData,'product_id',$product_id_fk);
			$response_text = 'Damaged Product Updated  successfully';
   
	if ($result) {
		$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
	} else {
		$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
	}
	redirect('/Damage/', 'refresh');
	}

	public function getpstock()
	{
		$prod1 = [];
		$id = $this->input->post('pid');
		$data =  $this->Damage_model->getpstock($id);
		$prod1['product_stock'] = $data->product_stock;
		$prod1['unit_name'] = $data->unit_name;
		echo json_encode($prod1);
	}
	
}
