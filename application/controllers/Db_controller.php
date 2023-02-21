<?php
ob_start();
defined('BASEPATH') or exit('No direct script access allowed');
class Db_controller extends MY_Controller
{
	public $page  = 'Dashboard';
	public function __construct()
	{
		parent::__construct();
		if (!$this->is_logged_in()) {
			redirect('/login');
		}
	}
	public function createTable()
	{
		$this->load->dbforge();
		$fields = [
			'cat_id' => [
				'type' => 'INT',
				'constraint' => '11',
				'auto_increment' => TRUE
			],
		
            'cat_name' => [
				'type' => 'VARCHAR',
				'constraint' => '100',
				'default' => NULL,
			],
          
			'cat_status' => [
				'type' => 'INT',
				'constraint' => '11',
			],
		];
		$this->dbforge->add_field($fields);
		$this->dbforge->add_key('cat_id', TRUE);
		//edit here table name
	//$query = $this->dbforge->create_table('tbl_category');
		if ($query) {
			echo "Success";
		} else {
			echo "failed";
		}
	}
	public function modifyTable()
	{
		$this->load->dbforge();
		$fields = [
			'scheme_status' => [
				'type' => 'VARCHAR',
				'constraint' => '50',
			],	
		];
	 	//$query = $this->dbforge->modify_column('tbl_scheme', $fields);
		if ($query) {
			echo "Success";
		} else {
			echo "failed";
		} 
	}
	public function alterTable()
	{
		$this->load->dbforge();
		$fields = [
			
				'purchase_ven_discount' => [
					'type' => 'FLOAT',
					'default' => NULL,
				],
				
		];
		//$query = $this->dbforge->add_column('tbl_mara_purchase',$fields);  //uncomment this line
		if ($query) {
			echo "Success";
		} else {
			echo "failed";
		} 
	}
	public function truncateTable()
	{
		$this->load->dbforge();
		//$query=$this->db->truncate('tbl_purchase');
		if ($query) {
			echo "Success";
		} else {
			echo "failed";
		}
	}
	public function dropTable()
	{
		$this->load->dbforge();
		//$query = $this->dbforge->drop_table('ntbl_stock_incoming');
		if ($query) {
			echo "Success";
		} else {
			echo "failed";
		}
	}
	public function mydb_backup()
	{
		$this->load->dbutil();
		$prefs = array(
			'format'      => 'zip',
			'filename'    => 'my_db_backup.sql'
		);
		$backup = &$this->dbutil->backup($prefs);
		$db_name = 'backup-on-' . date("Y-m-d-H-i-s") . '.zip';
		/* $save = 'pathtobkfolder/'.$db_name;
$this->load->helper('file');
write_file($save, $backup);  */
		$this->load->helper('download');
		force_download($db_name, $backup);
	}
	public function run_sql(){
		//$sql="ALTER TABLE `tbl_sale` ADD `invoice` INT NOT NULL AFTER `product_code`";
		$sql="UPDATE `tbl_product` SET `product_stock` = '1100' WHERE `tbl_product`.`product_id` = 1";
		//$sql="ALTER TABLE `tbl_employee` DROP `emp_designation`";
		$query = $this->db->query($sql);
		 if($query){ echo "Success"; }else{ echo "Failed"; } die;
	}
}
