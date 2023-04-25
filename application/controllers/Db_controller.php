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
			
				'punit_batch_no' => [
					'type' => 'VARCHAR',
					'constraint' => '80',
				],

				'batch_no' => [
					'type' => 'INT',
				],

				'punit_product_cost' => [
					'type' => 'FLOAT',
				],

				'punit_purchase_cost' => [
					'type' => 'FLOAT',
				],
				
		];
	//	$query = $this->dbforge->add_column('tbl_production_unit',$fields);  //uncomment this line
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
		/* $sql="CREATE TABLE IF NOT EXISTS `tbl_branch_receipt` (
			`receipt_id` int(11) NOT NULL AUTO_INCREMENT,
			`branch_id_fk` int(11) NOT NULL,
			`receipt_id_fk` varchar(11) NOT NULL,
			`finyear_id_fk` int(11) NOT NULL,
			`receipt_number` int(11) NOT NULL,
			`receipt_amount` varchar(100) NOT NULL,
			`rept_date` date NOT NULL,
			`paid_to` varchar(200) NOT NULL,
			`narration` varchar(250) NOT NULL,
			`receipt_status` int(11) NOT NULL,
			`group` int(11) NOT NULL,
			PRIMARY KEY (`receipt_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1"; */

		  /* $sql="CREATE TABLE IF NOT EXISTS `tbl_branch_receipthead` (
			`receipt_id` int(11) NOT NULL AUTO_INCREMENT,
			`receipt_branch_id_fk` varchar(100) NOT NULL,
			`fin_year` varchar(100) NOT NULL,
			`receipt_head` varchar(250) NOT NULL,
			`receipt_desc` varchar(255) NOT NULL,
			`receipt_date` date NOT NULL,
			`receipt_status` int(11) NOT NULL,
			PRIMARY KEY (`receipt_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1"; */

		 /*  $sql="CREATE TABLE IF NOT EXISTS `tbl_branch_voucher` (
			`voucher_id` int(11) NOT NULL AUTO_INCREMENT,
			`branch_id_fk` int(11) NOT NULL,
			`vouch_id_fk` int(11) NOT NULL,
			`finyear_id_fk` int(11) NOT NULL,
			`voucher_number` varchar(50) NOT NULL,
			`voucher_amount` varchar(100) NOT NULL,
			`paid_to` varchar(200) NOT NULL,
			`voucher_date` date NOT NULL,
			`narration` varchar(250) NOT NULL,
			`voucher_status` int(11) NOT NULL,
			`voucher_group` int(11) NOT NULL,
			PRIMARY KEY (`voucher_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1"; */

		/*   $sql="CREATE TABLE IF NOT EXISTS `tbl_branch_vouchhead` (
			`vouch_id` int(11) NOT NULL AUTO_INCREMENT,
			`vouch_branch_id_fk` varchar(100) NOT NULL,
			`fin_year` varchar(100) NOT NULL,
			`vouch_head` varchar(250) NOT NULL,
			`vouch_desc` varchar(255) NOT NULL,
			`vouch_date` date NOT NULL,
			`vouch_status` int(11) NOT NULL,
			PRIMARY KEY (`vouch_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1"; */

		 // $sql="ALTER TABLE `tbl_bank` ADD `bank_branch_id_fk` INT NOT NULL AFTER `bank_id`";

	//	$sql="UPDATE `tbl_production_unit` SET `punit_batch_no` = 'BATCH0002' WHERE `tbl_production_unit`.`punit_id` between 14 and 16";

		//$sql="ALTER TABLE `tbl_production_stock_history` CHANGE `pstock_punit_id_fk` `pstock_punit_id_fk` VARCHAR(50) NOT NULL";
		
		//$sql="TRUNCATE TABLE `tbl_branch_transfer`";

		//$sql="ALTER TABLE `tbl_bank_deposit` CHANGE `bd_type` `bd_type` INT(11) NOT NULL COMMENT '1=member_deposit,2=others,3=supplier_withdraw'";
		
		$sql="ALTER TABLE `tbl_vendor` ADD `vendortype` INT NOT NULL AFTER `vendorstatus`";

		//$sql="ALTER TABLE `tbl_member` CHANGE `member_bank` `member_bank` VARCHAR(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL"
		
	//	$sql="ALTER TABLE `tbl_member` CHANGE `member_account` `member_account` VARCHAR(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL, CHANGE `member_ifsc` `member_ifsc` VARCHAR(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL";
		

	//$sql="ALTER TABLE `tbl_member` CHANGE `member_address` `member_address` VARCHAR(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL";
	
//	$sql="ALTER TABLE `tbl_member` CHANGE `member_pnumber` `member_pnumber` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL, CHANGE `member_wnumber` `member_wnumber` VARCHAR(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL";
	
	/* $sql="CREATE TABLE IF NOT EXISTS `tbl_branch_return` (
			`return_id` int(11) NOT NULL AUTO_INCREMENT,
			`return_branch_id_fk` int(11) NOT NULL,
			`return_product_id_fk` int(11) NOT NULL,
			`return_bproduct_id_fk` int(11) NOT NULL,
			`return_stock` int(11) NOT NULL,
			`return_date` date NOT NULL,
			`return_status` int(11) NOT NULL,
			PRIMARY KEY (`return_id`)
		  ) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1"; */
		  
		 /*  $sql="CREATE TABLE IF NOT EXISTS `tbl_customer_receipt` (
			`receipt_id` int(11) NOT NULL AUTO_INCREMENT,
			`receipt_branch_id_fk` int(11) NOT NULL,
			`receipt_member_id_fk` int(11) NOT NULL,
			`finyear_id_fk` int(11) DEFAULT NULL,
			`receipt_amount` float DEFAULT NULL,
			`paid_to` varchar(255) DEFAULT NULL,
			`receipt_date` date DEFAULT NULL,
			`narration` varchar(255) DEFAULT NULL,
			`receipt_status` int(11) NOT NULL,
			`receipt_group` int(11) DEFAULT NULL,
			PRIMARY KEY (`receipt_id`)
		  ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb3"; */
		/*   $sql="CREATE TABLE IF NOT EXISTS `tbl_damage` (
			`damage_id` int(11) NOT NULL AUTO_INCREMENT,
			`damage_item_id_fk` int(11) NOT NULL,
			`damage_count` float NOT NULL,
			`damage_unit` int(11) NOT NULL,
			`current_stock` float NOT NULL,
			`current_stock_unit` varchar(20) NOT NULL,
			`damage_remark` varchar(80) NOT NULL,
			`damage_date` date NOT NULL,
			`damage_status` int(11) NOT NULL,
			PRIMARY KEY (`damage_id`)
		  ) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=latin1"; */
		//  $sql="ALTER TABLE `tbl_product` CHANGE `product_open_stock` `product_open_stock` FLOAT(11) NOT NULL, CHANGE `product_stock` `product_stock` FLOAT(20) NOT NULL";
		
	//	$sql="ALTER TABLE `tbl_sale` ADD `return_taxamount` FLOAT NOT NULL AFTER `return_qty`, ADD `return_igst` FLOAT NOT NULL AFTER `return_taxamount`, ADD `return_igstamt` FLOAT NOT NULL AFTER `return_igst`,ADD `return_status` INT NOT NULL AFTER `return_date`";
		$sql="ALTER TABLE `tbl_sale` ADD `sale_shareholder_discount_amount` FLOAT NOT NULL AFTER `sale_discount`, ADD `sale_net_total` FLOAT NOT NULL COMMENT 'final sale amount' AFTER `sale_shareholder_discount_amount`"; 
		
		
		$query = $this->db->query($sql);
		 if($query){ echo "Success"; }else{ echo "Failed"; } die;
	}
}
