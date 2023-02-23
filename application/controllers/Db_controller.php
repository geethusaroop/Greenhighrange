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
	//	$sql="ALTER TABLE `tbl_sale` ADD `sale_discount` FLOAT NOT NULL AFTER `sale_status`, ADD `sale_old_balance` FLOAT NOT NULL AFTER `sale_discount`, ADD `sale_new_balance` FLOAT NOT NULL AFTER `sale_old_balance`";
		//$sql="ALTER TABLE `tbl_sale` ADD `sale_shareholder_discount` FLOAT NOT NULL AFTER `sale_status`";
		//$sql="ALTER TABLE `tbl_stock_history` ADD `purchase_id_fk` INT NOT NULL AFTER `stock_id`";
		//$sql="ALTER TABLE `tbl_routsale` ADD `routsale_sale_count` INT NOT NULL COMMENT 'total item saled' AFTER `routsale_stock`";
		//$sql="ALTER TABLE `tbl_sale` ADD `routsale_status` INT NOT NULL AFTER `invoice`";
		//$sql="ALTER TABLE `tbl_routsale` ADD `routsale_return_status` INT NOT NULL AFTER `routsale_return_stock`, ADD `routsale_return_date` DATE NOT NULL AFTER `routsale_return_status`";
		
		//notrun
		//$sql="DELETE FROM `tbl_product` WHERE `tbl_product`.`product_id` = 7";
		//$sql="DELETE FROM `tbl_product` WHERE `tbl_product`.`product_id` = 8";
		//$sql="DELETE FROM `tbl_product` WHERE `tbl_product`.`product_id` = 9";
		//$sql="DELETE FROM `tbl_product` WHERE `tbl_product`.`product_id` = 10";
		//$sql="DELETE FROM `tbl_product` WHERE `tbl_product`.`product_id` = 11";
	//	$sql="DELETE FROM `tbl_product` WHERE `tbl_product`.`product_id` = 12";

	/* $sql="CREATE TABLE IF NOT EXISTS `tbl_vendor_voucher` (
		`voucher_id` int(11) NOT NULL AUTO_INCREMENT,
		`project_id_fk` int(11) NOT NULL,
		`vendor_id_fk` int(11) NOT NULL,
		`finyear_id_fk` int(11) DEFAULT NULL,
		`voucher_amount` float DEFAULT NULL,
		`paid_to` varchar(255) DEFAULT NULL,
		`voucher_date` date DEFAULT NULL,
		`narration` varchar(255) DEFAULT NULL,
		`voucher_status` int(11) NOT NULL,
		`voucher_group` int(11) DEFAULT NULL,
		PRIMARY KEY (`voucher_id`)
	  ) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 "; */

		//$sql="TRUNCATE TABLE `tbl_branch_transfer`";
		$query = $this->db->query($sql);
		 if($query){ echo "Success"; }else{ echo "Failed"; } die;
	}
}
