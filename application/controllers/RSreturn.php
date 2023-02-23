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
		$template['script'] = 'RSreturn/script2';
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
        $param['sdate'] = (isset($_REQUEST['sdate'])) ? $_REQUEST['sdate'] : '';
		$data = $this->Routsale_model->getClassinfoTablereturn($param,$date);
		$json_data = json_encode($data);
		echo $json_data;
    }

    public function addreturn_view()
	{
		$date=date('Y-m-d');
		$template['body'] = 'RSreturn/add';
		$template['script'] = 'RSreturn/script2';
        $template['records']=$this->Routsale_model->return_stock($date);
		$this->load->view('template',$template);
	}

	public function add(){
	 
			$temp =count($this->input->post('product_id_fk'));
			$product_id_fk = $this->input->post('product_id_fk');
			$routsale_return_stock = $this->input->post('routsale_return_stock');
			$routsale_return_date = $this->input->post('routsale_return_date');
		
            for($i=0;$i<$temp;$i++){
				$data = array(
						'routsale_return_date'=>$routsale_return_date,
						'routsale_return_stock' => $routsale_return_stock[$i],
						'routsale_return_status' => 1
							);
				//add to sale
                $result = $this->General_model->update($this->table1,$data,'routsale_product_id_fk',$product_id_fk[$i]);

				####################################################################################################
				$stok=$this->Purchase_model->get_current_productstock($product_id_fk[$i]);
				$rsnwstk = $stok + $routsale_return_stock[$i];
				$rsData = array(
					'product_stock' =>$rsnwstk,
					);
				$result = $this->General_model->update($this->tbl_stock,$rsData,'product_id',$product_id_fk[$i]);


                }

                $response_text = 'Stock Return added  successfully';
				####################################################################################################
                if ($result) {
                    $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
                } else {
                    $this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
                }
			
	            redirect('/RSreturn/', 'refresh');
		
	}


}
